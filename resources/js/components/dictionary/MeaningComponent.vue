<template>
    <div class="grow h-full bg-blue-100">
        Meaning of the word
        <span class="m-2 p-2" v-html="word.html"></span>
    </div>
</template>

<script>
export default {
    name: "MeaningComponent",
    props: {
        word: Object
    }
}
</script>

<style scoped>

</style>
