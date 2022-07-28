<template>
    <div class="h-full flex justify-center items-center bg-gray-300">
        <div class="dictionary-container
                    flex flex-col
                    h-3/6 lg:w-1/2 md:w-3/4 p-3
                    bg-white rounded">
            <div class="flex flex-row
                        align-middle
                        w-full">
                <div class="language-select w-1/4">
                    <select name="language" id="language"
                            class="h-full w-full
                                   border-2 border-stone-100 rounded"
                            @change="switchLanguage($event)">
                        <option selected value="vi-en">Vietnamese - English</option>
                        <option value="en-vi">English - Vietnamese</option>
                    </select>
                </div>
                <div class="word-look-up
                            flex flex-row
                            h-full flex-grow">
                    <input class="h-full px-1 flex-grow
                                  border-2 border-stone-100 rounded" type="text" placeholder="Look up...">
                    <button type="button" class="p-2 bg-sky-500 font-bold text-sm text-white">Look up</button>
                </div>
            </div>
            <div class="flex flex-row
                        overflow-hidden">
                <word-list-component
                    :words="words"
                    :selected-word="selectedWord"
                    @showMeaning="showMeaning($event)"
                />
                <meaning-component
                    :word="selectedWord"
                />
            </div>
        </div>
    </div>
</template>

<script>
import WordListComponent from "./WordListComponent";
import MeaningComponent from "./MeaningComponent";
import useDictionary from "../../composables/dictionary";
import {ref} from "vue";

export default {
    components: {
        WordListComponent,
        MeaningComponent
    },
    methods: {
        showMeaning(word) {
            this.selectedWord = word;
            this.$forceUpdate();
        },
        async switchLanguage(event) {
            this.language = event.target.value;
            this.$forceUpdate();
        },
        async getDictionaryWords() {
            const {words, getWords} = useDictionary(this.language);
            await getWords();
            this.words = words;
        }
    },
    data() {
        return {
            words: ref([]),
            selectedWord: ref({}),
            language: ref('vi-en')
        }
    },
    mounted() {
        this.getDictionaryWords().then(() => {
            this.selectedWord = this.words[0] || {};
        });
    },
    watch: {
        async language(newVal, oldVal) {
            console.log(`Switched from ${oldVal} to ${newVal}`);
            await this.getDictionaryWords();
        }
    }
}
</script>

<style scoped>

</style>
