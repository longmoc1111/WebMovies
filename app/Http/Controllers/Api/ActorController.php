<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActorRequest\StoreActorReqeust;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use App\Models\Country;
use Illuminate\Http\Request;
use File;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::orderBy("created_at", "DESC")->paginate(20);
        $countries = Country::all();
        return response()->json([
            "actors" => ActorResource::collection($actors),
            "Countries" => $countries
        ]);
    }
    public function destroy($id)
    {
        $data = Actor::find($id);
        if (!$data) return response()->json("Đã có lỗi xãy ra vui long thử lại sau!");
        if ($data->ActorAvatar) {
            $oldFile = storage_path("app/public/upload/avartarActor/" . $data->ActorAvatar);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
        }
        $data->ActorMovie()->detach();
        $data->delete();
        return response()->json("Xóa thành công thông tin diễn viên!");
    }
    public function store(Request $request)
    {
        $data = $request->all();
        // if ($request->hasFile("ActorAvatar")) {
        //     $file = $request->file("ActorAvatar");
        //     $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //     $fileNameExt = $file->getClientOriginalExtension();
        //     $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
        //     $data["ActorAvatar"] = $newFileName;
        //     $file->move(storage_path("app/public/upload/avartarActor"), $newFileName);
        // }
        // Actor::create($data);
        // return response()->json("Thêm mới thông tin diễn viên thành công!");
        return response($data);
    }
}
