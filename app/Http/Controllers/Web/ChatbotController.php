<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    private $predefinedQuestions = [
        'health_certificate' => [
            'question' => 'How do I apply for a health certificate?',
            'answer' => 'To apply for a health certificate, you need to: 1) Register an account, 2) Fill out the application form, 3) Upload required documents, 4) Pay the required fees, 5) Attend the medical examination, and 6) Wait for approval. The process typically takes 3-5 business days.'
        ],
        'sanitary_permit' => [
            'question' => 'What is a sanitary permit and how do I get one?',
            'answer' => 'A sanitary permit is required for food establishments to ensure they meet health and safety standards. To apply: 1) Register your business, 2) Complete the application form, 3) Submit required documents, 4) Pay fees, 5) Undergo inspection, 6) Wait for approval. Processing time is 5-7 business days.'
        ],
        'requirements' => [
            'question' => 'What documents do I need to submit?',
            'answer' => 'Required documents include: Valid ID, Medical certificate, Business permit (for business applications), Proof of address, Recent 2x2 photo, and other specific documents depending on your application type. Please check the requirements section for complete details.'
        ],
        'fees' => [
            'question' => 'How much are the fees?',
            'answer' => 'Fees vary by application type: Health Certificate - ₱500, Sanitary Permit - ₱1,000, Laboratory fees - ₱300-800 depending on tests required. Additional fees may apply for expedited processing.'
        ],
        'processing_time' => [
            'question' => 'How long does processing take?',
            'answer' => 'Standard processing times: Health Certificate - 3-5 business days, Sanitary Permit - 5-7 business days, Laboratory results - 2-3 business days. Expedited processing is available for additional fees.'
        ],
        'contact' => [
            'question' => 'How can I contact support?',
            'answer' => 'You can contact us through: Phone: (123) 456-7890, Email: support@qc-app.com, or visit our office during business hours (Monday-Friday, 8:00 AM - 5:00 PM).'
        ],
        'tracking' => [
            'question' => 'How can I track my application?',
            'answer' => 'You can track your application by logging into your account and visiting the "My Applications" section. Enter your application reference number to view the current status and progress.'
        ],
        'renewal' => [
            'question' => 'How do I renew my certificate or permit?',
            'answer' => 'To renew your certificate or permit: 1) Log into your account, 2) Select "Renew Application", 3) Update any changed information, 4) Submit updated documents if required, 5) Pay renewal fees. Renewals typically process faster than new applications.'
        ],
        'complaints' => [
            'question' => 'How do I file a complaint?',
            'answer' => 'To file a complaint: 1) Log into your account, 2) Go to "Submit Complaint" section, 3) Fill out the complaint form with details, 4) Attach supporting documents if any, 5) Submit. We will respond within 24-48 hours.'
        ],
        'thanks' => [
            'question' => 'Thank you for your message. We will get back to you as soon as possible.',
            'answer' => 'Thank you for your message. We will get back to you as soon as possible.'
        ],
    ];

    public function index()
    {
        return view('chatbot.index');
    }

    public function getResponse(Request $request): JsonResponse
    {
        $message = strtolower(trim($request->input('message', '')));

        $health = globalHelper()->getApplicationViaRefNo($message);
        $sanitary = globalHelper()->getBusinessViaRefNo($message);
        $complaint = globalHelper()->getComplaintViaRefNo($message);

        // return response()->json([
        //     'success' => true,
        //     'health' => $health,
        //     'sanitary' => $sanitary,
        //     'complaint' => $complaint,
        //     'message' => $message
        // ]);

        if ($health) {
            return response()->json([
                'success' => true,
                'response' => "Health Status : ". str_replace('-', ' ', config('system.application_progress_status')[$health['status']]),
                'data' => $health
            ]);
        }

        if ($sanitary) {
            return response()->json([
                'success' => true,
                'response' => "Business Status : ". str_replace('-', ' ', config('system.application_progress_status')[$sanitary['status']]),
                'data' => $sanitary
            ]);
        }

        if ($complaint) {
            return response()->json([
                'success' => true,
                'response' => "Complaint Status : ". str_replace('-', ' ', config('system.complaint_progress_status')[$complaint['status']]),
                'data' => $complaint
            ]);
        }
        

        
        // Simple keyword matching
        $response = $this->findBestMatch($message);
        
        return response()->json([
            'success' => true,
            'response' => $response,
            'suggestions' => $this->getSuggestions()
        ]);
    }

    private function findBestMatch($message): string
    {
        $keywords = [
            'health certificate' => 'health_certificate',
            'health' => 'health_certificate',
            'certificate' => 'health_certificate',
            'sanitary permit' => 'sanitary_permit',
            'sanitary' => 'sanitary_permit',
            'permit' => 'sanitary_permit',
            'requirements' => 'requirements',
            'documents' => 'requirements',
            'fees' => 'fees',
            'cost' => 'fees',
            'price' => 'fees',
            'payment' => 'fees',
            'processing time' => 'processing_time',
            'how long' => 'processing_time',
            'duration' => 'processing_time',
            'contact' => 'contact',
            'support' => 'contact',
            'help' => 'contact',
            'track' => 'tracking',
            'status' => 'tracking',
            'application status' => 'tracking',
            'renew' => 'renewal',
            'renewal' => 'renewal',
            'complaint' => 'complaints',
            'file complaint' => 'complaints',
            'report' => 'complaints',
            'okay' => 'thanks',
            'ok' => 'thanks',
            'thank you' => 'thanks',
            'thank you for your message' => 'thanks',
            'thank you for your help' => 'thanks',
            'thank you for your support' => 'thanks',
            'thank you for your time' => 'thanks',
            'thank you for your patience' => 'thanks',
            'thank you for your understanding' => 'thanks',
            'thank you for your assistance' => 'thanks',
            'thank you for your feedback' => 'thanks',
            'thank you for your concern' => 'thanks',
            'thank you for your cooperation' => 'thanks',
            'thank you for your kindness' => 'thanks',
            'thank you for your generosity' => 'thanks',
        ];

        foreach ($keywords as $keyword => $key) {
            if (strpos($message, $keyword) !== false) {
                return $this->predefinedQuestions[$key]['answer'];
            }
        }

        // Default response if no match found
        return "I'm sorry, I didn't understand your question. Here are some topics I can help you with: Health Certificates, Sanitary Permits, Requirements, Fees, Processing Time, Contact Information, Application Tracking, Renewals, and Complaints. Please try asking about one of these topics.";
    }

    private function getSuggestions(): array
    {
        return [
            'How do I apply for a health certificate?',
            'What documents do I need?',
            'How much are the fees?',
            'How long does processing take?',
            'How can I contact support?'
        ];
    }
} 