<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Models\ApplicationTypeLookUp;
use App\Models\BaranggayLookUp;
use App\Models\ClassificationLookUp;
use App\Models\IndustryLookUp;
use App\Models\SubIndustryLookUp;
use Exception;

class DropdownHelper {

    public function getAllDropDowns() {
        return [
            'barangays' => $this->getBarangays(),
            'classifications' => $this->getClassifications(),
            'application_types' => $this->getApplicationTypes(),
            'industries' => $this->getIndustries(),
            'sub_industries' => $this->getSubIndustries(),
        ];
    }
    
    public function getBarangays() {
        try {
            return BaranggayLookUp::orderBy('baranggay')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getClassifications() {
        try {
            return ClassificationLookUp::orderBy('classification')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getApplicationTypes() {
        try {
            return ApplicationTypeLookUp::orderBy('application')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getIndustries() {
        try {
            return IndustryLookUp::orderBy('industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getSubIndustries() {
        try {
            return SubIndustryLookUp::orderBy('sub_industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getSubIndustriesViaIndustry(int $industry_id) {
        try {
            return SubIndustryLookUp::where('industry_id', $industry_id)->orderBy('sub_industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }
}