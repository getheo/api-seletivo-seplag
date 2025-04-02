<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endereco extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'endereco';    

    // Ajustar o primary key
    protected $primaryKey = 'end_id';
    protected $autoIncrement = true;

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['end_tipo_logradouro', 'end_logradouro', 'end_numero', 'end_bairro', 'cid_id'];

    public function cidade(): HasOne
    {
        return $this->hasOne(Cidade::class, 'cid_id', 'cid_id');
    }
}
