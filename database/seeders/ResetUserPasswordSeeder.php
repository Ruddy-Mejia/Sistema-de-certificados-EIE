<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ResetUserPasswordSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', '1010')->first();
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
