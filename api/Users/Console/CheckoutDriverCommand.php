<?php

namespace Api\Users\Console;

use Illuminate\Console\Command;
use Api\Users\Repositories\DriverRepository;

class CheckoutDriverCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Driver checkout at 5pm';

    /**
     * User repository to persist user in database
     *
     * @var UserRepository
     */
    protected $driverRepository;

    /**
     * Create a new command instance.
     *
     * @param  UserRepository  $userRepository
     * @return void
     */
    public function __construct(DriverRepository $driverRepository)
    {
        parent::__construct();

        $this->driverRepository = $driverRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $driver = $this->driverRepository->checkout();

        $this->info(sprintf('Total records updated %s', $driver));
    }    
}