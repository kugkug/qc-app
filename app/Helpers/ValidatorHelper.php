<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper {

    public function validate(string $type, Request $request): array {
        
        $mapped = $this->key_map($request->except([
            'ConfirmPassword', 'ComplaintPhoto'
        ]));
        
        $validated = Validator::make($mapped, $this->rules($type));
        
        if ($validated->fails()) {
            return [
                'status' => false,
                'response' => $validated->errors()->first(),
            ];
        }

        return [
            'status' => true,
            'validated' => $validated->validated(),
        ]; 
    }

    private function key_map($to_map): array {

        $mapped = [];
        foreach($to_map as $key => $value) {
            if($value) {
                $mapped[keysHelper()->getKey($key)] = $value;
            }
        }

        return $mapped;
    }

    
    private function rules(string $type) {
        switch($type) {

            case 'registration_new':
                return [
                    'firstname' => 'required|string|max:250',
                    'middlename' => 'sometimes|string|max:250',
                    'lastname' => 'required|string|max:250',
                    'suffixname' => 'sometimes|string|max:50',
                    'birthdate' => 'required|string|max:20',
                    'sex' => 'required|string|max:10',
                    'contact' => 'required|string|max:15',
                    'email' => 'email|string|max:250',
                    'occupation' => 'sometimes|string|max:250',
                    'civil_status_id' => 'required|integer',
                    'barangay_id' => 'required|integer',
                    'street' => 'required|string|max:250',
                    'address' => 'sometimes|string|max:250',
                    'password' => 'required|string|max:250',
                    'nationality' => 'sometimes|string|max:250',
                    'yellow_card' => 'sometimes|string|max:10',
                ];
            break;

            case 'application_save':
                return [
                    'application_ref_no' => 'required|string',
                    'user_id' => 'required|integer',
                    'application_type_id' => 'required|integer',
                    'classification_id' => 'sometimes|integer',
                    'industry_id' => 'required|integer',
                    'sub_industry_id' => 'required|integer',
                    'business_line_id' => 'sometimes|integer',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'application_type' => 'required|string',
                ];
            break;
            
            case 'business_save':
                return [
                    'application_ref_no' => 'required|string',
                    'user_id' => 'required|integer',
                    'application_type_id' => 'required|integer',
                    'industry_id' => 'required|integer',
                    'sub_industry_id' => 'required|integer',
                    'business_line_text' => 'sometimes|string',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'company_owner' => 'sometimes|string',
                    'mayor_permit_no' => 'sometimes|string',
                    'total_employees' => 'sometimes|integer',
                    'total_employees_with_certifiates' => 'sometimes|integer',
                    'total_employees_without_certificates' => 'sometimes|integer',
                    'total_employees_with_ppe' => 'sometimes|integer',
                    'application_status' => 'sometimes|integer',
                ];
            break;

            case 'application_update':
                return [
                    'application_type_id' => 'sometimes|integer',
                    'classification_id' => 'sometimes|integer',
                    'industry_id' => 'sometimes|integer',
                    'sub_industry_id' => 'sometimes|integer',
                    'business_line_id' => 'sometimes|integer',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'application_status' => 'sometimes|integer',
                ];
            break;

            case 'process_application':
                return [
                    'firstname' => 'sometimes|string|max:250',
                    'middlename' => 'sometimes|string|max:250',
                    'lastname' => 'sometimes|string|max:250',
                    'suffixname' => 'sometimes|string|max:50',
                    'birthdate' => 'sometimes|string|max:20',
                    'sex' => 'sometimes|string|max:10',
                    'contact' => 'sometimes|string|max:15',
                    'email' => 'email|string|max:250',
                    'occupation' => 'sometimes|string|max:250',
                    'civil_status_id' => 'sometimes|integer',
                    'barangay_id' => 'sometimes|integer',
                    'street' => 'sometimes|string|max:250',
                    'address' => 'sometimes|string|max:250',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                ];
            break;

            case 'process_business':
                return [
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'company_owner' => 'sometimes|string',
                    'mayor_permit_no' => 'sometimes|string',
                    'total_employees' => 'sometimes|integer',
                    'total_employees_with_certificates' => 'sometimes|integer',
                    'total_employees_without_certificates' => 'sometimes|integer',
                    'total_employees_with_ppe' => 'sometimes|integer',
                    'application_status' => 'sometimes|integer',
                ];
            break;

            case 'upload_requirements':
                return [
                    'application_ref_no' => 'required|string',
                ];
            break;

            case 'update_requirements':
                return [
                    'requirement' => 'sometimes|integer',
                    'photo' => 'sometimes|string',
                    'status' => 'sometimes|integer',
                    'notes' => 'sometimes|string',
                ];
            break;
            
            case 'update_payment_order':
                return [
                    'application_ref_no' => 'sometimes|integer',
                    'payment_information' => 'sometimes|string',
                    'status' => 'sometimes|integer',
                    'reference_no' => 'sometimes|integer',
                    'notes' => 'sometimes|string',
                    'receipt_photo' => 'sometimes|string',
                    'created_by' => 'sometimes|string',
                    'checked_by' => 'sometimes|string',
                ];
            break;

            case 'submit_complaint':
                return [
                    'complaint_ref_no' => 'required|string',
                    'user_id' => 'required|integer',
                    'business_name' => 'required|string',
                    'business_address' => 'required|string',
                    'complaint_description' => 'required|string',
                    'specific_barangay_street' => 'required|string',
                    'sentiments' => 'sometimes|string',
                    'status' => 'sometimes|integer',
                ];
        }
    }

}