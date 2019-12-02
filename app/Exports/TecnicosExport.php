<?php

namespace App\Exports;

use App\Tecnico;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TecnicosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('exports.excel.tecnicos', [
            'tecnicos' => tecnico::all()
        ]);
        //return Tecnico::all();
    }
}
