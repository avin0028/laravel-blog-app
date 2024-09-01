<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $viewerRole = Role::create(['name'=>'viewer']);
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);
        $editorRole = Role::create(['name' => 'editor']);
    }
}
    