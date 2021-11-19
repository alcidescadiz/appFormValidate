<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use vendor\autoload;
use App\Models\Product;


class ExportExcel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("wavp25@gmail.com")
            ->setLastModifiedBy('wavp25@gmail.com')
            ->setTitle('Products')
            ->setSubject('Products')
            ->setDescription('')
            ->setKeywords('')
            ->setCategory('');

        $hoja = $documento->getActiveSheet();

        //nombre de la hoja
        $hoja->setTitle("Products");

        //encabezados
        $hoja->setCellValueByColumnAndRow(1, 1, "ID");
        $hoja->setCellValueByColumnAndRow(2, 1, "CODE");
        $hoja->setCellValueByColumnAndRow(3, 1, "NAME");
        $hoja->setCellValueByColumnAndRow(4, 1, "BRAND");
        $hoja->setCellValueByColumnAndRow(5, 1, "PRICE");
        $hoja->setCellValueByColumnAndRow(6, 1, "CATEGORY");

        //estilo a encabezados
        $documento->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        $documento->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal('center');

        //consultar en base de datos segun filtros
        $products = DB::table('products')->get();

        //echo count($products);
        
        //$products = array();
        
        for ($i = 0; $i < count($products); $i++) {
            //echo  $products[$i]->id;
            //echo 'prueba';
            //mostrar información de los bienes filtrados en la celdas
            $hoja->setCellValue("A" . $i+2, $products[$i]->id);
            $hoja->setCellValue("B" . $i+2, $products[$i]->code);
            $hoja->setCellValue("C" . $i+2, $products[$i]->name);
            $hoja->setCellValue("D" . $i+2, $products[$i]->brand);
            $hoja->setCellValue("E" . $i+2, $products[$i]->price);
            $hoja->setCellValue("F" . $i+2, $products[$i]->category);
        }
        
        //ajustar tamaño al conteenido de la celda
        $documento->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $documento->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $documento->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $documento->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $documento->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $documento->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


        $nombreDelDocumento = "products.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($documento, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
