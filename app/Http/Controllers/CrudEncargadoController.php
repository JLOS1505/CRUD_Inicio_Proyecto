<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudEncargadoController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from encargado");
        return view("welcomeEncargado")->with("datos", $datos);
    }

    public function create(Request $request)
    {

        try {
            $sql = DB::insert("insert into encargado(id_usuario, nombre, area, sueldo)values(?, ?, ?, ?) ", [
                $request->txtcodigo,
                $request->txtnombre,
                $request->txtarea,
                $request->txtsueldo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Encargado registrado correctamente");
        } else {
            return back()->with("incorrecto", "Error el registrar");
        }
    }

}