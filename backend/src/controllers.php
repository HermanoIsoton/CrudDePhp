<?php
require_once __DIR__ . '/services.php';

/**TRATAMENTO DE ERROS***/
// envia respostas http se deu boa ou nao
function respond(array $result): void{
    http_response_code($result['status']);

    if(isset($result['error'])){
        echo json_encode(['error' => $result['error']]);
    }   
    else{
        echo json_encode($result['data']);
    }
}

//tratamento generico para erros inesperado
function respondServerError(\Throwable $e): void
{
    error_log((string) $e);

    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}


//captura e converte os dados enviados no corpo da requisição RETORNA NULL SE O JSON FOR INVALIDO
function readJsonBody(): ?array
{
    $input = json_decode(file_get_contents('php://input'), true);

    return is_array($input) ? $input : null;
}


/**TRATAMENTO DE  METODOS DA REQUISIÇÃO***/

function handleGet(): void
{
    try {
        respond(getAllUsers());
    } catch (\Throwable $e) {
        respondServerError($e);
    }
}

function handlePost(): void
{
    try {
        respond(createUser(readJsonBody()));
    } catch (\Throwable $e) {
        respondServerError($e);
    }
}       

function handlePut(): void
{
    try {
        respond(editUser($_GET['id'] ?? null, readJsonBody()));
    } catch (\Throwable $e) {
        respondServerError($e);
    }
}

function handlePatch(): void
{
    try {
        respond(editUser($_GET['id'] ?? null, readJsonBody(), partial: true));
    } catch (\Throwable $e) {
        respondServerError($e);
    }
}

function handleDelete(): void
{
    try {
        respond(removeUser($_GET['id'] ?? null));
    } catch (\Throwable $e) {
        respondServerError($e);
    }
}

function handleMethodNotAllowed(): void
{
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}