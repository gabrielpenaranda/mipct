<?php

use App\Http\Controllers\BancoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\LineaNegocioController;
use App\Http\Controllers\LiquidacionConceptoController;
use App\Http\Controllers\LiquidacionMultaController;
use App\Http\Controllers\LiquidacionOperadorController;
use App\Http\Controllers\LiquidacionRecargoController;
use App\Http\Controllers\NotaIngresoController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\OperadorDocumentoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TerritorioController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoMultaController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\TipoRecargoController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ZonaController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/language/{language}', function ($language) {
    if (in_array($language, ['es', 'fr', 'pt', 'en'])) {
        App::setLocale($language);
        session()->put('locale', $language);
    }

    return redirect()->back();
})->name('language');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('bancos', BancoController::class);
    Route::resource('ciudades', CiudadController::class);
    Route::resource('linea-negocios', LineaNegocioController::class);
    Route::resource('liquidacion-conceptos', LiquidacionConceptoController::class);
    Route::resource('liquidacion-multas', LiquidacionMultaController::class);
    Route::resource('liquidacion-operadores', LiquidacionOperadorController::class);
    Route::resource('liquidacion-recargos', LiquidacionRecargoController::class);
    Route::resource('nota-ingresos', NotaIngresoController::class);
    Route::resource('operadores', OperadorController::class);
    Route::resource('operador-documentos', OperadorDocumentoController::class);
    Route::resource('pagos', PagoController::class);

    Route::prefix('provincias')->group(function () {
        Route::get('index', [ProvinciaController::class, 'index'])->middleware('can:provincias.index')->name('provincias.index');
        Route::get('create', [ProvinciaController::class, 'create'])->middleware('can:provincias.create')->name('provincias.create');
        Route::post('store', [ProvinciaController::class, 'store'])->middleware('can:provincias.create')->name('provincias.store');
        Route::get('edit/{provincia}', [ProvinciaController::class, 'edit'])->middleware('can:provincias.edit')->name('provincias.edit');
        Route::put('update/{provincia}', [ProvinciaController::class, 'update'])->middleware('can:provincias.edit')->name('provincias.update');
        Route::delete('destroy/{provincia}', [ProvinciaController::class, 'destroy'])->middleware('can:provincias.destroy')->name('provincias.destroy');
    });

    Route::resource('territorios', TerritorioController::class);
    Route::resource('tipo-documentos', TipoDocumentoController::class);
    Route::resource('tipo-multas', TipoMultaController::class);
    Route::resource('tipo-pagos', TipoPagoController::class);
    Route::resource('tipo-recargos', TipoRecargoController::class);
    Route::resource('tipo-servicios', TipoServicioController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('zonas', ZonaController::class);
});

require __DIR__.'/settings.php';
