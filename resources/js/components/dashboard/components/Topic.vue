<template>
        <button class="topic"
            @click="handleClick">
            <span class="btn-text"> {{ topic }} </span>
        </button>
</template>

<script>
import axios from "axios";

export default {
    name: "Topic",
    props: {
        topic: {
            required: true,
            type: String,
        }
    },
    methods: {
        handleClick() {
            let url = '/' + this.topic.replace(/\s+/g, '');
            const promise = new Promise((resolve) => {
                resolve(window.location.href = url)
            })

            axios
                .get(url)
                .then(
                    promise.resolve
                )
                .catch((error) => {
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>

.topic {
    margin-right: 3%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    display: flex;
    width: 250px;
    height: 250px;
    background-color: orange;
}

.btn-text {
    margin: auto auto 5px auto;
}

</style>
