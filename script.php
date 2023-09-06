<?php
// Código PHP anterior
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário e montar em um array
    $dados = [
        "estado_civil" => $_POST["estado_civil"],
        "horario_aula" => $_POST["horario_aula"],
        "escolaridade_materna"=>$_POST["escolaridade_materna"],
        "escolaridade_paterna"=>$_POST["escolaridade_paterna"],
        "profissao_materna"=>$_POST["profissao_materna"],
        "profissao_paterna"=>$_POST["profissao_paterna"],
        "necessidades_educacionais"=>$_POST["necessidades_educacionais"],
        "devedor_mensalidade"=>$_POST["devedor_mensalidade"],
        "mensalidade_em_dia"=>$_POST["mensalidade_em_dia"],
    ];

    // Enviar dados para a API Python
    $url = 'http://localhost:5000/prever_evasao';  // Substitua pela URL da sua API
    $options = [
        'http' => [
            'header' => 'Content-Type: application/json',
            'method' => 'POST',
            'content' => json_encode($dados)
        ]
    ];
    $context = stream_context_create($options);
    $resultado_api = file_get_contents($url, false, $context);

    // Analisar a resposta JSON
    $resultado = json_decode($resultado_api, true);

    // Verificar a previsão
    if ($resultado["previsao"] == 1) {
        $status_evasao = "Evasão";
    } else {
        $status_evasao = "Não evadido";
    }

    // Agora, você pode exibir $status_evasao no seu HTML
}
// Resto do código PHP
?>