<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    use HasFactory;

    //Nombre de la conexion que utitlizara este modelo
    protected $connection= 'mysql';

    //Todos los modelos deben extender la clase Eloquent
    protected $table = 'media';
    
}
