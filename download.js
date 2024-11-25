async function verificarLogin() {
    try {
        const response = await fetch('verificar_login.php');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erro ao verificar login:', error);
        return {status: 'deslogado', recem_cadastrado: false};
    }
}

// Função para iniciar o download
function iniciarDownload(sistema) {
    const url = `downloads/teste.jpeg`; // Exemplo de caminho
    const link = document.createElement('a');
    link.href = url;
    link.download = `imagem_teste_${sistema}.jpeg`;
    link.click();
}
async function verificarSessao() {
    const data= await verificarLogin();
    if (data.status === 'logado' && data.recem_cadastrado) {
        iniciarDownload('windows'); // Sistema padrão, pode ajustar conforme o contexto
    }
}

document.querySelectorAll('.baixasse div').forEach(div => {
    div.addEventListener('click', async event => {
        const sistema = event.target.closest('div').dataset.sistema;
        const data = await verificarLogin();

        if (data.status === 'logado') {
            iniciarDownload(sistema);
        } else {
            alert('Você precisa se cadastrar antes de fazer o download.');
            window.location.href = 'cadastro.html';
        }
    });
});

window.onload = verificarSessao;











