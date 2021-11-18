<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use Illuminate\Http\Response;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;


class AuthControllerPra
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = Pengguna::where('email', $email)->first();

        if($user){
                if (Hash::check($password, $user->password)) 
                    {
                            # Update token user
                            $jwt = $this->jwt(
                                    [
                                            "alg" => "HS256",
                                            "typ" => "JWT"
                                    ],
                                    [
                                            "sub" => "{$user->id}:{$user->email}", // sub biasanya berisi data unique dari user
                                            "name" => $user->name,
                                            "iat" => time() // iat atau singkatan dari issues at adalah waktu saat token dibuat (dalam satuan second)
                                    ],
                                    "Secret" // secret
                            );

                            $user->token = $jwt;
                        $user->save();

                            return response()->json([
                                    'success' => true,
                                    'message' => 'Successfully LogIn!',
                                    'data' => [
                                            'token' => $jwt // kembalikan token bersamaan dengan response
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

    public function update (Request $request, $id)
    {
        $pengguna = Pengguna::find($id);
        
        if ($pengguna){
            $pengguna->update($request->all());
            return response()->json([
                'message' => 'has been updated'
            ]);
        }

        return response()->json([
            'message' => 'data not found',
            ], 404);
    }

    public function delete ($id){
        $pengguna = Pengguna::find($id);

        if ($pengguna){
            $pengguna->delete();

            return response()->json([
                'message' => 'has been deleted'
            ]);

        return response()->json([
            'message' => 'post not found',
        ], 404);
        }
    }

    public function index()
    {
        return Pengguna::all();
    }


    private function base64url_encode(String $data): String
    {
        $base64 = base64_encode($data); // ubah json string menjadi base64
        $base64url = strtr($base64, '+/', '-_'); // ubah char '+' -> '-' dan '/' -> '_'

        return rtrim($base64url, '='); // menghilangkan '=' pada akhir string
    }

    private function sign(String $header, String $payload, String $secret): String
    {
        $signature = hash_hmac('sha256', "{$header}.{$payload}", $secret, true);
        $signature_base64url = $this->base64url_encode($signature);

        return $signature_base64url;
    }

    private function jwt(array $header, array $payload, String $secret): String
    {
        $header_json = json_encode($header);
        $payload_json = json_encode($payload);

        $header_base64url = $this->base64url_encode($header_json);
        $payload_base64url = $this->base64url_encode($payload_json);
        $signature_base64url = $this->sign($header_base64url, $payload_base64url, $secret);

        $jwt = "{$header_base64url}.{$payload_base64url}.{$signature_base64url}";

        return $jwt;
    }
}
