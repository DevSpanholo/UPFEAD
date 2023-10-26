<template>
    <div>
        <vc-slide
         :add-slide="testeFn"
        />

        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th>Slide</th>
                        <th>Texto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="slide in list">
                        <th>{{ slide.title }}</th>
                        <th v-html="slide.description"></th>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="row" style="display: none;">
            <div v-for="(slide, index) in list">
                <input type="hidden" :name="'slides[' + index + '][title]'" v-model="slide.title" />


                <input type="hidden" :name="'slides[' + index + '][description]'" v-model="slide.description" />
            </div>
        </div>
    </div>
  </template>

  <script>

  import VcSlide from './Slide.vue';

  export default {
    name: "form",
    components: {
        VcSlide
    },
    data() {
      return {
        list: [],
      };
    },
    methods: {
        testeFn(slide) {
            this.list.push(slide);
        }
    }
  };
  </script>
