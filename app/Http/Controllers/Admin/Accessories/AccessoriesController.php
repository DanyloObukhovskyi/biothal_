<?php

namespace App\Http\Controllers\Admin\Accessories;

use App\Http\Requests\Accessories\Add as AccessoryAddRequest;
use App\Http\Requests\Accessories\Delete as AccessoryDeleteRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Accessories\Accessories;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class AccessoriesController extends Controller
{
    public function index(Request $request)
    {
        $accessories = Accessories::all();
//        dd($accessories);

        if (count($accessories) == 0) {
            return view('admin.accessories.index', ['accessories' => null]);
        }
        if ($request->ajax()) {
            foreach ($accessories as $key => $val) {
                $accessories[$key]['number'] = $key + 1;
            }
            return Datatables::of($accessories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-toggle="modal" data-target="#change_access" name="tofita" data-id="'
                        . $row->id . '" data-title="' . $row->title . '" data-order="' . $row->ordering
                        . '" data-parent="' . ($row->parent_id != null ? $row->Accessory->title : "null")
                        . '" data-parent-id="' . ($row->parent_id != null ? $row->parent_id : "null")
                        . '" id="' . ("accessory_change" . $row->id) . '" class="btn btn-outline-dark fa fa-wrench"></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.accessories.index', ['accessories' => $accessories]);
    }

    public function addAccessory(AccessoryAddRequest $request)
    {
        $accessoriesCount = count(Accessories::all());
        Accessories::create([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'ordering' => $request->ordering,
        ]);

        if ($accessoriesCount == 0) {
            return response()->json([
                'message' => false,
            ]);
        }

        $accessory = Accessories::all()->last();
        // Проверяем создана ли РОДИТЕЛЬСКАЯ категория, если да - добавляем в модалку в селект
        if ($accessory->parent_id == null) {
            return response()->json([
                'message' => "Категория успешно добавлена",
                'value' => $accessory->title,
                'parent' => $accessory->title,
            ]);
        }

        return response()->json([
            'message' => "Потребность успешно добавлена",
            'value' => false,
        ]);
    }

    public function deleteAccessory(AccessoryDeleteRequest $request)
    {

        // Получаем статус 0 - проверка(если все хорошо, тогда удаление), 1 - удаление
        $status = $request->status;

        // Если статус равен 0
        if ($status == 0) {
            if ($request->checked != 0) {
                foreach ($request->checked as $catId) {
                    $accessory = Accessories::where('id', (int)$catId)->first();

                    // Возвращаем модалку с подтверждением
                    return response()->json([
                        'warning' => [
                            'title' => 'Вы уверены что хотите удалить эту потребность?',
                        ]
                    ]);

                }

                // Если родительских категорий нет, то просто удаляем
                foreach ($request->checked as $catId) {
                    $accessory = Accessories::where('id', (int)$catId)->first();
                    $accessory->delete();
                }
                return response()->json([
                    'accepted' => 'Потребности успешно удалены'
                ]);
            }

            // Если ничего не выбрано, отправляем уведомление
            return response()->json([
                'error' => "Выберите хотя бы одну потребность"
            ]);
        }

        // Если статус равен 1
        if ($status == 1) {
            if ($request->checked != 0) {
                $values = []; // Переменная для хранения id родительских категорий (удаление из селекта в модальном окне)
                foreach ($request->checked as $catId) {
                    $accessory = Accessories::where('id', (int)$catId)->first();

                    if ($accessory != null) {
                        $values[] += $accessory->id;
                        $accessory->delete();
                    }
                }

                // Если категорий не осталось, возвращаем false и перезагружаем страницу
                if (count(Accessories::all()) == 0) {
                    return response()->json([
                        'status' => false,
                    ]);

                }
                // Если все прошло успешно, возвращаем наобходимые данные
                return response()->json([
                    'accepted' => 'Потребности успешно удалены',
                    'value' => isset($values) ? $values : false,
                    'status' => true,
                ]);
            } else {
                // Если ничего не выбрано, отправляем уведомление
                return response()->json([
                    'error' => "Выберите хотя бы одну потребность"
                ]);
            }
        }
    }


    public function changeAccessory(AccessoryAddRequest $request)
    {
        $parentId = $request->parent_id == "NoAccessory" ? null : $request->parent_id;
        $accessory = Accessories::find($request->id);
        $accessory->update([
            'parent_id' => $parentId,
            'title' => $request->title,
            'ordering' => $request->ordering,
        ]);

        return response()->json([
            'message' => "Потребность успешно изменена"
        ]);
    }
}
