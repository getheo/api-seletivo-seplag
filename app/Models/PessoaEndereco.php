<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PessoaEndereco extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'pessoa_endereco';

    // Ajustar o primary key
    protected $primaryKey = 'pes_id';
    protected $autoIncrement = false;

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'end_id'];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'end_id');
    }
}
