<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Course;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        $lessonsData = [
            'HTML & CSS Básico' => [
                'Introdução ao HTML' => ['title' => 'O que é HTML?', 'description' => 'Entendendo a estrutura básica do HTML.'],
                'Introdução ao CSS' => ['title' => 'Estilizando com CSS', 'description' => 'Conceitos iniciais de estilização com CSS.']
            ],
            'JavaScript Essencial' => [
                'Sintaxe e Variáveis' => ['title' => 'Declarando variáveis em JS', 'description' => 'Como declarar e usar variáveis em JavaScript.'],
                'Funções e Objetos' => ['title' => 'Criando funções', 'description' => 'Definindo e usando funções em JS.']
            ],
        ];

        foreach ($courses as $course) {
            $modules = Module::where('course_id', $course->id)->get();
            if (isset($lessonsData[$course->name])) {
                foreach ($modules as $module) {
                    if (isset($lessonsData[$course->name][$module->name])) {
                        Lesson::create([
                            'course_id' => $course->id,
                            'module_id' => $module->id,
                            'title' => $lessonsData[$course->name][$module->name]['title'],
                            'description' => $lessonsData[$course->name][$module->name]['description']
                        ]);
                    }
                }
            }
        }
    }
}
