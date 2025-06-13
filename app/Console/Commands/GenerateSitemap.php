<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Site Map Index 
        $pages = ['', 'about', 'contact', 'forum', 'infos-partatiques', 'events', 'pub', 'videos', 'all-category', 'search-article'];
        $lastmod = now()->toDateString();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($pages as $page) {
            $url = 'https://togoactu.com/'. $page;
            $lastmod = now()->toDateString();

            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>{$url}</loc>\n";
            $sitemap .= "    <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n";
        }

        $sitemap .= '</urlset>';

        Storage::disk('public')->put('sitemap.xml', $sitemap);

        $this->info('✅ Sitemap généré avec succès dans storage/app/public/sitemap.xml');

        //Site Map Categories
        $categories = Category::orderBy('updated_at', 'desc')->get();
        $lastmod = now()->toDateString();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($categories as $category) {
            $url = 'https://togoactu.com/'. $category->slug;
            $lastmod = $category->updated_at->format('Y-m-d');

            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>{$url}</loc>\n";
            $sitemap .= "    <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n";
        }

        $sitemap .= '</urlset>';

        Storage::disk('public')->put('sitemap-categories.xml', $sitemap);

        $this->info('✅ Sitemap généré avec succès dans storage/app/public/sitemap-categories.xml');

        //Site Map Tags
        $Tags = Tag::orderBy('updated_at', 'desc')->get();
        $lastmod = now()->toDateString();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($Tags as $tag) {
            $url = 'https://togoactu.com/tags/'. $tag->slug;
            $lastmod = $tag->updated_at->format('Y-m-d');

            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>{$url}</loc>\n";
            $sitemap .= "    <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n";
        }

        $sitemap .= '</urlset>';

        Storage::disk('public')->put('sitemap-tags.xml', $sitemap);

        $this->info('✅ Sitemap généré avec succès dans storage/app/public/sitemap-tags.xml');

        //Site Map Tags
        $authors = Author::orderBy('updated_at', 'desc')->get();
        $lastmod = now()->toDateString();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($authors as $author) {
            $url = 'https://togoactu.com/authors/'. \Illuminate\Support\Str::slug(strip_tags($author->authorName));
            $lastmod = $author->updated_at->format('Y-m-d');

            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>{$url}</loc>\n";
            $sitemap .= "    <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n";
        }

        $sitemap .= '</urlset>';

        Storage::disk('public')->put('sitemap-authors.xml', $sitemap);

        $this->info('✅ Sitemap généré avec succès dans storage/app/public/sitemap-authors.xml');

         //Site Map Tags
        $publications = Publication::where('status', 1)->where('deja_citer', 0)->orderBy('updated_at', 'desc')->get();
        $lastmod = now()->toDateString();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($publications as $publication) {
            $url = 'https://togoactu.com/'. \Illuminate\Support\Str::slug(strip_tags($publication->slug));
            $lastmod = $publication->updated_at->format('Y-m-d');

            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>{$url}</loc>\n";
            $sitemap .= "    <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n";
        }

        $sitemap .= '</urlset>';

        Storage::disk('public')->put('sitemap-publications.xml', $sitemap);

        $this->info('✅ Sitemap généré avec succès dans storage/app/public/sitemap-publications.xml');
    }
}
