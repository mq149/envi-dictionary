<template>
    <div @click="select(word)"
         class="word my-1 py-1 px-2 rounded"
         v-bind:class="getBackgroundColor, getTextDecoration">
        <p>
            <span class="matching-text font-medium" v-bind:class="getMatchingTextDecoration" v-html="getMatchingText"></span>
            <span class="normal-text" v-html="getNormalText"></span>
        </p>
    </div>
</template>

<script>
export default {
    name: "WordComponent",
    props: {
        word: Object,
        selected: Boolean,
        lookUpText: String
    },
    emits: [
        "show-meaning",
    ],
    methods: {
        select(word) {
            this.$emit("show-meaning", word)
        },
        wordContainsLookUpText() {
            return this.word.word.slice(0, this.lookUpText.length) === this.lookUpText
                && this.lookUpText !== ""
        },
    },
    computed: {
        getBackgroundColor: function() {
            return this.selected
                ? "ml-0.5 -mr-0.5 bg-sky-400 drop-shadow-lg"
                : (this.wordContainsLookUpText() ? "bg-sky-100" : "bg-slate-50 hover:bg-slate-100")
        },
        getTextDecoration: function() {
            return this.selected ? "text-white font-semibold" : "text-black"
        },
        getNormalText: function() {
            return this.wordContainsLookUpText()
                ? this.word.word.slice(this.lookUpText.length)
                : this.word.word
        },
        getMatchingText: function() {
            return this.wordContainsLookUpText()
                ? this.word.word.slice(0, this.lookUpText.length)
                : ""
        },
        getMatchingTextDecoration() {
            return this.selected ? "" : "underline decoration-sky-400 underline-offset-2 font-semibold text-sky-500"
        }
    }
}
</script>

<style scoped>

</style>
