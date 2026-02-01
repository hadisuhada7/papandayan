<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuGroup;

class UncategorizedMenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if Uncategorized already exists
        $uncategorized = MenuGroup::where('name', 'Uncategorized')->first();
        
        if (!$uncategorized) {
            MenuGroup::create([
                'name' => 'Uncategorized',
                'order' => 999, // Put it at the end
            ]);
            
            $this->command->info('Uncategorized menu group created successfully.');
        } else {
            $this->command->info('Uncategorized menu group already exists.');
        }
    }
}
