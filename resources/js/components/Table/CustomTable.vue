<template>
    <div>
        <DataTable>
            <TableHead>
                <TableRow>
                    <TableHeadCells
                        :headers="headers"
                    >
                    </TableHeadCells>
                </TableRow>
            </TableHead>

            <TableBody>
                <TableRow
                    v-for="dataRow in data"
                >
                    <TableData
                        v-for="dataCell in dataRow"
                    >
                        {{ dataCell }}
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
export default {
    name: "CustomTable",
    components: {TableData, TableBody, TableHeadCells, TableRow, TableHead, DataTable},
    props: {
        headers: {
            type: Array,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        }
    },
}
</script>

<style scoped>

</style>
