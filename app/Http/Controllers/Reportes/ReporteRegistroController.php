<?php

namespace App\Http\Controllers\Reportes;

use DateTime;
use PgSql\Lob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Estado;
use App\Models\Administracion\Plan;
use App\Models\Administracion\Operadoras;
use App\Models\Administracion\Gerencia;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Administracion\Cargo;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Equipo;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\VEquipo_componente;
use App\Models\Registro\Registro;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ReporteRegistroController extends Controller
{


    /**
     * |La función __construct() es una función especial que se llama automáticamente cuando se crea un|
     * |objeto.                                                                                        |
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado = Estado::orderBy("descripcion")->get()->pluck("descripcion", "id_estado");
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $operadoras = Operadoras::pluck('descripcion', 'id_operadora');
        $plan = Plan::pluck('descripcion','monto_credito','id_plan');
        $gerencia = Gerencia::pluck('descripcion','id_gergral');
        $cargo = Cargo::pluck('descripcion','id_cargo');
        $equipo = Equipo::pluck('descripcion','id_sede_equipo');
        $vequipo_componente = VEquipo_componente::pluck('equipo','tipo','serial','accesorios','id_equipo_componente');
        $estatus = Estatus::pluck('descripcion','id_estatus');
		return view('reportes.index', compact('estado', 'gerencia','plan','operadoras','personal','cargo','equipo','vequipo_componente','estatus'));
    }




    /**
     * |Creación de una matriz de columnas para seleccionar de la base de datos.|
     * |Consulta los visitantes según los parámetros enviados el la solicitud   |
     * @return \Illuminate\Support\Collection
     * @param mixed $columnas
     */
    public function getRegistersByFilters($columnas, $filtros, $orderBy = [])
    {

        $select = [];
        //$orderBy = [];

        $registro = DB::table('registro');
        

        foreach ($columnas as $key => $columna) {

            switch ($columna->columna) {
                case 'ci':
                    array_push($select, 'personal.ci');
                    break;
                case 'nombre':
                    array_push($select, 'personal.nombre');
                    break;
                case 'apellido':
                    array_push($select, 'personal.apellido');
                    break;
                case 'nro_empleado':
                        array_push($select, 'personal.nro_empleado');
                    break;
                case 'cargo':
                        array_push($select, 'cargo.descripcion as cargo');
                    break;
                case 'gerencia':
                    array_push($select, 'gerencia.descripcion as gerencia');
                    break;
                case 'estado':
                    array_push($select, 'estados.descripcion as estados');
                    break;
                case 'operadora':
                    array_push($select, 'operadoras.descripcion as operadora');
                    break;
                case 'plan':
                    array_push($select, 'plan.descripcion as plan');
                    break;
                case 'monto_plan':
                    array_push($select, 'plan.monto_credito');
                    break;
                case 'estatus':
                    array_push($select, 'estatus.descripcion as estatus');
                    break;
                case 'nro_tlf':
                    array_push($select, 'registro.nro_tlf');
                    break;
                case 'cuenta_uso':
                    array_push($select, 'registro.cuenta_uso');
                    break;
				case 'estatus':
                     array_push($select, 'estatus.descripcion as estatus');
                    break;
                case 'observacion':
                    array_push($select, 'registro.observacion');
                    break;
                case 'equipo':
                    array_push($select, 'view_equipo_componente.equipo');
                    break;
            }
        }
        $registro = $registro->select($select);
        $registro = $registro->leftjoin('personal', 'personal.id_personal','registro.id_personal' );
        $registro = $registro->leftjoin('plan', 'plan.id_plan', 'registro.id_plan');
        $registro = $registro->leftjoin('operadoras', 'operadoras.id_operadora', 'registro.id_operadora');
        $registro = $registro->leftjoin('estatus', 'estatus.id_estatus', 'registro.id_estatus');
        $registro = $registro->leftjoin('estados', 'estados.id_estado', 'personal.id_estado');
        $registro = $registro->leftjoin('gerencia', 'gerencia.id_gergral', 'personal.id_gergral');
        $registro = $registro->leftjoin('cargo', 'cargo.id_cargo', 'personal.id_cargo');
        $registro = $registro->leftjoin('view_equipo_componente', 'view_equipo_componente.id_equipo_componente', 'registro.id_equipo_componente');

        if (!empty($filtros->plan)) {
            $registro = $registro->WhereIn('plan.id_plan', $filtros->plan);
        }

        if (!empty($filtros->operadoras)) {
            $registro = $registro->WhereIn('operadoras.id_operadora', $filtros->operadoras);
        }

		 if (!empty($filtros->estatus)) {
             $registro = $registro->WhereIn('registro.id_estatus', $filtros->estatus);
        }

		 if (!empty($filtros->cargo)) {
            $registro = $registro->WhereIn('cargo.id_cargo', $filtros->cargo);
        }
        
		 if (!empty($filtros->gerencia)) {
            $registro = $registro->WhereIn('gerencia.id_gergral', $filtros->gerencia);
        }
                
		 if (!empty($filtros->estados)) {
            $registro = $registro->WhereIn('estados.id_estado', $filtros->estados);
        }
        // if ($filtros->conSalida && $filtros->sinSalida) {
        //     $registro = $registro->where(function ($q) {
        //         $q->whereNotNull('registro.created_at')->orWhereNull('registro.created_at');
        //     });
        // }

        // if ($filtros->conSalida && !$filtros->sinSalida) {
        //     $registro = $registro->whereNotNull('registro.created_at');
        // }

        // if (!$filtros->conSalida && $filtros->sinSalida) {
        //     $registro = $registro->WhereNull('registro.created_at');
        // }

        // $entradaDesde = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaDesde)->format('Y/m/d');
        // $entradaHasta = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaHasta)->format('Y/m/d');

        // $registro = $registro->whereBetween('registro.created_at', [$entradaDesde, $entradaHasta]);

        if (!empty($orderBy)) {
            foreach ($orderBy as $valor) {
                switch ($valor->columna) {
                    case 'ci':
                        $registro = $registro->orderBy('personal.ci', $valor->orden);
                        break;
                    case 'nombre':
                        $registro = $registro->orderBy('personal.nombre', $valor->orden);
                        break;
                    case 'apellido':
                        $registro = $registro->orderBy('personal.apellido', $valor->orden);
                        break;
                    case 'nro_empleado':
                        $registro = $registro->orderBy('personal.nro_empleado', $valor->orden);
                        break;
                    case 'cargo':
                        $registro = $registro->orderBy('cargo.descripcion', $valor->orden);
                        break;                     
                    case 'gerencia':
                        $registro = $registro->orderBy('gerencia.descripcion', $valor->orden);
                        break;
                    case 'estado':
                        $registro = $registro->orderBy('estados.descripcion', $valor->orden);
                        break;
					case 'operadoras':
                        $registro = $registro->orderBy('operadoras.descripcion', $valor->orden);
                        break;
                    case 'plan':
                        $registro = $registro->orderBy('plan.descripcion', $valor->orden);
                        break;
                    case 'monto_credito':
                        $registro = $registro->orderBy('plan.monto_credito', $valor->orden);
                        break;
                    case 'estatus':
                        $registro = $registro->orderBy('estatus.descripcion', $valor->orden);
                        break;
                    case 'nro_tlf':
                        $registro = $registro->orderBy('registro.nro_tlf', $valor->orden);
                        break;
                    case 'cuenta_uso':
                        $registro = $registro->orderBy('registro.cuenta_uso', $valor->orden);
                        break;
                    case 'observacion':
                        $registro = $registro->orderBy('registro.observacion', $valor->orden);
                        break;
                    case 'equipo':
                        $registro = $registro->orderBy('view_equipo_componente.equipo', $valor->orden);
                        break;
                }
            }
        }
        $registro = $registro->get();
        return $registro;
    }



    /**
     * |Devuelve una respuesta  con la vista de reportes-visitates.result|
     *
     * @param Request request El objeto de la solicitud.
     */
    public function getViewRegistersByFilters(Request $request)
    {

        
        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;

        $registros = self::getRegistersByFilters($columnas, $filtros);
        //return "oK";//$registros;
        return view('reportes.result', compact('titulo', 'columnas', 'registros'));
    }





    /**
     * |Toma un objeto de solicitud, obtiene los datos de la base de datos y luego crea una hoja de |
     * |cálculo con los datos.                                                                      |
     *
     * @param Request request El objeto de la solicitud.
     * @return un objeto de hoja de cálculo.
     */
    public function buildReport($columnas, $filtros, $titulo, $orderBy = [])
    {


        $registro = self::getRegistersByFilters($columnas, $filtros, $orderBy);
        $fila_ini_datos = 3;
        $cont = 1;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $colSheet = range('A', 'Z');
        $mergeColTitle = $colSheet[count($columnas)];

        $sheet->mergeCells('A1:' . $mergeColTitle . '1');
        $sheet->setCellValue('A1', mb_strtoupper($titulo));

        foreach ($columnas as $columna) {
            switch ($columna->columna) {
                case 'registro':
                    $sheet->setCellValueByColumnAndRow($cont,     2, $columna->alias . ' (CÉDULA)');
                    $sheet->setCellValueByColumnAndRow($cont + 1, 2, $columna->alias . ' (NOMBRE Y APELLIDO)');
                    $cont++;
                    break;
                default:
                    $sheet->setCellValueByColumnAndRow($cont, 2, $columna->alias);
                    break;
            }
            $cont++;
        }

        foreach ($registro as $data) {

            $cont = 1;
            foreach ($data as $valor) {

                if ($valor === true) {

                    $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, "SÍ");
                } elseif ($valor === false) {

                    $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, "NO");
                } else {
                    //* Imprime si es un campo fecha imprime formateado
                    if (DateTime::createFromFormat('Y-m-d H:i:s', $valor) !== false) {

                        $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, date('d/m/Y h:i a', strtotime($valor)));
                    } else {

                        $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, $valor);
                    }
                }

                $cont++;
            }
            $fila_ini_datos++;
        }

        return $spreadsheet;
    }



    /**
     * |Toma una solicitud, crea un informe y luego lo exporta al formato deseado|
     *
     * @param Request request El objeto de la solicitud.
     */
    public function exportToExcelOrOpenOffice(Request $request)
    {

        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;
        $formato = $param->formato;
        $orderBy = $param->orderBy;


        $spreadsheet = self::buildReport($columnas, $filtros, $titulo, $orderBy);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $titulo . '.' . $formato . '"');
        header('Cache-Control: max-age=0');

        switch ($formato) {
            case 'xls':
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save('php://output');
                break;
            case 'ods':
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Ods');
                $writer->save('php://output');
                break;
        }
    }

    /**
     * |Toma una solicitud, obtiene los datos de la base de datos y luego devuelve un archivo PDF.|
     * @param Request request El objeto de la solicitud.
     * @return El archivo PDF está siendo devuelto.
     */
    public function exportToPDF(Request $request)
    {
        //-define("DOMPDF_ENABLE_REMOTE", true);

        $path = 'img/cintillo-superior.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;
        $orderBy = $param->orderBy;
        $dpi = 100;

        $registro = self::getRegistersByFilters($columnas, $filtros,$orderBy);

        if (count($columnas) >= 15 && count($columnas) <= 10) {
            $dpi = 150;
        } elseif (count($columnas) > 16) {
            $dpi = 200;
        }

        view()->share('registro', $registro);

        $pdf = Pdf::loadView(
            'reportes.pdf',
            [
                'data' => $registro,
                'logo' => $logo,
                'columnas' => $columnas,
                'titulo' => $titulo
            ]
        )->setPaper('letter', 'landscape')
            ->setOption(['dpi' => $dpi]);
        return $pdf->download($titulo . '.pdf');
        return view('reportes.pdf', compact('Registro', 'logo','columnas','titulo'));
    }

    public function registro_pdf(){

        //$registro = Registro::findOrFail();

        $pdf = Pdf::loadView('reportes.acta_pdf');
        // compact('registro'));
        return $pdf ->stream('Registro Linea Telefonica.pdf');

    }
}
