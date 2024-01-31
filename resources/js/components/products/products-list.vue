<template>
    <div style="height: 800px;">
        
        <b-alert variant="success" :show="showAlert">Editado com sucesso!</b-alert>
        <b-table v-if="!showProduct" striped hover :items="product" :fields="fields">
            <template #cell(name)="row">
               {{ truncateText(row.item.name, 40) }}
            </template>
            <template #cell(link)="row">
               {{ truncateText(row.item.link, 40) }}
            </template>
            <template #cell(rooms)="row">
                <b-badge variant="success" class="btn btn-dark" v-for="(room, index) in row.item.rooms" :key="'rooms'+index" >{{ room }}</b-badge>
            </template>
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
			        { key: 'rooms', sortable: true, sorter: null, label: 'Tipo' },
			        { key: 'actions', label: 'Editar' },
                ],
                showAlert: false,
            }
        },
        created() {
            this.getProducts();
        },
        methods: {
            truncateText(text, maxLength) {
                if (text.length > maxLength) {
                    return text.slice(0, maxLength) + "...";
                } else {
                    return text;
                }
            },
            editSave(){
                this.showAlert = true;
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
                this.showProduct = false;
                this.getProducts();
            },
            editarProdudo(item){
                axios.get('get-products',  {
                    params:{
                        limit: 1,
                        id: item.id,
                    }
                }).then((res) => {
                    this.itemselected = res.data;
                    this.showProduct = !this.showProduct;
                    if(this.showProduct){
                        this.fields = [
                            { key: 'name', sortable: true, sorter: null, label: 'Nome do produto' },
			                { key: 'rooms', sortable: true, sorter: null, label: 'Tipo' },
                            { key: 'actions', label: 'Editar' },
                        ]
                    }else{
                        this.fields = [
                            { key: 'name', sortable: true, sorter: null, label: 'Nome do produto' },
                            { key: 'link', sortable: true, sorter: null, label: 'link do produto' },
			                { key: 'rooms', sortable: true, sorter: null, label: 'Tipo' },
                            { key: 'actions', label: 'Editar' },
                        ]
                    }
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            getProducts(){
                axios.get('get-products',  {
                    params:{
                        limit: 3,
                        marlos: 333,
                    }
                }).then((res) => {
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


