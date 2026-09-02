<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // SOLID: Single Responsibility - Representa únicamente la estructura de datos del Producto en BD.
    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock'];
}
