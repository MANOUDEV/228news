<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get("https://www.togoactualite.com/wp-json/wp/v2/categories?per_page=100");

        $categories_count_by_type = [
            'x-wp-totalpages' => $response->getHeader('x-wp-totalpages')[0],
            'x-wp-total' => $response->getHeader('x-wp-total')[0],
        ];

        for($i = 1; $i <= $categories_count_by_type['x-wp-totalpages']; $i++){

            $categories = Http::get("https://www.togoactualite.com/wp-json/wp/v2/categories?per_page=100&page=$i")->json();

            foreach( $categories as $result )
            {

                $categories =  Category::create([
                    'name' =>  $result['name'],
                    'slug' => $result['slug'],
                    'count_publications' => 0,
                    'date_publish' =>  now(),
                    'wp_category_id' => intval($result['id']),
                    'user_id' => 1
                ]);

            }
            
        }
    }
}
