<?php
namespace App\Domain\Entities;

class Proposal
{
    public function __construct(
        public string $cpf,
        public string $nome,
        public string $data_nascimento,
        public float $valor_emprestimo,
        public string $chave_pix,
        public string $status = 'pendente'
    ) {}
}
