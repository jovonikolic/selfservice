<template>
    <div>
        <Topic
            :topic="'Charging Station'">
        </Topic>
        <Topic
            :topic="'Charging Process'">
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

