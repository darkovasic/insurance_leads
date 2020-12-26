<?php

namespace App\Imports;

use App\Lead;
use App\User;
use App\ImportErrorLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterImport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportFinished;

use Illuminate\Support\Facades\Log;

class LeadsImport implements 
    ToCollection, 
    WithHeadingRow,
    WithChunkReading,
    WithEvents,
    ShouldQueue

{
    use Importable;
    use RegistersEventListeners;
    use RemembersChunkOffset;

    public $jobId;
    public $importedBy;

    public function __construct(User $user) {

        $this->importedBy = $user;
        $this->jobId = Str::random(10);
    }

    public function collection(Collection $rows)
    {
        $chunkOffset = $this->getChunkOffset();

        // $validator = Validator::make($rows->toArray(), [
        //     '*.legal_name' => ['required', 'string', 'max:255'],
        //     '*.dot_number' => ['required', 'numeric'],
        //     '*.first_name' => ['string', 'max:50', 'nullable'],
        //     '*.last_name' => ['string', 'max:50', 'nullable'],
        //     '*.email_address' => ['email', 'nullable'],
        //     '*.phone' => ['required', 'numeric', 'digits:10'],
        //     '*.phy_street' => ['string', 'max:255', 'nullable'],
        //     '*.phy_zip' => ['numeric', 'nullable'],
        //     '*.phy_city' => ['string', 'max:255', 'nullable'],
        //     '*.phy_state' => ['string', 'max:2', 'nullable'],
        //     '*.nbr_power_unit' => ['numeric', 'nullable'],
        //     '*.driver_total' => ['numeric', 'nullable'],
        //     '*.last_insurance_carrier' => ['string', 'max:255', 'nullable'],
        //     '*.last_insurance_date' => ['date'],
        //     '*.full_time_employees' => ['numeric', 'nullable'],
        //     '*.part_time_employees' => ['numeric', 'nullable'],
        //     '*.currently_insured' => ['required', 'in:YES,NO'],
        //     '*.years_of_experience' => ['numeric', 'nullable'],
        //     '*.legal_entity' => ['nullable', 'in:Sole Proprietorship,Partnership,LLC,S Corporation,C Corporation,Joint Venture,Trust,Association,Municipality,Other'],
        //     '*.coverage_type' => ['nullable', 'in:Bond,Liability,Professional Liability (E&O),Commercial Property,Workers Compensation,Commercial Auto,BOP,Other/Not Sure'],
        //     '*.insurance_cancellation_date' => ['date'],
        //     '*.pv_apcant_id' => ['required', 'numeric'],
        //     '*.person_name' => ['string', 'max:255', 'nullable'],
        //     '*.title' => ['nullable', 'in:Mr.,Mrs.,Miss'],
        //     '*.carrier_operation' => ['in:A,B,C', 'nullable'],
        //     '*.hm_flag' => ['in:Y,N', 'nullable'],
        //     '*.pc_flag' => ['in:Y,N', 'nullable'],
        //     '*.mailing_street' => ['string', 'max:255', 'nullable'],
        //     '*.mailing_city' => ['string', 'max:255', 'nullable'],
        //     '*.mailing_state' => ['string', 'max:2', 'nullable'],
        //     '*.mailing_zip' => ['alpha_dash', 'max:15', 'nullable'],
        //     '*.mailing_country' => ['string', 'max:2', 'nullable'],
        //     '*.telephone' => ['string', 'max:20', 'nullable'],
        //     '*.fax' => ['string', 'max:20', 'nullable'],
        //     '*.mcs150_date' => ['alpha_dash', 'max:9', 'nullable'],
        //     '*.mcs150_mileage' => ['numeric', 'nullable'],
        //     '*.mcs150_mileage_year' => ['numeric', 'nullable'],
        //     '*.add_date' => ['alpha_dash', 'max:9', 'nullable'],
        //     '*.add_date_date' => ['date'],
        //     '*.oic_state' => ['string', 'max:2', 'nullable'],
        //     '*.description' => ['string', 'max:255', 'nullable'],
        //     '*.comment' => ['string', 'nullable'],
        // ]);

        // if ($validator->fails()) {

        //     $errors = $validator->errors();

        //     foreach ($errors->all() as $message) {
        //         error_log($message);
        //     }
        // }
    
        foreach ($rows as $index => $row) {

            try {
                $lead = Lead::firstOrNew(['dot_number' => $row['dot_number']]);

                $lead->dot_number = $row['dot_number'];
                $lead->legal_name = $row['legal_name'];
                $lead->first_name = $row['first_name'];
                $lead->last_name = $row['last_name'];
                $lead->email_address = $row['email_address'];
                $lead->phone = $row['phone'];
                $lead->dba_name = $row['dba_name'];
                $lead->phy_street = $row['phy_street'];
                $lead->phy_zip = $row['phy_zip'];
                $lead->phy_city = $row['phy_city'];
                $lead->phy_state = $row['phy_state'];
                $lead->nbr_power_unit = $row['nbr_power_unit'];
                $lead->driver_total = $row['driver_total'];
                $lead->last_insurance_carrier = $row['last_insurance_carrier'];
                $lead->last_insurance_date = Carbon::parse($row['last_insurance_date'])->toDateTimeString();
                $lead->full_time_employees = $row['full_time_employees'];
                $lead->part_time_employees = $row['part_time_employees']; 
                $lead->currently_insured = $row['currently_insured'];
                $lead->years_of_experience = $row['years_of_experience'];
                $lead->legal_entity = $row['legal_entity'];
                $lead->coverage_type = $row['coverage_type'];
                $lead->insurance_cancellation_date = Carbon::parse($row['insurance_cancellation_date'])->toDateTimeString();

                $lead->pv_apcant_id = $row['pv_apcant_id'];
                $lead->person_name = $row['person_name'];
                $lead->title = $row['title'];
                $lead->carrier_operation = $row['carrier_operation'];
                $lead->hm_flag = $row['hm_flag'];
                $lead->pc_flag = $row['pc_flag'];
                $lead->mailing_street = $row['mailing_street'];
                $lead->mailing_city = $row['mailing_city'];
                $lead->mailing_state = $row['mailing_state'];
                $lead->mailing_zip = $row['mailing_zip'];
                $lead->mailing_country = $row['mailing_country'];
                $lead->telephone = $row['telephone'];
                $lead->fax = $row['fax'];
                $lead->mcs150_date = $row['mcs150_date'];
                $lead->mcs150_mileage = $row['mcs150_mileage'];
                $lead->mcs150_mileage_year = $row['mcs150_mileage_year'];
                $lead->add_date = $row['add_date'];
                $lead->add_date_date = Carbon::parse($row['add_date_date'])->toDateTimeString();
                $lead->oic_state = $row['oic_state'];
                $lead->description = $row['description'];
                $lead->comment = $row['comment'];

                $lead->save();

            } catch(\Exception $e) {

                $rowNumber = $chunkOffset + $index;

                try {
                    ImportErrorLog::create([
                        'job_id' => $this->jobId,
                        'row_number' => $rowNumber,
                        'message' => $e->getMessage()
                    ]);
                } catch(\Exception $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 200;
    }

    public static function afterImport(AfterImport $event)
    {
        $importedBy = $event->getConcernable()->importedBy;

        try {
            $email = new ImportFinished();
            Mail::to($importedBy)->send($email);
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }
    }

    // public function prepareForValidation($data, $index)
    // {
    //     $data['last_insurance_date'] = Carbon::parse($data['last_insurance_date'])->toDateTimeString();
    //     $data['insurance_cancellation_date'] = Carbon::parse($data['insurance_cancellation_date'])->toDateTimeString();
    //     $data['add_date_date'] = Carbon::parse($data['add_date_date'])->toDateTimeString();
        
    //     return $data;
    // }
}