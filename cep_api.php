<?php
// Define o cabeçalho da resposta HTTP para indicar que o conteúdo que será enviado é do tipo JSON.
header("Content-Type: application/json");

// Obtém o valor do parâmetro 'cep' da URL que foi passado para a API.
$cep = $_GET['cep'];

// Verifica se o CEP foi fornecido (não está vazio).
if (!empty($cep)) {
    // Monta a URL da API ViaCEP com o CEP fornecido.
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    // Faz uma solicitação HTTP à URL da API e obtém os dados retornados.
    $result = file_get_contents($url);

    // Verifica se a solicitação HTTP foi bem-sucedida (se $result não é false).
    if ($result !== false) {
        // Imprime os dados do CEP (em formato JSON) como resposta HTTP para o cliente.
        echo $result;
    } else {
        // Se a solicitação HTTP falhou, define o código de resposta HTTP 500 (Erro Interno do Servidor)
        // e retorna uma mensagem de erro em formato JSON.
        http_response_code(500);
        echo json_encode(["error" => "Erro ao buscar informações de CEP"]);
    }
} else {
    // Se o CEP não foi fornecido (está vazio), define o código de resposta HTTP 400 (Solicitação Incorreta)
    // e retorna uma mensagem de erro em formato JSON.
    http_response_code(400);
    echo json_encode(["error" => "CEP não fornecido"]);
}
?>
