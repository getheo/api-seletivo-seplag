<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'pessoa';

    // Ajustar o primary key
    protected $primaryKey = 'pes_id';
    //public $incrementing = true;
    

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'pes_nome', 'pes_data_nascimento', 'pes_sexo', 'pes_mae', 'pes_pai'];

    public function servidorTemporario()
    {
        return $this->belongsTo(ServidorTemporario::class);
    }

    public function servidorEfetivo(): HasOne
    {
        return $this->HasOne(ServidorEfetivo::class, 'pes_id');
    }

    public function pessoaEndereco(): HasOne
    {
        return $this->HasOne(PessoaEndereco::class, 'pes_id')->with('endereco');
    }

    public function pessoaFoto(): HasMany
    {
        return $this->HasMany(FotoPessoa::class, 'pes_id', 'pes_id');
    }

    public function endereco(): HasMany
    {
        return $this->HasMany(Endereco::class, 'end_id', 'end_id');
    }
    
    public function idade(string $idade) 
    {
        $date = new DateTime($idade);
        $interval = $date->diff( new DateTime( date('Y-m-d') ) );
        return array_push(['idade' => $idade = $interval->format( '%Y anos' )]);
    }
    

}
