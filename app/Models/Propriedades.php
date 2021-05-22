<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Propriedades extends Model
{
    protected $table = 'Propriedades';
    protected $primaryKey = 'IdPropriedade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'IdPropriedade', 'IdSenhorio', 'TipoPropriedade', 'Localizacao', 'Latitude', 'Longitude', 'AreaMetros', 'Preco',
        'Descricao', 'OrientacaoSolar', 'NumeroQuartos', 'DuracaoAluguer', 'Lotacao', 'Disponibilidade', 'CasasBanho', 'EstadoConservacao', 
        'internetAcess', 'limpeza', 'faixaEtariaMin', 'faixaEtariaMax', 'generoMasc', 'generoFemin', 'aceitaFumadores', 'aceitaAnimais', 

    ];

    public $timestamps = false; 

}