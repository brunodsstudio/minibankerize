<?php
namespace App\Http\Controllers;

use App\Application\UseCases\CreateProposalUseCase;
use App\Jobs\CheckProposalStatusJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ProposalController extends Controller
{
    public function store(Request $request, CreateProposalUseCase $useCase)
    {
        $data = $request->validate([
            'cpf' => 'required|string',
            'nome' => 'required|string',
            'data_nascimento' => 'required|date',
            'valor_emprestimo' => 'required|numeric',
            'chave_pix' => 'required|email',
        ]);
      
        $response = $useCase->execute($data);
        
       CheckProposalStatusJob::dispatch($data['cpf']);

       if($response['status'] ==  "aprovado"){
            return response()->json(['message' => 'Proposta Aprovada.'], 200);
       } else {
            return response()->json(['message' => 'Proposta Enviada aguardando aprovação.'], 201);
       }

    }
}
