<?php

namespace App\Models\Registro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registro extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'registro';
    protected $primaryKey = 'id_registro';

    protected $fillable = [

		'id_personal',
        'id_operadora ',
        'id_plan',
        'nro_tlf',
        'cuenta_uso',
        'id_estatus',
        'observacion',
        'id_equipo_componente',
        'id_firmante',

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
     * Relciona el modelo Visitante con el modelo Operadora para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operadora()
    {
        return $this->belongsTo('\App\Models\Administracion\Operadoras', 'id_operadora', 'id_operadora');
    }

    /**
     * Relciona el modelo Visitante con el modelo Plan para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('\App\Models\Administracion\Plan', 'id_plan', 'id_plan');
    }

    /**
     * Relciona el modelo Visitante con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
    
    /**
     * Relciona el modelo Visitante con el modelo Cargo para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */	
	public function cargo()
    {
        return $this->belongsTo('\App\Models\Administracion\Cargo', 'id_cargo', 'id_cargo');
    }

    /**
     * Relciona el modelo Visitante con el modelo Equipo para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */	
	public function equipo()
    {
        return $this->belongsTo('\App\Models\Administracion\Equipo', 'id_sede_equipo', 'id_sede_equipo');
    }	
	
    public function equipo_componente()
    {
        return $this->belongsTo('\App\Models\Administracion\Equipo_componente', 'id_equipo_componente', 'id_equipo_componente');
    }

    public function firmante()
    {
        return $this->belongsTo('\App\Models\Administracion\Firmante', 'id_firmante', 'id_firmante');
    }
}
