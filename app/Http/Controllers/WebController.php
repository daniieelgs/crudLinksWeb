<?php

namespace App\Http\Controllers;

use App\Models\Web;
use Illuminate\Http\Request;
use App\Http\Requests\WebRequest;
use App\Http\Requests\WebRequestCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    function addWeb(WebRequestCreate $req){

        $web = $this->create_updateWeb($req);

        return view('seeWeb', ['dada' => $web,'username' => Auth::check() ? Auth::user() : null]);

    }

    function updateWeb(WebRequest $req, $id){

        if(Web::find($id)->name != $req->input('name') && $this->nameExists($req->input('name'))) return Redirect::back()->withInput($req->input())->withErrors(['name' => 'Aquest nom ja está registrat.']);

        $web = $this->create_updateWeb($req, $id);

        return view('seeWeb', ['dada' => $web, 'username' => Auth::check() ? Auth::user() : null]);

    }

    function deleteWeb($id){

        Web::find($id)->delete();

        return $this->seeAll(null);
    }
    
    function editWeb($id){
        $web = Web::find($id);

        return view('editWeb', ['dada' => $web, 'username' => Auth::check() ? Auth::user() : null]);
    }

    function createWeb(){

        return view('createWeb', ['username' => Auth::check() ? Auth::user() : null]);

    }

    function seeAll(?Request $req){

        $search = null;

        if($req != null && $req->input('s') != null){

            $search = $req->input('s');

            $dades = Web::where('name', 'LIKE', "%{$search}%")->get();

        }else{
            $dades = Web::all();
        }

        return view('seeAllWebs', ['dades' => $dades, 'search' => $search, 'username' => Auth::check() ? Auth::user() : null]);
    }

    function seeWeb($id){

        $web = Web::find($id);


        return view('seeWeb', ['dada' => $web, 'username' => Auth::check() ? Auth::user() : null]);
    }

    private function create_updateWeb(WebRequest $req, $id = null){

        $web = $id == null ? new Web :  Web::find($id);

        $web->url = $req->input('url');
        $web->name = $req->input('name');
        $web->description = $req->input('description');

        $web->save();

        return $web;

    }

    private function nameExists($name){

        return count(array_filter(Web::all()->toArray(), fn($n) => $n['name'] == $name)) > 0;
    }
}
