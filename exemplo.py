# Exemplo de integração — CPF Buscas API (Python 3 + requests)
# Gere sua chave em https://cpfbuscas.com (painel → API) e defina CPFBUSCAS_TOKEN no ambiente.
import os
import requests

TOKEN = os.environ['CPFBUSCAS_TOKEN']

# Principal e contingência: mesma API, mesma chave, mesmos limites.
BASES = ['https://cpfbuscas.com/api/v1', 'https://cpfbuscas.net/api/v1']


def consultar(endpoint: str, **params) -> dict:
    last_error = None
    for base in BASES:
        try:
            r = requests.get(
                f'{base}/query/{endpoint}',
                params=params,
                headers={'Authorization': f'Bearer {TOKEN}', 'Accept': 'application/json'},
                timeout=30,
            )
        except requests.RequestException as e:  # rede/timeout: tenta o próximo domínio
            last_error = e
            continue
        if r.status_code < 500:  # 4xx é resposta válida da API: não troca de domínio
            return {'status': r.status_code, 'body': r.json()}
        last_error = RuntimeError(f'HTTP {r.status_code} em {base}')
    raise last_error


if __name__ == '__main__':
    print(consultar('cpf', cpf='00000000000'))  # documento fictício
