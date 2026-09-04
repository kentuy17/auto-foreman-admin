<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TeamSeeder::class,
            PositionSeeder::class,
            AppCategoriesSeeder::class,
            EmployeeSeeder::class,
            TrackRecordsSeeder::class,
            RunningAppsSeeder::class,
            SessionsSeeder::class,
            TempTaskrunningSeeder::class,
            TimeLogsSeeder::class,
            AccessRoleSeeder::class,
            AnomalySeeder::class,
            BugSeeder::class,
            ExportHistorySeeder::class,
            ExtractTrackingDataSeeder::class,
            ManagerTeamSeeder::class,
            PasswordResetSeeder::class,
            RequestApprovalSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
