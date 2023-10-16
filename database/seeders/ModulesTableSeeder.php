<?php

use Illuminate\Database\Seeder;
use App\Module;
use App\Course;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();

        $modules = [
            'HTML & CSS Básico' => [
                ['name' => 'Introdução ao HTML', 'description' => 'Conceitos básicos de HTML.'],
                ['name' => 'Introdução ao CSS', 'description' => 'Conceitos básicos de CSS.']
            ],
            'JavaScript Essencial' => [
                ['name' => 'Sintaxe e Variáveis', 'description' => 'Conceitos iniciais de JS.'],
                ['name' => 'Funções e Objetos', 'description' => 'Como usar funções e objetos em JS.']
            ],
            
        ];

        foreach ($courses as $course) {
            if (isset($modules[$course->name])) {
                foreach ($modules[$course->name] as $moduleData) {
                    Module::create([
                        'course_id' => $course->id,
                        'name' => $moduleData['name'],
                        'description' => $moduleData['description']
                    ]);
                }
            }
        }
    }
}
