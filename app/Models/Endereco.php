<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'endereco';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['end_tipo_logradouro', 'end_logradouro', 'end_numero', 'end_bairro', 'cid_id'];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
