<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

/**
 * Class CreateUser
 */
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name : The name of the user} {email : The email address of the user} {password : The password of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $this->ask('Confirm password:'),
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('User created successfully.');
    }
}
