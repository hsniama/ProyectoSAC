<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::factory()->create(['name' => 'COVID-19']);
        Disease::factory()->create(['name' => 'Alzheimer']);
        Disease::factory()->create(['name' => 'Artritis']);
        Disease::factory()->create(['name' => 'Asma']);
        Disease::factory()->create(['name' => 'Cáncer']);
        Disease::factory()->create(['name' => 'Cáncer de mama']);
        Disease::factory()->create(['name' => 'Cáncer de próstata']);
        Disease::factory()->create(['name' => 'Cáncer de pulmón']);
        Disease::factory()->create(['name' => 'Cáncer de piel']);
        Disease::factory()->create(['name' => 'Cáncer de colon']);
        Disease::factory()->create(['name' => 'Cáncer de estómago']);
        Disease::factory()->create(['name' => 'Cáncer de hígado']);
        Disease::factory()->create(['name' => 'Cáncer de riñón']);
        Disease::factory()->create(['name' => 'Cáncer de tiroides']);
        Disease::factory()->create(['name' => 'Cáncer de ovario']);
        Disease::factory()->create(['name' => 'Cáncer de testículo']);
        Disease::factory()->create(['name' => 'Cáncer de cuello uterino']);
        Disease::factory()->create(['name' => 'Cáncer de endometrio']);
        Disease::factory()->create(['name' => 'Cáncer de laringe']);
        Disease::factory()->create(['name' => 'Cáncer de esófago']);
        Disease::factory()->create(['name' => 'Cáncer de hueso']);
        Disease::factory()->create(['name' => 'Cáncer de cerebro']);
        Disease::factory()->create(['name' => 'Cáncer de vejiga']);
        Disease::factory()->create(['name' => 'Cáncer de sangre']);
        Disease::factory()->create(['name' => 'Cáncer de garganta']);
        Disease::factory()->create(['name' => 'Cáncer de lengua']);
        Disease::factory()->create(['name' => 'Cáncer de pene']);
        Disease::factory()->create(['name' => 'Cáncer de vulva']);
        Disease::factory()->create(['name' => 'Cáncer de páncreas']);
        Disease::factory()->create(['name' => 'Diabetes']);
        Disease::factory()->create(['name' => 'Enfermedad de Crohn']);
        Disease::factory()->create(['name' => 'Enfermedad de Parkinson']);
        Disease::factory()->create(['name' => 'Epilepsia']);
        Disease::factory()->create(['name' => 'Esclerosis múltiple']);
        Disease::factory()->create(['name' => 'Esquizofrenia']);
        Disease::factory()->create(['name' => 'Fibromialgia']);
        Disease::factory()->create(['name' => 'Gripe']);
        Disease::factory()->create(['name' => 'Hepatitis']);
        Disease::factory()->create(['name' => 'Herpes']);
        Disease::factory()->create(['name' => 'Hipertensión']);
        Disease::factory()->create(['name' => 'Infarto']);
        Disease::factory()->create(['name' => 'Insomnio']);
        Disease::factory()->create(['name' => 'Lupus']);
        Disease::factory()->create(['name' => 'Meningitis']);
        Disease::factory()->create(['name' => 'Migraña']);
        Disease::factory()->create(['name' => 'Obesidad']);
        Disease::factory()->create(['name' => 'Osteoporosis']);
        Disease::factory()->create(['name' => 'Sarampión']);
        Disease::factory()->create(['name' => 'VIH']);
        Disease::factory()->create(['name' => 'Tuberculosis']);
        Disease::factory()->create(['name' => 'Varicela']);
        Disease::factory()->create(['name' => 'Virus del papiloma humano']);
        Disease::factory()->create(['name' => 'Zika']);
        Disease::factory()->create(['name' => 'Enfermedad no está registrada']);


    }
}
