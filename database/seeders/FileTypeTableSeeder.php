<?php

namespace Database\Seeders;

use App\Models\TypeFile;
use Illuminate\Database\Seeder;

class FileTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeFile::create(['name' => "IMAGES", 'slug_wp' => "image", 'slug' => "images", 'date_publish' =>  now(),  'user_id' => 1]);
        TypeFile::create(['name' => "VIDEOS", 'slug_wp' => "video", 'slug' => "videos", 'date_publish' =>  now(),  'user_id' => 1]);
        TypeFile::create(['name' => "DOCUMENTS", 'slug_wp' => "text", 'slug' => "documents", 'date_publish' =>  now(),  'user_id' => 1]);
        TypeFile::create(['name' => "APPLICATIONS", 'slug_wp' => "application", 'slug' => "applications", 'date_publish' =>  now(),  'user_id' => 1]);
        TypeFile::create(['name' => "AUDIOS", 'slug_wp' => "audio", 'slug' => "audios", 'date_publish' =>  now(),  'user_id' => 1]);
    }
}
