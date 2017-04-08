<?php

namespace Api\Users\Console;

use Api\Users\Repositories\UserRepository;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:add
                              {username}
                              {password}
                              {email}
                              {full_name}
                              {gender}
                              {phone_number}
                              {access_level}
                              {status}
                              {token}
                              {requests}
                              {division_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new user';

    /**
     * User repository to persist user in database
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new command instance.
     *
     * @param  UserRepository  $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->userRepository->create([
            'username' => $this->argument('username'),
            'password' => $this->argument('password'),
            'email' => $this->argument('email'),
            'full_name' => $this->argument('full_name'),
            'gender' => $this->argument('gender'),
            'phone_number' => $this->argument('phone_number'),
            'access_level' => $this->argument('access_level'),
            'status' => $this->argument('status'),
            'token' => $this->argument('token'),
            'requests' => $this->argument('requests'),
            'division_id' => $this->argument('division_id')
        ]);

        $this->info(sprintf('A user was created with ID %s', $user->id));
    }
}