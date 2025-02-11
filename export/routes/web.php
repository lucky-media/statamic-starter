<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicToken;

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

Route::statamic('/sitemap.xml', 'partials._sitemap', [
    'layout' => null
]);

Route::get('/!/token/refresh', DynamicToken::class);

Route::statamic('site.webmanifest', 'partials._manifest', [
    'layout' => null,
    'content_type' => 'application/json'
]);
