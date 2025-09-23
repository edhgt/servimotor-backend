<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BitacoraExport;
use App\Http\Resources\ActivityLogResource;
use Spatie\Activitylog\Models\Activity;

class BitacoraController extends Controller
{
    
    public function __invoke(Request $request)
    {
        $consulta = Activity::select('activity_log.id', 'u.name as responsable',
        DB::raw("DATE_FORMAT(activity_log.created_at, '%d/%m/%Y') as fecha"), 'activity_log.description', 'activity_log.properties', 'activity_log.subject_type')
        ->leftJoin('users as u', 'activity_log.causer_id', '=', 'u.id')
        ->orderBy('activity_log.id', 'DESC');

        if($request->columna == 'ID') {
            $consulta->where('activity_log.id', $request->valor);
        }

        if($request->columna == 'Responsable') {
            $consulta->where('u.id', $request->valor);
        }
        
        if($request->columna == 'Evento') {
            $consulta->where('activity_log.description', $request->valor);
        }
        
        $registros = $consulta->simplePaginate($request->per_page);
            
        return ActivityLogResource::collection($registros);
    }

    public function export(Request $request)
{
    $columna = $request->columna;
    $valor = $request->valor;
    $per_page = $request->per_page;

    return Excel::download(new BitacoraExport($columna, $valor, $per_page), 'ReporteBitacora.xlsx');
}
}
