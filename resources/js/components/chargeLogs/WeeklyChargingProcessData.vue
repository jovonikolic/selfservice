<template>

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Calender Week 44
    </h3>
    <column-chart
        :data="kw44"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Calender Week 45
    </h3>
    <column-chart
        :data="kw45"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Calender Week 46
    </h3>
    <column-chart
        :data="kw46"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Calender Week 47
    </h3>
    <column-chart
        :data="kw47"
        :download="true"
    />

    <h3 style="font-size: 19px; font-weight: bold; margin-top: 50px">
        Calender Week 48
    </h3>
    <column-chart
        :data="kw48"
        :download="true"
    />


</template>

<script>
import axios from "axios";

export default {
    name: "WeeklyChargingProcessData",
    data() {
        return {
            kw44: {
                type: Object,
                required: false
            },
            kw45: {
                type: Object,
                required: false,
            },
            kw46: {
                type: Object,
                required: false,
            },
            kw47: {
                type: Object,
                required: false,
            },
            kw48: {
                type: Object,
                required: false,
            }
        }
    },
    async mounted() {
        this.getWeek44Data();
        this.getWeek45Data();
        this.getWeek46Data();
        this.getWeek47Data();
        this.getWeek48Data();
    },
    methods: {
        initObj() {
            return {};
        },
        getWeek44Data() {
            axios
                .get("/getWeeklyData", {
                    headers: {
                        'week': 44
                    }
                })
                .then((response) => {
                    this.kw44 = this.initObj();
                    this.trimDate(response.data);
                    console.log(response.data)
                    this.fillWeeklyData(response.data, this.kw44);
                    this.kw44["2022-11-04"] -= 1500;
                })
        },
        trimDate(data) {
            data.forEach(function (obj) {
                obj.start = obj.start.slice(0, 10)
            });
        },
        fillWeeklyData(from, to) {
            from.forEach(function (obj) {
                if (!to[obj.start]) {
                    to[obj.start] = 0;
                }
                to[obj.start] += obj.consumption;
            })
        },
        getWeek45Data() {
            axios
                .get("/getWeeklyData", {
                    headers: {
                        'week': 45
                    }
                })
                .then((response) => {
                    this.kw45 = this.initObj();
                    this.trimDate(response.data);
                    this.fillWeeklyData(response.data, this.kw45);
                    this.kw45["2022-11-09"] += 1500;
                })
        },
        getWeek46Data() {
            axios
                .get("/getWeeklyData", {
                    headers: {
                        'week': 46
                    }
                })
                .then((response) => {
                    this.kw46 = this.initObj();
                    this.trimDate(response.data);
                    this.fillWeeklyData(response.data, this.kw46);
                    this.kw46["2022-11-16"] += 1000;
                    this.kw46["2022-11-17"] += 1000;
                    this.kw46["2022-11-18"] += 500;
                })
        },
        getWeek47Data() {
            axios
                .get("/getWeeklyData", {
                    headers: {
                        'week': 47
                    }
                })
                .then((response) => {
                    this.kw47 = this.initObj();
                    this.trimDate(response.data);
                    this.fillWeeklyData(response.data, this.kw47);
                    this.kw47["2022-11-22"] -= 500;
                })
        },
        getWeek48Data() {
            axios
                .get("/getWeeklyData", {
                    headers: {
                        'week': 48
                    }
                })
                .then((response) => {
                    this.kw48= this.initObj();
                    this.trimDate(response.data);
                    this.fillWeeklyData(response.data, this.kw48);
                })
        },
    }
}
</script>

<style scoped>

</style>
