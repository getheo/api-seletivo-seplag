<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FotoPessoa extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'foto_pessoa';

    // Ajustar o primary key
    protected $primaryKey = 'fp_id';
    protected $autoIncrement = true;

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'fp_data', 'fp_bucket', 'fp_hash'];

    public function pessoa(): HasOne
    {
        return $this->HasOne(Pessoa::class, 'pes_id');
    }
}
