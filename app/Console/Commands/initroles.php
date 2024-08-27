<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class initroles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'makes the webapp users roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewerRole = Role::create(['name'=>'viewer']);
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);
        $editorRole = Role::create(['name' => 'editor']);


    }
}
