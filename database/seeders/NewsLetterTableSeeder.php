<?php

namespace Database\Seeders;

use App\Models\NewsLetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsLetterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $news_letters =[ 
            [
                'email' => 'manouadjanor@gmail.com',
                'slug' => Str::slug('manouadjanor@gmail.com'),
                'status' => 1, 
                'date_publish' => now(),
            ],
            [
                'email' => 'nonojack@yahoo.fr',
                'slug' => Str::slug('nonojack@yahoo.fr'),
                'status' => 1, 
                'date_publish' => now(),
            ]
        ];

        foreach ($news_letters as $news_letter) {

           NewsLetter::create($news_letter);
           
        }
    }
}
