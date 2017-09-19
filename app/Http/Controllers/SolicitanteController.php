<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use App\Models\User;

use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    public function index()
    {
        return view ('solicitantes.index');
    }

    public function create()
    {
        return view ('solicitantes.create');
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
