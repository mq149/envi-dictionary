<template>
    <div class="word my-2 p-1 shadow bg-stone-100">
        <p @click="select(word)">{{ word.word }}</p>
    </div>
</template>

<script>
export default {
    name: "WordComponent",
    props: {
        word: Object
    },
    emits: [
        "show-meaning",
    ],
    methods: {
        select(word) {
            this.$emit("show-meaning", word);
        }
    }
}
</script>

<style scoped>

</style>
