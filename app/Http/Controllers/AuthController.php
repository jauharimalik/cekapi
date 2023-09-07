<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // ...

    public function login(Request $request){

        //
        $credentials = $request->only('email', 'password');
        //$credentials = ["email"=>"jauharimalikupil@gmail.com","password"=>"admin123"];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Flix')->plainTextToken;
    
            // Simpan token dalam cookie
            return response()
                ->json(['token' => $token], 200)
                ->cookie('token', $token, 60); // Simpan token dalam cookie selama 60 menit
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    // ...
}
