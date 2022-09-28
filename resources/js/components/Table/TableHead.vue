<template>
    <thead class="table-head">
        <slot />
    </thead>
</template>

<script>
export default {
    name: "TableHead"
}
</script>

<style scoped>

.table-head {
    border: 1px solid #ddd;
    padding: 8px;
}

</style>
