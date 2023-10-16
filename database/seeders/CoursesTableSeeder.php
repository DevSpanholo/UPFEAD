<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('role', 'Administração')->first();

        $courses = [
            ['name' => 'HTML & CSS Básico', 'description' => 'Introdução às linguagens básicas da web.'],
            ['name' => 'JavaScript Essencial', 'description' => 'Conceitos fundamentais de JavaScript.'],
            ['name' => 'Frameworks JavaScript', 'description' => 'Vue, React e Angular.'],
            ['name' => 'Desenvolvimento Backend com PHP', 'description' => 'Introdução ao PHP e Laravel.'],
            ['name' => 'Desenvolvimento Backend com Node.js', 'description' => 'Introdução ao Node.js e Express.'],
            ['name' => 'Banco de Dados Relacionais', 'description' => 'MySQL, PostgreSQL e SQL Server.'],
            ['name' => 'Banco de Dados Não-Relacionais', 'description' => 'MongoDB e NoSQL.'],
            ['name' => 'Controle de Versão com Git', 'description' => 'Git e GitHub.'],
            ['name' => 'Deploy e Cloud', 'description' => 'AWS, Azure e Google Cloud.'],
            ['name' => 'DevOps e CI/CD', 'description' => 'Introdução aos conceitos de DevOps e Integração Contínua.'],
        ];

        foreach ($courses as $course) {
            Course::create([
                'name' => $course['name'],
                'description' => $course['description'],
                'created_by' => $admin->id,
            ]);
        }
    }
}
