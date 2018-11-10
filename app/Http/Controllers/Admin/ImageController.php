<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $image = Image::make($_FILES['qqfile']['tmp_name']);

        $fileName = $request->get('qqfilename');
        $fileName = explode('.', $fileName);
        $fileName = $request->get('qquuid') . '.' . end($fileName);

        $filePath = storage_path('app/public/images/') . $fileName;

        $image->save($filePath);

        $imageToSave = new Photo([
            'name' => $request->get('qqfilename'),
            'album_id' => $request->get('album_id'),
            'saved_name' => $fileName,
            'uid' => $request->get('qquuid'),
            'type' => $request->all('qqfile')['qqfile']->getMimeType()
        ]);

        $imageToSave->save();

        return response()->json(["success" => true]);
    }

    /**
     * Apaga uma imagem de um album.
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request, $imageId)
    {
        $image = Photo::where('uid', '=', $imageId)
            ->first();

        if (empty($image)) {
            return response([], 404);
        }

        $filePath = storage_path('app/public/images/') . $image->saved_name;

        if (!file_exists($filePath)) {
            return response([], 404);
        }

        if (!unlink($filePath)) {
            return response([], 404);
        }

        $image->delete();
    }

    public function listByAlbum($albumId)
    {
        $album = Album::find($albumId);

        $responseImages = [];

        foreach ($album->photos as $image) {

            $filePath = storage_path('app/public/images/') . $image->saved_name;
            $originalImageFile = Image::make($filePath);

            $heightScale = 100;

            if ($originalImageFile->height() > $heightScale) {
                $height = $heightScale;

                $percentSize = ($heightScale * 100) / $originalImageFile->height();

                $width = ($originalImageFile->width() / 100) * $percentSize;

                $originalImageFile->resize($width, $height);
            }

            $base64Image = base64_encode($originalImageFile->encode()->encoded);

            $responseImages[] = [
                'name' => $image->name,
                'uuid' => $image->uid,
                'thumbnailUrl' => 'data:image/jpeg;base64,' . $base64Image
            ];
        }

        return response()->json($responseImages);
    }
}
