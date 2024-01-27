<template>
    <div style="height: 800px;">
        
        <b-alert variant="success" :show="showAlert">Editado com sucesso!</b-alert>
        <b-table v-if="!showProduct" striped hover :items="product" :fields="fields">
            <template #cell(actions)="row">
                <b-button @click="editarProdudo(row.item)" variant="primary"> Editar</b-button>
            </template>
        </b-table>

        <div v-if="showProduct">
            <h4>Edição produto - <b-button @click="editarProdudo(itemselected)" variant="danger">Cancelar</b-button></h4>
            <products-register :itemselected="itemselected" v-on:back="editSave"></products-register>
        </div>

    </div>
</template>

<script>
    import productsRegister from '../../components/products/products-register.vue';
    export default {
        components:{
            productsRegister,
        },
        data: function () {
            return {
                product: [],
                itemselected: [],
                showProduct: false,
                fields: [
			        { key: 'name', sortable: true, sorter: null, label: 'Nome do produto' },
			        { key: 'link', sortable: true, sorter: null, label: 'link do produto' },
			        { key: 'actions', label: 'Editar' },
                ],
                showAlert: false,
            }
        },
        created() {
            this.getProducts();
        },
        methods: {
            editSave(){
                this.showAlert = true;
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
                this.editarProdudo(this.itemselected);
            },
            editarProdudo(item){
                this.itemselected = item;
                this.showProduct = !this.showProduct;
                if(this.showProduct){
                    this.fields = [
                        { key: 'name', sortable: true, sorter: null, label: 'Nome do produto' },
                        { key: 'actions', label: 'Editar' },
                    ]
                }else{
                    this.fields = [
                        { key: 'name', sortable: true, sorter: null, label: 'Nome do produto' },
			            { key: 'link', sortable: true, sorter: null, label: 'link do produto' },
                        { key: 'actions', label: 'Editar' },
                    ]
                }
                
            },
            getProducts(){
                axios.get('get-products').then(res => {
                    if(res.data.success){
                        this.product = res.data.value;
                    }
                })
                .catch(err => {
                    console.error(err); 
                })
            },
        },
        computed: {
            // validateTextName() {
            // },
        },
    }
</script>

<style scoped>
</style>


