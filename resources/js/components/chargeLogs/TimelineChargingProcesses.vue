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
                    this.chargingProcesses = {
                        "00:00": 0.00,
                        "01:00": 0.00,
                        "02:00": 0.00,
                        "03:00": 0.00,
                        "04:00": 0.00,
                        "05:00": 0.00,
                        "06:00": 0.00,
                        "07:00": 0.00,
                        "08:00": 0.00,
                        "09:00": 0.00,
                        "10:00": 0.00,
                        "11:00": 0.00,
                        "12:00": 0.00,
                        "13:00": 0.00,
                        "14:00": 0.00,
                        "15:00": 0.00,
                        "16:00": 0.00,
                        "17:00": 0.00,
                        "18:00": 0.00,
                        "19:00": 0.00,
                        "20:00": 0.00,
                        "21:00": 0.00,
                        "22:00": 0.00,
                        "23:00": 0.00,
                    } // check

                    this.fillData(response.data, this.chargingProcesses) // check
                })
        },
        adjustDateTime(data) {
            data.forEach(function (obj) {
                obj.start = new Date(obj.start)
                obj.end = new Date(obj.end)
            });
        },
        calculateConsumption(data) {
            data.forEach(function (obj) {
                obj.lengthOfChargingProcess = obj.end.getHours() - obj.start.getHours();
                obj.avgConsumption = parseFloat((obj.lengthOfChargingProcess / obj.consumption).toFixed(2));
            });
        },
        fillData(source, destination) {
            source.forEach(function (obj) {
                let startHour = obj.start.getHours();

                for (let i = 0; i < obj.lengthOfChargingProcess; i++) {
                    let updatedDate = startHour + i;

                    if (updatedDate.toString().length === 1) {
                        updatedDate = "0" + updatedDate + ":00";
                    } else {
                        updatedDate += ":00";
                    }

                    destination[updatedDate] += obj.avgConsumption;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
