<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\TypeFile;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearFile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        function str_replace_all($search, $replace, $subject) {

            return str_replace($search, $replace, $subject);

        }

        $type_files = TypeFile::get();

        $medias_count_by_type = [];

        foreach($type_files as $type_file){

            $response = Http::get("https://www.togoactualite.com/wp-json/wp/v2/media?media_type=$type_file->slug_wp&per_page=100");
            
            $medias_count_by_type[] = [
                'x-wp-totalpages' => $response->getHeader('x-wp-totalpages')[0],
                'x-wp-total' => $response->getHeader('x-wp-total')[0],
                'type_file_id' => $type_file->id,
                'type_file_name' => $type_file->name,
                'type_file_slug_wp' => $type_file->slug_wp,
            ];

            $type_file->count_files = $response->getHeader('x-wp-total')[0];

            $type_file->update();
        
        }

        //dd($medias_count_by_type);

        foreach($medias_count_by_type as $result){

           
            $media_type = $result['type_file_slug_wp'];

            $page = $result['x-wp-totalpages'];

            $type_file_id = $result['type_file_id'];

            for($i = 1; $i <= $page; $i++){

                $medias = Http::get('https://www.togoactualite.com/wp-json/wp/v2/media?media_type=$media_type&page='.$i.'&per_page=100')->json();

            
                foreach( $medias as $media ){ 
                    
                    if(isset($media['source_url'])){

                        $link = $media['source_url']; 

                        $date = Carbon::parse($media["modified_gmt"]);

                        $mois_id = $date->format('m');

                        $year = $date->format('Y');

                        $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                        $date_name = $mois->month.' '.$year;

                        $verify_date_name = InfosMonthYearFile::where('date_name', $date_name)->first();

                        if(!$verify_date_name){

                            InfosMonthYearFile::create(['date_name' => $date_name]);

                        }

                        $fichier_original = File::create([
                            'file_url' => str_replace('https://togoactualite.com/wp-content/uploads', 'https://togoactualite.com/wp-content/uploads', $link),
                            'date_name' => $date_name,
                            'file_name' => $media['title']['rendered'],
                            'caption' => $media['caption']['rendered'] ? strip_tags($media['caption']['rendered']) : null,
                            'file_slug' => \Illuminate\Support\Str::slug($media['title']['rendered']),
                            'wp_file' => $media['source_url'],
                            'date_publish' => $media["modified_gmt"],
                            'type_file_id' => $type_file_id,
                            'user_id' => 1
                        ]);
        
                            
                    }

                    
                }

                    
            }
            
        }

    }
}
