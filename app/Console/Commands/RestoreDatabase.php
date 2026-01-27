<?php 

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestoreDatabase extends Command
{
    protected $signature = 'db:restore {backupFile}';

    protected $description = 'Restore database tables from backup';

    public function handle(): int
    {
        if (!$this->argument('backupFile')) {
            $this->error('Please provide a backup file name.');
            return Command::FAILURE;
        }

        if (!file_exists($this->argument('backupFile'))) {
            $this->error("Backup file not found: {$this->argument('backupFile')}");
            return Command::FAILURE;
        }

        $confirmed = $this->confirm('Are you sure you want to restore the database from backup? This will overwrite current data. (yes/no)', false);
        if ($confirmed) {
            $this->info('Restoring database tables from backup...');

            $this->clearExistingTables();

            // Run the SQL file to restore the database
            $sql = file_get_contents($this->argument('backupFile'));
            DB::unprepared($sql);

            $this->info('Database restoration complete.');
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }

    protected function clearExistingTables(): void
    {
        $this->info('Clearing existing tables...');

        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Get all table names
        $database = config('database.connections.' . config('database.default') . '.database');
        $tables = DB::select("SHOW TABLES");
        $tableKey = 'Tables_in_' . $database;

        // Drop each table
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            $this->info("  Dropping table: {$tableName}");
            Schema::dropIfExists($tableName);
        }
        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $this->info('Existing tables cleared.');
    }
}