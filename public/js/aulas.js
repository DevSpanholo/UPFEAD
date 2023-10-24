/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/aulas.js ***!
  \*******************************/
document.addEventListener('DOMContentLoaded', function () {
  var btnAdicionarAula = document.getElementById('btnAdicionarAula');
  var listaDeAulas = document.getElementById('listaDeAulas');
  if (btnAdicionarAula) {
    btnAdicionarAula.addEventListener('click', adicionarAula);
  }
  listaDeAulas.addEventListener('click', function (event) {
    if (event.target.classList.contains('btn-editar')) {
      editarAula(event.target.dataset.id);
    } else if (event.target.classList.contains('btn-excluir')) {
      excluirAula(event.target.dataset.id);
    }
  });
});
function adicionarAula() {
  var nomeDaAula = prompt('Digite o nome da aula:');
  if (nomeDaAula) {
    console.log("Aula \"".concat(nomeDaAula, "\" adicionada"));
  }
}
function editarAula(id) {
  var novoNome = prompt('Digite o novo nome da aula:');
  if (novoNome) {
    console.log("Aula com ID ".concat(id, " alterada para \"").concat(novoNome, "\""));
  }
}
function excluirAula(id) {
  var confirmacao = confirm('Você tem certeza que deseja excluir esta aula?');
  if (confirmacao) {
    console.log("Aula com ID ".concat(id, " exclu\xEDda"));
  }
}
/******/ })()
;