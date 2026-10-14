// Exemplo fictício de integração — CPF Busca API (Node 18+)
// Gere sua chave em cpfbusca.com (painel → API) e defina CPFBUSCA_TOKEN no ambiente.
const TOKEN = process.env.CPFBUSCA_TOKEN;
if (!TOKEN) throw new Error('Defina CPFBUSCA_TOKEN');

async function consultar(modulo, valor) {
  const url = new URL('https://cpfbusca.com/api/v1/consulta');
  url.searchParams.set('modulo', modulo);
  url.searchParams.set('valor', valor);
  const r = await fetch(url, { headers: { Authorization: 'Bearer ' + TOKEN, Accept: 'application/json' } });
  if (!r.ok) throw new Error('HTTP ' + r.status);
  return r.json();
}

// Exemplo com documento fictício:
consultar('cpf', '00000000000').then(console.log).catch(console.error);
