<?php

namespace App\Http\Controllers;

use App\Models\Graph;
use Illuminate\Http\Request;

class ChartJSController extends Controller
{
    //


    public function chart(){
        $graphs = Graph::select('x','y')->orderBy('x')->get();
        $xarray =array();
        $yarray =array();


        foreach ($graphs as $graph) {
            array_push($xarray,$graph->x);
            array_push($yarray,$graph->y);
        }

        $xarr = json_encode($xarray);
        $yarr = json_encode($yarray);
        // dd($graphs);
        // dd($yarray);

        return view('graph',[
            'graphs'=>$graphs,
            'xarray'=>$xarr,
            'yarray'=>$yarr

        ]);
    }
}
