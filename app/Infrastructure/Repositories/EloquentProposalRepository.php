<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Proposal as DomainProposal;
use App\Domain\Repositories\ProposalRepositoryInterface;
use App\Models\Proposal as EloquentProposal;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EloquentProposalRepository implements ProposalRepositoryInterface
{
    protected string $apiUrl;
    protected string $autorizeUrl;

    public function __construct(){
        $this->apiUrl = 'https://util.devi.tools/api/v1/notify';
        $this->autorizeUrl = 'https://util.devi.tools/api/v2/authorize';
    }

    public function send(DomainProposal $proposal): array
    {
       
    $sendNew = true;
    $id = ""; 


    $autorize = Http::get("{$this->autorizeUrl}");
    $auth  = json_decode($autorize);
    if($auth->status == "fail"){
            \Log::info("Erro de autorização cpf: {$proposal->cpf}: {$auth->data->authorization}");
    }
    // 
     $getProposal = $this->getProposal($proposal->cpf);
      if($getProposal !== []){
            $sendNew  =  false;
            if($getProposal[0]['status'] == "aprovado"){
                return ["status" => "aprovado", "id" => $getProposal[0]['id']];
            } else {
                $id = $getProposal[0]['id'];
            }
       } 
       
        $response = Http::post("{$this->apiUrl}", [
            'cpf' => $proposal->cpf,
            'nome' => $proposal->nome,
            'data_nascimento' => $proposal->data_nascimento,
            'valor_emprestimo' => $proposal->valor_emprestimo,
            'chave_pix' => $proposal->chave_pix,
            'status' => $proposal->status,
        ]);
   
        $res = $response->getBody()->getContents();

        if($res == "" || $res == 1){
            $status = "aprovado";
        } else {  
            $status = "pendente";
        }
      
        if($sendNew){
          $res =   EloquentProposal::create([
                'cpf' => $proposal->cpf,
                'nome' => $proposal->nome,
                'data_nascimento' => $proposal->data_nascimento,
                'valor_emprestimo' => $proposal->valor_emprestimo,
                'chave_pix' => $proposal->chave_pix,
                'status' => $status,
            ])->toArray();
            $id =  $res['id'];

        } else {
            if( $status == "aprovado"){
                $proposal = EloquentProposal::where('cpf', $proposal->cpf)->first();
                if ($proposal) {
                    $proposal->status = $status;
                    $proposal->save();
                }
            }

        }
        return ["status" => $status, "id" => $id];
        
    }

    public function getStatus(string $cpf): string
    {
        $response = Http::get("{$this->apiUrl}/proposal/status", ['cpf' => $cpf]);
        $status = $response->json()['status'] ?? 'indefinido';

        $proposal = EloquentProposal::where('cpf', $cpf)->first();
        if ($proposal) {
            $proposal->status = $status;
            $proposal->save();
        }

        return $status;
    }


    public function getProposal($cpf): array
    {
        $res =  EloquentProposal::where('cpf', "=" , $cpf)->get()->toArray();
        return $res ;
       
    }

}
