<template>
    <td class="table-data">
        <slot />
    </td>
</template>

<script>
export default {
    name: "TableData",
}
</script>

<style scoped>

.table-data {
    border: 1px solid #ddd;
    padding: 8px;
}

</style>
