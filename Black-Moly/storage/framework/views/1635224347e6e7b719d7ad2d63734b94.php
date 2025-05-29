<!-- resources/views/components/chatbot.blade.php -->
<?php if(auth()->guard()->check()): ?>
    <div class="chatbot-container">
        <div class="chatbot-icon" id="chatbot-toggle">
            <i class="fa fa-comment"></i>
        </div>
        <div class="chatbot-box" id="chatbot-box" style="display: none;">
            <div class="chatbot-header">
                <h4>Auto-Moly Assistant</h4>
                <span class="close-chat" id="close-chat"><i class="fa fa-times"></i></span>
            </div>
            <div class="chatbot-messages" id="chatbot-messages">
                <div class="bot-message">
                    <div class="message-content">Hello! How can I help you with your vehicle search today?</div>
                </div>
            </div>
            <div class="chatbot-input">
                <form id="chatbot-form">
                    <input type="text" id="user-message" placeholder="Type your message..." required>
                    <button type="submit"><i class="fa fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .chatbot-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        font-family: 'Arial', sans-serif;
    }

    .chatbot-icon {
        background-color: #0056b3;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .chatbot-icon i {
        font-size: 24px;
    }

    .chatbot-box {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
    }

    .chatbot-header {
        background-color: #0056b3;
        color: white;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-header h4 {
        margin: 0;
    }

    .close-chat {
        cursor: pointer;
    }

    .chatbot-messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
    }

    .user-message, .bot-message {
        margin-bottom: 15px;
        display: flex;
    }

    .user-message {
        justify-content: flex-end;
    }

    .message-content {
        max-width: 80%;
        padding: 10px 15px;
        border-radius: 18px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .user-message .message-content {
        background-color: #0056b3;
        color: white;
    }

    .bot-message .message-content {
        background-color: #f1f1f1;
        color: #333;
    }

    .chatbot-input {
        border-top: 1px solid #e0e0e0;
        padding: 10px;
    }

    .chatbot-input form {
        display: flex;
    }

    .chatbot-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-right: 10px;
    }

    .chatbot-input button {
        background-color: #0056b3;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    .typing-indicator {
        display: flex;
        align-items: center;
    }

    .typing-indicator .message-content {
        display: flex;
        align-items: center;
    }

    .typing-indicator .dot {
        height: 8px;
        width: 8px;
        border-radius: 50%;
        background-color: #888;
        margin: 0 2px;
        animation: typing 1s infinite;
    }

    .typing-indicator .dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-5px);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotBox = document.getElementById('chatbot-box');
        const closeChat = document.getElementById('close-chat');
        const chatbotForm = document.getElementById('chatbot-form');
        const userMessageInput = document.getElementById('user-message');
        const chatbotMessages = document.getElementById('chatbot-messages');

        // Check if all elements exist before setting up event listeners
        if (!chatbotToggle || !chatbotBox || !closeChat || !chatbotForm) {
            console.error('One or more chatbot elements not found');
            return;
        }

        // Toggle chatbot visibility
        chatbotToggle.addEventListener('click', function() {
            chatbotBox.style.display = 'flex';
        });

        closeChat.addEventListener('click', function() {
            chatbotBox.style.display = 'none';
        });

        // Handle form submission
        chatbotForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const userMessage = userMessageInput.value.trim();
            if (!userMessage) return;

            // Add user message to chat
            addMessage('user', userMessage);
            userMessageInput.value = '';

            // Show typing indicator
            const typingIndicator = document.createElement('div');
            typingIndicator.className = 'bot-message typing-indicator';
            typingIndicator.innerHTML = '<div class="message-content"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>';
            chatbotMessages.appendChild(typingIndicator);
            scrollToBottom();

            // Get CSRF token - look for meta tag or input field
            let csrfToken = '';
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            const inputToken = document.querySelector('input[name="_token"]');

            if (metaToken) {
                csrfToken = metaToken.getAttribute('content');
            } else if (inputToken) {
                csrfToken = inputToken.value;
            } else {
                console.error('CSRF token not found');
                // Remove typing indicator and show error
                chatbotMessages.removeChild(typingIndicator);
                addMessage('bot', 'Sorry, there was a security error. Please refresh the page and try again.');
                return;
            }

            // Send to server
            // Modify just the fetch part of your existing chatbot script
            fetch('/chatbot/query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ query: userMessage })
            })
                .then(response => {
                    if (!response.ok) {
                        // Get the error message from the response if possible
                        return response.json().then(errorData => {
                            console.error('Server error response:', errorData);
                            throw new Error(errorData.message || errorData.error || 'Server error');
                        }).catch(jsonError => {
                            // If we can't parse the JSON, just throw the HTTP status
                            throw new Error(`Server error: ${response.status} ${response.statusText}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Remove typing indicator
                    if (typingIndicator.parentNode) {
                        chatbotMessages.removeChild(typingIndicator);
                    }

                    // Check if response exists before using it
                    if (data && data.response) {
                        addMessage('bot', data.response);
                    } else if (data && data.error) {
                        addMessage('bot', 'Error: ' + data.error);
                    } else {
                        addMessage('bot', 'Sorry, I received an empty response. Please try again.');
                        console.error('Empty response data:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Remove typing indicator if it still exists
                    if (typingIndicator.parentNode) {
                        chatbotMessages.removeChild(typingIndicator);
                    }

                    addMessage('bot', 'Sorry, I encountered an error: ' + error.message);
                });
        });

        function addMessage(type, content) {
            if (content === undefined || content === null) {
                console.error('Message content is undefined or null');
                content = 'Error: No message content';
            }

            const messageDiv = document.createElement('div');
            messageDiv.className = type === 'user' ? 'user-message' : 'bot-message';

            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            contentDiv.textContent = content; // Using textContent instead of innerHTML for security

            messageDiv.appendChild(contentDiv);
            chatbotMessages.appendChild(messageDiv);
            scrollToBottom();
        }

        function scrollToBottom() {
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }
    });
</script>
<?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/components/chatbot.blade.php ENDPATH**/ ?>