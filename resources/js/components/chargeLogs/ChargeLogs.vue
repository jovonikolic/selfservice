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
    name: "ChargeLogs",
    components: {CustomTable},
    data() {
        return {
            headers:
                [
                    "ID",
                    "Station ID",
                    "Start",
                    "End",
                    "kWh at start",
                    "kWh at end",
                    "Invoiced"
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
                .get('/chargelogs')
                .then((response) => {
                    this.data = response.data.chargingProcesses;
                })
        }
    }
}
</script>

<style scoped>

</style>
