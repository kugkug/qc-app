<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC App - Chatbot</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .chatbot-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .chatbot-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .chatbot-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .chatbot-header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .chat-messages {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .message {
            margin-bottom: 15px;
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
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 18px;
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
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-size: 16px;
        }
        
        .message.user .message-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .message.bot .message-avatar {
            background: #28a745;
            color: white;
        }
        
        .chat-input-container {
            padding: 20px;
            background: white;
            border-top: 1px solid #e9ecef;
        }
        
        .input-group {
            position: relative;
        }
        
        .form-control {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 12px 20px;
            font-size: 14px;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-send {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .btn-send:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .suggestions {
            margin-top: 15px;
        }
        
        .suggestion-btn {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 20px;
            padding: 8px 16px;
            margin: 5px;
            font-size: 12px;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .suggestion-btn:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        .typing-indicator {
            display: none;
            padding: 12px 16px;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 18px;
            border-bottom-left-radius: 5px;
            margin-bottom: 15px;
            max-width: 70%;
        }
        
        .typing-dots {
            display: flex;
            align-items: center;
        }
        
        .typing-dots span {
            width: 8px;
            height: 8px;
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
        
        .welcome-message {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .chatbot-container {
                margin: 20px;
                border-radius: 15px;
            }
            
            .chat-messages {
                height: 350px;
            }
            
            .message-content {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="chatbot-container">
            <div class="chatbot-header">
                <h3><i class="fas fa-robot me-2"></i>QC App Assistant</h3>
                <p>Ask me anything about health certificates, sanitary permits, and more!</p>
            </div>
            
            <div class="chat-messages" id="chatMessages">
                <div class="welcome-message">
                    <i class="fas fa-comments"></i> Welcome! How can I help you today?
                </div>
            </div>
            
            <div class="typing-indicator" id="typingIndicator">
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <div class="chat-input-container">
                <div class="input-group">
                    <input type="text" class="form-control" id="messageInput" placeholder="Type your message here..." autocomplete="off">
                    <button class="btn btn-send" id="sendButton">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
                
                <div class="suggestions" id="suggestions">
                    <!-- Suggestions will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            const chatMessages = $('#chatMessages');
            const messageInput = $('#messageInput');
            const sendButton = $('#sendButton');
            const typingIndicator = $('#typingIndicator');
            const suggestions = $('#suggestions');
            
            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Initial suggestions
            updateSuggestions([
                'How do I apply for a health certificate?',
                'What documents do I need?',
                'How much are the fees?',
                'How long does processing take?',
                'How can I contact support?'
            ]);
            
            // Send message function
            function sendMessage() {
                const message = messageInput.val().trim();
                if (message === '') return;
                
                // Add user message
                addMessage(message, 'user');
                messageInput.val('');
                
                // Show typing indicator
                showTypingIndicator();
                
                // Send to server
                $.ajax({
                    url: '/chatbot/response',
                    method: 'POST',
                    data: { message: message },
                    success: function(response) {
                        hideTypingIndicator();
                        
                        // Add bot response
                        addMessage(response.response, 'bot');
                        
                        // Update suggestions
                        if (response.suggestions) {
                            updateSuggestions(response.suggestions);
                        }
                    },
                    error: function() {
                        hideTypingIndicator();
                        addMessage('Sorry, I encountered an error. Please try again.', 'bot');
                    }
                });
            }
            
            // Add message to chat
            function addMessage(message, sender) {
                const messageDiv = $('<div class="message ' + sender + '"></div>');
                const avatar = $('<div class="message-avatar"><i class="fas fa-' + (sender === 'user' ? 'user' : 'robot') + '"></i></div>');
                const content = $('<div class="message-content"></div>').text(message);
                
                messageDiv.append(avatar, content);
                chatMessages.append(messageDiv);
                
                // Scroll to bottom
                chatMessages.scrollTop(chatMessages[0].scrollHeight);
            }
            
            // Show typing indicator
            function showTypingIndicator() {
                typingIndicator.show();
                chatMessages.scrollTop(chatMessages[0].scrollHeight);
            }
            
            // Hide typing indicator
            function hideTypingIndicator() {
                typingIndicator.hide();
            }
            
            // Update suggestions
            function updateSuggestions(suggestionList) {
                suggestions.empty();
                suggestionList.forEach(function(suggestion) {
                    const btn = $('<button class="suggestion-btn"></button>').text(suggestion);
                    btn.click(function() {
                        messageInput.val(suggestion);
                        sendMessage();
                    });
                    suggestions.append(btn);
                });
            }
            
            // Event listeners
            sendButton.click(sendMessage);
            
            messageInput.keypress(function(e) {
                if (e.which === 13) { // Enter key
                    sendMessage();
                }
            });
            
            // Focus on input when page loads
            messageInput.focus();
        });
    </script>
</body>
</html> 