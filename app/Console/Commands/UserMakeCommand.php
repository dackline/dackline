<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        do {
            $details  = $this->askForUserDetails($details ?? null);
            $name     = $details['name'];
            $email    = $details['email'];
            $password = $details['password'];
        } while (!$this->confirm("Create user {$name} <{$email}>?", true));

        $user = User::forceCreate(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $user->assignRole('admin');
        $this->info("Created new admin user #{$user->id}");
    }

    /**
	 * @param null $defaults
	 * @return array
	 */
    protected function askForUserDetails($defaults = null)
    {
        $name     = $this->ask('Full name of user?', $defaults['name'] ?? null);
        $email    = $this->askUniqueEmail('Email Address for user?', $defaults['email'] ?? null);
        $password = $this->ask('Password for user? (will be visible)', $defaults['password'] ?? null);

        return compact('name', 'email', 'password');
    }

	/**
	 * @param      $message
	 * @param null $default
	 * @return string
	 */
    protected function askUniqueEmail($message, $default = null)
    {
        do {
            $email = $this->ask($message, $default);
        } while (!$this->checkEmailIsValid($email) || !$this->checkEmailIsUnique($email));

        return $email;
    }

	/**
	 * @param $email
	 * @return bool
	 */
    protected function checkEmailIsValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Sorry, "' . $email . '" is not a valid email address!');
            return false;
        }

        return true;
    }

	/**
	 * @param $email
	 * @return bool
	 */
    public function checkEmailIsUnique($email)
    {
        if ($existingUser = User::where('email', $email)->first()) {
            $this->error('Sorry, "' . $existingUser->email . '" is already in use by ' . $existingUser->name . '!');
            return false;
        }

        return true;
    }
}
