<template>
    <CustomTable
        :headers="headers"
        :data="data"
    >
    </CustomTable>
</template>

<script>
import CustomTable from "../Table/CustomTable.vue";
import axios from "axios";

export default {
    components: {CustomTable},
    data() {
        return {
            headers:
                [
                    "Id",
                    "Station Name",
                    "Public Name",
                    "Street",
                    "City",
                    "Zip",
                    "Lat",
                    "Long",
                    "Serial number",
                ],
            data: []
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios
                .get('/stations')
                .then((response) => {
                    this.data = response.data.cps;
                    console.log(this.data);
                })
        }
    }
}
</script>
