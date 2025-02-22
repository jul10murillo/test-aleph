<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\IndexController as categoryIndex;
use App\Http\Controllers\CMDB\ShowController as CMDBShow;
use App\Http\Controllers\CMDB\ExportController as CMDBExport;
use App\Http\Controllers\CMDB\ImportController as CMDBImport;

Route::get('/', function () {
    return redirect()->route('categories.index');
});

Route::get('/categories', categoryIndex::class)->name('categories.index');
Route::get('/cmdb/{categoryId}', CMDBShow::class)->name('cmdb.show');
Route::get('/cmdb/export/{categoryId}', CMDBExport::class)->name('cmdb.export');
Route::post('/cmdb/import', CMDBImport::class)->name('cmdb.import');