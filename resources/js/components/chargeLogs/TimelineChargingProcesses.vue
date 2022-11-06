<template>
    <line-chart
        :data="chargingProcesses"
    />
</template>

<script>
import axios from "axios";

export default {
    name: "TimelineChargingProcesses",
    data() {
        return {
            chargingProcesses: {
                type: Object,
                required: false
            }
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios
                .get('/getDataForChargingProcessAnalytics')
                .then((response) => {
                    this.adjustDateTime(response.data);  //check
                    this.calculateConsumption(response.data) // check
                    this.formatTime(response.data) // check
                    this.chargingProcesses = {
                        "00:00": 0,
                        "01:00": 0,
                        "02:00": 0,
                        "03:00": 0,
                        "04:00": 0,
                        "05:00": 0,
                        "06:00": 0,
                        "07:00": 0,
                        "08:00": 0,
                        "09:00": 0,
                        "10:00": 0,
                        "11:00": 0,
                        "12:00": 0,
                        "13:00": 0,
                        "14:00": 0,
                        "15:00": 0,
                        "16:00": 0,
                        "17:00": 0,
                        "18:00": 0,
                        "19:00": 0,
                        "20:00": 0,
                        "21:00": 0,
                        "22:00": 0,
                        "23:00": 0,
                    } // check

                    this.fillData(response.data, this.chargingProcesses)
                    console.log(this.chargingProcesses)
                    console.log(response.data)
                })
        },
        adjustDateTime(data) {
            data.forEach(function (obj) {
                obj.start = obj.start.slice(11, 13)
                obj.end = obj.end.slice(11, 13)
            });
        },
        calculateConsumption(data) {
            data.forEach(function (obj) {
                obj.lengthOfChargingProcess = obj.end - obj.start;
                obj.avgConsumption = (obj.lengthOfChargingProcess / obj.consumption).toFixed(2);
            });
        },
        formatTime(data) {
            data.forEach(function (obj) {
                obj.start = obj.start + ":00"
                obj.end = obj.end + ":00"
            });
        },
        fillData(source, destination) {
            source.forEach(function (obj) {
                destination[obj.start] += parseFloat(obj.avgConsumption); // check

            })
        },
        compareKeys(a, b) {
            function compareKeys(a, b) {
                var aKeys = Object.keys(a).sort();
                var bKeys = Object.keys(b).sort();
                return JSON.stringify(aKeys) === JSON.stringify(bKeys);
            }
        }
    }
}
</script>

<style scoped>

</style>
