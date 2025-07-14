<?php

declare(strict_types=1);
namespace App\Helpers;

class KeysHelper {
    private const KEYS = [
        'FirstName' => 'firstname',
        'MiddleName' => 'middlename',
        'LastName' => 'lastname',
        'SuffixName' => 'suffixname',
        'BirthDate' => 'birthdate',
        'Sex' => 'sex',
        'Contact' => 'contact',
        'Email' => 'email',
        'Occupation' => 'occupation',
        'CivilStatusId' => 'civil_status_id',
        'BarangayId' => 'barangay_id',
        'BaranggayId' => 'barangay_id',
        'Street' => 'street',
        'Address' => 'address',
        'Password' => 'password',
        'Nationality' => 'nationality',
        'YellowCard' => 'yellow_card',

        'UserId' => 'user_id',
        'ApplicationRefNo' => 'application_ref_no',
        'ClassificationId' => 'classification_id',
        'ApplicationTypeId' => 'application_type_id',
        'IndustryId' => 'industry_id',
        'SubIndustryId' => 'sub_industry_id',
        'BusinessLineId' => 'business_line_id',
        'CompanyName' => 'company_name',
        'CompanyAddress' => 'company_address',
        'ApplicationStatus' => 'application_status',
        'ApplicationType' => 'application_type',

        'Requirement' => 'requirement',
        'Photo' => 'photo',
        'Status' => 'status',
        'Notes' => 'notes',

        'ReceiptPhoto' => 'receipt_photo',
        'PaymentInformation' => 'payment_information',
        'ReferenceNo' => 'reference_no',
        'ReceiptPhoto' => 'receipt_photo',
        'CreatedBy' => 'created_by',
        'CheckedBy' => 'checked_by',

        'BusinessName' => 'business_name',
        'BusinessAddress' => 'business_address',
        'ComplaintPhoto' => 'complaint_photo',
        'ComplaintDescription' => 'complaint_description',
        'SpecificBarangayStreet' => 'specific_barangay_street',

        'CompanyOwner' => 'company_owner',
        'MayorPermitNo' => 'mayor_permit_no',
        'TotalEmployees' => 'total_employees',
        'TotalEmployeesWithCertificates' => 'total_employees_with_certificates',
        'TotalEmployeesWithoutCertificates' => 'total_employees_without_certificates',
        'TotalEmployeesWithPPE' => 'total_employees_with_ppe',
        'BusinessLineText' => 'business_line_text',
    ];
    
    public function getKey(string $key_index): string {
        return self::KEYS[$key_index];
    }
}