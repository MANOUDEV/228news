<?php

namespace Database\Seeders;

use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $response = Http::get("https://www.togoactualite.com/wp-json/wp/v2/tags?per_page=100");

        $tags_count_by_type = [
            'x-wp-totalpages' => $response->getHeader('x-wp-totalpages')[0],
            'x-wp-total' => $response->getHeader('x-wp-total')[0],
        ];

        for($i = 1; $i <= $tags_count_by_type['x-wp-totalpages']; $i++){
         

            //Exporter les Tags 01
            $tags = Http::get('https://www.togoactualite.com/wp-json/wp/v2/tags?per_page=100&page='.$i)->json();

            foreach ($tags as  $value) {

                $date = Carbon::parse(now());

                $mois_id = $date->format('m');

                $year = $date->format('Y');

                $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                $date_name = $mois->month.' '.$year;

                $verify_date_name = InfosMonthYearTag::where('date_name', $date_name)->first();

                if(!$verify_date_name){

                    InfosMonthYearTag::create(['date_name' => $date_name, 'deja_citer' => 0, 'user_id' => 1]);

                }else{

                    if($verify_date_name->deja_citer === 0){

                        InfosMonthYearTag::create(['date_name' => $date_name, 'deja_citer' => 1, 'user_id' => 1]);

                    }

                }

                $post =  Tag::create([
                    'name' =>  $value['name'],
                    'date_name' => $date_name,
                    'slug' => $value['slug'],
                    'count_publications' => 0,
                    'date_publish' =>  now(),
                    'wp_tag_id' => intval($value['id']),
                    'user_id' => 1
                ]);

            }

        }
    }
}
