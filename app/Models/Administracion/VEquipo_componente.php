<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VEquipo_componente extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'view_equipo_componente';
    protected $primaryKey = 'id_equipo_componente';

    protected $fillable = [
		'id_sede_equipo',
        'equipo',
        'serial',
        'tipo',
        'accesorios',           
    ];

    /**
     * Relciona el modelo Visitante con el modelo Personal para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipo()
    {
        return $this->belongsTo('\App\Models\Administracion\Equipo', 'id_sede_equipo', 'id_sede_equipo');
    }
    
	
}
