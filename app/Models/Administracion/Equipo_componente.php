<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo_componente extends Model
{
    use HasFactory;

    protected $table = 'equipo_componente';
    protected $primaryKey = 'id_equipo_componente';

    protected $fillable = [
        'id_sede_equipo',       
        'tipo',
        'serial',
        'accesorios',
        'id_estatus',
    ];

    /**
     * Relciona el modelo Municipio con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

    /**
     * Relciona el modelo Municipio con el modelo Estado para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Equipo()
    {
        return $this->belongsTo('\App\Models\Administracion\Equipo', 'id_sede_equipo', 'id_sede_equipo');
    }
}
