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
                    "Consumption in kWh",
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
                    this.convertDataToHumanReadable();
                })
        },
        convertDataToHumanReadable() {
            this.data.forEach(function (obj) {
                obj.invoiced = obj.invoiced == 1 ? "Yes" : "No";
            });
        }
    }
}
</script>

<style scoped>

</style>
