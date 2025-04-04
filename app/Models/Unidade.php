<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Unidade extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'unidade';

    // Ajustar o primary key
    protected $primaryKey = 'unid_id';
    //public $incrementing = true;

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['unid_nome', 'unid_sigla'];
    
    // Relacionamento com endereço     
    public function endereco(): BelongsToMany
    {
        return $this->belongsToMany(
            Endereco::class,
            'unidade_endereco',
            'unid_id',
            'end_id'
        );
    }   

    public function lotacao(): HasOne
    {
        return $this->HasOne(Lotacao::class, 'unid_id')->with('pessoa');
    }

}
