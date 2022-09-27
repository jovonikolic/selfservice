<template>
    <th
        v-for="header in headers"
    >
        {{ header }}
    </th>
</template>

<script>
export default {
    name: "TableHeadCells",
    props: {
        headers: {
            type: Array,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
