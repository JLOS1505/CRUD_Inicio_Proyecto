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

    public function update(Request $request)
    {
        try {
            $sql = DB::update("update encargado set nombre=?, area=?, sueldo=? where id_usuario=?", [
                $request->txtnombre,
                $request->txtarea,
                $request->txtsueldo,
                $request->txtcodigo,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Encargado modificado correctamente");
        } else {
            return back()->with("incorrecto", "Error el modificar");
        }
    }

    public function delete($id)
    {
        try {
            $sql = DB::delete("delete from encargado where id_usuario=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Encargado eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error el eliminar el Encargado");
        }
    }

}