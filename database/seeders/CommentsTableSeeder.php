<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\Comment;
use App\Models\Commentator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get("https://www.togoactualite.com/wp-json/wp/v2/comments?per_page=100");

        $comments_count_by_type = [
            'x-wp-totalpages' => $response->getHeader('x-wp-totalpages')[0],
            'x-wp-total' => $response->getHeader('x-wp-total')[0],
        ];

        for($i = 1; $i <= $comments_count_by_type['x-wp-totalpages']; $i++){
         

            $comments = Http::get('https://www.togoactualite.com/wp-json/wp/v2/comments?per_page=100&page='.$i)->json();

            foreach ($comments as  $value) {

                $check_commentator = Commentator::where('nom_complet', $value['author_name'])->first();

                $check_articles = Publication::where('wp_article_id', $value['post'])->get();

                if($check_articles){

                    foreach ($check_articles as  $check_article) {

                        if ($check_commentator) {

                            $comment_create = Comment::create([
                                'content' => $value['content']['rendered'],
                                'publication_id' => $check_article->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                'commentator_id' => $check_commentator->id
                            ]);

                            $check_commentator->count_comments += 1;

                        } else {

                            $commentator_create = Commentator::create([
                                'nom_complet' => $value['author_name'],
                                'slug' => Str::slug($value['author_name']),
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                            ]);

                            $comment_create = Comment::create([
                                'content' => $value['content']['rendered'],
                                'publication_id' => $check_article->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                'commentator_id' => $commentator_create->id
                            ]);

                            $commentator_create->count_comments += 1;

                        }

                        $check_article->comment_count += 1;

                        $check_article->update();
                    }
                }


            }

        }
    }
}
