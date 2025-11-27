 <?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\MovieController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',function(Request $request){       
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get("/movies/create-data", [MovieController::class, "createData"]);
    Route::apiResource('users', UserController::class);
    Route::apiResource('/movies',MovieController::class);
}); 
    


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
