<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

Route::prefix('install')->group(function (){

    /*--------------------------------------------------------
    |           Check requirements
    ---------------------------------------------------------*/
    Route::get("/", [InstallController::class, 'welcome'])
            ->name("install.welcome");

    Route::get("requirements", [InstallController::class, 'requirements'])
                    ->name('install.requirements');

    Route::get("permissions", [ InstallController::class, "permissions"])
                    ->name('install.permissions');

    /*---------------------------------------------------------------------------------
    |                          Database
    ---------------------------------------------------------------------------------*/
    Route::get("database", [InstallController::class, 'databaseInfoForm'])
            ->name('install.databaseInfoForm');

    Route::post("database", [InstallController::class, 'databaseInfo'])
            ->name('install.databaseInfo');

    Route::get("installation", [InstallController::class, "installationShowForm"])
            ->name('install.installationShowForm');

    Route::post("installation", [InstallController::class, "installation"])
                ->name('install.installation');

    /*---------------------------------------------------------------------------------
    |                          Admin user
    ---------------------------------------------------------------------------------*/
    Route::match(['get', 'post'], "admin", [ InstallController::class, 'createUser' ])
                    ->name('install.admin');

    /*--------------------------------------------------------
    |             finals
    ---------------------------------------------------------*/
    Route::match(['get', 'post'], "final", [InstallController::class, 'finish' ])
        ->name('install.final');

    Route::get("error", [InstallController::class, 'fails' ])
        ->name('install.fails');
});
