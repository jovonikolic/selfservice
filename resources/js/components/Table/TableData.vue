<template>
    <td>
        {{ data }}
    </td>
</template>

<script>
export default {
    name: "TableData",
    props: {
        data: {
            type: null,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
