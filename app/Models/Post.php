<?php

namespace App\Models;

use DateTimeImmutable;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public string $title;
    public string $excerpt;
    public DateTimeImmutable $date;
    public string $body;
    public string $slug;

    /**
     * @param string $title
     * @param string $excerpt
     * @param DateTimeImmutable $date
     * @param string $body
     * @param string $slug
     */
    public function __construct(string $title, string $excerpt, DateTimeImmutable $date, string $body, string $slug)
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
    public static function find(string $slug): Post
    {
        return self::all()->firstWhere('slug', $slug);
    }

    public static function all(): Collection
    {
        return collect(File::files(resource_path('posts')))
            ->map(fn($file) => YamlFrontMatter::parse(
                cache()->remember($file->getFileName(), now()->addMinutes(30), fn() => $file->getContents())
            ))
            ->map(fn($doc) => new Post(
                $doc->matter('title'),
                $doc->matter('excerpt'),
                DateTimeImmutable::createFromFormat('Ymd', $doc->matter('date')),
                $doc->body(),
                $doc->matter('slug')
            ))
            ->sort(fn($a, $b) => $a->date->getTimestamp() >= $b->date->getTimestamp() ? -1 : 1);
    }
}
