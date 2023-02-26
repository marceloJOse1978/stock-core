<?php

use App\Core\ConfigCore;
use App\Http\Controllers\AllController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\CategoreisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\Doc\DocumentController;
use App\Http\Controllers\Doc\FPController;
use App\Http\Controllers\Doc\FTController;
use App\Http\Controllers\Doc\NEController;
use App\Http\Controllers\Doc\RGController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackgeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TimeWorkController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('login');
})->middleware("core")->name("login");



Route::get('/upgrades', function (Request $request,ConfigCore $configCore) {
    session(['upgrades' => $configCore->versions()["actual"]]);
    session(['actual' => $configCore->versions()["version"]]);
    if ($request->ajax()) {
        $data = $configCore->versions();
        $url=null;
        
        
        if (!empty($configCore->online())) 
        if($configCore->upgrades()[0]!="Already up to date."){
            $configCore->updateVersion($data["actual"]);
            $url=url("/exit");
        }
        
        
        $data = $configCore->versions();
        
        
        if (!empty($configCore->online())) 
        return response()->json(array(
            'message'=>" VERSÃO ".$data["version"]." INSTALADA",
            "open"=>$url
        ));

        if (empty($configCore->online())) 
        return response()->json(array(
            'erro'=>"SEM ACESSO A INTERNET !"
        ));
    }
    return view('upgrade');
})->middleware("auth")->name("upgrades.index");



#***** DASHBOAD START  *****# 

Route::get('/dashboard/{page?}', [DashboardController::class, 'show'])->middleware("auth")->name("dashboard");

#***** DASHBOAD END *****# 



#***** LOGIN START *****#


Route::controller(LoginController::class)->group(function () {
   Route::post('/sign_in', 'enter');
   Route::get('/exit', 'exit');
});


#***** LOGIN END *****# 


Route::controller(DocumentController::class)->group(function () {
    Route::get('/itens/create/{id?}', 'register')->name("itens");
    Route::get('/itens/{id?}/destroy', 'destroy_itens')->name("itens.destroy");
    Route::get('/itens/{id?}/setting', 'setting')->name("itens.setting");
    Route::get('/document/{id?}', 'created')->name("document");
    Route::get('/itens/{like?}', 'view')->name("item");
    Route::get('/documentTotal/{id?}', 'documentTotal');

    /* EMISSÃO DE DOCUMENTO */
    Route::get("/document/{id?}/emission","documents")->name("document.emission");
    Route::get("/finalize/{id}}","finalize")->name("finalize");
});


Route::controller(SettingController::class)->group(function () {
    Route::post('/settings/company', 'core')->middleware("admin");
    Route::get('/settings/app/pay', 'payments')->name("payments.app")->middleware("admin");
    Route::get('/settings/{id}/pay', 'buy')->name("buy.app")->middleware("admin");
    Route::post('/settings/{id}/send', 'send')->name("send.app")->middleware("admin");
    Route::post('/settings/send', 'serial')->name("send.serial")->middleware("admin");
    Route::get('/settings/checked', 'checked')->name("checked.app")->middleware("admin");
});
Route::controller(SettingController::class)->group(function () {
    Route::post('/settings/register', 'register')->name("settings")->middleware("admin");
});
/* REPORT CONTROLLER SERVE PARA CRIAR UMA ROUTE QUE GERIR */
Route::controller(ReportsController::class)->group(function () {
    Route::get('/reports/clients/{date_init?}/{date_end?}', 'client')->name("report.client")->middleware("admin");
    Route::get('/reports/cash/{date_init?}/{date_end?}', 'cash')->name("report.cash")->middleware("admin");
    Route::get('/reports/products/{date_init?}/{date_end?}', 'products')->name("report.products")->middleware("admin");
    Route::get('/reports/category/{date_init?}/{date_end?}', 'category')->name("report.category")->middleware("admin");
    Route::get('/reports/brands/{date_init?}/{date_end?}', 'brands')->name("report.brands")->middleware("admin");
    Route::get('/reports/variants/{date_init?}/{date_end?}', 'variants')->name("report.variants")->middleware("admin");
    Route::get('/reports/providers/{date_init?}/{date_end?}', 'providers')->name("report.providers")->middleware("admin");
    Route::get('/reports/users/{date_init?}/{date_end?}', 'users')->name("report.users")->middleware("admin");

    Route::get('/reports/maps_tax/{date_init?}/{date_end?}', 'maps_tax')->name("report.maps_tax")->middleware("admin");
    Route::get('/reports/maps_tax_providers/{date_init?}/{date_end?}', 'maps_tax_providers')->name("report.maps_tax_providers")->middleware("admin");
    Route::post('/reports/core/{parament}', 'core')->middleware("admin");

});
/* IMPORT VIEWS & ACTION*/
Route::controller(ImportController::class)->group(function () {
    Route::get('/import/clients', 'clients')->middleware("admin");
    Route::post('/import/client', 'client')->middleware("admin");
    Route::get('/import/providers', 'providers')->middleware("admin");
    Route::post('/import/provider', 'provider')->middleware("admin");
    Route::get('/import/products', 'products')->middleware("admin");
    Route::post('/import/product', 'product')->middleware("admin");
});
/* EXPORT VIEWS & ACTION*/
Route::controller(ExportController::class)->group(function () {
    Route::get('/export/clients', 'clients')->name("export.clients")->middleware("admin");
    Route::get('/export/providers', 'providers')->name("export.providers")->middleware("admin");
    Route::get('/export/products', 'products')->name("export.products")->middleware("admin");
    Route::get('/export/products', 'inventory')->name("export.inventory")->middleware("admin");
});

/* EXPORT VIEWS & ACTION*/

Route::controller(TimeWorkController::class)->group(function () {
    Route::get('/timeworks/init', 'store')->name("init.timeworks")->middleware("auth");
});

Route::resource('clients',ClientController::class)->middleware("admin");
Route::resource('providers' , ProvidersController::class)->middleware("admin");
Route::resource('category',CategoreisController::class)->middleware("admin");
Route::resource('brands',BrandController::class)->middleware("admin");
Route::resource('variants',VariantController::class)->middleware("admin");
Route::resource('documents',DocumentController::class)->middleware("admin");
Route::resource('payments',PaymentController::class)->middleware("admin");
Route::resource('all',AllController::class)->middleware("admin");
Route::resource('FT',FTController::class)->middleware("admin");
Route::resource('FP',FPController::class)->middleware("admin");
Route::resource('RG',RGController::class)->middleware("admin");
Route::resource('NE',NEController::class)->middleware("admin");
Route::resource('packges',PackgeController::class)->middleware("admin");
Route::resource('products',ProductController::class)->middleware("admin");
Route::resource('settings',SettingController::class)->middleware("admin");
Route::resource('cash',CashController::class)->middleware("auth");
Route::resource('users',UserController::class)->middleware("admin");
Route::resource('invoices',InvoiceController::class)->middleware("admin");
Route::resource('units',UnitController::class)->middleware("admin");
Route::resource('items',ItemController::class)->middleware("admin");
Route::resource("stocks",StockController::class)->middleware("admin");
Route::resource("timeworks",TimeWorkController::class)->middleware("admin");
#***** LOGIN START *****# 
Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'profile')->name("profile");
    Route::put('/profile/{user}', 'editProfile')->name("profile.edit");
});
 #***** LOGIN END *****# 

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoice/item', 'items')->name("item.invoice")->middleware("admin");
    Route::get('/invoice/item/{search?}', 'items')->name("itens.invoice")->middleware("admin");
    Route::get('/invoice/{id}/stock', 'stocks')->name("stock.invoice")->middleware("admin");
    Route::get('/invoice/table', 'table')->name("table.invoice")->middleware("admin");
    Route::get('/invoice/{id?}/created', 'created')->name("invoice.created")->middleware("admin");
    Route::post('/invoice/end', 'end')->name("invoice.end")->middleware("admin");
    Route::get('/invoice/{id?}/destroy', 'destroy_itens')->name("invoice.destroy.itens")->middleware("admin");
});






#***** CORE START *****# 
Route::controller(CoreController::class)->group(function () {
   
   
    #***** VIEW START *****# 
   Route::get('/core/upgrades', 'upgrades')->name("core.upgrades")->middleware("admin");
   Route::get('/core/packs', 'pack')->name("core.packs")->middleware("admin");
   #***** VIEW END *****# 


   #***** FUNCTION START *****# 
   Route::get('/core/install-upgrade/{install}', 'installUpgrade')->name("install.upgrades")->middleware("admin");
   Route::get('/core/install-packs/{install}', 'installPack')->name("install.packs")->middleware("admin");
   #***** FUNCTION END *****# 


});
#***** CORE END *****# 


