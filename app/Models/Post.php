<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{

    /**
     * @throws \Exception
     */
    public static function find($slug): string
    {
        if (!file_exists($file = resource_path("/posts/$slug.html"))){
            return new ModelNotFoundException();
        }

        return cache()->remember("posts/$slug", now()->addHour(3), fn() => file_get_contents($file));

    }

    public static function all(): array
    {
        return array_map(
            fn($file) => $file->getContents(),
            File::files(resource_path('/posts'))
        );
    }
}
