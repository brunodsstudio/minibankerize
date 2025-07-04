# 💸 MINIBANKERIZE - BRUNO DE LIMA

Este projeto é um exemplo de aplicação Laravel com **arquitetura hexagonal**, que simula o envio de propostas de empréstimo para uma **API externa fictícia**, salvando no banco de dados e utilizando uma **fila (Queue)** para verificar o status posteriormente.

---

## ⚙️ Tecnologias

- PHP 8.x / Laravel 10.x
- MySQL
- Arquitetura Hexagonal (Ports & Adapters)
- Fila com Jobs (Laravel Queue)
- PHPUnit

---

## 🚀 Funcionalidades

- 📤 Enviar proposta de empréstimo para API externa
- 💾 Salvar proposta localmente no banco de dados
- 🔁 Atualizar status da proposta via Job em background

---

## 📦 Instalação

```bash
git clone git@github.com:brunodsstudio/minibankerize.git
cd minibankerize
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## 🛠 Exemplo de Requisição

**Endpoint:** `POST /api/proposals`

**Payload:**

```json
{
  "cpf": "123123123123",
  "nome": "Fulano de Tal",
  "data_nascimento": "2024-10-10",
  "valor_emprestimo": 1000.00,
  "chave_pix": "teste@teste.com"
}
```

A proposta é:
- Salva no banco
- Enviada para a API externa fictícia
- E uma job é agendada para verificar o status depois de 90 segundos

---

## 🧪 Testes

Execute os testes com:

```bash
php artisan test
```

Ou com PHPUnit diretamente:

```bash
./vendor/bin/phpunit
```

---

## 🧱 Arquitetura Hexagonal

```
[ Controller ] --> [ Use Case ] --> [ Domain Entity ]
                        ↓
        [ ProposalRepositoryInterface ]
                        ↓
[ EloquentRepository | ExternalAPI Adapter ]
```

---

## 📂 Estrutura

- `app/Domain` – Entidades e contratos (interfaces)
- `app/Application/UseCases` – Casos de uso da aplicação
- `app/Infrastructure` – Comunicação com banco e APIs externas
- `app/Jobs` – Verificações em segundo plano
- `routes/api.php` – Endpoint da API

---

## 🧰 Fila (Queue)

Configure o driver de fila no `.env`:

```
QUEUE_CONNECTION=database
```

E execute:

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

---


