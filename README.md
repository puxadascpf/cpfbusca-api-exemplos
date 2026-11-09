# 💻 CPF Buscas API — Exemplos de integração

Exemplos mínimos (com dados fictícios) para integrar a **API do CPF Buscas** em JavaScript, Python e PHP, já com **failover automático** para o domínio de contingência.

> **Endereço atualizado:** o domínio oficial é **[cpfbuscas.com](https://cpfbuscas.com/)** (com "s"). O antigo `cpfbusca.com` não é mais operado pela plataforma. Contingência: **[cpfbuscas.net](https://cpfbuscas.net/)**.

| Arquivo | Linguagem |
|---|---|
| `exemplo.js` | Node 18+ (fetch nativo) |
| `exemplo.py` | Python 3 (requests) |
| `exemplo.php` | PHP 8 (cURL) |

## Como usar

1. Assine um plano de API em **https://cpfbuscas.com/api** (a partir de R$30/mês).
2. No painel → API, gere sua **chave Bearer** (1 a 4 chaves, conforme o plano).
3. Defina a variável de ambiente e rode o exemplo:

```bash
export CPFBUSCAS_TOKEN=SUA_CHAVE_AQUI
node exemplo.js        # ou: python3 exemplo.py  /  php exemplo.php
```

## Referência rápida

| | |
|---|---|
| Base URL principal | `https://cpfbuscas.com/api/v1` |
| Base URL de contingência | `https://cpfbuscas.net/api/v1` |
| Formato | `GET /api/v1/query/{endpoint}?{parametros}` |
| Autenticação | `Authorization: Bearer SUA_CHAVE` |
| Catálogo (público) | `GET https://cpfbuscas.com/api/v1/modules` — 62 módulos |
| Limites | 20 a 1.000 req/min conforme o plano |
| Documentação | https://cpfbuscas.com/api-docs |

### Quando usar a contingência

Os exemplos tentam `cpfbuscas.com` e só passam para `cpfbuscas.net` em **falha de rede, timeout ou HTTP 5xx**. Respostas 4xx (`api_token_invalid`, `validation_error`, `rate_limit_exceeded`) são respostas válidas e não disparam a troca. A chave, a cota e o rate limit são os mesmos nos dois domínios.

⚠️ Nunca commite sua chave real nem dados pessoais reais. Use apenas documentos fictícios em exemplos públicos.
