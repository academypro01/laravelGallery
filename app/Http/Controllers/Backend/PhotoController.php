<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;


class PhotoController extends Controller
{
    // public_path('images'.DIRECTORY_SEPARATOR.'eset.png')
    public function upload(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:4096',
        ]);

        $image = $request->file('file');
        $name = uniqid().time().$image->getClientOriginalName();
        $input['file'] = $name;

        $imgFile = Image::make($image->getRealPath());

        $imgFile->text('@Academy.01', $imgFile->width()/5, $imgFile->height()/5, function($font) use ($imgFile) {
            $font->file(public_path('backend/dist/fonts/Vazir.ttf'));
            $font->size($imgFile->width()/20);
            $font->color('#2c2c2c');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(0);
        })
            ->resize(720, 650)
            ->encode('webp')
            ->save(public_path('/images').'/'.$input['file']);

        $photo = new Photo();

        $photo->path = $name;
        $photo->original_name = $image->getClientOriginalName();
        $photo->user_id = Auth::id();

        $photo->save();

        return response()->json([
            'photo_id' => $photo->id
        ]);
    }
}
