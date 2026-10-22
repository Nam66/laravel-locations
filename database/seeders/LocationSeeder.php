<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run seeder forcing insert (used by reset command).
     */
    public function runForce(): void
    {
        $this->seedLocations();
    }

    public function run(): void
    {
        // Only seed if table is empty
        if (Location::count() > 0) {
            return;
        }

        $this->seedLocations();
    }

    private function seedLocations(): void
    {
        $locations = [
            ['id' =>  1, 'name' => 'Singapore',                    'latitude' => 1.3,      'longitude' => 103.8,      'status' => 'active'],
            ['id' =>  2, 'name' => 'Kampong Serangoon Kechil',     'latitude' => 1.39,     'longitude' => 103.9072,   'status' => 'active'],
            ['id' =>  3, 'name' => 'Jalan Kayu',                   'latitude' => 1.3972,   'longitude' => 103.8719,   'status' => 'active'],
            ['id' =>  4, 'name' => 'Bukit Sembawang Estate',       'latitude' => 1.3956,   'longitude' => 103.8692,   'status' => 'active'],
            ['id' =>  5, 'name' => 'Choa Chu Kang New Town',       'latitude' => 1.3833,   'longitude' => 103.75,     'status' => 'active'],
            ['id' =>  6, 'name' => 'Keat Hong Village',            'latitude' => 1.3778,   'longitude' => 103.7442,   'status' => 'active'],
            ['id' =>  7, 'name' => 'Bukit Panjang Estate',         'latitude' => 1.3817,   'longitude' => 103.7525,   'status' => 'active'],
            ['id' =>  8, 'name' => 'Kampong Cutforth',             'latitude' => 1.3819,   'longitude' => 103.7364,   'status' => 'active'],
            ['id' =>  9, 'name' => 'Matilda Estate',               'latitude' => 1.3994,   'longitude' => 103.9028,   'status' => 'active'],
            ['id' => 10, 'name' => 'Serangoon',                    'latitude' => 1.3756,   'longitude' => 103.8972,   'status' => 'active'],
            ['id' => 11, 'name' => 'Kampong Pinang',               'latitude' => 1.3811,   'longitude' => 103.8942,   'status' => 'active'],
            ['id' => 12, 'name' => 'Kampong Tongkang Pechah',      'latitude' => 1.39,     'longitude' => 103.8764,   'status' => 'active'],
            ['id' => 13, 'name' => 'Kampong Teban',                'latitude' => 1.3786,   'longitude' => 103.9078,   'status' => 'active'],
            ['id' => 14, 'name' => 'Kampong Sungai Tengah',        'latitude' => 1.3833,   'longitude' => 103.9,      'status' => 'active'],
            ['id' => 15, 'name' => 'Kangkar',                      'latitude' => 1.3761,   'longitude' => 103.9017,   'status' => 'active'],
            ['id' => 16, 'name' => 'Kampong Beremban',             'latitude' => 1.3814,   'longitude' => 103.9158,   'status' => 'active'],
            ['id' => 17, 'name' => 'Seletar Hills Estate',         'latitude' => 1.3844,   'longitude' => 103.8681,   'status' => 'active'],
            ['id' => 18, 'name' => 'Woodlands New Town',           'latitude' => 1.4363,   'longitude' => 103.7867,   'status' => 'active'],
            ['id' => 19, 'name' => 'Mok Peng Hiang Estate',        'latitude' => 1.4456,   'longitude' => 103.7969,   'status' => 'active'],
            ['id' => 20, 'name' => 'Jurong Town',                  'latitude' => 1.3342,   'longitude' => 103.7228,   'status' => 'active'],
            ['id' => 21, 'name' => 'Tay Keng Loon Estate',         'latitude' => 1.4533,   'longitude' => 103.7989,   'status' => 'active'],
            ['id' => 22, 'name' => 'Bukit Panjang New Town',       'latitude' => 1.3808,   'longitude' => 103.7625,   'status' => 'active'],
            ['id' => 23, 'name' => 'Marsiling',                    'latitude' => 1.4411,   'longitude' => 103.7708,   'status' => 'active'],
            ['id' => 24, 'name' => 'Chia Keng',                    'latitude' => 1.36,     'longitude' => 103.8917,   'status' => 'active'],
            ['id' => 25, 'name' => 'Jurong West',                  'latitude' => 1.3445,   'longitude' => 103.7068,   'status' => 'active'],
            ['id' => 26, 'name' => 'Kampong Ulu Jurong',           'latitude' => 1.35,     'longitude' => 103.7167,   'status' => 'active'],
            ['id' => 27, 'name' => 'Somapah Serangoon',            'latitude' => 1.3667,   'longitude' => 103.8833,   'status' => 'active'],
            ['id' => 28, 'name' => 'Boon Lay',                     'latitude' => 1.3333,   'longitude' => 103.7,      'status' => 'active'],
            ['id' => 29, 'name' => 'Kampong Sireh',                'latitude' => 1.35,     'longitude' => 103.8833,   'status' => 'active'],
            ['id' => 30, 'name' => 'Kampong Bukit Panjang',        'latitude' => 1.3836,   'longitude' => 103.76,     'status' => 'active'],
            ['id' => 31, 'name' => 'Marsiling Estate',             'latitude' => 1.4297,   'longitude' => 103.7675,   'status' => 'active'],
            ['id' => 32, 'name' => 'Ong Lee',                      'latitude' => 1.35,     'longitude' => 103.75,     'status' => 'active'],
            ['id' => 33, 'name' => 'Ulu Bedok',                    'latitude' => 1.3333,   'longitude' => 103.9333,   'status' => 'active'],
            ['id' => 34, 'name' => 'Kampong Chai Chee',            'latitude' => 1.3333,   'longitude' => 103.9333,   'status' => 'active'],
            ['id' => 35, 'name' => 'Kampong Pachitan',             'latitude' => 1.3167,   'longitude' => 103.9167,   'status' => 'active'],
            ['id' => 36, 'name' => 'Bedok New Town',               'latitude' => 1.3236,   'longitude' => 103.9273,   'status' => 'active'],
            ['id' => 37, 'name' => 'Bedok Ville',                  'latitude' => 1.3244,   'longitude' => 103.9544,   'status' => 'active'],
            ['id' => 38, 'name' => 'Kampong Ladang',               'latitude' => 1.3333,   'longitude' => 103.9,      'status' => 'active'],
            ['id' => 39, 'name' => 'Kampong Reteh',                'latitude' => 1.3333,   'longitude' => 103.9,      'status' => 'active'],
            ['id' => 40, 'name' => 'Kampong Ubi',                  'latitude' => 1.3167,   'longitude' => 103.9,      'status' => 'active'],
            ['id' => 41, 'name' => 'Kampong Wak Hassan',           'latitude' => 1.4614,   'longitude' => 103.8364,   'status' => 'active'],
            ['id' => 42, 'name' => 'Chong Pang',                   'latitude' => 1.4444,   'longitude' => 103.8239,   'status' => 'pending'],
            ['id' => 43, 'name' => 'Sembawang',                    'latitude' => 1.4491,   'longitude' => 103.8185,   'status' => 'pending'],
            ['id' => 44, 'name' => 'Yio Chu Kang',                 'latitude' => 1.3911,   'longitude' => 103.8514,   'status' => 'pending'],
            ['id' => 45, 'name' => 'Yio Chu Kang Estate',          'latitude' => 1.3897,   'longitude' => 103.8539,   'status' => 'pending'],
            ['id' => 46, 'name' => 'Ang Mo Kio New Town',          'latitude' => 1.3803,   'longitude' => 103.8397,   'status' => 'pending'],
            ['id' => 47, 'name' => 'Singapore United Plantation',  'latitude' => 1.3792,   'longitude' => 103.8578,   'status' => 'pending'],
            ['id' => 48, 'name' => 'Kampong Amoy Quee',            'latitude' => 1.3833,   'longitude' => 103.85,     'status' => 'pending'],
            ['id' => 49, 'name' => 'Kampong Lew Lian',             'latitude' => 1.35,     'longitude' => 103.8667,   'status' => 'pending'],
            ['id' => 50, 'name' => 'Kampong Kebun Baharu',         'latitude' => 1.3667,   'longitude' => 103.8667,   'status' => 'pending'],
            ['id' => 51, 'name' => "Saint Michael's Estate",       'latitude' => 1.3278,   'longitude' => 103.8608,   'status' => 'pending'],
            ['id' => 52, 'name' => 'Kam Wak Hassan',               'latitude' => 1.4375,   'longitude' => 103.8306,   'status' => 'pending'],
            ['id' => 53, 'name' => 'Sungai Simpang',               'latitude' => 1.4381,   'longitude' => 103.8267,   'status' => 'pending'],
            ['id' => 54, 'name' => "Teacher's Housing Estate",     'latitude' => 1.3833,   'longitude' => 103.8286,   'status' => 'pending'],
            ['id' => 55, 'name' => 'Tanjong Pagar',                'latitude' => 1.2833,   'longitude' => 103.8333,   'status' => 'pending'],
            ['id' => 56, 'name' => 'Kampong Kopit',                'latitude' => 1.2667,   'longitude' => 103.8333,   'status' => 'pending'],
            ['id' => 57, 'name' => 'Saga',                         'latitude' => 1.2667,   'longitude' => 103.8333,   'status' => 'pending'],
            ['id' => 58, 'name' => 'Kampong Siren',                'latitude' => 1.3522,   'longitude' => 103.8981,   'status' => 'pending'],
            ['id' => 59, 'name' => 'Nee Soon Estate',              'latitude' => 1.4028,   'longitude' => 103.8178,   'status' => 'pending'],
            ['id' => 60, 'name' => 'Kampong Pengkalan Kundor',     'latitude' => 1.41,     'longitude' => 103.8444,   'status' => 'pending'],
            ['id' => 61, 'name' => 'Kampong Punggol',              'latitude' => 1.4125,   'longitude' => 103.9103,   'status' => 'pending'],
            ['id' => 62, 'name' => 'Punggol',                      'latitude' => 1.3983,   'longitude' => 103.909,    'status' => 'pending'],
            ['id' => 63, 'name' => 'Yew Tee',                      'latitude' => 1.3944,   'longitude' => 103.7539,   'status' => 'pending'],
            ['id' => 64, 'name' => 'Kampong Sungai Blukar',        'latitude' => 1.3881,   'longitude' => 103.9183,   'status' => 'suspended'],
            ['id' => 65, 'name' => 'Kampong Loyang',               'latitude' => 1.3778,   'longitude' => 103.9594,   'status' => 'suspended'],
            ['id' => 66, 'name' => 'Springleaf Park',              'latitude' => 1.3953,   'longitude' => 103.8214,   'status' => 'suspended'],
            ['id' => 67, 'name' => 'Kampong Tebing Terjun',        'latitude' => 1.3333,   'longitude' => 103.75,     'status' => 'suspended'],
            ['id' => 68, 'name' => 'West Coast Village',           'latitude' => 1.3167,   'longitude' => 103.75,     'status' => 'suspended'],
            ['id' => 69, 'name' => 'Kampong Sungai Pandan',        'latitude' => 1.3167,   'longitude' => 103.75,     'status' => 'suspended'],
            ['id' => 70, 'name' => 'Yishun New Town',              'latitude' => 1.43,     'longitude' => 103.835,    'status' => 'suspended'],
            ['id' => 71, 'name' => 'Kampong Pengkalan Petai',      'latitude' => 1.4033,   'longitude' => 103.85,     'status' => 'suspended'],
            ['id' => 72, 'name' => 'Sarang Rimau',                 'latitude' => 1.2597,   'longitude' => 103.8089,   'status' => 'suspended'],
            ['id' => 73, 'name' => 'Bright Hill Crescent',         'latitude' => 1.35,     'longitude' => 103.8333,   'status' => 'suspended'],
            ['id' => 74, 'name' => 'Kampong Pasir Ris',            'latitude' => 1.3783,   'longitude' => 103.9319,   'status' => 'suspended'],
            ['id' => 75, 'name' => 'Kampong Tanjong Penjuru',      'latitude' => 1.3,      'longitude' => 103.75,     'status' => 'suspended'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
