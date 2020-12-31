<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function delete(Request $request)
    {
        try {
            $img = Image::where('id', '=', $request->image_id)->first();
            deleteImageS3($img->image);
            $img->delete();

            Session('success', 'Imagem removida com sucesso.');
            return redirect()->back();
        } catch (\Exception $e) {
            Session('danger', 'Cocorreu um erro ao remover imagem.');
            return redirect()->back();
        }
    }
}
