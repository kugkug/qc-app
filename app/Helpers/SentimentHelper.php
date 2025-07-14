<?php

declare(strict_types=1);
namespace App\Helpers;

class SentimentHelper {
    // Combined sentiment analysis for both English and Tagalog
    public function getSentiment(string $text): string {
        $positiveWords = [
            // English positive words
            'good', 'great', 'excellent', 'amazing', 'wonderful', 'fantastic', 'outstanding',
            'perfect', 'satisfied', 'happy', 'pleased', 'content', 'delighted', 'thrilled',
            'helpful', 'supportive', 'professional', 'efficient', 'quick', 'fast', 'responsive',
            // Tagalog positive words
            'maganda', 'mahusay', 'napakaganda', 'napakahusay', 'masaya', 'kontento',
            'nasiyahan', 'natutuwa', 'nagagalak', 'nagpapasalamat', 'salamat', 'thank you',
            'tulong', 'tumulong', 'nakatulong', 'mabait', 'mabuti', 'maayos', 'maayos',
            'mabilis', 'mabilisan', 'agad', 'kaagad', 'salamat', 'maraming salamat'
        ];
        
        $negativeWords = [
            // English negative words
            'bad', 'terrible', 'awful', 'horrible', 'disgusting', 'disappointing', 'frustrated',
            'angry', 'upset', 'annoyed', 'irritated', 'disgusted', 'outraged', 'furious',
            'slow', 'unhelpful', 'unprofessional', 'inefficient', 'rude', 'incompetent', 'useless',
            'no', 'not', 'never', 'bad', 'terrible', 'awful', 'horrible', 'disappointed',
            'unhappy', 'angry', 'frustrated', 'annoyed', 'upset', 'worried', 'concerned',
            'expensive', 'costly', 'pricey', 'unaffordable', 'cancel', 'refund', 'complaint',
            'problem', 'issue', 'difficult', 'complicated', 'confusing', 'waste', 'useless',
            // Tagalog negative words
            'masama', 'pangit', 'napakasama', 'napakapangit', 'malungkot', 'galit',
            'nagagalit', 'nainis', 'nairita', 'nayamot', 'nagagalit', 'nagagalit',
            'mabagal', 'mabagal', 'mabagal', 'walang kwenta', 'walang silbi', 'pangit',
            'masama', 'nakakainis', 'nakakairita', 'nakakayamot', 'nakakagalit'
        ];
        
        $text = strtolower($text);
        $words = preg_split('/\s+/', $text);
        
        $positiveCount = 0;
        $negativeCount = 0;
        
        foreach ($words as $word) {
            $word = trim($word, '.,!?;:');
            if (in_array($word, $positiveWords)) {
                $positiveCount++;
            } elseif (in_array($word, $negativeWords)) {
                $negativeCount++;
            }
        }

        $total = $positiveCount + $negativeCount;
        if ($total === 0) {
            return 'neutral';
        }
        
        $sentimentScore = ($positiveCount - $negativeCount) / $total;
        
        if ($sentimentScore > 0.1) {
            return 'positive';
        } elseif ($sentimentScore < -0.1) {
            return 'negative';
        } else {
            return 'neutral';
        }
    }
}