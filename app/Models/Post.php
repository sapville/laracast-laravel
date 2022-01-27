<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{

    public string $title;
    public string $excerpt;
    public \DateTimeImmutable $date;
    public string $body;
    public string $slug;

    /**
     * @param string $title
     * @param string $excerpt
     * @param \DateTimeImmutable $date
     * @param string $body
     * @param string $slug
     */
    public function __construct(string $title, string $excerpt, \DateTimeImmutable $date, string $body, string $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    /**
     * @throws Exception
     */
    public static function find(string $slug): string
    {
        if (!file_exists($file = resource_path("/posts/$slug.html"))){
            return new ModelNotFoundException();
        }

        return cache()->remember("posts/$slug", now()->addHours(3), fn() => file_get_contents($file));

    }

    public static function all(): array
    {
        return array_map(
            fn($file) => $file->getContents(),
            File::files(resource_path('/posts'))
        );
    }
}
