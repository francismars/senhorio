<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Senhorios extends Model
{
    protected $table = 'Senhorio';
    protected $primaryKey = 'IdSenhorio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'IdSenhorio', 'Username',
    ];

    public $timestamps = false; 

}
