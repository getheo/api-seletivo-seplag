<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'lotacao';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'unid_id', 'lot_data_lotacao', 'lot_data_remocao', 'lot_portaria'];
}
