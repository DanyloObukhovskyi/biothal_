<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    ValidImgRequest,
    Images\Delete as ImageDeleteRequest
};
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $imagesAll = Image::all();
        // Если нет изображений, выводим подсказку
        if (count($imagesAll) == 0) {
            return view('admin.images.index', ['images' => null]);
        }

        $n = 0; // Номер группы
        $i = 0; // Итератор
        // Делаю групы по 4 изображения, для удобного размещения на форме
        foreach ($imagesAll as $image) {
            $imageS[$i + 1] = $image;
            $i++;
            $images[$n] = $imageS;
            if ($i % 4 == 0) {
                $imageS = null;
                $n++;
            }
        }
        return view('admin.images.index', ['images' => $images]);
    }

    public function addImage(ValidImgRequest $request)
    {
//        dd($request->toArray());
        // Проверяем есть ли файл
        if (!$request->hasFile('img')) {
            return redirect()->route('admin.images.page');
        }
        $name = $request->file('img')->getClientOriginalName();

        // Помещаем файл в репозиторий
        $request->file('img')->move(public_path("img"), $name);
        // Добавляем файл в базу
        Image::create([
            'name' => $name
        ]);

        return redirect()->route('admin.images.page');
    }

    public function deleteImage(ImageDeleteRequest $request)
    {
//        dd($request->toArray());
        foreach ($request->checked as $imgId) {
            $image = Image::where('id', (int)$imgId)->first();
            $image->delete();
        }
        return true;
    }
}
