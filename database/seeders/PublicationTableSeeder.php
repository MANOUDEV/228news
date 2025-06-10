<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\PublicationFile;
use App\Models\PublicationTag;
use App\Models\Author;
use App\Models\Category;
use App\Models\File;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearFile;
use App\Models\InfosMonthYearPublication;
use App\Models\Tag;
use App\Models\TypePublication;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $publications_count = 0;

        $response = Http::get("https://www.togoactualite.com/wp-json/wp/v2/posts?per_page=100");

        $posts_count_by_type = [
            'x-wp-totalpages' => $response->getHeader('x-wp-totalpages')[0],
            'x-wp-total' => $response->getHeader('x-wp-total')[0],
        ];

        for($i = 1; $i <= $posts_count_by_type['x-wp-totalpages']; $i++){

            $posts = Http::get("https://www.togoactualite.com/wp-json/wp/v2/posts?page=$i&per_page=100")->json();

            foreach ($posts as  $value) {

                $author = Author::where('wp_author_id', $value['author'])->first();

                $type_publication = TypePublication::where('slug',"article")->first();


                if($author){

                    if($author->count_publications === 0){

                        $author->count_publications = 1;

                        $author->update();

                    }else{

                        $author->count_publications++;

                        $author->update();

                    }

                    if($type_publication->count_publications === 0){

                        $type_publication->count_publications = 1;

                        $type_publication->update();

                    }else{

                        $type_publication->count_publications++;

                        $type_publication->update();

                    }

                    $image_cover_url = null;

                    $verify_link_file = null;

                    if(isset($value['yoast_head_json']["schema"]['@graph'][0]['thumbnailUrl'])){

                        $image_cover_url = str_replace('https://togoactualite.com/wp-content/uploads', 'https://togoactualite.com/wp-content/uploads', $value['yoast_head_json']["schema"]['@graph'][0]['thumbnailUrl']);

                        $link_file = str_replace('https://togoactualite.com/wp-content/uploads', 'https://togoactualite.com/wp-content/uploads', $value['yoast_head_json']["schema"]['@graph'][0]['thumbnailUrl']);

                        $verify_link_file = File::where('file_url',  $link_file)->first();

                        if($verify_link_file){

                            if($verify_link_file->count_publications === 0){

                                $verify_link_file->count_publications = 1;

                                $verify_link_file->update();

                            }else{

                                $verify_link_file->count_publications++;

                                $verify_link_file->update();

                            }

                        }else{
                            
                            $link = $link_file; 

                            $date = Carbon::parse($value['date']);

                            $mois_id = $date->format('m');

                            $year = $date->format('Y');

                            $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                            $date_name = $mois->month.' '.$year;

                            $verify_date_name = InfosMonthYearFile::where('date_name', $date_name)->first();

                            if(!$verify_date_name){

                                InfosMonthYearFile::create(['date_name' => $date_name]);

                            }

                            $fichier_original = File::create([
                                'file_url' => $link,
                                'date_name' => $date_name,
                                'date_publish' => $value['date'],
                                'type_file_id' => 1,
                                'user_id' => 1
                            ]);
                        }


                    }

                    foreach ($value['categories'] as $wp_category) {

                        $info =  Category::where('wp_category_id', $wp_category)->first();

                        if($info->count_publications === 0){

                            $info->count_publications = 1;

                            $info->update();

                        }else{

                            $info->count_publications++;

                            $info->update();

                        }
                    }

                    foreach ($value['tags'] as $wp_tag) {

                        $info =  Tag::where('wp_tag_id', $wp_tag)->first();

                        if($info->count_publications === 0){

                            $info->count_publications = 1;

                            $info->update();

                        }else{

                            $info->count_publications++;

                            $info->update();

                        }
                    }

                    $date = Carbon::parse(date('Y-m-d H:i:s', strtotime($value['date'])));

                    $mois_id = $date->format('m');

                    $year = $date->format('Y');

                    $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                    $date_name = $mois->month.' '.$year;

                    $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                    if(!$verify_date_name){

                        InfosMonthYearPublication::create(['date_name' => $date_name]);

                    }

                    $views_count =  rand(351,2564);

                    $likes_count =  rand(123,554);

                    if(count($value['categories']) == 0){

                        $post = Publication::create([
                            'title' => $value["title"]['rendered'],
                            'title_truncate' => \Illuminate\Support\Str::words(strip_tags($value["title"]['rendered']), 10, ' ...'),
                            'slug' => \Illuminate\Support\Str::slug(strip_tags($value["title"]['rendered'])),
                            'date_name' => $date_name,
                            'deja_citer' => 0,
                            'image_cover_url' => $image_cover_url,
                            'content' =>  $value["content"]["rendered"],
                            'truncate_content' => \Illuminate\Support\Str::words(strip_tags($value["excerpt"]["rendered"]), 20, ' ...'),
                            'truncate_content_max' => $value["excerpt"]["rendered"],
                            'status' => $value["status"] == 'publish' ? 1 : 0,
                            'comment_status' => $value["comment_status"] == 'open' ? 1 : 0,
                            'views_count' => $views_count,
                            'likes_count' => $likes_count,
                            'shares_count' => 0,
                            'comment_count' => 0,
                            'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                            'wp_article_id' => $value["id"],
                            'author_id' => $author->id,
                            'author_slug' => $author->slug,
                            'author_name' => $author->authorName,
                            'type_publication_id' => $type_publication->id,
                            'type_publication_name' => $type_publication->name,
                            'type_publication_slug' => $type_publication->slug,
                            'user_id' => 1,
                            'source' => 'Togoactualité'
                        ]);

                    }else{

                        foreach ($value['categories'] as $wp_category) {

                            $category =  Category::where('wp_category_id', $wp_category)->first();

                            $publication_verify = Publication::where('title', $value["title"]['rendered'])->count();

                            if($publication_verify == 0){

                                $deja_citer = 0;

                            }else{

                                $deja_citer = 1;

                            }

                            if($category){

                                $post = Publication::create([
                                    'title' => $value["title"]['rendered'],
                                    'title_truncate' => \Illuminate\Support\Str::words(strip_tags($value["title"]['rendered']), 10, ' ...'),
                                    'slug' => \Illuminate\Support\Str::slug(strip_tags($value["title"]['rendered'])),
                                    'date_name' => $date_name,
                                    'deja_citer' => $deja_citer,
                                    'image_cover_url' => $image_cover_url,
                                    'content' => $value["content"]["rendered"],
                                    'truncate_content' => \Illuminate\Support\Str::words(strip_tags($value["excerpt"]["rendered"]), 20, ' ...'),
                                    'truncate_content_max' => $value["excerpt"]["rendered"],
                                    'status' => $value["status"] == 'publish' ? 1 : 0,
                                    'comment_status' => $value["comment_status"] == 'open' ? 1 : 0,
                                    'views_count' => $views_count,
                                    'likes_count' => $likes_count,
                                    'shares_count' => 0,
                                    'comment_count' => 0,
                                    'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                    'wp_article_id' => $value["id"],
                                    'category_id' => $category->id,
                                    'category_name' => $category->name,
                                    'category_slug' => $category->slug,
                                    'author_id' => $author->id,
                                    'author_slug' => $author->slug,
                                    'author_name' => $author->authorName,
                                    'type_publication_id' => $type_publication->id,
                                    'type_publication_name' => $type_publication->name,
                                    'type_publication_slug' => $type_publication->slug,
                                    'user_id' => 1,
                                    'source' => 'Togoactualité'
                                ]);
    
                            }
                        }

                    }

                    


                    if(count($value['tags'])){

                        foreach ($value['tags'] as $wp_tag) {

                            $info =  Tag::where('wp_tag_id', $wp_tag)->first();

                            PublicationTag::create([
                                'publication_id' => $post->id,
                                'tag_id' => $info->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                            ]);

                        }

                    }

                    if(isset($value['yoast_head_json']["schema"]['@graph'][0]['thumbnailUrl'])){

                        $info =  File::where('file_url',  str_replace('https://togoactualite.com/wp-content/uploads', 'https://togoactualite.com/wp-content/uploads', $value['yoast_head_json']["schema"]['@graph'][0]['thumbnailUrl']))->first();

                        if($info){

                            PublicationFile::create([
                                'publication_id' => $post->id,
                                'file_id' => $info->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                            ]);

                        }
                    }


                }

                $publications_count++;
            }
        }

    }
}
