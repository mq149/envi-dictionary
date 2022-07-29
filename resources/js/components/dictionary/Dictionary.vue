<template>
    <div class="flex flex-col justify-center items-center
                h-full w-full">
        <div class="flex flex-col
                    h-1/2 w-4/6 p-3
                    bg-white rounded shadow">
            <div class="flex flex-row
                        align-middle
                        h-10 w-full">
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
                                  border-2 border-stone-100 rounded"
                           type="text"
                           placeholder="Look up..."
                           v-model="lookUpWord">
                    <button type="button"
                            class="p-2 bg-sky-500 font-medium text-base text-white"
                            @click="lookUp">Look up
                    </button>
                </div>
            </div>
            <div class="flex flex-row
                        overflow-hidden">
                <word-list-component
                    :words="words"
                    :selected-word="selectedWord"
                    :look-up-text="lookUpWord"
                    @showMeaning="showMeaning($event)"
                />
                <meaning-component
                    :word="selectedWord"
                />
            </div>
        </div>
        <div class="w-4/6 px-3">
            <a class="language" href="#">Vietnamese</a>
            <a class="language" href="#">English</a>
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
            this.selectedWord = word
            this.$forceUpdate()
        },
        async switchLanguage(event) {
            this.language = event.target.value
            this.$forceUpdate()
        },
        async getDictionaryWords() {
            const {words, getWords} = useDictionary(this.language)
            await getWords()
            this.words = words
            this.selectedWord = this.words[0] || {}
        },
        async lookUp() {
            console.log(this.lookUpWord)
            const {words, lookUpFromDictionary} = useDictionary(this.language)
            await lookUpFromDictionary(this.lookUpWord)
            this.words = words
            this.$forceUpdate()
        }
    },
    data() {
        return {
            words: ref([]),
            selectedWord: ref({}),
            language: ref('vi-en'),
            lookUpWord: ''
        }
    },
    mounted() {
        this.getDictionaryWords()
    },
    watch: {
        async language(newVal, oldVal) {
            console.log(`Switched from ${oldVal} to ${newVal}`)
            await this.getDictionaryWords()
        },
        async lookUpWord(newVal, oldVal) {
            console.log(`Lookup word is: ${newVal}`)
            await this.lookUp()
        }
    }
}
</script>

<style scoped>

</style>
