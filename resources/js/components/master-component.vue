<template>
    <div>
        <nav-bar :session_user="session_user_object"></nav-bar>
        <wrapper :session_user="session_user_object"></wrapper>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                session_user_object: {},
            }
        },
        created() {
            if(this.session_user){
                this.session_user_object = JSON.parse(this.session_user);
            }
        },
        props:{
            session_user: String,
        }
    }
</script>

<style scoped>
</style>

