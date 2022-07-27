<template>
    <div class="h-full flex justify-center items-center bg-gray-300">
        <div class="dictionary-container
                    flex flex-row
                    h-3/6 w-1/2 p-3 bg-white">
            <word-list-component
                :words="words"
                @showMeaning="showMeaning($event)"
            />
            <meaning-component
                :word="selectedWord"
            />
        </div>
    </div>
</template>

<script>
import WordListComponent from "./WordListComponent";
import MeaningComponent from "./MeaningComponent";
import {ref, onMounted} from "vue";
import useVietnameseWord from "../../composables/vietnamese";
// import useEnglishWord from "../../composables/english";

export default {
    components: {
        WordListComponent,
        MeaningComponent
    },
    methods: {
        showMeaning(word) {
            this.selectedWord = word;
            this.$forceUpdate();
            console.log(word);
        }
    },
    setup() {
        const {words, getWords} = useVietnameseWord();
        let selectedWord = {};

        onMounted(getWords);

        selectedWord = words[0] || {};

        return {
            words,
            selectedWord
        }
    }
}
</script>

<style scoped>

</style>
