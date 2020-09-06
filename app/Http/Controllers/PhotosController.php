<?php


namespace App\Http\Controllers;


use App\Entities\Helpers\HasPhotos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PhotosController extends Controller
{
    /**
     * @param HasPhotos|Model $entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($entity)
    {
        $this->authorize('view', $entity);

        return response()->json(
            $entity->photosDetails()
        );
    }


    /**
     * @param Request $request
     * @param HasPhotos|Model $entity
     */
    public function upload(Request $request, $entity)
    {
        $this->authorize('update', $entity);

        foreach (Arr::wrap($request->file('file')) as $file) {
            $name = $file->getClientOriginalName();
            $path = $file->store("accommodations/{$entity->id}", 'public');

            $entity->photos()->create([
                'path' => $path,
                'name' => $name,
            ]);
        }
    }

    /**
     * @param Request $request
     * @param HasPhotos|Model $entity
     */
    public function delete(Request $request, $entity)
    {
        $this->authorize('update', $entity);

        $entity->photos()->where('name', $request->file)->delete();
    }
}
