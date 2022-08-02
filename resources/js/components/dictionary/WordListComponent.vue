<template>
    <div class="scrolling-component overflow-y-auto
                h-full w-1/4
                px-2"
         ref="scrollComponent"
         id="word-list">
        <word-component
            v-for="(word, index) in words"
            :word="word"
            :key="index"
            :selected="selectedWord === word"
            :look-up-text="lookUpText"
            @show-meaning="showMeaning"
        />
        <div v-if="noResults" class="text-sm mt-2">
            <span>{{ __('dictionary.no_result', {'word': lookUpText}) }}</span>
        </div>
    </div>
</template>

<script>
import WordComponent from "./WordItemComponent";

export default {
    name: "WordListComponent",
    components: {
        WordComponent
    },
    props: {
        words: Array,
        selectedWord: Object,
        lookUpText: String
    },
    methods: {
        showMeaning(word) {
            this.$emit("show-meaning", word)
        }
    },
    computed: {
        noResults: function () {
            return this.words.length === 0 && this.lookUpText !== '';
        }
    }
}
</script>

<style scoped>

</style>
