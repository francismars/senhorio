<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propriedades;

class PropriedadesController extends Controller
{
    private $model;

    public function __construct(Propriedades $propriedades)
    {
        $this->model = $propriedades;
    }

    public function getAllPropriedades(){
        $propriedades = Propriedades::all();
        //return response()->json($propriedades);
        return view('allProperties',compact('propriedades'));
    }

    public function getPropriedade($id){
        $propriedade = Propriedades::find($id);
        return response()->json($propriedade);
    }
    
    public function storePropriedade(Request $request){
        $propriedade = Propriedades::create($request->all());
        return response()->json($propriedade);
    }

    public function updatePropriedade($id, Request $request){
        $propriedade = Propriedades::find($id)->update($request->all());
        return response()->json($propriedade);
    }

    public function destroyPropriedade($id){
        $propriedade = Propriedades::find($id)->delete();
        return response()->json(null);
    }

    public function destroyAllPropriedades(){
        $deletedRows = Propriedades::getQuery()->delete();
        return response()->json($deletedRows);
    }

    public function getPropertiesFromSenhorio($id){
        $propriedades = Propriedades::where('IdSenhorio', $id)->get();
        //return response()->json($propriedades);
        return view('senhorioProperties',compact('propriedades'));
    }

    public function destroyPropriedadeSenhorio($id){
        $deletedRows = Propriedades::where('IdSenhorio', $id)->delete();
        return response()->json($deletedRows);
    }
}
