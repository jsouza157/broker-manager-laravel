<?php
/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 26/12/18
 * Time: 11:19
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (! function_exists('saveImageS3')) {
    function saveImageS3($img)
    {
        $input = $img;
        $image = Image::make($input)->stream(\File::extension($input->getClientOriginalName()), 80);
        $path = '/easymovel/' . base64_encode($input->getClientOriginalName().Auth::id().date('H:i:s'));
        Storage::disk("s3")->put($path, $image->__toString(), "public");
        return $path;
    }
}
