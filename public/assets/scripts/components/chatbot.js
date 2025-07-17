/**
 * QC App Chatbot
 * A jQuery-based chatbot with predefined questions and answers
 */

class QCChatbot {
    constructor(options = {}) {
        this.options = {
            endpoint: "/chatbot/response",
            csrfToken: $('meta[name="_token"]').attr("content"),
            suggestions: [
                "How do I apply for a health certificate?",
                "What documents do I need?",
                "How much are the fees?",
                "How long does processing take?",
                "How can I contact support?",
            ],
            ...options,
        };

        this.init();
    }

    init() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": this.options.csrfToken,
            },
        });

        this.bindEvents();
        this.updateSuggestions(this.options.suggestions);
    }

    bindEvents() {
        // Send button click
        $(document).on("click", ".btn-send", (e) => {
            e.preventDefault();
            this.sendMessage();
        });

        // Enter key press
        $(document).on("keypress", ".chatbot-input input", (e) => {
            if (e.which === 13) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // Suggestion button clicks
        $(document).on("click", ".suggestion-btn", (e) => {
            e.preventDefault();
            const message = $(e.target).text();
            this.setInputValue(message);
            this.sendMessage();
        });

        // Toggle chatbot (for widget)
        $(document).on("click", "#chatbotToggle", (e) => {
            e.preventDefault();
            this.toggleChatbot();
        });

        // Close chatbot
        $(document).on("click", "#closeChatbot", (e) => {
            e.preventDefault();
            this.closeChatbot();
        });
    }

    sendMessage() {
        const input = this.getInputElement();
        const message = input.val().trim();

        if (message === "") return;

        // Add user message
        this.addMessage(message, "user");
        input.val("");

        // Show typing indicator
        this.showTypingIndicator();

        // Send to server
        $.ajax({
            url: this.options.endpoint,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": this.options.csrfToken,
            },
            data: { message: message },
            success: (response) => {
                this.hideTypingIndicator();

                // Add bot response
                this.addMessage(response.response, "bot");

                // Update suggestions
                if (response.suggestions) {
                    this.updateSuggestions(response.suggestions);
                }
            },
            error: () => {
                this.hideTypingIndicator();
                this.addMessage(
                    "Sorry, I encountered an error. Please try again.",
                    "bot"
                );
            },
        });
    }

    addMessage(message, sender) {
        const messagesContainer = this.getMessagesContainer();
        const messageDiv = $('<div class="message ' + sender + '"></div>');
        const avatar = $(
            '<div class="message-avatar"><i class="fas fa-' +
                (sender === "user" ? "user" : "robot") +
                '"></i></div>'
        );
        const content = $('<div class="message-content"></div>').text(message);

        messageDiv.append(avatar, content);
        messagesContainer.append(messageDiv);

        // Scroll to bottom
        this.scrollToBottom();
    }

    showTypingIndicator() {
        const indicator = this.getTypingIndicator();
        indicator.show();
        this.scrollToBottom();
    }

    hideTypingIndicator() {
        const indicator = this.getTypingIndicator();
        indicator.hide();
    }

    updateSuggestions(suggestionList) {
        const suggestionsContainer = this.getSuggestionsContainer();
        suggestionsContainer.empty();

        suggestionList.forEach((suggestion) => {
            const btn = $('<button class="suggestion-btn"></button>').text(
                suggestion
            );
            suggestionsContainer.append(btn);
        });
    }

    toggleChatbot() {
        const panel = $("#chatbotPanel");
        const badge = $("#notificationBadge");

        panel.toggleClass("active");
        badge.hide();

        if (panel.hasClass("active")) {
            this.getInputElement().focus();
        }
    }

    closeChatbot() {
        $("#chatbotPanel").removeClass("active");
    }

    setInputValue(value) {
        this.getInputElement().val(value);
    }

    scrollToBottom() {
        const container = this.getMessagesContainer();
        container.scrollTop(container[0].scrollHeight);
    }

    // Helper methods to get elements
    getInputElement() {
        return $(".chatbot-input input, #widgetMessageInput");
    }

    getMessagesContainer() {
        return $("#chatMessages, #widgetChatMessages");
    }

    getTypingIndicator() {
        return $("#typingIndicator, #widgetTypingIndicator");
    }

    getSuggestionsContainer() {
        return $("#suggestions, #widgetSuggestions");
    }

    // Public methods for external use
    showNotification() {
        $("#notificationBadge").show();
    }

    hideNotification() {
        $("#notificationBadge").hide();
    }

    // Method to add custom questions and answers
    addCustomQA(question, answer) {
        // This would typically be handled on the server side
        console.log("Custom QA added:", { question, answer });
    }

    // Method to get chat history
    getChatHistory() {
        const messages = [];
        this.getMessagesContainer()
            .find(".message")
            .each(function () {
                const sender = $(this).hasClass("user") ? "user" : "bot";
                const content = $(this).find(".message-content").text();
                messages.push({ sender, content });
            });
        return messages;
    }

    // Method to clear chat
    clearChat() {
        this.getMessagesContainer().empty();
        this.addMessage("Welcome! How can I help you today?", "bot");
    }
}

// Initialize chatbot when document is ready
$(document).ready(function () {
    window.qcChatbot = new QCChatbot();

    // Show notification badge after 5 seconds (demo)
    setTimeout(function () {
        if (!$("#chatbotPanel").hasClass("active")) {
            window.qcChatbot.showNotification();
        }
    }, 5000);
});

// Export for use in other modules
if (typeof module !== "undefined" && module.exports) {
    module.exports = QCChatbot;
}
