<template>
    <div class="topic-container">
        <button class="topic"
            @click="handleClick">
            <span class="btn-text"> {{ topic }} </span>
        </button>
    </div>
</template>

<script>
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

        }
    }
}
</script>

<style scoped>
.topic-container {
    display: flex;
    flex-direction: row;
    margin-left: 10%;
    margin-top: 5%;
}

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
