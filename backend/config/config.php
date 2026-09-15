<?php
// variavel que aponta para o banco de dados
// __DIR__ para sempre referenciar este arquivo para acessar o banco de dados
const DATA_FILE = __DIR__ . '/../data/data.json/';

//lista de urls autorizadas para fazer reqisiçoes http
$allowedOrigins = [
    'http://0.0.0.0:8080', 'http://localhost:8080', 'http://127.0.0.1:8080',
    'http://0.0.0.0:5500', 'http://localhost:5500', 'http://127.0.0.1:5500',
];