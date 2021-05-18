<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propriedades;
use App\Models\FotosPropriedades;

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
        $idSenhorio = $request->input('idSenhorio');
        $inputTipo = $request->input('inputtipo');
        $localizacao = $request->input('inputLocalizacao');
        $latitude = $request->input('inputLatitude');
        $longitude = $request->input('inputLongitude');
        $area = $request->input('inputArea');
        $preco = $request->input('inputPreco');
        //$endereco = $request->input('inputEndereco');
        $descricao = $request->input('inputDescricao');
        $orientacao = $request->input('inputOrientacao');
        $numQuartos = $request->input('inputQuartos');
        $duracao = $request->input('inputDuracao');
        $lotacao = $request->input('inputLotacao');
        $disponibilidade = $request->input('inputDiponibilidade');
        $numWc = $request->input('inputBanho');       
        $estado = $request->input('inputEstado');

        $propriedade = Propriedades::create([
            'IdSenhorio' => $idSenhorio, 
            'TipoPropriedade' => $inputTipo,
            'Localizacao' => $localizacao, 
            'Latitude' => $latitude, 
            'Longitude' => $longitude, 
            'AreaMetros' => $area, 
            'Preco' => $preco,
            'Descricao' => $descricao, 
            'OrientacaoSolar' => $orientacao, 
            'NumeroQuartos' => $numQuartos, 
            'DuracaoAluguer' => $duracao, 
            'Lotacao' => $lotacao, 
            'Disponibilidade' => $disponibilidade, 
            'CasasBanho' => $numWc, 
            'EstadoConservacao' => $estado, 
        ]);

        if ($request->hasfile('inputFotos')) {
            
            foreach ($request->file('inputFotos') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('./upload/',  $name);
                $data[] = $name;

                $foto = FotosPropriedades::create([
                    'IdPropriedade' => $propriedade->IdPropriedade,
                    'FileName' => $name,
                ]);
            }
        }
        //return response()->json($request->all());
        //$propriedade = Propriedades::create($request->all());
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
