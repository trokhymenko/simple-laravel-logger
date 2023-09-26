<?php

namespace App\Http\Controllers;

use App\Contracts\LogInterface;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(LogInterface $logger)
    {
        $logs = $logger->getLogs();

        return view('index',compact('logs'));

    }

    public function delete(LogInterface $logger)
    {
        $logger->deleteLogs();

        return redirect()->back();

    }

}
