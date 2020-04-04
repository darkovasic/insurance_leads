<?php
/*
|--------------------------------------------------------------------------
| Help with
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

namespace App\Helpers;

class StateHelper
{
    /**
     * State abbreviations by country
     *
     * @var array
     */
    protected $states = [
        'US' => [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ],
        'CA' => [
        ],
    ];

    /**
     * Get US state name from abbreviation
     *
     * @param  string[2]  $abbreviation  State abbreviation (FL, NY, ...)
     * @param  string[2]  $country       Country abbreviation (US, SR, GB, ...)
     * @return string State name
     */
    public function getStateNameFromAbbreviation(string $abbreviation, string $country)
    {
        return isset($this->states[strtoupper($country)][strtoupper($abbreviation)]) ?
            $this->states[strtoupper($country)][strtoupper($abbreviation)] : $abbreviation;
    }

    /**
     * Get StateHelper instance
     *
     * @return StateHelper Instance
     */
    public static function instance()
    {
        return new StateHelper();
    }
}