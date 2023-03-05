<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listaPedidos()
    {
        $clientes = Cliente::all();

        return view('welcome', compact('clientes'));
    }
}
