document.addEventListener('DOMContentLoaded', () => {
    const btnAdicionarModulo = document.getElementById('btnAdicionarModulo');
    const listaDeModulos = document.getElementById('listaDeModulos');
  
    if (btnAdicionarModulo) {
      btnAdicionarModulo.addEventListener('click', adicionarModulo);
    }
  
    listaDeModulos.addEventListener('click', (event) => {
      if (event.target.classList.contains('btn-editar')) {
        editarModulo(event.target.dataset.id);
      } else if (event.target.classList.contains('btn-excluir')) {
        excluirModulo(event.target.dataset.id);
      }
    });
  });
  
  function adicionarModulo() {
    const nomeDoModulo = prompt('Digite o nome do módulo:');
    if (nomeDoModulo) {
      console.log(`Módulo "${nomeDoModulo}" adicionado`);
    }
  }
  
  function editarModulo(id) {
    const novoNome = prompt('Digite o novo nome do módulo:');
    if (novoNome) {
      console.log(`Módulo com ID ${id} alterado para "${novoNome}"`);
    }
  }
  
  function excluirModulo(id) {
    const confirmacao = confirm('Você tem certeza que deseja excluir este módulo?');
    if (confirmacao) {
      console.log(`Módulo com ID ${id} excluído`);
    }
  }
  