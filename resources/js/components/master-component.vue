<template>
    <div>
        <nav-bar :session_user="session_user"></nav-bar>
        <wrapper :session_user="session_user"></wrapper>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:{
            session_user: String,
        }
    }
</script>

<style scoped>
</style>

