<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;


class UserController extends Controller
{
    public function index()
    {

        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users')],
            'password' => ['required ', 'confirmed', 'min:6'],
            'password_confirmation' => ['required'],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);
        DB::beginTransaction();
        try {
            $userData = $request->only(['name', 'email', 'city', 'phone']);
            $userData['password'] = Hash::make($request->get('password'));
            $user = User::query()->create($userData);
            $img = $request->file('img');
            if ($user && $img) {
                $user->addMedia($img)->toMediaCollection('photo');
                Image::load($user->getMedia('photo')->first()->getPath())
                    ->crop(Manipulations::CROP_CENTER, 70, 70)
                    ->format('jpg')
                    ->save();
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('error', [$e->getMessage()]);
        }
        DB::commit();

        return redirect('/users');
    }

    public function getToken(Request $request)
    {
        $user = User::query()->where('email', $request->get('email'))->first();
        $token = $user->createToken(config('app.name'));

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
        ], 200);
    }
}
