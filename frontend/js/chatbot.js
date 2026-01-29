// ===================================
// CHATBOT JAVASCRIPT (Gemini AI)
// ===================================

const chatbotToggle = document.getElementById('chatbot-toggle');
const chatbotWidget = document.getElementById('chatbot-widget');
const closeChatbot = document.getElementById('close-chatbot');
const chatbotMessages = document.getElementById('chatbot-messages');
const chatbotInputField = document.getElementById('chatbot-input-field');
const chatbotSend = document.getElementById('chatbot-send');
const openChatbotBtn = document.getElementById('open-chatbot');

// Toggle chatbot
chatbotToggle?.addEventListener('click', () => {
    chatbotWidget.classList.toggle('active');
    if (chatbotWidget.classList.contains('active')) {
        chatbotInputField.focus();
        // Remove badge
        const badge = chatbotToggle.querySelector('.chatbot-badge');
        if (badge) badge.style.display = 'none';
    }
});

openChatbotBtn?.addEventListener('click', (e) => {
    e.preventDefault();
    chatbotWidget.classList.add('active');
    chatbotInputField.focus();
});

closeChatbot?.addEventListener('click', () => {
    chatbotWidget.classList.remove('active');
});

// Send message
async function sendMessage() {
    const message = chatbotInputField.value.trim();
    if (!message) return;
    
    // Add user message to chat
    addMessage(message, 'user');
    chatbotInputField.value = '';
    
    // Show typing indicator
    const typingId = addTypingIndicator();
    
    try {
        // Call chatbot API
        const response = await fetch('../backend/api/chatbot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message })
        });
        
        const data = await response.json();
        
        // Remove typing indicator
        removeTypingIndicator(typingId);
        
        if (data.success) {
            addMessage(data.response, 'bot');
        } else {
            addMessage('Maaf, saya mengalami kesulitan. Silakan coba lagi.', 'bot');
        }
        
    } catch (error) {
        console.error('Chatbot error:', error);
        removeTypingIndicator(typingId);
        addMessage('Maaf, terjadi kesalahan. Silakan coba lagi nanti.', 'bot');
    }
}

// Add message to chat
function addMessage(text, sender) {
    const messageDiv = document.createElement('div');
    messageDiv.className = sender === 'user' ? 'user-message' : 'bot-message';
    
    messageDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-${sender === 'user' ? 'user' : 'robot'}"></i>
        </div>
        <div class="message-content">${escapeHtml(text)}</div>
    `;
    
    chatbotMessages.appendChild(messageDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

// Add typing indicator
function addTypingIndicator() {
    const typingDiv = document.createElement('div');
    typingDiv.className = 'bot-message typing-indicator';
    typingDiv.id = 'typing-' + Date.now();
    
    typingDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-robot"></i>
        </div>
        <div class="message-content">
            <div class="typing-dots">
                <span></span><span></span><span></span>
            </div>
        </div>
    `;
    
    // Add CSS for typing animation
    const style = document.createElement('style');
    style.textContent = `
        .typing-dots {
            display: flex;
            gap: 4px;
            padding: 8px 0;
        }
        .typing-dots span {
            width: 8px;
            height: 8px;
            background: #64748b;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }
        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }
    `;
    if (!document.querySelector('#typing-animation-style')) {
        style.id = 'typing-animation-style';
        document.head.appendChild(style);
    }
    
    chatbotMessages.appendChild(typingDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    
    return typingDiv.id;
}

// Remove typing indicator
function removeTypingIndicator(id) {
    const typingDiv = document.getElementById(id);
    if (typingDiv) {
        typingDiv.remove();
    }
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Event listeners
chatbotSend?.addEventListener('click', sendMessage);

chatbotInputField?.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

// Quick suggestions (optional)
const quickSuggestions = [
    'Apa itu FloodGuard?',
    'Bagaimana cara mencegah banjir?',
    'Apa yang harus dilakukan saat banjir?',
    'Kontak darurat banjir Jakarta'
];

function addQuickSuggestions() {
    const suggestionsDiv = document.createElement('div');
    suggestionsDiv.className = 'quick-suggestions';
    suggestionsDiv.style.cssText = `
        padding: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    `;
    
    quickSuggestions.forEach(suggestion => {
        const btn = document.createElement('button');
        btn.textContent = suggestion;
        btn.style.cssText = `
            padding: 0.5rem 1rem;
            background: var(--lighter-bg);
            border: 1px solid var(--light-bg);
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--text-dark);
            transition: var(--transition);
        `;
        
        btn.addEventListener('click', () => {
            chatbotInputField.value = suggestion;
            sendMessage();
            suggestionsDiv.remove();
        });
        
        btn.addEventListener('mouseenter', () => {
            btn.style.background = 'var(--primary-light)';
            btn.style.color = 'var(--lighter-bg)';
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.background = 'var(--lighter-bg)';
            btn.style.color = 'var(--text-dark)';
        });
        
        suggestionsDiv.appendChild(btn);
    });
    
    chatbotMessages.appendChild(suggestionsDiv);
}

// Add suggestions on first open
let firstOpen = true;
chatbotToggle?.addEventListener('click', () => {
    if (firstOpen && chatbotWidget.classList.contains('active')) {
        setTimeout(addQuickSuggestions, 500);
        firstOpen = false;
    }
});