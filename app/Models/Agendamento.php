<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente_id',
        'data_agendamento',
        'hora_agendamento',
        'status'
    ];

    // Relacionamento com Cliente (muitos para 1)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com Servico (muitos para muitos)
    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'agendamento_servico');
    }
}
