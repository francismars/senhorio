<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FotosPropriedades extends Model
{
    protected $table = 'FotosPropriedades';
    protected $primaryKey = 'IdFoto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'IdFoto', 'IdPropriedade', 'FileName',
    ];

    public $timestamps = false; 

}