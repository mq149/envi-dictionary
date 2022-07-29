<template>
    <div @click="select(word)"
         class="word my-1 p-1"
         v-bind:class="getBackgroundColor">
        <p>{{ word.word }}</p>
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
    },
    computed: {
        getBackgroundColor: function () {
            return this.selected
                ? 'bg-sky-200'
                : (this.lookUpText !== "" && this.word.word.includes(this.lookUpText.trim()) ? 'bg-sky-100' : 'bg-stone-100')
        }
    }
}
</script>

<style scoped>

</style>
