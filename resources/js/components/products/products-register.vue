<template>
    <div>
        <div>
            <b-alert variant="success" :show="showAlert">Salvo com sucesso!</b-alert>
            <b-alert variant="danger" :show="showDanger">Falta selecionar alguma coisa</b-alert>
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
                :state="validateTextName"
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
                    :state="validateTextDescr"
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
                :state="validateTextInfo"
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
                :state="validateTextLink"
                ></b-form-input>
            </b-form-group>

            <!-- <b-form-group 
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
            </b-form-group> -->

            <b-row>
                <b-col>
                    <b-form-group 
                        class="mt-1"
                        id="input-group-6"
                        label="Imagem do produto"
                        label-for="input-6"
                    >
                        <b-form-input
                        id="input-6"
                        v-model="form.image"
                        type="text"
                        placeholder="Imagem do produto"
                        @keyup.enter="addImage" 
                        ></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col cols="auto" style="margin-top: 28px;">
                    <b-input-group-append>
                        <!-- <b-button variant="outline-success" @click="addImage">Adicionar</b-button> -->
                    </b-input-group-append>
                </b-col>
            </b-row>
            <span v-for="(item, index) in images" :key="'images1'+index" class="d-inline-block mr-2">
                <img class="d-inline-block" :src="item"  @click="openModal(item)"  style="height: 150px; width: 150px;" :alt="'teste'+index"><br>
                <b-button @click="removerImage(index)" class="btn btn-danger" style="width: 130px;">remover</b-button>
            </span>
            <b-modal class="text-center" id="modal-1" 
                hide-header-close hide-footer size="lg" 
            >
                <b-row>
                    <b-col cols="auto">
                        <div v-for="(item, index) in images" :key="'images2'+index">
                            <span  class="border-image mt-1 caret" @click="setImageModal(item)">
                                <img :src="item" style="width: 100px;" class="card-img-top" alt="Produto 1">
                            </span>
                            <br>
                        </div>
                    </b-col>
                    <b-col>
                        <img v-b-modal.modal-1 :src="imageselected" class="card-img-top" alt="Produto 1">
                    </b-col>
                </b-row>
            </b-modal>

            <hr>
                <div class="mt-3" for="opções">OPÇÕES - PARA <b>ADICIONAR</b> BASTA CLICAR EM CIMA.</div>
                <div>
                    <b-badge v-for="(item, index) in options" :key="'badge'+index" class="gray caret" @click="insertComodo(item, index)">{{item.text}}</b-badge>
                </div>
                <p for="opções">OPÇÕES - PARA <b>REMOVER</b> BASTA CLICAR EM CIMA.</p>
                <b-badge v-for="(item, index) in comodosSelecteds" :key="'badgee'+index" class="success caret" @click="removeComodo(item, index)">{{item.text}}</b-badge>
            <hr>

            <hr>
                <b-form-group label="OPÇÕES DE TEXTO" v-slot="{ ariaDescribedby }">
                    <b-form-radio v-model="selectedRadio" :aria-describedby="ariaDescribedby" name="some-radios" value="A">Array - Tem que começar com '[' e terminar com ']' </b-form-radio>
                    <b-form-radio v-model="selectedRadio" :aria-describedby="ariaDescribedby" name="some-radios" value="B">Text - Adicionar 1 por 1</b-form-radio>
                </b-form-group>
                <div  v-if="selectedRadio == 'A'">
                    <div class="mt-3" for="opções">PALAVRAS CHAVES - ARRAY</div>
                    <b-row>
                        <b-col>
                            <b-form-group 
                                class="mt-1"
                                id="input-group-6"
                                label-for="input-6"
                            >
                                <b-form-input
                                id="input-6"
                                v-model="form.key"
                                type="text"
                                @keyup.enter="processarPalavrasChave" 
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="auto" style="margin-top: 4px;">
                            <b-input-group-append>
                                <b-button variant="outline-danger" @click="bugRemoverTodaKey">Remover tudo</b-button>
                                <!-- <b-button variant="outline-success" @click="processarPalavrasChave">Adicionar</b-button> -->
                            </b-input-group-append>
                        </b-col>
                    </b-row>
                </div>
                <div  v-if="selectedRadio == 'B'">
                    <div class="mt-3" for="opções">PALAVRAS CHAVES - TEXTO</div>
                    <b-row>
                        <b-col>
                            <b-form-group 
                                class="mt-1"
                                id="input-group-6"
                                label-for="input-6"
                            >
                                <b-form-input
                                id="input-6"
                                v-model="form.key"
                                type="text"
                                @keyup.enter="addKey" 
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="auto" style="margin-top: 4px;">
                            <b-input-group-append>
                                <b-button variant="outline-danger" @click="bugRemoverTodaKey">Remover tudo</b-button>
                                <!-- <b-button variant="outline-success" @click="addKey">Adicionar</b-button> -->
                            </b-input-group-append>
                        </b-col>
                    </b-row>
                </div>
                <p for="opções">REMOVER PALAVRAS CHAVES</p>
                <b-badge v-for="(item, index) in keys" :key="'badge'+index" class="primary caret" @click="removeKey(index)">{{item}}</b-badge>
            <hr>


            
            <b-alert variant="danger" :show="showDanger">Falta selecionar alguma coisa</b-alert>
            <br><br><br>
            
            <b-button v-if="itemselected == null" class="mt-1" style="float: right;" type="submit" variant="success" @click="createItem">Criar produto</b-button>
            <b-button v-else class="mt-1" style="float: right;" type="submit" variant="warning" @click="EditItem">Editar produto</b-button>
        </div>
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
                    // value: '',
                    image: '',
                    key: '',
                },
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
                keys: [],
                comodosSelecteds:[],
                images: [],
                imageselected: '',
                showAlert: false,
                showDanger: false,
                selectedRadio: 'A',
            }
        },
        props:{
            itemselected: Object,
        },
        created() {
            console.log(this.itemselected);
            this.form = {
                name: this.itemselected.name,
                description: this.itemselected.description,
                info: this.itemselected.info,
                link: this.itemselected.link,
                image: this.itemselected.image,
                key: this.itemselected.key
            };
            this.images = this.itemselected.images;
            this.keys = JSON.parse(this.itemselected.keys);

            this.comodosSelecteds = this.itemselected.rooms;
            this.options = this.options.filter(option => !this.itemselected.rooms.includes(option));

        },
        mounted() {
            this.sortLists();
        },
        methods: {
            EditItem(){
                if(
                    this.form.name.trim() == '' || 
                    this.form.description.trim() == '' || 
                    this.form.info.trim() == '' || 
                    this.form.link.trim() == '' || 
                    this.images.length == 0 || 
                    this.comodosSelecteds.length == 0
                ){
                    setTimeout(() => {
                        this.showDanger = false;
                    }, 2500);
                    return this.showDanger = true;
                }

                axios.post('/edit-product',{
                    id: this.itemselected.id,
                    form: this.form,
                    images: this.images,
                    comodos: this.comodosSelecteds,
                    keys: this.keys,
                }).then(res => {
                    if(res.data.success){
                        this.$emit('back');
                    }
                }).catch(err => {
                    console.error(err); 
                });
                
            },
            createItem() {
                if(
                    this.form.name.trim() == '' || 
                    this.form.description.trim() == '' || 
                    this.form.info.trim() == '' || 
                    this.form.link.trim() == '' || 
                    this.images.length == 0 || 
                    this.comodosSelecteds.length == 0
                ){
                    setTimeout(() => {
                        this.showDanger = false;
                    }, 2500);
                    return this.showDanger = true;
                }

                axios.post('/create-product',{
                    form: this.form,
                    images: this.images,
                    comodos: this.comodosSelecteds,
                    keys: this.keys,
                }).then(res => {
                    if(res.data.success){
                        this.form = {
                            name: '',
                            description: '',
                            info: '',
                            link: '',
                            image: '',
                        }
                        this.images = [];
                        this.keys = [];
                        this.comodosSelecteds = [];
                        this.options = [
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
                        ];
                        this.showAlert = true;
                        // Configurar um temporizador para ocultar o alerta após 5 segundos
                        setTimeout(() => {
                            this.showAlert = false;
                        }, 2500);
                    }else{
                        alert('erro ao salvar');
                    }
                }).catch(err => {
                    console.error(err); 
                })
            },
            openModal(value) {
                this.$bvModal.show('modal-1');
                this.setImageModal(value);
            },
            setImageModal(value){
                var vm = this;
                vm.imageselected = value;
            },
            processarPalavrasChave() {
                try {
                    if (Array.isArray(this.keys)) {
                        this.keys = JSON.parse(this.form.key);
                        setTimeout(() => {
                            this.form.key = '';
                        }, 100);
                    }

                    if (!Array.isArray(this.keys)) {
                    console.error('Formato de entrada inválido.');
                    }
                } catch (error) {
                    console.error('Erro ao analisar JSON:', error.message);
                }
            },
            addKey(){
                this.keys.push(this.form.key);
                this.form.key = '';
            },
            removeKey(index){
                this.keys.splice(index, 1);
            },
            bugRemoverTodaKey(){
                this.keys = [];
            },
            addImage(){
                this.images.push(this.form.image);
                this.form.image = '';
            },
            removerImage(index){
                this.images.splice(index, 1);
            },
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
        },
        computed: {
            validateTextName() {
                const textLength = this.form.name.length;
                return textLength > 4 && textLength < 255;
            },
            validateTextDescr() {
                const textLength = this.form.description.length;
                return textLength > 4 && textLength < 400;
            },
            validateTextInfo() {
                const textLength = this.form.info.length;
                return textLength > 4;
            },
            validateTextLink() {
                const link = this.form.link.trim();
                const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
                const maxLength = 254;

                return urlRegex.test(link) && link.length <= maxLength;
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
    .success{
        background-color: #28a745;
        margin-right: 8px;
        padding: 4px;
        font-size: 14px;
    }

    .primary{
        background-color: #007bff;
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


