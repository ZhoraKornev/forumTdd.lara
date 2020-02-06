<?php


namespace App;
use Illuminate\Database\Eloquent\Collection;

/** @property Collection|Favorite[] $favorites */
trait Favoritable
{
    /**
     * @return mixed
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];
        if (!$this->favorites()->where($attributes)->exists()) {

            $this->favorites()->create($attributes);
        }
    }

    /**
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * @return mixed
     */
    public function getFavoritesCountAttribute()
    {

        return $this->favorites->count();
    }
}
