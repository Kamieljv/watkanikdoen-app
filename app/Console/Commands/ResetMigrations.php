<?php 

// Simple command to reset all migrations (for development purposes only)

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ResetMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrations:reset-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all migrations and re-run them (development only)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Dropping all data tables...');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Delete all tables except 'migrations'
        $tables = DB::select('SHOW TABLES');
        
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            if ($tableName !== 'migrations') {
                DB::statement("DROP TABLE IF EXISTS `{$tableName}`;");
                $this->line("  ✓ Dropped table: {$tableName}");
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->info('Clearing all rows from migrations table...');
        DB::table('migrations')->truncate();

        if ($this->confirm('Do you want to re-run all migrations?', false)) {
            $this->info('Re-running all migrations...');
            Artisan::call('migrate', ['--force' => true], $this->getOutput());
            $this->info('All migrations have been reset and re-run successfully.');
        }

        if ($this->confirm('Do you want to re-seed the database?', false)) {
            $this->info('Re-seeding the database...');
            Artisan::call('db:seed', ['--force' => true], $this->getOutput());
            $this->info('Database seeding complete.');
        }

        return Command::SUCCESS;
    }
}