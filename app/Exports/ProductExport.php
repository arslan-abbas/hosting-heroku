<?php

namespace App\Exports;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductExport implements FromView,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        return view('exports.products', [
            'products' => Product::all()
        ]);
    }
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'family' => 'Calibri',
                        'size'   => '25',
                        'bold' => true
                    ]
                ]);
                $event->sheet->insertNewRowBefore(1,4);
                $event->sheet->insertNewColumnBefore('A',4);
            },
        ];
    }
}
