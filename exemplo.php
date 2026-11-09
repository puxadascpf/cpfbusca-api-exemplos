<?php
// Exemplo de integração — CPF Buscas API (PHP 8 + cURL)
// Gere sua chave em https://cpfbuscas.com (painel → API) e defina CPFBUSCAS_TOKEN no ambiente.
$token = getenv('CPFBUSCAS_TOKEN') ?: throw new RuntimeException('Defina CPFBUSCAS_TOKEN');

// Principal e contingência: mesma API, mesma chave, mesmos limites.
const CPFBUSCAS_BASES = ['https://cpfbuscas.com/api/v1', 'https://cpfbuscas.net/api/v1'];

function cpfbuscasConsultar(string $endpoint, array $params, string $token): array
{
    $lastError = 'sem resposta';
    foreach (CPFBUSCAS_BASES as $base) {
        $ch = curl_init($base . '/query/' . rawurlencode($endpoint) . '?' . http_build_query($params));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $token, 'Accept: application/json'],
            CURLOPT_TIMEOUT => 30,
        ]);
        $res = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($res === false) { $lastError = $err; continue; }         // rede/timeout: próximo domínio
        if ($status >= 500) { $lastError = "HTTP $status em $base"; continue; }
        return ['status' => $status, 'body' => json_decode($res, true, flags: JSON_THROW_ON_ERROR)];
    }
    throw new RuntimeException($lastError);
}

var_dump(cpfbuscasConsultar('cpf', ['cpf' => '00000000000'], $token)); // documento fictício
