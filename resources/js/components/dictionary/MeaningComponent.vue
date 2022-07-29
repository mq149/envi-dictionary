<template>
    <div class="h-full w-3/4">
        <div class="meaning
                    h-full m-2 p-2
                    scrolling-component overflow-y-auto"
             ref="scrollComponent"
             v-html="word.html"></div>
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
