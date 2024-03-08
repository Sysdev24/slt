<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipo';
    protected $primaryKey = 'id_sede_equipo';

    protected $fillable = [
        'id_sede_equipo',
        'descripcion',
        'id_estatus',
    	
    ];
 /**
     * Relaciona el modelo estatus con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estatus()
    {
        return $this->hasMany('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
    
	     
}