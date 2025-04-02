<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServidorTemporario extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'servidor_temporario';
    protected $primaryKey = 'pes_id';   

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'st_data_admissao', 'st_data_demissao'];

    
    // Relacionamento Pessoa
    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
    
    // Relacionamento Lotação
    public function lotacaoAtiva(): HasOne
    {
        return $this->hasOne(Lotacao::class, 'pes_id', 'pes_id')->whereNull('lot_data_remocao'); // NULL significa ativo
    }
    
    // Relacionamento Todas as Lotações    
    public function lotacoes(): HasMany
    {
        return $this->hasMany(Lotacao::class, 'pes_id', 'pes_id');
    }
    
    // Relacionamento Foto (através da tabela pessoa)     
    public function foto(): HasOne
    {
        return $this->hasOne(FotoPessoa::class, 'pes_id', 'pes_id')->latest('fp_data'); // Foto recente
    }
}
