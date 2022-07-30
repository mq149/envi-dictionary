<template>
    <div class="scrolling-component overflow-y-auto
                h-full w-1/4
                px-2"
         ref="scrollComponent">
        <word-component
            v-for="(word, index) in words"
            :word="word"
            :key="index"
            :selected="selectedWord === word"
            :look-up-text="lookUpText"
            @show-meaning="showMeaning"
        />
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
    }
}
</script>

<style scoped>

</style>
