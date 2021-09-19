<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// quickly create a user via the command line
Artisan::command('user:create', function () {
    $email = "admin@example.com";
    $user = \App\Models\User::where('email', $email)->first();
    if( empty($user) ){
        \App\Models\User::create([
            'name' => "Admin",
            'email' => $email,
            'role' => 'admin',
            'referrer_token' => md5($email),
            'password' => Hash::make("Admin123"),
        ]);
        $this->info('Admin account created');
    } else {
        $this->info('Admin already created');
    }
});
