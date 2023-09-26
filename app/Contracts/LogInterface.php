<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface LogInterface {
    public function saveLogs(Request $request, Response|JsonResponse|RedirectResponse $response);
    public function getLogs();
    public function deleteLogs();

}
