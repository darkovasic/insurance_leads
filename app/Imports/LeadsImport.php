<?php

namespace App\Imports;

use App\Lead;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\SkipsOnError;

use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class LeadsImport implements OnEachRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
      
        $lead = Lead::updateOrCreate(
            [
                'dot_number' => $row['dot_number']
            ],
            [
            'dot_number' => $row['dot_number'],
            'legal_name' => $row['legal_name'],
            'first_name' => $row['first_name'], 
            'last_name' => $row['last_name'], 
            'email_address' => $row['email_address'], 
            'phone' => $row['phone'],
            'dba_name' => $row['dba_name'], 
            'phy_street' => $row['phy_street'], 
            'phy_zip' => $row['phy_zip'], 
            'phy_city' => $row['phy_city'], 
            'phy_state' => $row['phy_state'], 
            'nbr_power_unit' => $row['nbr_power_unit'], 
            'driver_total' => $row['driver_total'], 
            'last_insurance_carrier' => $row['last_insurance_carrier'], 
            'last_insurance_date' => Date::excelToDateTimeObject($row['last_insurance_date']), 
            'full_time_employees' => $row['full_time_employees'], 
            'part_time_employees' => $row['part_time_employees'], 
            'currently_insured' => $row['currently_insured'], 
            'years_of_experience' => $row['years_of_experience'], 
            'legal_entity' => $row['legal_entity'], 
            'coverage_type' => $row['coverage_type'], 
            'insurance_cancellation_date' => Date::excelToDateTimeObject($row['insurance_cancellation_date']), 

            'pv_apcant_id' => $row['pv_apcant_id'],
            'person_name' => $row['person_name'],
            'title' => $row['title'],
            'carrier_operation' => $row['carrier_operation'],
            'hm_flag' => $row['hm_flag'],
            'pc_flag' => $row['pc_flag'],
            'mailing_street' => $row['mailing_street'],
            'mailing_city' => $row['mailing_city'],
            'mailing_state' => $row['mailing_state'],
            'mailing_zip' => $row['mailing_zip'],
            'mailing_country' => $row['mailing_country'],
            'telephone' => $row['telephone'],
            'fax' => $row['fax'],
            'mcs150_date' => $row['mcs150_date'],
            'mcs150_mileage' => $row['mcs150_mileage'],
            'mcs150_mileage_year' => $row['mcs150_mileage_year'],
            'add_date' => $row['add_date'],
            'add_date_date' => Date::excelToDateTimeObject($row['add_date_date']),
            'oic_state' => $row['oic_state'],
            'description' => $row['description'],
            'comment' => $row['comment'],
        ]);
    }

    public function rules(): array {
        return [
            '*.legal_name' => ['required', 'string', 'max:255'],
            '*.dot_number' => ['required', 'numeric'],
            '*.first_name' => ['string', 'max:50', 'nullable'],
            '*.last_name' => ['string', 'max:50', 'nullable'],
            '*.email_address' => ['email', 'nullable'],
            '*.phone' => ['required', 'numeric', 'digits:10'],
            '*.phy_street' => ['string', 'max:255', 'nullable'],
            '*.phy_zip' => ['numeric', 'nullable'],
            '*.phy_city' => ['string', 'max:255', 'nullable'],
            '*.phy_state' => ['string', 'max:2', 'nullable'],
            '*.nbr_power_unit' => ['numeric', 'nullable'],
            '*.driver_total' => ['numeric', 'nullable'],
            '*.last_insurance_carrier' => ['string', 'max:255', 'nullable'],
            // '*.last_insurance_date' => ['date'],
            '*.full_time_employees' => ['numeric', 'nullable'],
            '*.part_time_employees' => ['numeric', 'nullable'],
            '*.currently_insured' => ['required', 'in:YES,NO'],
            '*.years_of_experience' => ['numeric', 'nullable'],
            '*.legal_entity' => ['nullable', 'in:Sole Proprietorship,Partnership,LLC,S Corporation,C Corporation,Joint Venture,Trust,Association,Municipality,Other'],
            '*.coverage_type' => ['nullable', 'in:Bond,Liability,Professional Liability (E&O),Commercial Property,Workers Compensation,Commercial Auto,BOP,Other/Not Sure'],
            // '*.insurance_cancellation_date' => ['date'],
            '*.pv_apcant_id' => ['required', 'numeric'],
            '*.person_name' => ['string', 'max:255', 'nullable'],
            '*.title' => ['nullable', 'in:Mr.,Mrs.,Miss'],
            '*.carrier_operation' => ['in:A,B,C', 'nullable'],
            '*.hm_flag' => ['in:Y,N', 'nullable'],
            '*.pc_flag' => ['in:Y,N', 'nullable'],
            '*.mailing_street' => ['string', 'max:255', 'nullable'],
            '*.mailing_city' => ['string', 'max:255', 'nullable'],
            '*.mailing_state' => ['string', 'max:2', 'nullable'],
            '*.mailing_zip' => ['alpha_dash', 'max:15', 'nullable'],
            '*.mailing_country' => ['string', 'max:2', 'nullable'],
            '*.telephone' => ['string', 'max:20', 'nullable'],
            '*.fax' => ['string', 'max:20', 'nullable'],
            '*.mcs150_date' => ['alpha_dash', 'max:9', 'nullable'],
            '*.mcs150_mileage' => ['numeric', 'nullable'],
            '*.mcs150_mileage_year' => ['numeric', 'nullable'],
            '*.add_date' => ['alpha_dash', 'max:9', 'nullable'],
            // '*.add_date_date' => ['date'],
            '*.oic_state' => ['string', 'max:2', 'nullable'],
            '*.description' => ['string', 'max:255', 'nullable'],
            '*.comment' => ['string', 'nullable'],
        ];
    }

    // public function onError(\Throwable $error) {
            
    // }
}