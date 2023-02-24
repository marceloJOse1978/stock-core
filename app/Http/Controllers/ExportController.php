<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Product;
use App\Models\Providers;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportController extends Controller
{
    public function __construct() {
        if(!is_dir("storage/export"))
        Storage::makeDirectory("export");
    }
    public function clients(Clients $clients)
    {
        
        $data=$clients->where("active",true)->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(('STOCK SYSTEM'));
        $sheet->getStyle('A1:E1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1','NIF');
        $sheet->setCellValue('B1', 'NOME');
        $sheet->setCellValue('C1', 'EMAIL');
        $sheet->setCellValue('D1', 'TELEMOVEL');
        $sheet->setCellValue('E1', 'CRIADO EM');
        $line = 2;
        foreach ($data as $item) {
            $sheet->setCellValueByColumnAndRow(1, $line, $item->code);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->name);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->email);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->mobile);
            $sheet->setCellValueByColumnAndRow(5, $line, $item->created_at);
            $line++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = "report-clients" . time() . ".xlsx";
        $writer->save('public/storage/export/' . $filename);
        return redirect()->intended('public/storage/export/' . $filename);
    }
    public function providers(Providers $providers)
    {
        
        $data=$providers->where("active",true)->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(('STOCK SYSTEM'));
        $sheet->getStyle('A1:E1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1','NIF');
        $sheet->setCellValue('B1', 'NOME');
        $sheet->setCellValue('C1', 'EMAIL');
        $sheet->setCellValue('D1', 'TELEMOVEL');
        $sheet->setCellValue('E1', 'CRIADO EM');
        $line = 2;
        foreach ($data as $item) {
            $sheet->setCellValueByColumnAndRow(1, $line, $item->code);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->name);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->email);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->mobile);
            $sheet->setCellValueByColumnAndRow(5, $line, $item->created_at);
            $line++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = "report-providers" . time() . ".xlsx";
        $writer->save('public/storage/export/' . $filename);
        return redirect()->intended('public/storage/export/' . $filename);
    }
    public function products(Product $product)
    {
        
        $data=$product->where("status",true)->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(('STOCK SYSTEM'));
        $sheet->getStyle('A1:F1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1','REFERENCIA');
        $sheet->setCellValue('B1', 'TITULO');
        $sheet->setCellValue('C1', 'PREÇO DO PRODUTO');
        $sheet->setCellValue('D1', 'IVA %');
        $sheet->setCellValue('E1', 'NO STOCK');
        $sheet->setCellValue('F1', 'MONTANTE DO STOCK');
        $line = 2;
        foreach ($data as $item) {
            $sheet->setCellValueByColumnAndRow(1, $line, $item->reference);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->title);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->gross_price);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->tax_id);
            $sheet->setCellValueByColumnAndRow(5, $line, $item->stocks()->sum("qty"));
            $sheet->setCellValueByColumnAndRow(6, $line, $item->stocks()->sum("pvp")*$item->stocks()->sum("qty"));
            $line++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = "report-products" . time() . ".xlsx";
        $writer->save('public/storage/export/' . $filename);
        return redirect()->intended('public/storage/export/' . $filename);
    }
    public function inventory()
    {
        
        $data=Stock::where("active",true)
        ->selectRaw('SUM(qty) as qtd , document_id , product_id, unit, net_total')
        ->groupBy('product_id')
        ->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(('STOCK SYSTEM'));
        $sheet->getStyle('A1:D1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1','REFERENCIA');
        $sheet->setCellValue('B1', 'TITULO');
        $sheet->setCellValue('C1', 'UNIDADE');
        $sheet->setCellValue('D1', 'QTD');
        $line = 2;
        
        foreach ($data as $item) {
            $sheet->setCellValueByColumnAndRow(1, $line, $item->products->reference);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->products->title);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->units->title);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->qtd);
            $line++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = "report-inventory" . time() . ".xlsx";
        $writer->save('public/storage/export/' . $filename);
        return redirect()->intended('public/storage/export/' . $filename);
    }
}
