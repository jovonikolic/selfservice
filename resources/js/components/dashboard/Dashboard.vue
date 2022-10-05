<template>
    <div class="topic-container">
        <Topic
            :topic="'Charging Stations'">
        </Topic>
        <Topic
            :topic="'Charging Processes'">
        </Topic>
        <Topic
            :topic="'Errors'">
        </Topic>
    </div>
</template>

<script>
import Topic from "./components/Topic.vue";
export default {
    name: "Dashboard",
    components: { Topic }
}
</script>

<style>

.topic-container {
    display: flex;
    flex-direction: row;
    margin-left: 1%;
    margin-top: 1%;
}

</style>
