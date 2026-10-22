<?php

namespace App\Console\Commands;

use App\Models\Location;
use Database\Seeders\LocationSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResetLocationsData extends Command
{
    protected $signature = 'locations:reset
                            {--force : Force reset without confirmation}';

    protected $description = 'Reset locations table to initial seed data (runs daily via scheduler)';

    public function handle(): int
    {
        if (!$this->option('force') && !$this->confirm('This will delete ALL location data and re-seed. Continue?')) {
            $this->info('Reset cancelled.');
            return self::SUCCESS;
        }

        $this->info('Resetting locations data...');

        try {
            DB::transaction(function () {
                Location::truncate();
                $this->info('Locations table cleared.');

                $seeder = new LocationSeeder();
                // Override the "only if empty" check
                $seeder->runForce();
                $this->info('Locations table re-seeded.');
            });

            $count = Location::count();
            $this->info("Done! {$count} locations restored.");
            Log::info("Locations data reset completed. {$count} records restored.");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Reset failed: ' . $e->getMessage());
            Log::error('Locations data reset failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
