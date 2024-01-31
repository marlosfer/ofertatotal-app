<template>
    <div class="wrapper">
        <br>
        <b-row :class="$store.state.showBanner ? '': 'mt-2'" style="justify-content: center;">
            <b-col cols="12"> 
                <span style="display: flex;justify-content: center;">
                    <span @click="showTab = 'produtos'" :class="showTab == 'produtos' ? 'menusuperior caret menu-h active-h' : 'menusuperior caret menu-h'">Lista de Produtos</span>
                    <span @click="showTab = 'cadastrar'" :class="showTab == 'cadastrar' ? 'menusuperior caret menu-h active-h' : 'menusuperior caret menu-h'">Cadastrar</span>
                    <span @click="showTab = 'emails'" :class="showTab == 'emails' ? 'menusuperior caret menu-h active-h' : 'menusuperior caret menu-h'">Emails/Sugestões</span>  
                </span>
            </b-col>
        </b-row>

        <div class="mt-2" v-if="showTab == 'produtos'">
            <products-list></products-list>
        </div>

        <div class="mt-2" v-if="showTab == 'cadastrar'">
            <h4>Cadastrar</h4>
            <b-row :class="$store.state.showBanner ? '': 'mt-2'" style="justify-content: center;">
                <b-col cols="12"> 
                    <span style="display: flex;justify-content: center;">
                        <span @click="showRegister = 'produtos'" :class="showRegister == 'produtos' ? 'menusuperior caret menu-h active-h' : 'menusuperior caret menu-h'">Produtos</span>
                        <span @click="showRegister = 'outros'" :class="showRegister == 'outros' ? 'menusuperior caret menu-h active-h' : 'menusuperior caret menu-h'">Outros</span>
                    </span>
                </b-col>
            </b-row>

            <div class="mt-2" v-if="showRegister == 'produtos'">
                <products-register></products-register>
            </div>

            <div class="mt-2" v-if="showRegister == 'outros'">
                <outers></outers>
            </div>

        </div>

        <div v-if="showTab == 'emails'">
            <emails></emails>
        </div>
      




    </div>
</template>

<script>
    import productsRegister from '../components/products/products-register.vue';
    import productsList from '../components/products/products-list.vue';
    import outers from '../components/products/outers.vue';
    import emails from '../components/products/emails.vue';
    export default {  
        components:{
            productsRegister,
            productsList,
            outers,
            emails,
        },
        data: function () {
            return {
                showTab: '',
                showRegister: 'produtos',
                fields: ['first_name', 'last_name', 'age'],
                items: [
                    { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                    { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                    { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                    { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
                ],
                form: {
                    email: '',
                    name: '',
                    food: null,
                    checked: []
                },
                foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
                show: true
            }
        },
        props:{
            session_user: Object,
        },
        mounted() {
            const valorSalvo = localStorage.getItem('ofertatotal');
            if (valorSalvo) {
                this.showTab = valorSalvo;
            }
        },
        watch: {
            showTab(newVal) {
                // Salvar no localStorage quando showTab mudar
                localStorage.setItem('ofertatotal', newVal);
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault()
                alert(JSON.stringify(this.form))
            },
        },
    }
</script>

<style scoped>

    .border-image {
        border: 1px solid rgb(184, 184, 184);
        padding: 10px;
        display: inline-block; /* Impede que o span se expanda para a largura total */
    }
    .ajust-check{
        margin-right: 10px;
        margin-top: 1px;
    }

    .card-itens{
        background-color: white; 
        border-radius: 10px;
        margin-left: 0;
        margin-right: 0;
    }

    .active-h{
        font-weight: bolder;
        background-color: #0d6efd !important;
        color: white !important;
    }
    
    .menu-h:hover{
        font-weight: bolder;
    }

    .banner1 {
        height: 400px;
        background-image: url('/images/slide1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }

    .banner2 {
        height: 400px;
        background-image: url('/images/slide2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner3 {
        height: 400px;
        background-image: url('/images/slide3.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner4 {
        height: 400px;
        background-image: url('/images/slide4.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }


    .sizeCard{
        padding: 20px;
        min-height: 400px;
    }

    .menusuperior{
        background-color: white;
        color: black;
        width: 100%;
        padding: 8px;
        text-align: center;
    }
    .product{
        width: 16rem;
        margin-left: 10px;
    }

    .image-container {
        position: relative;
        max-width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .text-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #ffffff; /* Cor do texto */
        font-size: 24px; /* Tamanho da fonte */
        font-weight: bold; /* Peso da fonte */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra do texto */
    }

    /* pre {
        font-family: 'Helvetica', 'Arial', sans-serif;
    } */
</style>


