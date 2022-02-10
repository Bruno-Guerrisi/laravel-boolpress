<template>


    <div class="mb-3 text-center">

        <h4 class="mb-2">Tags</h4>

        <div v-for="tag in list" :key="`tag-${tag.id}`" 
            class="badge badge-primary me-2">
            {{ tag.name }}
        </div>

    </div>
</template>

<script>

export default {
    name: 'PostDetail',
    props: {
        list: Array,
    }
}
</script>

<style lang="scss">

</style>