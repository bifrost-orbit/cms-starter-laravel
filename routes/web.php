<?php

use App\Http\Controllers\CmsWebhookController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::post('/cms-webhook', CmsWebhookController::class);

Route::get('/{path?}', [PageController::class, 'show'])->where('path', '.*');
