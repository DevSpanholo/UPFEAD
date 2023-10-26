<template>
    <div class="row d-flex">
      <div class="editor-panel">
        <p>Título</p>
        <div class="form-group">
          <input type="text" class="form-control" v-model="title" />
        </div>

        <p>Descrição</p>
        <div class="form-group">
          <textarea
            type="text"
            contenteditable="true"
            name="eventDescription"
            id="eventDescription"
            class="form-control"
            v-model="description"
          />
        </div>

        <div class="form-group">
          <a @click="addSlide({ title, description })">Adicionar Slide</a>
        </div>
      </div>

      <div class="slide-preview-panel">
        <div class="slide">
          <div class="texto-editavel">{{ title }}</div>
          <div class="texto-editavel" v-html="description"></div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import CKEditor from "ckeditor4-vue";

  export default {
    name: "slide",
    props: {
      addSlide: Function,
    },
    data() {
      return {
        title: "Seu título",
        description: "<p>Hello from CKEditor 5!</p>",
      };
    },
    computed: {
      filteredDescription() {
        // Mantém as tags <p>, <strong>, <em>, <u> e <br>
        return this.description.replace(/<\/?(?!(p|strong|em|u|br)\b)[^>]*>/gi, "");
      },
    },
    mounted() {
      const self = this;
      var editor = CKEDITOR.replace("eventDescription", {
        uiColor: "#14B8C4",
        toolbar: [
            ['Undo', 'Redo'],
            ['Cut', 'Copy', 'Paste'],
            ['Bold', 'Italic', 'Underline', 'Strike'],
            ['FontSize', 'TextColor', 'BGColor'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['NumberedList', 'BulletedList'],
            ['Outdent', 'Indent'],
            ['Link', 'Unlink'],
            ['Image', 'Table', 'HorizontalRule', 'SpecialChar'],
            ["NumberedList", "BulletedList"],
            ],
        });

      editor.on("pluginsLoaded", function (event) {
        editor.on("contentDom", function (evt) {
          var editable = editor.editable();
          editable.attachListener(editable, "keyup", function (e) {
            self.description = e.data.$.target.innerHTML;
          });
        });
      });
    },
  };
  </script>
<style scoped>
.row {
    display: flex;
    gap: 20px;
    height: 100vh;
    padding: 20px;
  }

  .editor-panel {
    flex: 1;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
  }

  .slide-preview-panel {
    flex: 2;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .slide {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%;
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .texto-editavel {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
    width: 100%;
    text-align: center;
    overflow: hidden;
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }
  .form-control {
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }
  .form-group {
    margin-bottom: 20px;
  }

  input,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  button,
  a {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
  }

  button:hover,
  a:hover {
    background-color: #45a049;
  }

</style>
