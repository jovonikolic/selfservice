<template>
    <div>
        <DataTable>
            <TableHead>
                <TableRow>
                    <TableHeadCells
                        :headers="headers"
                    >
                        test
                    </TableHeadCells>
                </TableRow>
            </TableHead>

            <TableBody>
                <TableRow>
                    <TableData>

                    </TableData>
                </TableRow>
            </TableBody>
        </DataTable>
    </div>
</template>

<script>
import DataTable from "./DataTable.vue";
import TableHead from "./TableHead.vue";
import TableRow from "./TableRow.vue";
import TableHeadCells from "./TableHeadCells.vue";
import TableBody from "./TableBody.vue";
import TableData from "./TableData.vue";
import axios from "axios";
export default {
    name: "CustomTable",
    components: {TableData, TableBody, TableHeadCells, TableRow, TableHead, DataTable},
    data() {
        return {
            headers: [],
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
                    console.log(response);
                    this.data = response;
                })
        }
    }
}
</script>

<style scoped>

</style>
