<?php
require_once __DIR__ . '/../config/config.php';

// guarda de onde veio a requisição http
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';  

                    /******CORS*****/
//verifica se a origem da requisição esta na lista de permissoes
in_array($origin, $allowedOrigins) ? header("Access-Control-Allow-Origin: $origin ") : null;
//define quais metodos http sao aceitos
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS");
//Autoriza o envio de dados JSON;
header('Access-Control-Allow-Headers: Content-Type');

          /****TRATAMENTO DE REQUISIÇOES PREFLIGHT*****/
// dispara o preflight OPTIONS verifica se o servidor aceita os metodos antes de executar
if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(204); // 204 = aceito(sem conteudo)
    exit;
}
          /****ROTEAMENTO DE URLs*****/
// corta tudo o que vem depois do ? na url do request_uri
$uri = strtok($_SERVER['REQUEST_URI'], '?');

match($uri){
    '/api/users' => require __DIR__ . '/../api.php',
    default => notFound(),
};

/*TRATAMENTO DE ERRO**/
function notFound(): void
{
  http_response_code(404);
  echo json_encode(['error' => 'not found']);
}





