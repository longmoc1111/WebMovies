<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Directors\StoreDirectorRequest;
use App\Http\Requests\Directors\UpdateDirectorRequest;
use App\Http\Resources\DirectorResource;
use App\Models\Country;
use App\Models\Director;
use Illuminate\Http\Request;
use File;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = Director::orderBy("created_at", "DESC")->paginate(10);
        $countries = Country::all();
        return DirectorResource::collection($directors)
            ->additional([
                'countries' => $countries
            ]);
    }

    public function destroy($id)
    {
        $data = Director::find($id);
        if (!$data) return response()->json("Đã có lỗi xãy ra vui long thử lại sau!");
        if ($data->DirectorAvatar) {
            $oldFile = storage_path("app/public/upload/avartarDirector/" . $data->DirectorAvatar);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
        }
        $data->DirectorMovie()->detach();
        $data->delete();
        return response()->json("Xóa thành công thông tin tác giả!");
    }

    public function store(StoreDirectorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile("DirectorAvatar")) {
            $file = $request->file("DirectorAvatar");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $data["DirectorAvatar"] = $newFileName;
            $file->move(storage_path("app/public/upload/avartarDirector"), $newFileName);
        }
        Director::create($data);
        return response()->json("Thêm mới thông tin tác giả thành công!");
    }
    public function update(UpdateDirectorRequest $request, $id)
    {
        $data = $request->validated();

        if (!$data) return response()->json([
            "message" => "Đã có lỗi xãy ra vui lòng thử lại sau!"
        ]);
        $director = Director::find($id);
        if ($request->hasFile("DirectorAvatar")) {
            if ($director->DirectorAvatar) {
                $oldFile = storage_path("app/public/upload/avartarDirector/" . $director->DirectorAvatar);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }
            $file = $request->file("DirectorAvatar");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $data["DirectorAvatar"] = $newFileName;
            $file->move(storage_path("app/public/upload/avartarDirector"), $newFileName);
        }
        if ($director) {
            $director->fill($data);
            if ($director->isDirty()) {
                $director->save();
            }
        }

        return response()->json("Cập nhật thông tin tác giả thành công!");
    }
}
