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
        Disease::create(['name' => 'COVID-19']);
        Disease::create(['name' => 'Alzheimer']);
        Disease::create(['name' => 'Artritis']);
        Disease::create(['name' => 'Asma']);
        Disease::create(['name' => 'Cáncer']);
        Disease::create(['name' => 'Cáncer de mama']);
        Disease::create(['name' => 'Cáncer de próstata']);
        Disease::create(['name' => 'Cáncer de pulmón']);
        Disease::create(['name' => 'Cáncer de piel']);
        Disease::create(['name' => 'Cáncer de colon']);
        Disease::create(['name' => 'Cáncer de estómago']);
        Disease::create(['name' => 'Cáncer de hígado']);
        Disease::create(['name' => 'Cáncer de riñón']);
        Disease::create(['name' => 'Cáncer de tiroides']);
        Disease::create(['name' => 'Cáncer de ovario']);
        Disease::create(['name' => 'Cáncer de testículo']);
        Disease::create(['name' => 'Cáncer de cuello uterino']);
        Disease::create(['name' => 'Cáncer de endometrio']);
        Disease::create(['name' => 'Cáncer de laringe']);
        Disease::create(['name' => 'Cáncer de esófago']);
        Disease::create(['name' => 'Cáncer de hueso']);
        Disease::create(['name' => 'Cáncer de cerebro']);
        Disease::create(['name' => 'Cáncer de vejiga']);
        Disease::create(['name' => 'Cáncer de sangre']);
        Disease::create(['name' => 'Cáncer de garganta']);
        Disease::create(['name' => 'Cáncer de lengua']);
        Disease::create(['name' => 'Cáncer de pene']);
        Disease::create(['name' => 'Cáncer de vulva']);
        Disease::create(['name' => 'Cáncer de páncreas']);
        Disease::create(['name' => 'Diabetes']);
        Disease::create(['name' => 'Enfermedad de Crohn']);
        Disease::create(['name' => 'Enfermedad de Parkinson']);
        Disease::create(['name' => 'Epilepsia']);
        Disease::create(['name' => 'Esclerosis múltiple']);
        Disease::create(['name' => 'Esquizofrenia']);
        Disease::create(['name' => 'Fibromialgia']);
        Disease::create(['name' => 'Gripe']);
        Disease::create(['name' => 'Hepatitis']);
        Disease::create(['name' => 'Herpes']);
        Disease::create(['name' => 'Hipertensión']);
        Disease::create(['name' => 'Infarto']);
        Disease::create(['name' => 'Insomnio']);
        Disease::create(['name' => 'Lupus']);
        Disease::create(['name' => 'Meningitis']);
        Disease::create(['name' => 'Migraña']);
        Disease::create(['name' => 'Obesidad']);
        Disease::create(['name' => 'Osteoporosis']);
        Disease::create(['name' => 'Sarampión']);
        Disease::create(['name' => 'VIH']);
        Disease::create(['name' => 'Tuberculosis']);
        Disease::create(['name' => 'Varicela']);
        Disease::create(['name' => 'Virus del papiloma humano']);
        Disease::create(['name' => 'Zika']);
        Disease::create(['name' => 'Enfermedad no está registrada']);
        Disease::create(['name' => 'Otra']);

    }
}
