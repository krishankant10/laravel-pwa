<?php

namespace laraPWA\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use laraPWA\Services\LaucherIconService;
use laraPWA\Services\ManifestService;

class LaravelPWAController extends Controller
{
    public function manifestJson()
    {
        $output = (new ManifestService)->generate();
        return response()->json($output);
    }

    public function offline(){
        return view('laraPWA::offline');
    }
}
