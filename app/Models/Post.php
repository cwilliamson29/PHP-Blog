<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Support\Facades\File;
    use Spatie\YamlFrontMatter\YamlFrontMatter;

    class Post
	{
        public $title;
        public $excerpt;
        public $date;
        public $body;
        public $slug;

        public function __construct($title, $excerpt, $date, $body,$slug){
            $this->body = $body;
            $this->date = $date;
            $this->excerpt = $excerpt;
            $this->title = $title;
            $this->slug = $slug;

        }
        public static function find($slug){
//                if(!file_exists($path = resource_path("posts/{$slug}.html"))){
//                    throw new ModelNotFoundException();
//                 }
//
//            return cache()->remember("posts.{$slug}", 1200, fn()=> file_get_contents($path));
            return static::all()->firstWhere('slug', $slug);
        }
        public static function all(){
            return collect(File::files(resource_path("posts")))->map(function ($file) {
                $document = YamlFrontMatter::parseFile($file);

                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            });
        }
	}
