<section class="chatbot">
<div id="chat-toggle" onclick="toggleChat()">💬</div>

    <div id="chat-box" class="hidden">
        <div class="chat-header">
            <span>Asisten Sekolah</span>
            <button onclick="toggleChat()">✖</button>
        </div>

        <div id="chat-body" class="chat-body"></div>

        <div class="chat-input">
            <input type="text" id="message" placeholder="Tanya sesuatu...">
            <button onclick="sendMessage()">➤</button>
        </div>
    </div>

<script>
function appendMessage(type, text) {
    let chat = document.getElementById('chat-body');

    let bubble = document.createElement('div');
    bubble.classList.add('chat-bubble', type);
    bubble.innerText = text;

    chat.appendChild(bubble);
    chat.scrollTop = chat.scrollHeight;
}

function showTyping() {
    let chat = document.getElementById('chat-body');

    let typing = document.createElement('div');
    typing.classList.add('typing');
    typing.id = 'typing';
    typing.innerText = "Bot sedang mengetik...";

    chat.appendChild(typing);
    chat.scrollTop = chat.scrollHeight;
}

function removeTyping() {
    let typing = document.getElementById('typing');
    if (typing) typing.remove();
}

function toggleChat() {
    document.getElementById('chat-box').classList.toggle('hidden');
}

function sendMessage() {
    let input = document.getElementById('message');
    let msg = input.value.trim();

    if (msg === '') return;

    appendMessage('user', msg);

    input.value = '';
    input.focus();

    showTyping();

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ message: msg })
    })
    .then(res => res.json())
    .then(data => {
        removeTyping();
        appendMessage('bot', data.reply);
    });
}

// ✅ FIX DI SINI
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("message").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessage();
        }
    });
});
</script>
</section>
