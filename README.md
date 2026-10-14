# 💻 CPF Busca API — Exemplos de integração

Exemplos mínimos (com dados fictícios) para integrar a **API do CPF Busca** em JavaScript, Python e PHP.

| Arquivo | Linguagem |
|---|---|
| `exemplo.js` | Node 18+ (fetch nativo) |
| `exemplo.py` | Python 3 (requests) |
| `exemplo.php` | PHP (cURL) |

## Como usar

1. Assine um plano de API em **https://cpfbusca.com** (a partir de R$30/mês).
2. No painel → API, gere sua **chave Bearer** (até 5 chaves ativas).
3. Defina a variável de ambiente e rode o exemplo:

```bash
export CPFBUSCA_TOKEN=SUA_CHAVE_AQUI
node exemplo.js
```

Base URL: `https://cpfbusca.com/api/v1` · Autenticação: `Authorization: Bearer SUA_CHAVE` · Limites: 20 a 1.000 req/min conforme o plano.

⚠️ Nunca commite sua chave real nem dados pessoais reais. Use apenas documentos fictícios em exemplos públicos.
