<!-- Floating Chatbot Widget -->
<div id="chatbot-widget" class="chatbot-widget">
    <!-- Chatbot Toggle Button -->
    <div class="chatbot-toggle" id="chatbotToggle">
        <i class="fas fa-comments"></i>
        <span class="notification-badge" id="notificationBadge" style="display: none;">1</span>
    </div>
    
    <!-- Chatbot Container -->
    <div class="chatbot-panel" id="chatbotPanel">
        <div class="chatbot-header">
            <h5><i class="fas fa-robot me-2"></i>QC App Assistant</h5>
            <button class="btn-close" id="closeChatbot">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chatbot-messages" id="widgetChatMessages">
            <div class="welcome-message">
                <i class="fas fa-comments"></i> Hi! How can I help you today?
            </div>
        </div>
        
        <div class="typing-indicator" id="widgetTypingIndicator">
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <div class="chatbot-input">
            <div class="input-group">
                <input type="text" class="form-control" id="widgetMessageInput" placeholder="Type your message...">
                <button class="btn btn-send" id="widgetSendButton">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            
            <div class="suggestions" id="widgetSuggestions">
                <!-- Suggestions will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<style>
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.chatbot-toggle {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    position: relative;
}

.chatbot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.chatbot-panel {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-panel.active {
    display: flex;
}

.chatbot-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.btn-close {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.btn-close:hover {
    background: rgba(255,255,255,0.2);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background: #f8f9fa;
}

.welcome-message {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    margin-bottom: 15px;
    font-size: 14px;
}

.message {
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
}

.message.user {
    justify-content: flex-end;
}

.message.bot {
    justify-content: flex-start;
}

.message-content {
    max-width: 80%;
    padding: 8px 12px;
    border-radius: 15px;
    font-size: 13px;
    word-wrap: break-word;
}

.message.user .message-content {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom-right-radius: 5px;
}

.message.bot .message-content {
    background: white;
    color: #333;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 5px;
}

.message-avatar {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 8px;
    font-size: 12px;
}

.message.user .message-avatar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.message.bot .message-avatar {
    background: #28a745;
    color: white;
}

.typing-indicator {
    display: none;
    padding: 8px 12px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    border-bottom-left-radius: 5px;
    margin-bottom: 10px;
    max-width: 80%;
}

.typing-dots {
    display: flex;
    align-items: center;
}

.typing-dots span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #667eea;
    margin: 0 2px;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: -0.32s; }
.typing-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes typing {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

.chatbot-input {
    padding: 15px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.input-group {
    position: relative;
    margin-bottom: 10px;
}

.form-control {
    border-radius: 20px;
    border: 1px solid #e9ecef;
    padding: 8px 15px;
    font-size: 13px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-send {
    border-radius: 50%;
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-send:hover {
    transform: scale(1.1);
}

.suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.suggestion-btn {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 5px 10px;
    font-size: 11px;
    color: #667eea;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.suggestion-btn:hover {
    background: #667eea;
    color: white;
}

@media (max-width: 768px) {
    .chatbot-panel {
        width: 300px;
        height: 400px;
        bottom: 70px;
        right: 10px;
    }
    
    .chatbot-toggle {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}
</style>

<script>
$(document).ready(function() {
    const chatbotToggle = $('#chatbotToggle');
    const chatbotPanel = $('#chatbotPanel');
    const closeChatbot = $('#closeChatbot');
    const widgetChatMessages = $('#widgetChatMessages');
    const widgetMessageInput = $('#widgetMessageInput');
    const widgetSendButton = $('#widgetSendButton');
    const widgetTypingIndicator = $('#widgetTypingIndicator');
    const widgetSuggestions = $('#widgetSuggestions');
    const notificationBadge = $('#notificationBadge');
    
    // Set CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
    // Initial suggestions
    updateWidgetSuggestions([
        'How do I apply?',
        'What documents?',
        'How much fees?',
        'Processing time?',
        'Contact support?'
    ]);
    
    // Toggle chatbot
    chatbotToggle.click(function() {
        chatbotPanel.toggleClass('active');
        notificationBadge.hide();
        if (chatbotPanel.hasClass('active')) {
            widgetMessageInput.focus();
        }
    });
    
    // Close chatbot
    closeChatbot.click(function() {
        chatbotPanel.removeClass('active');
    });
    
    // Send message function
    function sendWidgetMessage() {
        const message = widgetMessageInput.val().trim();
        
        if (message === '') return;
        
        // Add user message
        addWidgetMessage(message, 'user');
        widgetMessageInput.val('');
        
        // Show typing indicator
        showWidgetTypingIndicator();
        
        // Send to server
        $.ajax({
            url: '/chatbot/response',
            method: 'POST',
            data: { message: message },
            success: function(response) {
                console.log(response);
                hideWidgetTypingIndicator();
                
                // Add bot response
                addWidgetMessage(response.response, 'bot');
                
                // Update suggestions
                if (response.suggestions) {
                    updateWidgetSuggestions(response.suggestions);
                }
            },
            error: function(e) {
                console.log(e);
                hideWidgetTypingIndicator();
                addWidgetMessage('Sorry, I encountered an error. Please try again.', 'bot');
            }
        });
    }
    
    // Add message to widget chat
    function addWidgetMessage(message, sender) {
        const messageDiv = $('<div class="message ' + sender + '"></div>');
        const avatar = $('<div class="message-avatar"><i class="fas fa-' + (sender === 'user' ? 'user' : 'robot') + '"></i></div>');
        const content = $('<div class="message-content"></div>').text(message);
        
        messageDiv.append(avatar, content);
        widgetChatMessages.append(messageDiv);
        
        // Scroll to bottom
        widgetChatMessages.scrollTop(widgetChatMessages[0].scrollHeight);
    }
    
    // Show typing indicator
    function showWidgetTypingIndicator() {
        widgetTypingIndicator.show();
        widgetChatMessages.scrollTop(widgetChatMessages[0].scrollHeight);
    }
    
    // Hide typing indicator
    function hideWidgetTypingIndicator() {
        widgetTypingIndicator.hide();
    }
    
    // Update suggestions
    function updateWidgetSuggestions(suggestionList) {
        widgetSuggestions.empty();
        suggestionList.forEach(function(suggestion) {
            const btn = $('<button class="suggestion-btn"></button>').text(suggestion);
            btn.click(function() {
                widgetMessageInput.val(suggestion);
                sendWidgetMessage();
            });
            widgetSuggestions.append(btn);
        });
    }
    
    // Event listeners
    widgetSendButton.click(sendWidgetMessage);
    
    widgetMessageInput.keypress(function(e) {
        if (e.which === 13) { // Enter key
            sendWidgetMessage();
        }
    });
    
    // Show notification badge after 5 seconds (demo)
    setTimeout(function() {
        if (!chatbotPanel.hasClass('active')) {
            notificationBadge.show();
        }
    }, 5000);
});
</script> 