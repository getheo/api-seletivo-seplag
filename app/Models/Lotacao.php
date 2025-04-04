<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lotacao extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'lotacao';

    // Ajustar o primary key
    protected $primaryKey = 'lot_id';
    //public $incrementing = true;
    

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'unid_id', 'lot_data_lotacao', 'lot_data_remocao', 'lot_portaria'];

    /**
     * Servidor Efetivo (se houver)
     */
    public function servidorEfetivo(): BelongsTo
    {
        return $this->belongsTo(ServidorEfetivo::class, 'pes_id', 'pes_id');
    }

    public function servidorTemporario()
    {
        return $this->belongsTo(ServidorTemporario::class, 'pes_id', 'pes_id');
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }

    public function unidade(): HasOne
    {
        return $this->hasOne(Unidade::class, 'unid_id', 'unid_id')->with('endereco');
    }

    
}
