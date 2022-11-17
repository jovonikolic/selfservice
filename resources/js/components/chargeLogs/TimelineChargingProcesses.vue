<template>
    <line-chart
        :data="chargingProcesses"
        :round="2"
        :download="true"
        />


    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Aggregated Consumption of all charging processes within a week
    </h3>

    <column-chart
        :data="weeklyData"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Consumption of the latest charging process
    </h3>

    <line-chart
        :data="singleProcessData"
        :round="2"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Aggregated Consumption of all charging processes for the month of November
    </h3>

    <column-chart
        :data="monthlyData"
        :download="true"
    />

</template>

<script>
import axios from "axios";
import {parseInt, startsWith} from "lodash";

export default {
    name: "TimelineChargingProcesses",
    data() {
        return {
            chargingProcesses: {
                type: Object,
                required: false
            },
            weeklyData: {
                type: Object,
                required: false,
            },
            monthlyData: {
                type: Object,
                required: false,
            },
            singleProcessData: {
                type: Object,
                required: false,
            }
        }
    },
    mounted() {
        this.getData();
        this.getWeeklyData();
        this.getMonthlyData();
        this.getSingleProcessData();
    },
    methods: {
        initDataForHoursOnXAxis() {
            return {
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
            }
        },
        getData() {
            axios
                .get('/getDataForChargingProcessAnalytics')
                .then((response) => {
                    this.adjustDateTime(response.data);  //check
                    this.calculateConsumption(response.data) // check
                    this.chargingProcesses = this.initDataForHoursOnXAxis();

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
                let timeDiff = Math.abs(obj.end - obj.start) / 36e5;
                obj.lengthOfChargingProcess = parseInt(timeDiff);
                obj.avgConsumption = (obj.lengthOfChargingProcess / obj.consumption);
            });
        },
        fillData(source, destination) {
            source.forEach(function (obj) {
                let startHour = obj.start.getHours();

                for (let i = 0; i < obj.lengthOfChargingProcess; i++) {
                    let updatedDate = startHour + i;

                    updatedDate = updatedDate > 23 ? updatedDate - 24 : updatedDate;

                    if (updatedDate.toString().length === 1) {
                        updatedDate = "0" + updatedDate + ":00";
                    } else {
                        updatedDate += ":00";
                    }

                    destination[updatedDate] += obj.avgConsumption;
                }
            })
        },
        getWeeklyData() {
            axios
                .get("/getWeeklyChargingProcessData")
                .then((response) => {
                    this.weeklyData = {
                        "Monday, 21. Nov": 0,
                        "Tuesday, 22. Nov": 0,
                        "Wednesday, 23. Nov": 0,
                        "Thursday, 24. Nov": 0,
                        "Friday, 25. Nov": 0,
                        "Saturday, 26. Nov": 0,
                        "Sunday, 27. Nov": 0,
                    }

                    this.trimDate(response.data);
                    this.fillWeeklyData(response.data, this.weeklyData);
                })
        },
        trimDate(data) {
            data.forEach(function (obj) {
                obj.start = obj.start.slice(0, 10)
            });
        },
        fillWeeklyData(data, destination) {
            data.forEach(function (obj) {
                switch (obj.start) {
                    case "2022-11-21":
                        destination["Monday, 21. Nov"] += obj.consumption;
                        break;
                    case "2022-11-22":
                        destination["Tuesday, 22. Nov"] += obj.consumption;
                        break;
                    case "2022-11-23":
                        destination["Wednesday, 23. Nov"] += obj.consumption;
                        break;
                    case "2022-11-24":
                        destination["Thursday, 24. Nov"] += obj.consumption;
                        break;
                    case "2022-11-25":
                        destination["Friday, 25. Nov"] += obj.consumption;
                        break;
                    case "2022-11-26":
                        destination["Saturday, 26. Nov"] += obj.consumption;
                        break;
                    case "2022-11-27":
                        destination["Sunday, 27. Nov"] += obj.consumption;
                        break;
                    default:
                        break;
                }
            });
        },
        initMonthlyData() {
            return {
                "1": 0,
                "2": 0,
                "3": 0,
                "4": 0,
                "5": 0,
                "6": 0,
                "7": 0,
                "8": 0,
                "9": 0,
                "10": 0,
                "11": 0,
                "12": 0,
                "13": 0,
                "14": 0,
                "15": 0,
                "16": 0,
                "17": 0,
                "18": 0,
                "19": 0,
                "20": 0,
                "21": 0,
                "22": 0,
                "23": 0,
                "24": 0,
                "25": 0,
                "26": 0,
                "27": 0,
                "28": 0,
                "29": 0,
                "30": 0,
            }
        },
        getMonthlyData() {
            axios
                .get("/getMonthlyChargingProcessData")
                .then((response) => {
                    this.monthlyData = this.initMonthlyData();
                    this.trimMonthlyDate(response.data);
                    this.fillMonthlyData(response.data, this.monthlyData);
                })
        },
        trimMonthlyDate(data) {
            data.forEach(function (obj) {
                obj.start = obj.start.slice(8, 10)
            });
        },
        fillMonthlyData(source, destination) {
            source.forEach(function (obj) {
                if (obj.start.startsWith("0")) {
                    obj.start = obj.start.slice(1)
                }
                destination[obj.start] += obj.consumption;
            });
        },
        getSingleProcessData() {
            axios
                .get("/getLatestChargingProcess")
                .then((response) => {
                    this.adjustDateTime(response.data);  //check
                    this.calculateConsumption(response.data) // check
                    this.singleProcessData = this.initDataForHoursOnXAxis();

                    this.fillData(response.data, this.singleProcessData) // check
                })
        }
    }
}
</script>

<style scoped>

</style>
