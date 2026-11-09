// Exemplo de integração — CPF Buscas API (Node 18+)
// Gere sua chave em https://cpfbuscas.com (painel → API) e defina CPFBUSCAS_TOKEN no ambiente.
const TOKEN = process.env.CPFBUSCAS_TOKEN;
if (!TOKEN) throw new Error('Defina CPFBUSCAS_TOKEN');

// Principal e contingência: mesma API, mesma chave, mesmos limites.
const BASES = ['https://cpfbuscas.com/api/v1', 'https://cpfbuscas.net/api/v1'];

async function consultar(endpoint, params) {
  let lastError;
  for (const base of BASES) {
    const url = new URL(`${base}/query/${endpoint}`);
    for (const [k, v] of Object.entries(params)) url.searchParams.set(k, v);
    try {
      const r = await fetch(url, {
        headers: { Authorization: `Bearer ${TOKEN}`, Accept: 'application/json' },
        signal: AbortSignal.timeout(30000),
      });
      // 4xx é resposta válida da API (token, validação, rate limit): não troca de domínio.
      if (r.status < 500) return { status: r.status, body: await r.json() };
      lastError = new Error(`HTTP ${r.status} em ${base}`);
    } catch (e) {
      lastError = e; // rede/timeout: tenta o próximo domínio
    }
  }
  throw lastError;
}

// Exemplo com documento fictício:
consultar('cpf', { cpf: '00000000000' }).then(console.log).catch(console.error);
