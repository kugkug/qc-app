# QC App Chatbot

A jQuery-based chatbot system with predefined questions and answers for the QC App. This chatbot provides instant support for users asking about health certificates, sanitary permits, and other services.

## Features

-   **Predefined Q&A System**: Handles common questions about health certificates, sanitary permits, fees, processing times, etc.
-   **Floating Widget**: Can be added to any page as a floating chat widget
-   **Full-Page Chat**: Dedicated chatbot page for extended conversations
-   **Smart Suggestions**: Dynamic suggestion buttons based on context
-   **Responsive Design**: Works on desktop and mobile devices
-   **Typing Indicators**: Visual feedback when the bot is "thinking"
-   **CSRF Protection**: Secure AJAX requests with Laravel CSRF tokens

## Installation

### 1. Controller Setup

The chatbot controller is already created at `app/Http/Controllers/Web/ChatbotController.php`. It includes:

-   Predefined questions and answers
-   Keyword matching system
-   JSON response handling

### 2. Routes

Routes are already added to `routes/web.php`:

```php
// Chatbot routes
Route::get("/chatbot", [ChatbotController::class, 'index'])->name('chatbot');
Route::post("/chatbot/response", [ChatbotController::class, 'getResponse'])->name('chatbot.response');
```

### 3. Views

Two main views are available:

-   `resources/views/chatbot/index.blade.php` - Full-page chatbot
-   `resources/views/components/chatbot-widget.blade.php` - Floating widget component

### 4. JavaScript

The main JavaScript file is at `public/assets/scripts/components/chatbot.js`.

## Usage

### Adding the Floating Widget to Any Page

Include the widget component in your Blade template:

```php
@include('components.chatbot-widget')
```

Make sure to include the required CSS and JavaScript dependencies:

```html
<!-- In your layout or page head -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/scripts/components/chatbot.js') }}"></script>
```

### Using the Full-Page Chatbot

Navigate to `/chatbot` to access the full-page chatbot interface.

### Customizing Questions and Answers

Edit the `$predefinedQuestions` array in `ChatbotController.php`:

```php
private $predefinedQuestions = [
    'your_key' => [
        'question' => 'Your question here?',
        'answer' => 'Your detailed answer here.'
    ],
    // Add more Q&A pairs...
];
```

### Adding New Keywords

Update the `$keywords` array in the `findBestMatch()` method:

```php
$keywords = [
    'your keyword' => 'your_key',
    // Add more keyword mappings...
];
```

## Predefined Questions and Answers

The chatbot currently handles these topics:

1. **Health Certificates**

    - How to apply
    - Required documents
    - Processing time

2. **Sanitary Permits**

    - Application process
    - Requirements
    - Fees

3. **General Information**
    - Contact support
    - Application tracking
    - Renewals
    - Complaints

## Customization

### Styling

The chatbot uses CSS classes that can be customized:

-   `.chatbot-widget` - Main widget container
-   `.chatbot-toggle` - Floating button
-   `.chatbot-panel` - Chat panel
-   `.message` - Individual messages
-   `.suggestion-btn` - Suggestion buttons

### JavaScript Customization

The `QCChatbot` class provides several public methods:

```javascript
// Initialize with custom options
const chatbot = new QCChatbot({
    endpoint: "/custom-endpoint",
    suggestions: ["Custom suggestion 1", "Custom suggestion 2"],
});

// Show/hide notification badge
chatbot.showNotification();
chatbot.hideNotification();

// Get chat history
const history = chatbot.getChatHistory();

// Clear chat
chatbot.clearChat();
```

### Adding Custom Questions

To add new questions and answers:

1. **Server-side**: Add to the `$predefinedQuestions` array in `ChatbotController.php`
2. **Client-side**: Add keywords to the `$keywords` array in `findBestMatch()`

Example:

```php
// In ChatbotController.php
'custom_topic' => [
    'question' => 'How do I do something specific?',
    'answer' => 'Here is the detailed answer with steps...'
]

// Add keyword mapping
'custom keyword' => 'custom_topic'
```

## API Endpoints

### POST /chatbot/response

**Request:**

```json
{
    "message": "How do I apply for a health certificate?"
}
```

**Response:**

```json
{
    "success": true,
    "response": "To apply for a health certificate, you need to...",
    "suggestions": [
        "How do I apply for a health certificate?",
        "What documents do I need?",
        "How much are the fees?"
    ]
}
```

## Browser Support

-   Chrome 60+
-   Firefox 55+
-   Safari 12+
-   Edge 79+

## Dependencies

-   jQuery 3.6.0+
-   Font Awesome 6.0+
-   Bootstrap 5.1+ (for styling)
-   Laravel 8+ (for backend)

## Security

-   CSRF protection enabled
-   Input sanitization
-   XSS prevention through proper escaping
-   Secure AJAX requests

## Performance

-   Lightweight implementation
-   Minimal DOM manipulation
-   Efficient event handling
-   Responsive design

## Troubleshooting

### Common Issues

1. **Chatbot not responding**

    - Check browser console for JavaScript errors
    - Verify CSRF token is set correctly
    - Ensure jQuery is loaded before chatbot.js

2. **Styling issues**

    - Check if Font Awesome is loaded
    - Verify CSS is not being overridden
    - Test on different screen sizes

3. **AJAX errors**
    - Check Laravel logs for server errors
    - Verify route is accessible
    - Ensure CSRF token is valid

### Debug Mode

Enable debug mode by adding this to your JavaScript:

```javascript
const chatbot = new QCChatbot({
    debug: true,
});
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This chatbot system is part of the QC App project and follows the same licensing terms.

## Support

For technical support or questions about the chatbot implementation, please refer to the project documentation or contact the development team.
