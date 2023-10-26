<template>
    <div>
        <vc-slide :add-slide="testeFn" />

        <div>
            <Carousel :items-to-show="1" :wrap-around="true">
                <Slide v-for="(slide, index) in list" :key="index">
                    <div class="slide-preview">
                        <div class="slide-content">
                            <h3>{{ slide.title }}</h3>
                            <div v-html="slide.description"></div>
                        </div>
                    </div>
                </Slide>

                <template #addons>
                    <Navigation />
                </template>
            </Carousel>
        </div>

        <div class="row" style="display: none;">
            <div v-for="(slide, index) in list" :key="index">
                <input type="hidden" :name="'slides[' + index + '][title]'" v-model="slide.title" />
                <input type="hidden" :name="'slides[' + index + '][description]'" v-model="slide.description" />
            </div>
        </div>
    </div>
</template>


<script>
import { defineComponent } from 'vue';
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import VcSlide from './Slide.vue';

export default defineComponent({
    name: 'Form',
    components: {
        VcSlide,
        Carousel,
        Slide,
        Navigation,
    },
    data() {
        return {
            list: [],
        };
    },
    methods: {
        testeFn(slide) {
            this.list.push(slide);
        },
    },
});
</script>

<style scoped>
.slide-preview {
    border: 1px solid #262626;
    border-radius: 4px;
    overflow: hidden;
    background: linear-gradient(to bottom right, #ffffff, #e0e0e0);
    /* Fundo em degradê */
    width: 500px;
    height: 500px;
    margin: 0 auto;
}

.slide-content {
    padding: 10px;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.slide-content h3 {
    font-size: 28px;
    margin-bottom: 10px;
    color: #333;
}

.slide-content div {
    font-size: 18px;
    color: #555;
}

.carousel {
    max-width: 50vw;
    /* 50% da largura da tela */
    margin: 0 auto;
    /* Centraliza o carrossel */
}
</style>
