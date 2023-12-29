<!DOCTYPE html>
<html>
<head>
    <title>Resultado da Pesquisa</title>
    <link rel="stylesheet" href="style-resultado.css">
</head>
<body>
    <h1>Resultado da Pesquisa</h1>
    <?php
    // Obtém o valor do parâmetro 'cep' da URL que foi passado para a página.
    $cep = $_GET['cep'];

    // Verifica se o CEP foi fornecido (não está vazio).
    if (!empty($cep)) {
        // Monta a URL para chamar a API PHP local (cep_api.php) com o CEP fornecido.
        $api_url = "http://localhost/bscep/cep_api.php?cep=" . urlencode($cep);

        // Faz uma solicitação HTTP à API PHP local e obtém os dados retornados.
        $result = file_get_contents($api_url);

        // Verifica se a solicitação HTTP foi bem-sucedida.
        if ($result !== false) {
            // Decodifica os dados JSON retornados em um objeto PHP.
            $data = json_decode($result);

            // Verifica se a propriedade 'erro' está definida nos dados. Se estiver, o CEP não foi encontrado.
            if (isset($data->erro)) {
                echo "<p>CEP não encontrado.</p>";
            } else {
                // Se não houver erro, exibe os detalhes do CEP em uma tabela.
                echo "<table class='result-table'>";
                echo "<tr><th>CEP</th><td>" . $data->cep . "</td></tr>";
                echo "<tr><th>Logradouro</th><td>" . $data->logradouro . "</td></tr>";
                echo "<tr><th>Bairro</th><td>" . $data->bairro . "</td></tr>";
                echo "<tr><th>Cidade</th><td>" . $data->localidade . "</td></tr>";
                echo "<tr><th>Estado</th><td>" . $data->uf . "</td></tr>";
                echo "</table>";
            }
        } else {
            // Se a solicitação HTTP falhar, exibe uma mensagem de erro.
            echo "<p>Erro ao buscar informações de CEP.</p>";
        }
    } else {
        // Se o CEP não foi fornecido (está vazio), exibe uma mensagem de erro.
        echo "<p>CEP não fornecido.</p>";
    }
    ?>
    <!-- Adiciona um link para voltar à página inicial (index.php). -->
    <a href="index.html">Voltar</a>
</body>
</html>
