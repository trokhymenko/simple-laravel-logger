<?php

namespace App\Http\Middleware;

use App\Contracts\LogInterface;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Logger
{
    protected $logger;

    public function __construct(LogInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure                $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        return $response;
    }

    public function terminate(Request $request, Response|JsonResponse|RedirectResponse $response) {
        $this->logger->saveLogs($request, $response);
    }
}
