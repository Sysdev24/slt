<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $table = 'estatus';
    protected $primaryKey = 'id_estatus';

    protected $fillable = [
        'siglas',
        'descripcion',
    ];

    /**
     * Relaciona el modelo Estados con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estado()
    {
        return $this->hasMany('\App\Models\Administracion\Estados', 'id_estatus', 'id_estatus');
    }

 
    /**
     * Relaciona el modelo Operadoras con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operadoras()
    {
        return $this->hasMany('\App\Models\Administracion\operadoras', 'id_estatus', 'id_estatus');
    }

    /**
     * Relaciona el modelo Plan con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plan()
    {
        return $this->hasMany('\App\Models\Administracion\Plan', 'id_estatus', 'id_estatus');
    }

    /**
     * Relaciona el modelo estatus con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estatus()
    {
        return $this->hasMany('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

    /**
     * Relaciona el modelo Gerencia con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gerencia()
    {
        return $this->hasMany('\App\Models\Administracion\Gerencia', 'id_estatus', 'id_estatus');
    }

    /**
     * Relaciona el modelo Cargo con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cargo()
    {
        return $this->hasMany('\App\Models\Administracion\Cargo', 'id_estatus', 'id_estatus');
    }


}
