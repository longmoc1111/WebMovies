<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Directors\StoreDirectorRequest;
use App\Http\Resources\DirectorResource;
use App\Models\Country;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index(){
        $directors = Director::orderBy("created_at", "DESC")->paginate(20);
        $countries = Country::all();
        return response()->json([
            "directors" => DirectorResource::collection($directors),
            "Countries" => $countries
        ]);
    }

    public function destroy($id){
        $data = Director::find($id);
        if(!$data) return response()->json("Đã có lỗi xãy ra vui long thử lại sau!");
        $data->DirectorMovie()->detach();
        $data->delete();
        return response()->json("Xóa thành công thông tin tác giả!");
    }

    public function store(StoreDirectorRequest $request){
        $data = $request->validated();
        if($request->hasFile("DirectorAvatar")){
            $file = $request->file("DirectorAvatar");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_". time() . "." . $fileNameExt;
            $data["DirectorAvatar"] = $newFileName;
            $file->move(storage_path("app/public/upload/avartarDirector"), $newFileName);
        }
        Director::create($data);
        return response()->json("Thêm mới thông tin tác giả thành công!");
    }
    public function update($id){
        
    }
}
