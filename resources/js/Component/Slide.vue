<template>
    <div class="row">
      <div class="col-sm-4">
        <p>Título</p>
        <div class="form-group">
            <input type="text" class="form-control" v-model="title" />
        </div>

        <p>Descrição</p>
        <div class="form-group">
            <textarea type="text" contenteditable="true" name="eventDescription" id="eventDescription" class="form-control" v-model="description" />
        </div>

        <div class="form-group">
            <a @click="addSlide({title, description})">Adicionar Slide</a>
        </div>
      </div>

      <div class="col-sm-8">
        <div class="slide">
            <div class="texto-editavel">
                {{ title }}
            </div>

            <div class="texto-editavel" v-html="description">

            </div>
        </div>
      </div>

    </div>
  </template>

  <script>
import CKEditor from 'ckeditor4-vue';


  export default {
    name: "slide",
    props: {
        addSlide: Function,
    },
    data() {
      return {
        title: 'Seu tiel',
        description: '<p>Hello from CKEditor 5!</p>',
      };
    },

    methods: {

    },
    mounted() {
        const self = this;
        var editor = CKEDITOR.replace( 'eventDescription', {
	        uiColor: '#14B8C4',
	        toolbar: [
		        // ['Styles','Format','Font','FontSize'],
                ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-'],
                ['NumberedList','BulletedList'],
	        ]
        });

        editor.on( "pluginsLoaded", function( event ){
            editor.on( 'contentDom', function( evt ) {
                var editable = editor.editable();
                editable.attachListener( editable, 'keyup', function( e ) {
                    self.description = e.data.$.target.innerHTML;
                });
            });
        });
    }
  };
  </script>
  <style scoped>
  .button {
    margin-top: 35px;
  }
  .handle {
    float: left;
    padding-top: 8px;
    padding-bottom: 8px;
  }

  .close {
    float: right;
    padding-top: 8px;
    padding-bottom: 8px;
  }

  input {
    display: inline-block;
    width: 50%;
  }

  .text {
    margin: 20px;
  }

  .editor-container {
    display: flex;
  }

  .toolbox {
    width: 200px;
    border-right: 1px solid #ccc;
    padding: 10px;
  }

  .slide-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-grow: 1;
  }

  .slide {
    border: 1px solid #ccc;
    padding: 20px;
    text-align: center;
    width: 500px;
    height: 300px;
    position: relative;
    background-color: #555;
  }

  .text-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .texto{
    cursor: grab;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    background-color: white;
  }

  .texto-editavel {
      margin-top: 10px;
      position: relative;
      background-color: white;
    }

    .texto-editavel button {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 14px;
      cursor: pointer;
      line-height: 16px;
      text-align: center;
      padding: 0;
      display: none; /* Esconde o botão por padrão */
    }

    .texto-editavel:hover button {
      display: block; /* Mostra o botão quando o mouse estiver sobre o texto */
    }


  .texto[data-type='Title'], .texto-editavel[data-type='Title'] {
    font-size: 24px;
    font-weight: bold;
    color: #333;
  }

  .texto[data-type='Description'], .texto-editavel[data-type='Description'] {
    font-size: 16px;
    color: #777;
  }

  .texto[data-type='List'], .texto-editavel[data-type='List'] {
    font-size: 14px;
    color: #555;
    background-color: #f4f4f4;
    list-style-type: disc;
    padding-left: 20px;
  }
  </style>
