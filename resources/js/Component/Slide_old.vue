<template>
    <div class="editor-container">
      <div class="toolbox">
        <draggable class="text-container" :list="textos" group="textos" :move="checkMove" item-key="id" @end="onEnd">
          <template #item="{ element }">
            <div :key="element.id" class="texto" :data-type="element.conteudo">{{ element.conteudo }}</div>
          </template>
        </draggable>
        <input v-model="novoTexto" placeholder="Digite o novo texto aqui" />
        <button @click="adicionarTexto">Adicionar Texto</button>
      </div>
      <div class="slide-container">
        <draggable :list="textosNoSlide" group="textos" :move="checkMove" item-key="id" class="slide">
          <h1>{{ titulo }}</h1>
          <template #item="{ element }">
            <div :key="element.id" class="texto-editavel" contenteditable="true" :data-type="element.conteudo">{{ element.conteudo }}</div>
          </template>
        </draggable>
      </div>
    </div>
</template>



<script>
import { ref } from 'vue';
import draggable from 'vuedraggable';

export default {
  components: {
    draggable,
  },
  setup() {
    const titulo = ref("TÍTULO");
    const textos = ref([
      { id: 1, conteudo: 'Title' },
      { id: 2, conteudo: 'Description' },
      { id: 3, conteudo: 'List' },
    ]);
    const textosNoSlide = ref([]);

    const novoTexto = ref("");

    const adicionarTexto = () => {
      if (novoTexto.value.trim() !== "") {
        const novoId = textos.value.length ? Math.max(...textos.value.map(t => t.id)) + 1 : 1;
        textos.value.push({ id: novoId, conteudo: novoTexto.value });
        novoTexto.value = "";
      }
    };

    const onEnd = (event) => {
        const movedItem = event.item.getAttribute('data-type');
        if (event.from.classList.contains('text-container') && event.to.classList.contains('slide')) {
            const itemToMove = textos.value.find(t => t.conteudo === movedItem);
            if (itemToMove) {
            textosNoSlide.value.push({ ...itemToMove });
            textos.value = textos.value.filter(t => t.conteudo !== movedItem);
            }
        } else if (event.from.classList.contains('slide') && event.to.classList.contains('text-container')) {
            const itemToMove = textosNoSlide.value.find(t => t.conteudo === movedItem);
            if (itemToMove) {
            textos.value.push({ ...itemToMove });
            textosNoSlide.value = textosNoSlide.value.filter(t => t.conteudo !== movedItem);
            }
        }
        };


    const checkMove = (event) => {
      return (event.from.classList.contains('text-container') && event.to.classList.contains('slide')) ||
             (event.from.classList.contains('slide') && event.to.classList.contains('text-container'));
    };


    return {
      titulo,
      textos,
      textosNoSlide,
      onEnd,
      checkMove,
      novoTexto,
      adicionarTexto
    };
  },
};
</script>

<style scoped>
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
}

.text-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.texto, .texto-editavel {
  cursor: grab;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 5px;
  background-color: white;
}

.texto-editavel {
  margin-top: 10px;
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
