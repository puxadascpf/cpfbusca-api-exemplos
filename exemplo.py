# Exemplo fictício de integração — CPF Busca API (Python 3)
import os, requests

TOKEN = os.environ['CPFBUSCA_TOKEN']

def consultar(modulo: str, valor: str) -> dict:
    r = requests.get(
        'https://cpfbusca.com/api/v1/consulta',
        params={'modulo': modulo, 'valor': valor},
        headers={'Authorization': f'Bearer {TOKEN}', 'Accept': 'application/json'},
        timeout=30,
    )
    r.raise_for_status()
    return r.json()

if __name__ == '__main__':
    print(consultar('cpf', '00000000000'))  # documento fictício
