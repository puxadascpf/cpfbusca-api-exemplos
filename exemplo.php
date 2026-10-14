<?php
// Exemplo fictício de integração — CPF Busca API (PHP + cURL)
$token = getenv('CPFBUSCA_TOKEN');

function cpfbuscaConsultar(string $modulo, string $valor, string $token): array {
    $url = 'https://cpfbusca.com/api/v1/consulta?' . http_build_query(['modulo' => $modulo, 'valor' => $valor]);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $token, 'Accept: application/json'],
        CURLOPT_TIMEOUT => 30,
    ]);
    $res = curl_exec($ch);
    if ($res === false) throw new RuntimeException(curl_error($ch));
    curl_close($ch);
    return json_decode($res, true, flags: JSON_THROW_ON_ERROR);
}

var_dump(cpfbuscaConsultar('cpf', '00000000000', $token)); // documento fictício
