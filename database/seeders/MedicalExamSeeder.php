<?php

namespace Database\Seeders;

use App\Models\MedicalExam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedicalExam::create(['name' => 'Ecografía', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Radiografía', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Análisis de sangre', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Análisis de orina', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Análisis de heces fecales', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Análisis de esputo', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Análisis de líquido seminal', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Hemograma completo', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Perfil lipídico', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Perfil tiroideo', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Perfil hepático', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Perfil renal', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Perfil hormonal', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Panel metabólico básico', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de glucosa', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de embarazo', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de VIH', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de hepatitis', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de drogas', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de alcohol', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de alergias', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de aliento', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de ADN', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Prueba de paternidad', 'type' => 'Laboratorio']);
        MedicalExam::create(['name' => 'Radiografía de tórax', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Radiografía de huesos', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Electrocardiograma', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Electroencefalograma', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Colonoscopia', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Endoscopia', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Mamografía', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Densitometría ósea', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Prueba de COVID', 'type' => 'Imagen']);
        MedicalExam::create(['name' => 'Otro', 'type' => 'Otro']);
        MedicalExam::create(['name' => 'Ninguno', 'type' => 'Ninguno']);

    }
}
