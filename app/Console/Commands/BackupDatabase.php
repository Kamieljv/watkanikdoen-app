<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup {--path= : Custom path for the backup file (./storage/backups by default)}';

    protected $description = 'Create a backup of the database';

    public function handle()
    {
        $this->info('╔════════════════════════════════════════════════════════════╗');
        $this->info('║   Database Backup Tool                                     ║');
        $this->info('╚════════════════════════════════════════════════════════════╝');
        $this->newLine();

       
        if (!$this->backupDatabase()) {
            $this->error('Backup failed. Migration aborted.');
            return 1;
        }
        return 0;
    }

    protected function backupDatabase(): bool
    {
        $this->info('💾 Creating database backup...');
        
        $timestamp = Carbon::now()->format('Y-m-d_His');
        $backupPath = $this->option('path') ?: './storage/backups';
        
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $filename = "database_backup_{$timestamp}.sql";
        $filepath = "{$backupPath}/{$filename}";
        $database = config('database.connections.' . config('database.default') . '.database');

        try {
            $tables = DB::select('SHOW TABLES');
            $tableKey = 'Tables_in_' . $database;
            
            $sql = "-- Database Backup: {$database}\n-- Generated: {$timestamp}\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $tableName = $table->$tableKey;
                $this->line("  Backing up table: {$tableName}");
                
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $sql .= "\n-- Table: {$tableName}\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                $sql .= $createTable[0]->{'Create Table'} . ";\n\n";
                
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    foreach ($rows as $row) {
                        $values = [];
                        foreach ((array)$row as $value) {
                            $values[] = is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                        }
                        $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sql .= "\n";
                }
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
            file_put_contents($filepath, $sql);
            
            $this->info("✓ Backup saved to: {$filepath}");
            $this->info("  Backup size: " . round(filesize($filepath) / 1024 / 1024, 2) . " MB");
            
            return true;
        } catch (\Exception $e) {
            $this->error("Failed to create backup: " . $e->getMessage());
            return false;
        }
    }
}