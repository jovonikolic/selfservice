<template>
    <CustomTable
        :headers="headers"
        :data="data"
    />
</template>

<script>
import CustomTable from "../Table/CustomTable.vue";
import axios from "axios";
export default {
    name: "ErrorList",
    components: {CustomTable},
    data() {
        return {
            headers:
                [
                    "ID",
                    "Code",
                    "Info",
                    "Station ID",
                    "Occured",
                    "Solved"
                ],
            data: [],
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios
                .get('/errors')
                .then((response) => {
                    this.data = response.data.errors;
                })
        }
    }
}
</script>

<style scoped>

</style>
