<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResponseExport;

class HomeController extends Controller
{
    
    protected $response;

    public function getData($request)
    {
        $month = $request->input('month');
        $day = $request->input('day');

        //return $request->all();

        //get current year
        $current_year = Carbon::now()->format('Y');

        $url_base = 'https://api.sbif.cl/api-sbifv3/recursos_api/dolar/';
        $url_full = $url_base . $current_year . '/' . $month . '/dias/' . $day;

        $response = Http::get($url_full, [
            'apikey' => 'd8093171162117c0c6e8da895b00978d4e2b6a0e',
            'formato' => 'json',
        ]);

        $this->response = $response;

    }
    public function getValue(Request $request)
    {

        $this->getData($request);

        if ( $this->response->status() == '404' ) {
            return response()->json([
                'statusCode' => $this->response->status(),
                'message' => $this->response->json()['Mensaje']
            ], 200);
        }

        $data = $this->response->json()['Dolares'][0];
        return response()->json([
            'statusCode' => $this->response->status(),
            'data' => $data
        ], 200);
    }

    public function export(Request $request)
    {

        $this->getData($request);

        if ( $this->response->status() == '404' ) {
            
            return view('home')->with([
                'status' => $this->response->json()['CodigoHTTP'],
                'message' => $this->response->json()['Mensaje']
            ]);
        }

        $data = $this->response->json()['Dolares'][0];

        $export = new ResponseExport([
            ['Valor', 'Fecha'],
            [$data['Valor'], $data['Fecha']]
        ]);

        return Excel::download($export, 'ValuesUSD.xlsx');
    }
}
