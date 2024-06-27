<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class studentseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches=['2081 Batch','2019 Batch'];
        $program=['Bachelors of Computer Applications','Bachelor of Business Studies'];
        $type=['1st semester','1st year'];
        for($i=1; $i<10;$i++){
            Student::create([
             'student_name'=>fake()->name(),
             'email'=>fake()->email(),
             'date_of_birth'=>fake()->date(),
             'address'=>fake()->address(),
             'contact'=>fake()->phoneNumber(),
             'gender'=>'Male',
             'batch_name'=>$batches[array_rand($batches)],
             'program'=>$program[array_rand($program)],
             'type'=>$type[array_rand($type)],

             // 'semester_id'=>$request->semester,
             'father_name'=>fake()->name(),
             'father_contact'=>fake()->phoneNumber(),
             'mother_name'=>fake()->name(),
             'mother_contact'=>fake()->phoneNumber(),
             'previous_college'=>fake()->country(),
            // 'image'=>$imagepath,
        ]);
    }
    }
}
