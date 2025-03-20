<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Models\TimelineLookUp;
use Exception;

class GlobalHelper {

    public function getTimeLines(): array {
        try {
            return TimelineLookUp::orderBy('order', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }
}