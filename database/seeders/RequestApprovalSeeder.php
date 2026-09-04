<?php

namespace Database\Seeders;

use App\Models\RequestApproval;
use Illuminate\Database\Seeder;

class RequestApprovalSeeder extends Seeder
{
    public function run(): void
    {
        RequestApproval::factory()->count(5)->create();
    }
}
