<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use Illuminate\Http\Response;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index(){
      return Pengguna::all();
   }

    public function register(Request $request)
    {
      $name = $request->input('name');
      $email = $request->input('email');
      $password = Hash::make($request->input('password'));

      $register = Pengguna::create([
          'name' => $name,
          'email' => $email,
          'password' => $password
      ]);

      if($register){
          return response()->json([
              'success' => true,
              'message' => 'Register Success!',
              'data' => $register
          ], 201);
      }else {
          return response()->json([
              'success' => false,
              'message' => 'Register Failed!',
              'data' => ''
          ], 400);
      }
    }


    public function login(Request $request)
    { 
      $email = $request->input('email');
      $password = $request->input('password');

      $user = Pengguna::where('email', $email)->first();

      if($user){
          if (Hash::check($password, $user->password)) {
              # Update token user
              $token = Str::replace("-", ".", Str::uuid()) . Str::random(36);

              $user->token = $token;
              $user->save();

              return response()->json([
                  'success' => true,
                  'message' => 'Successfully LogIn!',
                  'data' => [
                      'token' => $user->token // kembalikan token bersamaan dengan response
                  ]
              ], 200);
          } else {
              return response()->json([
                  'success' => false,
                  'message' => 'Password doesnt match!',
                  'data' => ''
              ], 400);
          }
      } else {
          return response()->json([
              'success' => false,
              'message' => 'User not found!',
              'data' => ''
          ], 404);
      }
  }

  
  public function update (Request $request, $id)
  {
    $post = Pengguna::find($id);
    
    if ($post){
        $post->update($request->all());
        return response()->json([
            'message' => 'has been updated'
        ]);
    }

    return response()->json([
        'message' => 'data not found',
        ], 404);
  }
}
