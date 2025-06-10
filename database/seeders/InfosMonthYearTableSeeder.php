<?php

namespace Database\Seeders;

use App\Models\InfosMonthYear;
use Illuminate\Database\Seeder;

class InfosMonthYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
            [ 'month_id' => '01', 'month' => 'Janvier' ],
            ['month_id' => '02', 'month' => 'Février' ],
            ['month_id' => '03','month' => 'Mars'],
            ['month_id' => '04','month' => 'Avril'],
            ['month_id' => '05', 'month' => 'Mai'],
            ['month_id' => '06','month' => 'Juin'],
            ['month_id' => '07','month' => 'Juillet'],
            ['month_id' => '08','month' => 'Aout'],
            ['month_id' => '09', 'month' => 'Septembre'],
            ['month_id' => '10', 'month' => 'Octobre'],
            ['month_id' => '11', 'month' => 'Novembre'],
            ['month_id' => '12', 'month' => 'Décembre'],
        ];

        foreach ($months as $month) {

            $result = InfosMonthYear::create($month);
            
        }
    }
}
