<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$modules = config("modular.modules");

if ($modules) {
    $apiRouter = function ($prefix, $modules) use (&$apiRouter) {
        foreach ($modules as $mod => $submodules) {
            if (is_string($submodules)) {
                $relativePath = $prefix . "/" . $submodules;
                $apiRoutesPath = config("modular.path") . $relativePath . "/Routes/api.php";
                if (file_exists($apiRoutesPath)) {
                    $namespace = str_replace('/', '\\', $relativePath);
                    Route::namespace("App\Modules$namespace\Controllers")->group($apiRoutesPath);
                }
            } else {
                $apiRouter($prefix.'/'.$mod, $submodules);
            }
        }
    };

    $apiRouter("", $modules);
}
