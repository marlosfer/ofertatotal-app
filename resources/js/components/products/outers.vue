<template>
    <div style="height: 800px;">
        <h4><center>EM BREVE</center></h4>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                selectedRadio: 'A',
                fields: ['first_name', 'last_name', 'age'],
                items: [
                    { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                    { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                    { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                    { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
                ],
            }
        },
        props:{
            session_user: Object,
        },
        mounted() {
        },
        methods: {
            openModal(value) {
                this.$bvModal.show('modal-1');
                this.setImageModal(value);
            },
        },
        computed: {
            validateTextName() {
            },
        },
    }
</script>

<style scoped>
</style>


