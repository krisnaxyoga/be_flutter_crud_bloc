<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\People;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    public function index(){
        $people = People::all();
        return new PostResource(true, 'List Data User', $people);
    }
    
    public function register(Request $request){
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:people,email',
                'phone' => 'required|unique:people,phone',
                'password' => 'required|min:8'
            ]);

            $people = People::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => '',
                'password' => Hash::make($request->password)
            ]);

            return new PostResource(true, 'Register Success', $people);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(),'request'=>$request->all()], 500);
        }
    }
}

