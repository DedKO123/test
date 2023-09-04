<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(45)->create();
        foreach (User::query()->get() as $user){
            $user->addMediaFromUrl('https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg?w=2000')->toMediaCollection('photo');
            Image::load($user->getMedia('photo')->first()->getPath())
                ->crop(Manipulations::CROP_CENTER, 70, 70)
                ->format('jpg')
                ->save();
        }
    }
}
