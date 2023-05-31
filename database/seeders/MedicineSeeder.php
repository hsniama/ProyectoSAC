<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicine::create([
            'name' => 'Paracetamol',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Ibuprofeno',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Amoxicilina',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Ciprofloxacina',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Dexametasona',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Loratadina',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Omeprazol',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Metronidazol',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Dipirona',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Diclofenaco',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Clonazepam',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Lorazepam',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Alprazolam',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Cetirizina',
            'presentation' => 'Tabletas',
        ]); 

        Medicine::create([
            'name' => 'Diazepam',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Furosemida',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Hidroclorotiazida',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Losartan',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Metformina',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Metoprolol',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Naproxeno',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Pantoprazol',
            'presentation' => 'Tabletas',
        ]);

        Medicine::create([
            'name' => 'Salbutamol',
            'presentation' => 'Tabletas',
        ]);
        
    }
}
