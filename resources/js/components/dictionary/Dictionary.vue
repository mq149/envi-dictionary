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
                                   border border-stale-200 rounded"
                            @change="switchLanguage($event)">
                        <option selected value="vi-en">{{ __('dictionary.vi_en') }}</option>
                        <option value="en-vi">{{ __('dictionary.en_vi') }}</option>
                    </select>
                </div>
                <div class="word-look-up
                            flex flex-row
                            h-full flex-grow
                            pl-2">
                    <input class="h-full px-1 flex-grow
                                  border border-stale-200 rounded"
                           type="text"
                           :placeholder="__('dictionary.look_up_placeholder')"
                           v-model="lookUpWord">
                    <button type="button"
                            class="w-1/12 p-2
                                   bg-sky-500 hover:bg-sky-600
                                   font-semibold text-base text-white
                                   rounded-r shadow"
                            @click="lookUp">{{ __('dictionary.look_up') }}
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
        <div class="w-4/6 px-3 py-1
                    flex flex-row justify-between">
            <div>
                <a class="text-sm underline mr-1" href="javascript:" @click="switchLocale('vi')">{{ __('dictionary.vi') }}</a>
                <a class="text-sm underline mr-1" href="javascript:" @click="switchLocale('en')">{{ __('dictionary.en') }}</a>
            </div>
            <span class="text-sm" v-html="languageVersions"></span>
            <a class="text-sm underline"
               href="https://github.com/yenthanh132/avdict-database-sqlite-converter">{{ __('dictionary.credit') }}</a>
        </div>
    </div>
</template>

<script>
import WordListComponent from "./WordListComponent";
import MeaningComponent from "./MeaningComponent";
import useDictionary from "../../composables/dictionary";
import {version, ref} from "vue";
// import {devDependencies} from "../../../../package.json";

export default {
    components: {
        WordListComponent,
        MeaningComponent
    },
    props: {
        laravelVersion: String,
        phpVersion: String
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
        },
        switchLocale(locale) {
            console.log(`Setting locale to: ${locale}`)
            this.$lang().setLocale(locale)
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
        // console.log(devDependencies)
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
    },
    computed: {
        languageVersions() {
            const tailwindVersion = require('../../../../package.json').devDependencies.tailwindcss.slice(1)
            return [
                `Laravel v${this.laravelVersion}`,
                `PHP v${this.phpVersion}`,
                `Vue v${version}`,
                `Tailwind CSS v${tailwindVersion}`
            ].join(' &bull; ')
        }
    }
}
</script>

<style scoped>

</style>
