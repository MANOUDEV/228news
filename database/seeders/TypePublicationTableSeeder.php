<?php

namespace Database\Seeders;

use App\Models\TypePublication;
use Illuminate\Database\Seeder;

class TypePublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePublication::create(['name' => "ARTICLE", 'slug' => "article",'date_publish' =>  now(),  'user_id' => 1]);
        TypePublication::create(['name' => "INFO ALERT", 'slug' => "info-alert",'date_publish' =>  now(),  'user_id' => 1]);
        TypePublication::create(['name' => "ANNONCE", 'slug' => "annonce",'date_publish' =>  now(),  'user_id' => 1]);
        TypePublication::create(['name' => "VIDEOS", 'slug' => "videos",'date_publish' =>  now(),  'user_id' => 1]);
        TypePublication::create(['name' => "PUBLICITES", 'slug' => "publicites",'date_publish' =>  now(),  'user_id' => 1]);
        TypePublication::create(['name' => "EVENEMENT", 'slug' => "evenement",'date_publish' =>  now(),  'user_id' => 1]);
    }
}
