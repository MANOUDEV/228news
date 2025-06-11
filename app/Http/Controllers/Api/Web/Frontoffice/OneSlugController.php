<?php

namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Models\Publication;
use App\Models\PublicationTag;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OneSlugController extends BaseController
{
    public function slug(Request $request, $slug){

        $articles_count = Publication::where('status', 1)->where("publications.type_publication_id", 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            if($slug === 'ads.txt'){

                return view('adsense.ads');

            }elseif($slug === 'privacy'){

                return view('oneSlugPage.privacy');

            }elseif($slug === 'contact'){

                return view('oneSlugPage.contact');

            }elseif($slug === 'about'){

                $users = User::where('status', 1)->paginate(10);

                return view('oneSlugPage.about', ['users' => $users]);

            }elseif ($slug === 'terms') {

                return view('oneSlugPage.terms');

            }elseif ($slug === 'all-category') {

                $categories = Category::query();

                if($request->input('search')){

                    $categories = DB::table("categories")
                    ->where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.slug', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.date_publish', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.count_publications', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->paginate(9);

                    $categoryCount = DB::table("categories")
                    ->where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.slug', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.date_publish', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.count_publications', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->count();

                }else{

                    $categories = DB::table("categories")
                    ->orderBy('categories.count_publications', 'desc')
                    ->paginate(9);

                    $categoryCount = Category::count();

                }

                return view('oneSlugPage.all-category', ['categories' => $categories, 'categoryCount'=> $categoryCount]);

            }else if($slug === "search-posts"){

                $categories = Category::query();

                if($request->input('query')){

                    $search = $request->input('query');

                    $articles = Publication::where('publications.status', 1)
                    ->where("publications.type_publication_id", 1)
                    ->where('publications.deja_citer', 0)
                    ->where('publications.title', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.category_name', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.author_name', 'like', '%'. $request->input('query') . '%')
                    ->orderBy('publications.date_publish', 'desc')
                    ->get();

                    $count = Publication::where('publications.status', 1)
                    ->where("publications.type_publication_id", 1)
                    ->where('publications.deja_citer', 0)
                    ->where('publications.title', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.category_name', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.author_name', 'like', '%'. $request->input('query') . '%')
                    ->orderBy('publications.date_publish', 'desc')
                    ->count();

                    return view('oneSlugPage.search-publications', ['articles' => $articles, 'search' => $search, 'count' => $count]);

                }else{

                    $search = false;

                    $count = false;

                    $articles = Publication::where('status', 1)->where("publications.type_publication_id", 1)->where('deja_citer', 0)->orderBy('date_publish', 'desc')->take(10)->get();

                    return view('oneSlugPage.search-publications', ['articles' => $articles, 'search' => $search, 'count' => $count]);

                }
            }else if($slug === "cookies"){

                return view('oneSlugPage.cookies');

            }else if($slug === "pub"){

                return view('oneSlugPage.pub');

            } else{

                $category = Category::where('slug', $slug)->first();

                $article = Publication::where('slug', $slug)->where("status", 1)->first();

                if (($category == null) && ( $article == null)) {

                    return view('errors.ErrorSlugPage');

                }elseif(($category !== null) && ( $article == null)) {


                    $otherCategory = Category::get();

                    $articles = Publication::where("publications.status", 1)
                    ->where("publications.type_publication_id", 1)
                    ->where("publications.category_id", $category->id)
                    ->orderBy('publications.date_publish', 'desc')
                    ->paginate(6);

                    $alireaussi = Publication::where("publications.deja_citer", 0)
                    ->where("publications.type_publication_id", 1)
                    ->where("publications.status", 1)
                    ->orderBy('publications.date_publish', 'desc')
                    ->take(5)
                    ->get();

                    return view('oneSlugPage.category', ['articles' => $articles, 'alireaussi' => $alireaussi, 'category' => $category, 'otherCategory' => $otherCategory]);

                }else{

                    if($article->type_publication_id == 1){

                        $categoriesH = Publication::where("publications.id", $article->id)->get();

                        $tags = PublicationTag::select(array("tags.name", "tags.id", "tags.slug"))
                        ->where("publications.id", $article->id)
                        ->leftJoin("publications", "publications.id", "=", "publication_tags.publication_id")
                        ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                        ->get();

                        $tagsCount = PublicationTag::select(array("tags.name", "tags.id", "tags.slug"))
                        ->where("publications.id", $article->id)
                        ->leftJoin("publications", "publications.id", "=", "publication_tags.publication_id")
                        ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                        ->count();

                        $files = Publication::select(array("files.file_url"))
                        ->where("publications.id", $article->id)
                        ->leftJoin("publication_files", "publication_files.publication_id", "=", "publications.id")
                        ->leftJoin("files", "files.id", "=", "publication_files.file_id")
                        ->get();

                        $previous = Publication::select('title', 'slug')->where('id', '<' ,$article->id)->where("status", 1)->where("publications.type_publication_id", 1)->where("deja_citer", 0)->orderBy('publications.date_publish', 'desc')->first();

                        $next = Publication::select('title', 'slug')->where('id', '>' ,$article->id)->where("status", 1)->where("publications.type_publication_id", 1)->where("deja_citer", 0)->orderBy('publications.date_publish', 'desc')->first();

                        if($previous && $next){

                            $category = Publication::where("publications.id", $article->id)->first();

                            $similars = Publication::where("status", 1)
                            ->where("publications.type_publication_id", 1)
                            ->where("category_id", $category->category_id)
                            ->where("id", "!=" ,$article->id)
                            ->where("id", "!=" ,$previous->id)
                            ->where("id", "!=" ,$next->id)
                            ->where("deja_citer", 0)
                            ->orderBy('date_publish', 'desc')
                            ->take(9)->get();

                        }else{

                            $category = Publication::where("publications.id", $article->id)->first();

                            $similars = Publication::where("status", 1)
                            ->where("publications.type_publication_id", 1)
                            ->where("category_id", $category->category_id)
                            ->where("deja_citer", 0)
                            ->where("id", "!=" ,$article->id)
                            ->orderBy('date_publish', 'desc')
                            ->take(9)->get();

                        }

                        return view('oneSlugPage.publication',[
                            'article' => $article,
                            'files' => $files,
                            'tags' => $tags,
                            'tagsCount' => $tagsCount,
                            'previous' => $previous,
                            'next' => $next,
                            'similars' => $similars,
                            'categoriesH' => $categoriesH
                        ]);

                    }



                }
            }

        }
    }

    public function tags($slug)
    {


        $articles_count = Publication::where('status', 1)->where("publications.type_publication_id", 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            $tag = Tag::where('slug', $slug)->first();

            if ($tag == null) {

                return view('errors.ErrorSlugPage');

            } else {



                $articles = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.image_cover_url"))
                ->where("publications.status", 1)
                ->where("publications.type_publication_id", 1)
                ->where("tags.id", $tag->id)
                ->where("publications.deja_citer", 0)
                ->leftJoin("publication_tags", "publication_tags.publication_id", "=", "publications.id")
                ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                ->orderBy('publications.date_publish', 'desc')
                ->paginate(6);

                return view('oneSlugPage.tags', ['articles' => $articles, 'tag' => $tag]);

            }
        }
    }

    public function authors($slug)
    {

        $articles_count = Publication::where('status', 1)->where("publications.type_publication_id", 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            $author = Author::where('slug', $slug)->first();

            if ($author == null) {

                return view('errors.ErrorSlugPage');

            } else {

                $articles = Publication::where("status", 1)
                ->where("publications.type_publication_id", 1)
                ->where("deja_citer", 1)
                ->where("author_slug", $author->slug)
                ->orderBy('date_publish', 'desc')
                ->paginate(6);

                return view('oneSlugPage.authors', ['articles' => $articles, 'author' => $author]);

            }
        }
    }

}
