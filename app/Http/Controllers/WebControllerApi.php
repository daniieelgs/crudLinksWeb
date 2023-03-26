<?php

namespace App\Http\Controllers;

use App\Models\Web;


class WebControllerApi extends Controller
{

    function readAllNames(){
        
        $webs = Web::orderBy('name')->get()->toArray();

        $data = array_map(fn ($web) => ['id' => $web['id'], 'name' => $web['name']], $webs);

        return response()->json($data, 200, ['Content-Type' => 'application/json'], 0);

    }

}
