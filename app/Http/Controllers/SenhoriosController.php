<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilizadores;
use App\Models\Propriedades;
use App\Models\HistoricoSaldo;
use Carbon\Carbon;
use App\Models\Arrendamento;
use App\Models\Pagamentos;
use App\Models\Messages;
use App\Models\Notifications;

class SenhoriosController extends Controller
{
    private $model;



    public function updateUtilizador(Request $req, $id)
    {
        $data = Utilizadores::find($id);
        $data->Username=$req->input('nomeUser');
        $data->PrimeiroNome=$req->input('primeiroNome');
        $data->UltimoNome=$req->input('ultimoNome');
        $data->Email=$req->input('mail');
        $data->Morada=$req->input('morada');
        $data->Nascimento=$req->input('dateNascimento');

        //Limpamos eventuais espaços a mais
        $nif=trim($req->input('NIF'));
        $ignoreFirst=true;
        //Verificamos se é numérico e tem comprimento 9
        if (!is_numeric($nif) || strlen($nif)!=9) {
            return response()->json('NIF Invalido');
        } else {
            $nifSplit=str_split($nif);
            //O primeiro digíto tem de ser 1, 2, 3, 5, 6, 8 ou 9
            //Ou não, se optarmos por ignorar esta "regra"
            if (
                in_array($nifSplit[0], array(1, 2, 3, 5, 6, 8, 9))
                ||
                $ignoreFirst
            ) {
                //Calculamos o dígito de controlo
                $checkDigit=0;
                for($i=0; $i<8; $i++) {
                    $checkDigit+=$nifSplit[$i]*(10-$i-1);
                }
                $checkDigit=11-($checkDigit % 11);
                //Se der 10 então o dígito de controlo tem de ser 0
                if($checkDigit>=10) $checkDigit=0;
                //Comparamos com o último dígito
                if ($checkDigit==$nifSplit[8]) {
                    $data->NIF=$req->input('NIF');
                } else {
                    return response()->json('NIF Invalido');
                }
            } else {
                return response()->json('NIF Invalido');
            }
        }

        
        $data->Nacionalidade=$req->input('Nacionalidade');
        $data->Telefone=$req->input('Telefone');
        $data->save();
        
        return response()->json('Updated successfully.');
    }

    public function chat(){
        $id = '1';
        $user = Utilizadores::find($id);
        return view('chat',['user'=>$user]);
    }

    public function searchUserChat($name){
       $users = Utilizadores::where('UserName','LIKE',"%".$name."%")->orWhere('PrimeiroNome','LIKE',"%".$name."%")->orWhere('UltimoNome','LIKE',"%".$name."%")->get();
       return response()->json($users);
    }

    public function getMessages($sender, $receiver){
        $messages = Messages::where('sender','=',$sender)->where('receiver','=',$receiver)->
        orWhere('receiver','=',$sender)->where('sender','=',$receiver)->orderBy('id', 'ASC')->get();
        return response()->json($messages);
    }

    public function getAllMessages($sender){
        $messages = Messages::where('sender','=',$sender)
        ->orWhere('receiver','=',$sender)
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json($messages);
        //
    }
    

    public function getUserInfo($id){
        $data = Utilizadores::find($id);
        return response()->json($data);
        //
    }

    public function postChatMessage(Request $req){

        $user = new Notifications();
        $user->UserId=$req->input('receiver');
        $user->type="message";
        $user->seen=0;
        $user->sentBy=$req->input('sender');
        $user->date=Carbon::now();
        $user->save();
        
        //dd($req->input('sender'), $req->input('receiver'), $req->input('message'));
        $message = new Messages;
        $message->sender=$req->input('sender');
        $message->receiver=$req->input('receiver');
        $message->message=$req->input('message');
        $message->time=Carbon::now();
        $message->save();
        return response()->json($message);
    }
    

    public function showWallet()
    {
        $id = '1';
        $user = Utilizadores::where('IdUser','=',$id)->get();
        $user2 = Utilizadores::find($id);

        $userHist = HistoricoSaldo::where('IdUser','=',$id)->orderBy('IdSaldo', 'desc')->limit(4)->get();

        return view('wallet',['data'=>$user,'user'=>$user2],['data2'=>$userHist]);
    }

    public function markNotificationRead($id)
    {
        $notification = Notifications::find($id)->update(['seen' => 1]);;
        return response()->json(['res'=>$notification]);
    }

    public function getNotifications($id)
    {
        $notifications = Notifications::where('userId', $id)->get();
        return response()->json([$notifications]);
    }

    public function senhorioHome(){
        $id = '1';
        $notifications = Notifications::where('userId', $id)->get();
        $utilizador = Utilizadores::find($id);
        $propriedadesPag = Propriedades::where('IdSenhorio', $id)->paginate(4);
        $propriedades = Propriedades::where('IdSenhorio', $id)->get();
        $dataHoje = Carbon::now();
        $arrendamentos = Arrendamento::all();
        $pagamentos = Pagamentos::all();        
        return view('senhorioHome',['user'=>$utilizador,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>0,'dataHoje'=>$dataHoje,'pagamentos','arrendamentos'=>$arrendamentos,'pagamentos'=>$pagamentos, 'notifications'=>$notifications]);
    }

    public function addSaldo(Request $amount){
        dump($amount->getContent());
        dump($amount->input());
        $id = 1;
        $user = Utilizadores::find($id);
        $user->Saldo=$amount->input('amountToAdd')+$user->Saldo;
        $user->save();
        $histSaldo = new HistoricoSaldo();
        //$user->IdSaldo=1;
        $histSaldo->IdUser=$id;
        $histSaldo->Descricao=$amount->input('Descricao');
        $histSaldo->Valor=$amount->input('amountToAdd');
        $histSaldo->Data=Carbon::now();
        $histSaldo->save();

        return response()->json(['res'=>$user->Saldo]);
    }


    public function senhorioHomeDisp(){
        $id = '1';
        $utilizador = Utilizadores::find($id);
        $senhorioId = $id;
        $propriedadesPag = Propriedades::where('IdSenhorio', $id)->where('Disponibilidade', "Disponivel")->paginate(3);
        $propriedades = Propriedades::where('IdSenhorio', $id)->get();
        return view('senhorioHome',['user'=>$utilizador,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>1]);
    }

    public function storeProfileImg(Request $req, $id)
    {
        $this->validate($req,[
            'imgProfile' => 'required|mimes:jpg,png,jpeg,|max:5048'
        ]);
        $file = $req->imgProfile->getClientOriginalName();
        $fileName = pathinfo($file,PATHINFO_FILENAME);

        $newImgName = time() . '-' . $fileName . '.' . 
        $req->imgProfile->extension();

        $req->imgProfile->move('img',$newImgName);

        $user = Utilizadores::find($id);
        $user->imagem=$newImgName;
        $user->save();

        $id = '1';
        $propriedadesPag = Propriedades::where('IdSenhorio', $id)->paginate(3);
        $propriedades = Propriedades::where('IdSenhorio', $id)->get();
        return redirect()->to('/senhorio/home');
    }
    
    public function store(Request $request){
        dd($request->all());
    }

    public function update($id, Request $request){
        dd($id, $request->all());
    }

    public function destroy($id){
        return "get " . $id;
    }

    //
}
