<template>
    <th>
        {{ headers }}
    </th>
</template>

<script>
export default {
    name: "TableHeadCells",
    props: {
        headers: {
            type: String,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
