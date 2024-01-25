<template>
    <div>
        <b-form @submit="onSubmit" >
            <b-form-group 
                class="mt-1"
                id="input-group-1"
                label="Nome do produto:"
                label-for="input-1"
            >
            <b-form-input
                id="input-2"
                v-model="form.name"
                type="text"
                placeholder="Nome do produto"
                required
                ></b-form-input>
            </b-form-group>
            <b-form-group 
                class="mt-1"
                id="input-group-2"
                label="Descrição do produto:"
                label-for="input-2"
            >
                <b-form-textarea
                    id="input-1"
                    v-model="form.description"
                    type="text"
                    placeholder="Descrição do produto"
                    required
                    rows="3"
                    ></b-form-textarea>
            </b-form-group>

            <b-form-group 
                class="mt-1"
                id="input-group-3"
                label="Informações do produto:"
                label-for="input-3"
            >
                <b-form-textarea
                id="input-3"
                v-model="form.info"
                type="text"
                placeholder="Informações do produto"
                required
                rows="3"
                ></b-form-textarea>
            </b-form-group>

            <b-form-group 
                class="mt-1"
                id="input-group-4"
                label="Link de afilidado do produto:"
                label-for="input-4"
            >
                <b-form-input
                id="input-4"
                v-model="form.link"
                type="text"
                placeholder="Link de afilidado do produto"
                required
                ></b-form-input>
            </b-form-group>

            <b-form-group 
                class="mt-1"
                id="input-group-5"
                label="Preço do produto (OPCIONAL)"
                label-for="input-5"
            >
                <b-form-input
                id="input-5"
                v-model="form.value"
                type="text"
                placeholder="Preço do produto"
                required
                ></b-form-input>
            </b-form-group>

            <b-form-group 
                class="mt-1"
                id="input-group-6"
                label="Imagem do produto"
                label-for="input-6"
            >
                <b-form-input
                id="input-6"
                v-model="form.image1"
                type="text"
                placeholder="Imagem do produto"
                required
                ></b-form-input>
            </b-form-group>

            <div class="mt-3" for="opções">OPÇÕES - PARA <b>ADICIONAR</b> BASTA CLICAR EM CIMA.</div>
            <div>
                <b-badge v-for="(item, index) in options" :key="'badge'+index" class="gray caret" @click="insertComodo(item, index)">{{item.text}}</b-badge>
            </div>
            <hr>

            <p for="opções">OPÇÕES - PARA <b>REMOVER</b> BASTA CLICAR EM CIMA.</p>
            <b-badge v-for="(item, index) in comodosSelecteds" :key="'badge'+index" class="success caret" @click="removeComodo(item, index)">{{item.text}}</b-badge>


            <br><br><br>
            <b-button class="mt-1" style="float: right;" type="submit" variant="success">Criar produto</b-button>
        </b-form>
        <br><br><br>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                form: {
                    name: '',
                    description: '',
                    info: '',
                    link: '',
                    value: '',
                    image1: '',
                },
                selected: null,
                options: [
                    { value: 'SaladeEstar', text: 'Sala de Estar' },
                    { value: 'SaladeJantar', text: 'Sala de Jantar' },
                    { value: 'Cozinha', text: 'Cozinha' },
                    { value: 'BanheiroPrincipal', text: 'Banheiro Principal' },
                    { value: 'QuartoPrincipal', text: 'Quarto Principal' },
                    { value: 'QuartodeHóspedes', text: 'Quarto de Hóspedes' },
                    { value: 'BanheirodeHóspedes', text: 'Banheiro de Hóspedes' },
                    { value: 'Escritório', text: 'Escritório' },
                    { value: 'Lavanderia', text: 'Lavanderia' },
                    { value: 'Garagem', text: 'Garagem' },
                    { value: 'Sótão', text: 'Sótão' },
                    { value: 'Porão', text: 'Porão' },
                    { value: 'QuartodeCrianças', text: 'Quarto de Crianças' },
                    { value: 'BanheirodeCrianças', text: 'Banheiro de Crianças' },
                    { value: 'SaladeTV/HomeTheater', text: 'Sala de TV / Home Theater' },
                    { value: 'VarandaouTerraço', text: 'Varanda ou Terraço' },
                    { value: 'CorredorouHalldeEntrada', text: 'Corredor ou Hall de Entrada' },
                    { value: 'Closet', text: 'Closet' },
                    { value: 'Despensa', text: 'Despensa' },
                    { value: 'BanheiroSocial', text: 'Banheiro Social' },
                ],
                comodosSelecteds:[],
            }
        },
        props:{
            session_user: Object,
        },
        mounted() {
                this.sortLists();
        },
        methods: {
            insertComodo(item, index){
                this.comodosSelecteds.push(item);
                this.options.splice(index, 1);
                this.sortLists();
            },
            removeComodo(item, index) {
                this.options.push(item);
                this.comodosSelecteds.splice(index, 1);
                this.sortLists();
            },
            sortLists() {
            // Ordena ambas as listas alfabeticamente
                this.options.sort((a, b) => a.text.localeCompare(b.text));
                this.comodosSelecteds.sort((a, b) => a.text.localeCompare(b.text));
            },
            onSubmit(event) {
                event.preventDefault()
                alert(JSON.stringify(this.form))
            },
        },
    }
</script>

<style scoped>
    .success{
        background-color: #28a745;
        margin-right: 8px;
        padding: 4px;
        font-size: 14px;
    }
    .gray{
        background-color: rgb(61, 61, 61);
        color: white;
        margin-right: 8px;
        padding: 4px;
        font-size: 14px;
    }
</style>


