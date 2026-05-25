<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class OcrValidationService
{
    public function extractText(string $filePath): string
    {
        try {
            $fullPath = Storage::disk('public')->path($filePath);
            $ext      = strtoupper(pathinfo($filePath, PATHINFO_EXTENSION));

            $multipart = [
                [
                    'name'     => 'apikey',
                    'contents' => env('OCR_SPACE_API_KEY', 'helloworld'),
                ],
                [
                    'name'     => 'isOverlayRequired',
                    'contents' => 'false',
                ],
                [
                    'name'     => 'OCREngine',
                    'contents' => '2',
                ],
                [
                    'name'     => 'filetype',
                    'contents' => $ext,
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($fullPath, 'r'),
                    'filename' => basename($fullPath),
                ],
            ];

            if ($ext === 'PDF') {
                $multipart[] = [
                    'name'     => 'isCreateSearchablePdf',
                    'contents' => 'false',
                ];
                $multipart[] = [
                    'name'     => 'isSearchablePdfHideTextLayer',
                    'contents' => 'false',
                ];
            }

            $response = Http::timeout(60)->asMultipart()->post( 
                'https://api.ocr.space/parse/image',
                $multipart
            );

            if ($response->failed()) {
                Log::error('OCR.space failed', ['body' => $response->body()]);
                return '';
            }

            $parsed = $response->json();

            if ($parsed['IsErroredOnProcessing'] ?? false) {
                Log::error('OCR.space error', ['message' => $parsed['ErrorMessage']]);
                return '';
            }
            
            $text = collect($parsed['ParsedResults'] ?? [])
                ->pluck('ParsedText')
                ->join(' ');

            return strtolower(trim($text));

        } catch (\Exception $e) {
            Log::error('OCR Exception: ' . $e->getMessage());
            return '';
        }
    }

    public function validateIjazah(string $filePath): array
    {
        $text     = $this->extractText($filePath);
        $keywords = ['ijazah', 'surat keterangan lulus', 'skl'];
        $matched  = collect($keywords)->first(fn($k) => str_contains($text, $k));
        $valid    = $matched !== null;

        return [
            'valid'     => $valid,
            'matched'   => $matched ?? null,
            'message'   => $valid
                            ? "✅ Terdeteksi sebagai Ijazah/SKL (kata kunci: \"{$matched}\")"
                            : '❌ Dokumen tidak terdeteksi sebagai Ijazah/SKL',
            'extracted' => substr($text, 0, 300),
        ];
    }

    public function validateKartuKeluarga(string $filePath): array
    {
        $text     = $this->extractText($filePath);
        $keywords = ['kartu keluarga'];
        $matched  = collect($keywords)->first(fn($k) => str_contains($text, $k));
        $valid    = $matched !== null;

        return [
            'valid'     => $valid,
            'matched'   => $matched ?? null,
            'message'   => $valid
                            ? "✅ Terdeteksi sebagai Kartu Keluarga (kata kunci: \"{$matched}\")"
                            : '❌ Dokumen tidak terdeteksi sebagai Kartu Keluarga',
            'extracted' => substr($text, 0, 300),
        ];
    }

    public function validateAkta(string $filePath): array
    {
        $text     = $this->extractText($filePath);
        $keywords = ['akta kelahiran', 'akta lahir', 'kutipan akta'];
        $matched  = collect($keywords)->first(fn($k) => str_contains($text, $k));
        $valid    = $matched !== null;

        return [
            'valid'     => $valid,
            'matched'   => $matched ?? null,
            'message'   => $valid
                            ? "✅ Terdeteksi sebagai Akta Kelahiran (kata kunci: \"{$matched}\")"
                            : '❌ Dokumen tidak terdeteksi sebagai Akta Kelahiran',
            'extracted' => substr($text, 0, 300),
        ];
    }
}