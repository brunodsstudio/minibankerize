<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;

Route::post('/proposals', [ProposalController::class, 'store']);
