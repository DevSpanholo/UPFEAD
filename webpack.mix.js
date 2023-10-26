const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue({version: 3})
   .postCss('resources/css/app.css', 'public/css');

// Adicione esta parte apenas se você tiver criado os arquivos aula.js e modulo.js
mix.js('resources/js/aulas.js', 'public/js')
   .js('resources/js/modulos.js', 'public/js');
