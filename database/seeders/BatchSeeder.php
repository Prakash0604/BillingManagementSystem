<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=['1','0'];
        for($i=1; $i<5; $i++){
            Batch::create([
                'batch_name'=>fake()->name(),
                'starting_date'=>fake()->date(),
                'ending_date'=>fake()->date(),
                'status'=>array_rand($data),
                ] );
        }
    }
}
