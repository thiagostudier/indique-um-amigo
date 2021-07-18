<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    // CRIAR INDICAÇÃO
    Route::post('/indications', 'App\Http\Controllers\IndicationController@store');
    // LISTAR INDICAÇÕES
    Route::get('/indications', 'App\Http\Controllers\IndicationController@get');
    // PEGAR INDICAÇÃO ESPECÍFICA
    Route::get('/indications/{id}', 'App\Http\Controllers\IndicationController@show');
    // ATUALIZAR INDICAÇÃO
    Route::patch('/indications/{id}', 'App\Http\Controllers\IndicationController@update');
    // ATUALIZAR STATUS DA INDICAÇÃO
    Route::patch('/indications-status/{id}', 'App\Http\Controllers\IndicationController@update_status');
    // REMOVER INDICAÇÃO
    Route::delete('/indications/{id}', 'App\Http\Controllers\IndicationController@delete');
});