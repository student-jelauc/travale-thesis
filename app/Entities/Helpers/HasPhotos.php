<?php


namespace App\Entities\Helpers;


use App\Entities\Photo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait HasPhotos
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'entity');
    }

    /**
     * @return Collection
     */
    public function photosDetails()
    {
        return $this->photos->map(function ($photo) {
            return [
                'name' => $photo->name,
                'size' => Storage::disk('public')->size($photo->path),
                'type' => Storage::disk('public')->mimeType($photo->path),
                'url' => Storage::disk('public')->url($photo->path),
            ];
        });
    }

    /**
     * @return string[]|Collection
     */
    public function photosUrl()
    {
        return $this->photos->map(function ($photo) {
            return Storage::disk('public')->url($photo->path);
        });
    }
}
