<template>
    <div class="container">
        <pie-chart
            :data="chartData"
        >

        </pie-chart>
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
        }
    },
    mounted() {
        this.getChartData();
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
        }
    }
}
</script>

<style scoped>

</style>
