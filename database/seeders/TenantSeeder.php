<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => "Super Admin",
            'email' => 'super@test.com',
            'password' => bcrypt('super'),
        ]);

        $tenant = \App\Models\Tenant::first() ?? \App\Models\Tenant::create([
                'name'=>'Ao-Invoicer'
        ]);

        $tenant->domains()->create([
            'domain' => 'http://gis.ao-invoicer.test/',
        ]);

        $tenant->run(function () {
            \App\Models\User::create([
                'name' => "Tenant Admin",
                'email' => 'test@test.com',
                'password' => bcrypt('password'),
            ]);

        });


    }
}
