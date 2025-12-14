 <?php

use App\Http\Controllers\api\ActorController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\MovieController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\DirectorController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',function(Request $request){       
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get("/movies/create-data", [MovieController::class, "createData"]);
    Route::get("/movies/update-data",[MovieController::class, "updateData"]);
    Route::delete("/delete-episodes", [MovieController::class, "deleteEpisodes"]);
    Route::delete("delete-single-eposode/{id}", [MovieController::class, "deleteSingleEpisode"]);
    Route::delete("/delete-server/{id}", [MovieController::class, "deleteServer"]);
    Route::apiResource('users', UserController::class);
    Route::apiResource('/movies',MovieController::class);
    Route::apiResource("/actors", ActorController::class);

    Route::apiResource("/directors", DirectorController::class);
}); 
    


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
