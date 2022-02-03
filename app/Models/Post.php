<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Traits\Conditionable;

class Post extends Model
{
    use HasFactory;

    /*    protected $primaryKey = 'slug';
        protected $keyType = 'string';
        public $incrementing = false;*/

    /*    public function getRouteKeyName(): string
        {
            return 'slug';
        }*/

    protected $with = ['category', 'author'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $query, array $request)
    {
        $query->when($request['search'] ?? false, function (Builder $builder, $search) {
            $builder
                ->where('body', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%");
        });

        $query->when($request['category'] ?? false, function (Builder $builder, $search) {
            $builder->whereRelation('category', 'slug', $search);
        });

        $query->when($request['author'] ?? false, function (Builder $builder, $search) {
            $builder->whereRelation('author', 'username', $search);
        });
    }

}
