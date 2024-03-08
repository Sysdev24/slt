<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Firmante extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'firmante';
    protected $primaryKey = 'id_firmante';

    protected $fillable = [

		'id_personal',
        'resolucion',
        'fecha_resolucion',
        'id_estatus',
        
    ];

    /**
     * Relciona el modelo Visitante con el modelo Personal para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo('\App\Models\Administracion\Personal', 'id_personal', 'id_personal');
    }


    /**
     * Relciona el modelo Visitante con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
    
	
}
