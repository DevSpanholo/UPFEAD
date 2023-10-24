/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/modulos.js ***!
  \*********************************/
document.addEventListener('DOMContentLoaded', function () {
  var btnAdicionarModulo = document.getElementById('btnAdicionarModulo');
  var listaDeModulos = document.getElementById('listaDeModulos');
  if (btnAdicionarModulo) {
    btnAdicionarModulo.addEventListener('click', adicionarModulo);
  }
  listaDeModulos.addEventListener('click', function (event) {
    if (event.target.classList.contains('btn-editar')) {
      editarModulo(event.target.dataset.id);
    } else if (event.target.classList.contains('btn-excluir')) {
      excluirModulo(event.target.dataset.id);
    }
  });
});
function adicionarModulo() {
  var nomeDoModulo = prompt('Digite o nome do módulo:');
  if (nomeDoModulo) {
    console.log("M\xF3dulo \"".concat(nomeDoModulo, "\" adicionado"));
  }
}
function editarModulo(id) {
  var novoNome = prompt('Digite o novo nome do módulo:');
  if (novoNome) {
    console.log("M\xF3dulo com ID ".concat(id, " alterado para \"").concat(novoNome, "\""));
  }
}
function excluirModulo(id) {
  var confirmacao = confirm('Você tem certeza que deseja excluir este módulo?');
  if (confirmacao) {
    console.log("M\xF3dulo com ID ".concat(id, " exclu\xEDdo"));
  }
}
/******/ })()
;