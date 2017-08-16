<?php

namespace Magox\Admin\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin_api:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin_api package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->publishDatabase();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function publishDatabase()
    {
        $this->call('migrate', ['--path' => str_replace(base_path(), '', __DIR__).'/../../migrations/']);

        $this->call('db:seed', ['--class' => \Magox\Admin\Auth\Database\AdminTablesSeeder::class]);
    }

    
}
