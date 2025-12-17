<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActorRequest\StoreActorRequest;
use App\Http\Requests\ActorRequest\UpdateActorRequest;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use App\Models\Country;
use Illuminate\Http\Request;
use File;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::orderBy("created_at", "DESC")->paginate(10);
        $countries = Country::all();
        return ActorResource::collection($actors)->additional(["countries" =>$countries]);
        
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
    public function store(StoreActorRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile("ActorAvatar")) {
            $file = $request->file("ActorAvatar");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $data["ActorAvatar"] = $newFileName;
            $file->move(storage_path("app/public/upload/avartarActor"), $newFileName);
        }
        Actor::create($data);
        return response()->json("Thêm mới thông tin diễn viên thành công!");
    }
    public function update(UpdateActorRequest $request, $id)
    {
        $data = $request->validated();

        if (!$data) return response()->json([
            "message" => "Đã có lỗi xãy ra vui lòng thử lại sau!"
        ]);
        $actor = Actor::find($id);
        if ($request->hasFile("ActorAvatar")) {
            if ($actor->ActorAvatar) {
                $oldFile = storage_path("app/public/upload/avartarActor/" . $actor->ActorAvatar);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }
            $file = $request->file("ActorAvatar");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $data["ActorAvatar"] = $newFileName;
            $file->move(storage_path("app/public/upload/avartarActor"), $newFileName);
        }
        if ($actor) {
            $actor->fill($data);
             if($actor->isDirty()){
                $actor->save();
             }
        }

        return response()->json("Cập nhật thông tin diễn viên thành công!");
    }
}
