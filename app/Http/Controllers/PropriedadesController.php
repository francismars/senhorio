<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propriedades;
use App\Models\FotosPropriedades;
use App\Models\Rating;
use App\Models\Arrendamento;
use App\Models\Indisponivel;
use App\Models\Utilizadores;
use App\Models\Pagamentos;
use Carbon\Carbon;

class PropriedadesController extends Controller
{
    private $model;

    public function __construct(Propriedades $propriedades)
    {
        $this->model = $propriedades;
    }

    public function ApagarIndisponivel($id)
    {
    $propertyId = Indisponivel::find($id);
    $indisponiveis = Indisponivel::find($id)->delete();
    return redirect()->to('/propriedade/' . $propertyId['IdPropriedade']);
    }

    public function showFatura($id)
    {
        $arrendamento = Arrendamento::find($id);
        $property = Propriedades::find($arrendamento['IdPropriedade']);
        $senhorio = Utilizadores::find($property['IdSenhorio']);
        $inquilino = Utilizadores::find($arrendamento['IdInquilino']);
        $pagamentos = Pagamentos::where('IdArrendamento', $id)->get();
        
        return view('faturaRent',compact('arrendamento','property','senhorio','inquilino','pagamentos'));
    }

    

    public function AddIndisponivel($id, Request $request)
    {
    $mes = $request->input('Mes');
    $indisponiveis = Indisponivel::create([
        'IdPropriedade' => $id,
        'Mes' => $mes,
    ]);
    return redirect()->to('/propriedade/' . (int)$id);
    }

    public function propertyInfo($id)
    {
        $property = Propriedades::where('IdPropriedade', $id)->get();
        $arrendamentos = Arrendamento::where('IdPropriedade', $id)->get();
        $indisponiveis = Indisponivel::where('IdPropriedade', $id)->get();
        $avgStar = Rating::where('IdPropriedade', $id)->avg('Rating');
        $data = Carbon::now();
        $pagamentos = array();
        foreach($arrendamentos as $arrendamento){
            $pagamento = Pagamentos::where('IdArrendamento', $arrendamento['IdArrendamento'])->get();
            array_push($pagamentos, $pagamento);
        }
        //return response()->json($avgStar);
        return view('infoProp',compact('property','avgStar','data','arrendamentos','indisponiveis','pagamentos'));
    }

    public function getPropriedadeEdit($id){
        $propriedade = Propriedades::find($id);
        return view('editProp',compact('propriedade'));
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
        $lotacao = $request->input('inputLotacao');
        $numWc = $request->input('inputBanho');       
        $estado = $request->input('inputEstado');

        $internetAcess = $request->input('internetAcess');
        $limpeza = $request->input('limpeza');
        $faixaEtariaMin = $request->input('faixaEtariaMin');
        $faixaEtariaMax = $request->input('faixaEtariaMax');
        $generoMasc = $request->input('generoMasc');
        $generoFemin = $request->input('generoFemin');
        $aceitaFumadores = $request->input('aceitaFumadores');
        $aceitaAnimais = $request->input('aceitaAnimais');

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
            'Lotacao' => $lotacao, 
            'CasasBanho' => $numWc, 
            'EstadoConservacao' => $estado, 

            'internetAcess' => $internetAcess=="on" ? '1' : '0',
            'limpeza' => $limpeza=="on" ? '1' : '0', 
            
            'faixaEtariaMin' => $faixaEtariaMin,
            'faixaEtariaMax' => $faixaEtariaMax,
            'generoMasc' => $generoMasc=="on" ? '1' : '0',
            'generoFemin' => $generoFemin=="on" ? '1' : '0',
            'aceitaFumadores' => $aceitaFumadores=="on" ? '1' : '0',
            'aceitaAnimais' => $aceitaAnimais=="on" ? '1' : '0',

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
        //return response()->json($propriedade);
        return redirect()->to('/senhorio/home');
    }

    public function updatePropriedade($id, Request $request){
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
        $lotacao = $request->input('inputLotacao');
        $numWc = $request->input('inputBanho');       
        $estado = $request->input('inputEstado');

        $internetAcess = $request->input('internetAcess');
        $limpeza = $request->input('limpeza');
        $faixaEtariaMin = $request->input('faixaEtariaMin');
        $faixaEtariaMax = $request->input('faixaEtariaMax');
        $generoMasc = $request->input('generoMasc');
        $generoFemin = $request->input('generoFemin');
        $aceitaFumadores = $request->input('aceitaFumadores');
        $aceitaAnimais = $request->input('aceitaAnimais');

        $propriedade = Propriedades::find($id)->update([
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
            'Lotacao' => $lotacao, 
            'CasasBanho' => $numWc, 
            'EstadoConservacao' => $estado, 

            'internetAcess' => $internetAcess=="on" ? '1' : '0',
            'limpeza' => $limpeza=="on" ? '1' : '0', 
            
            'faixaEtariaMin' => $faixaEtariaMin,
            'faixaEtariaMax' => $faixaEtariaMax,
            'generoMasc' => $generoMasc=="on" ? '1' : '0',
            'generoFemin' => $generoFemin=="on" ? '1' : '0',
            'aceitaFumadores' => $aceitaFumadores=="on" ? '1' : '0',
            'aceitaAnimais' => $aceitaAnimais=="on" ? '1' : '0',

        ]);
        return redirect()->to('/propriedade/' . (int)$id);
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
