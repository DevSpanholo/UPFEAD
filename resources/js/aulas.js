document.addEventListener('DOMContentLoaded', () => {
    const btnAdicionarAula = document.getElementById('btnAdicionarAula');
    const listaDeAulas = document.getElementById('listaDeAulas');
  
    if (btnAdicionarAula) {
      btnAdicionarAula.addEventListener('click', adicionarAula);
    }
  
    listaDeAulas.addEventListener('click', (event) => {
      if (event.target.classList.contains('btn-editar')) {
        editarAula(event.target.dataset.id);
      } else if (event.target.classList.contains('btn-excluir')) {
        excluirAula(event.target.dataset.id);
      }
    });
  });
  
  function adicionarAula() {
    const nomeDaAula = prompt('Digite o nome da aula:');
    if (nomeDaAula) {
      console.log(`Aula "${nomeDaAula}" adicionada`);
    }
  }
  
  function editarAula(id) {
    const novoNome = prompt('Digite o novo nome da aula:');
    if (novoNome) {
      console.log(`Aula com ID ${id} alterada para "${novoNome}"`);
    }
  }
  
  function excluirAula(id) {
    const confirmacao = confirm('Você tem certeza que deseja excluir esta aula?');
    if (confirmacao) {
      console.log(`Aula com ID ${id} excluída`);
    }
  }
  