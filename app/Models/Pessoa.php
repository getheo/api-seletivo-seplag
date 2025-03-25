<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'pessoa';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'pes_nome', 'pes_data_nascimento', 'pes_sexo', 'pes_mae', 'pes_pai'];

    public function servidorTemporario()
    {
        return $this->belongsTo(ServidorTemporario::class);
    }

    public function servidorEfetivo()
    {
        return $this->belongsTo(ServidorEfetivo::class);
    }

    public function pessoaEndereco(): HasOne
    {
        return $this->HasOne(PessoaEndereco::class, 'pes_id')->with('endereco');
    }
    

}
