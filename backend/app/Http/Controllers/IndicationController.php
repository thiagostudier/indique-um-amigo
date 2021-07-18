<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\IndicationCollection;
use App\Models\Indication;
use App\Models\Status;
use App\Http\Requests\IndicationRequest;

class IndicationController extends Controller
{
    //LISTAR INDICAÇÕES
    public function get(Request $request){
        $indications = Indication::with('status')->paginate();
        return new IndicationCollection($indications);
    }

    //PEGAR INDICAÇÃO
    public function show($id){
        return Indication::findOrFail($id);
    }

    //CADASTRAR INDICAÇÃO
    public function store(IndicationRequest $request){
        // PEGAR OS DADOS
        $data = $request->all();
        // CADASTRAR REUNIÃO
        $meeting = Indication::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status_id' => Status::first()->id ?? null,
        ]);
        // RETORNAR INDICATION NOVA
        return $meeting;
    }

    //ATUALIZAR INDICAÇÃO
    public function update(IndicationRequest $request, $id){
        // PEGAR INDICAÇÃO
        $indication = Indication::findOrFail($id);
        // PEGAR OS DADOS
        $data = $request->all();
        // ATUALIZAR REUNIÃO
        $indication->update($data);
        // RETORNAR REUNIÃO NOVA
        return $indication;
    }

    //ATUALIZAR INDICAÇÃO
    public function update_status(Request $request, $id){
        // PEGAR INDICAÇÃO
        $indication = Indication::findOrFail($id);
        // PEGAR STATUS ATUAL
        $status = Status::find($indication->status_id);
        // PEGAR PRÓXIMO STATUS
        $next = Status::where('id', '>', $status->id)->first() ?? Status::first();
        // ATUALIZAR REUNIÃO
        $indication->update([
            'status_id' => $next->id
        ]);
        // RETORNAR REUNIÃO NOVA
        return $next;
    }

    // EXCLUIR INDICAÇÃO
    public function delete(Request $request, $id){
        // PEGAR REUNIÃO
        $indication = Indication::findOrFail($id);
        // REMOVER REUNIÃO
        $indication->delete();
        // RETORNAR REUNIÃO NOVA
        return $indication;
    }
}
