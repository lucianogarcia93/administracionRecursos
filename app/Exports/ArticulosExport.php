<?php

namespace App\Exports;

use App\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ArticulosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.excel.articulos', [
            'articulos' => articulo::all()
        ]);
        //return Articulo::select("nombre","codigo","stock","fecha_venc")->get();
    }
}
