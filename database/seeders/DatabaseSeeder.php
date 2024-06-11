<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\SystemGroup;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $tenant = Tenant::factory()->create([
            'name' => 'A new tenant',
        ]);

        $company = Company::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'T4M',
        ]);
        SystemGroup::factory()->create([
            'company_id' => $company->id,
            'name' => 'Default',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'company_id' => $company->id,
        ]);
    }
}
