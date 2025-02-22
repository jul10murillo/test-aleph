<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categoria\IndexController as CategoriaIndex;
use App\Http\Controllers\CMDB\ShowController as CMDBShow;
use App\Http\Controllers\CMDB\ExportController as CMDBExport;
use App\Http\Controllers\CMDB\ImportController as CMDBImport;

Route::get('/categorias', CategoriaIndex::class)->name('categorias.index');
Route::get('/cmdb/{categoriaId}', CMDBShow::class)->name('cmdb.show');
Route::get('/cmdb/export/{categoriaId}', CMDBExport::class)->name('cmdb.export');
Route::post('/cmdb/import', CMDBImport::class)->name('cmdb.import');