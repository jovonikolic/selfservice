<template>
    <div class="container">
        <bar-chart
            :data="chartData"
        />

        <h3 style="font-size: 19px; font-weight: bold">
            Resolved Errors
        </h3>
        <pie-chart
            :data="pieChartData"
        />

        <!--<line-chart
            :data="occurrenceData"
        />!-->
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ErrorCharts",
    data() {
        return {
            chartData: {
                type: Object,
                required: false,
            },
            pieChartData: {
                type: Object,
                required: false
            },
            occurrenceData: {
                type: Object,
                required: false
            },
        }
    },
    mounted() {
        this.getChartData();
        this.getPieChartData();
        this.getOccurrenceData();
    },
    methods: {
        getChartData() {
            axios
                .get('/chartErrors')
                .then((response) => {
                    // convert array of objects to one big object
                    let responseObj = Object.assign({}, response.data.errors);

                    let errors = {
                        "WeakSignal": 0,
                        "UnderVoltage": 0,
                        "OverVoltage": 0,
                        "OtherError": 0,
                        "ConnectorLockFailure": 0
                    };

                    for (const obj in responseObj) {
                        switch (responseObj[obj].code) {
                            case "WeakSignal":
                                errors.WeakSignal++;
                                break;
                            case "UnderVoltage":
                                errors.UnderVoltage++;
                                break;
                            case "OverVoltage":
                                errors.OverVoltage++;
                                break;
                            case "OtherError":
                                errors.OtherError++;
                                break;
                            case "ConnectorLockFailure":
                                errors.ConnectorLockFailure++;
                                break;
                        }
                    }

                    this.chartData = errors;
                })
        },
        getPieChartData() {
            axios
                .get('/solvedErrorsChart')
                .then((response) => {
                    this.pieChartData = Object.assign({}, response.data);
                })
        },
        getOccurrenceData() {
            axios
                .get('/errorOccurrence')
                .then((response) => {
                    //let responseObj = Object.assign({}, response.data.errors);

                    let responseObj = response.data.errors;

                    for (const pos in responseObj) {
                        responseObj[pos].occurred = responseObj[pos].occurred.slice(0,10);
                        responseObj[pos].Count = 1;
                    }

                    var reduced = responseObj.reduce(function(allDates, date) {
                        if (allDates.some(function(e) {
                            return e.occurred === date.occurred
                        })) {
                            allDates.filter(function(e) {
                                return e.occurred === date.occurred
                            })[0].Count += +date.Count
                        } else {
                            allDates.push({
                                occurred: date.occurred,
                                Count: +date.Count
                            })
                        }
                        return allDates
                    }, []);

                    var output = Object.assign({}, reduced);

                    console.log(output)

                    this.occurrenceData = output;
                })
        }
    }
}
</script>

<style scoped>

</style>
