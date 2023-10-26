<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'module_id'];

    /**
     * Obtém o módulo associado à avaliação.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Obtém as questões associadas à avaliação.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Adiciona uma questão à avaliação.
     *
     * @param array $data Dados da questão.
     * @return \App\Models\Question A instância da questão criada.
     */
    public function addQuestion($data)
    {
        return $this->questions()->create($data);
    }
}
