<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServidorEfetivo extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'servidor_efetivo';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'se_matricula'];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id');
    }
}
