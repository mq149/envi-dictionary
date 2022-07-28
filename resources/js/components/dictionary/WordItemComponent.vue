<template>
    <div @click="select(word)" class="word my-1 p-1"
        v-bind:class="[ { 'bg-sky-100': selected }, 'bg-stone-100' ]">
        <p>{{ word.word }}</p>
    </div>
</template>

<script>
import {onUpdated} from "vue";

export default {
    name: "WordComponent",
    props: {
        word: Object,
        selected: Boolean
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
