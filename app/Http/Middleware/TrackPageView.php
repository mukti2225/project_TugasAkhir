<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && !$request->is('admin/*')) {
            PageView::create([
                'url'        => $request->path(),
                'ip_address' => $request->ip(),
                'session_id' => session()->getId(),
                'user_agent' => $request->userAgent(),
                'referer'    => $request->headers->get('referer'),
            ]);
        }

        return $next($request);
    }
}
