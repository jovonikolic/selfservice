<template>
    <div>
        <DataTable class="custom-datatable">
            <TableHead>
                <TableRow class="table-head-row">
                    <TableHeadCells
                        :headers="headers"
                    >
                    </TableHeadCells>
                </TableRow>
            </TableHead>

            <TableBody class="table-body">
                <TableRow
                    v-for="dataRow in data"
                >
                    <TableData
                        v-for="dataCell in dataRow"
                    >
                        {{ dataCell }}
                    </TableData>
                </TableRow>
                <TableRow
                    v-if="!data || data.length === 0"
                >
                    <TableData
                        :colspan="headers.length"
                        class="empty-table"
                    >
                        {{ "No available data!" }}
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

.custom-datatable {
    width: 100%;
}

.table-head-row {
    background-color: midnightblue;
    color: white;
    text-align: center;
    line-height: 50px;
    font-size: large;
}

.table-body tr:nth-child(even){background-color: #f2f2f2;}

.table-body tr:hover {background-color: #ddd;}

.empty-table {
    text-align: center;
}
</style>
