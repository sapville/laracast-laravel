<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

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

    protected $with = ['category', 'author', 'postView', 'bookmarks'];
    protected $fillable = ['user_id', 'slug', 'title', 'excerpt', 'body', 'category_id', 'thumbnail', 'published_at'];

    public function bookmarks(): BelongsToMany {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function postView(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter(Builder $query, array $request)
    {
        $query->when($request['search'] ?? false, function (Builder $builder, $search) {
            $builder->where(fn($query) => $query
                ->where('body', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%")
            );
        })->when(!Gate::allows('admin'), function (Builder $builder) {
            $builder->whereNotNull('published_at');
        });

        $query->when($request['category'] ?? false, function (Builder $builder, $search) {
            $builder->whereRelation('category', 'slug', $search);
        });

        $query->when($request['author'] ?? false, function (Builder $builder, $search) {
            $builder->whereRelation('author', 'username', $search);
        });

    }

    public function setTitleAttribute($value)
    {
        $this->attributes['slug'] = Str::of($value)->slug();
        $this->attributes['title'] = $value;
    }

    protected function thumbnail(): Attribute
    {
        return new Attribute(
            fn($value) => asset($value ? '/storage/' . $value : '/images/illustration-' . collect(['1', '2', '3', '4', '5'])->random() . '.png')
        );
    }

}
