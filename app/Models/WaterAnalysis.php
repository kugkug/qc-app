<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterAnalysis extends Model
{
    protected $table = 'water_analyses';
    protected $guarded = ['id'];

    public function application()
    {
        return $this->belongsTo(Business::class, 'application_ref_no', 'application_ref_no');
    }
}