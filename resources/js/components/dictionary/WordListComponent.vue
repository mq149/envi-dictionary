<template>
    <div class="scrolling-component overflow-y-auto h-full w-64" ref="scrollComponent">
        <word-component
            v-for="(word, index) in words"
            :word="word"
            :key="index"
            @show-meaning="showMeaning"
        />
    </div>
</template>

<script>
import WordComponent from "./WordItemComponent";

export default {
    name: "WordListComponent",
    props: {
        words: Array
    },
    components: {
        WordComponent
    },
    methods: {
        showMeaning(word) {
            this.$emit("show-meaning", word);
        }
    }
}
</script>

<style scoped>

</style>
