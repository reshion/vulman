<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\SystemGroup;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Vulnerability;
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


        if (Tenant::count() == 0) {
            $tenant = Tenant::factory()->create([
                'name' => 'A new tenant',
            ]);
        } else {
            $this->command->info('Table already seeded, skipping.');
        }


        if (Company::count() == 0) {
            $company = Company::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'T4M',
            ]);
        } else {
            $this->command->info('Table already seeded, skipping.');
        }


        if (SystemGroup::count() == 0 && $company) {
            SystemGroup::factory()->create([
                'company_id' => $company->id,
                'name' => 'Default',
            ]);
        } else {
            $this->command->info('Table already seeded, skipping.');
        }


        if (User::count() == 0 && $company) {

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'company_id' => $company->id,
            ]);
        } else {
            $this->command->info('Table already seeded, skipping.');
        }


        if (Vulnerability::count() == 0) {

            $this->call([
                SQLVulnerabilityImportSeeder::class,
                // Weitere Seeder
            ]);
        } else {
            $this->command->info('Table already seeded, skipping.');
        }
    }
}
