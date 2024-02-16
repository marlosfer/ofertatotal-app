<template>
    <div class="wrapper">
        <div v-show="$store.state.showBanner" class="flexslider" style="margin-bottom: 0;">
            <ul class="slides">
                <li>
                    <div class="image-container">
                        <div class="banner0"></div>
                        <div class="text-overlay">
                            <pre>
                                <h2><b><center>{{ capsM('Ofertas Incríveis para o Seu Dia a Dia') }}</center></b></h2>
                            </pre>
                            <div>
                                <pre>    
<h6><b>
{{ capsM('Na nossa seleção de produtos úteis e baratos, você encontrará soluções ') }}
{{ capsM('inteligentes para simplificar a sua vida sem pesar no seu bolso. ') }}
</b></h6>
<h6><b>{{capsM('Descubra ofertas incríveis que tornarão o seu dia a dia mais prático e econômico.')}}</b></h6> 
                                </pre>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="image-container">
                        <div class="banner1"></div>
                        <div class="text-overlay">
                            <pre>
                                <h2><b><center>{{ capsM('Produtos essenciais combina utilidade e economia. ') }}</center></b></h2>
                            </pre>
                            <div>
                                <pre>    
<h6><b>
{{ capsM('Apresentamos uma variedade de soluções inteligentes, ') }}
{{ capsM('projetadas para facilitar a sua rotina diária a preços imbatíveis. ') }}
</b></h6>
<h6><b>{{capsM('Descubra como é possível ter qualidade sem comprometer o seu orçamento.')}}</b></h6> 
                                </pre>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="image-container">
                        <div class="banner2"></div>
                        <div class="text-overlay">
                            <pre>
                                <h2><b><center>{{ capsM('Aproveite nossas promoções exclusivas ') }}</center></b></h2>
                            </pre>
                            <!-- <div style="background-color: #9cd2bb;">
                            </div> -->
                            <div>
                                <pre>    
<h6><b>
{{ capsM('Na busca por soluções úteis que não pesem no seu orçamento, ') }}
{{ capsM('oferecemos uma variedade de opções que tornarão sua vida mais fácil sem comprometer sua carteira.') }}
</b></h6>
<h6><b>{{capsM('Explore as ofertas agora!')}}</b></h6> 
                                </pre>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- <b-row>
            <b-col cols="auto">
                <div>
                    <img src="/images/ofertatotal.png" alt="CaserioBr" width="80" />
                </div>
            </b-col>
            <b-col>
            </b-col>
            <b-col cols="auto"></b-col>
        </b-row> -->
    
        <!-- <b-row :class="$store.state.showBanner ? '': 'mt-2'" style="justify-content: center;">
            <b-col cols="12"> 
                <span style="display: flex;justify-content: center;">
                    <span class="menusuperior caret menu-h active-h">Produtos</span>
                    <span class="menusuperior caret menu-h">Cursos</span>
                    <span class="menusuperior caret menu-h">Ofertas Especiais</span>
                    <span class="menusuperior caret menu-h">Novidades</span>
                    <span class="menusuperior caret menu-h">Mais Vendidos</span>    
                </span>
            </b-col>
        </b-row> -->
        <b-row class="mt-3">
            <b-col cols="auto"> 
                <b-list-group>
                    <b-list-group-item class="bd-none"><center><b>Cômodos</b></center></b-list-group-item>
                    <b-list-group-item class="bd-none"  v-for="(item, index) in columns" :key="'columns'+index">
                        <div  class="dp-flex">
                             <input
                                :id="'checkbox-' + index"
                                type="checkbox"
                                :name="'checkbox-' + index"
                                v-model="selectedColumns"
                                :value="item.id"
                                class="custom-control-input ajust-check"
                                />
                            <label :for="'checkbox-' + index" class="custom-control-label">
                                {{ item.name }}
                            </label>
                        </div>
                    </b-list-group-item>
                </b-list-group>
            </b-col>

            <b-col>
                <b-row class="jc-c card-itens" :style="product.length == 1 ? '' : 'min-height: 840px;'">
                    <!-- <div class="input-group mb-3" style="margin-top: 10px;">
                        <input type="text" class="form-control" placeholder="Pesquisar produto...">
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" style="margin-left: 10px;" type="button">Pesquisar</button>
                        </div>
                    </div> -->
                    <b-col v-for="(item, index) in product" :key="'product'+index" cols="auto" class="dp-flex sizeCard">
                        <div class="card product bd-none bdshadow"> 
                            <div v-if="isItemNew(item)" class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-danger">NOVO</span>
                            </div>
                            <div style="height: 100%;">
                                <img 
                                    class="card-img-top caret"
                                    :style="isItemNew(item) ? 'border: 3px solid red' : ''"
                                    @click="openModal(item)" 
                                    :src="item.images[0]" 
                                    :alt="'Produto '+index"
                                >
                                <div class="card-body">
                                    <h6 class="card-titl"><b>{{item.name}}</b></h6>
                                    <p class="card-text">
                                        {{ truncateText(item.description, 100) }}
                                    </p>
                                </div>
                            </div>
                            <a :href="item.link" class="btn btn-primary w-90 mg-10" target="_blank">Ver Detalhes</a>
                        </div>
                    </b-col>
                </b-row>
                <div v-if="selectedColumns.length == 0 && $store.state.filterSearch">
                    <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" align="fill"></b-pagination>
                </div>
                
                <b-modal class="text-center fw-bd" id="modal-1" 
                    hide-header-close hide-footer size="lg" 
                    :title="itemSelected.name"
                >
                    <b-row>
                        <b-col cols="auto">
                            <div v-for="(item, index) in itemSelected.images" :key="'images2'+index">
                                <span  class="border-image mt-1 caret" @click="setImageModal(itemSelected.images[index])">
                                    <img :src="item" style="width: 100px;" class="card-img-top" :alt="'Imagem '+index">
                                </span>
                                <br>
                            </div>
                            <div v-for="(item, index) in itemSelected.videos" :key="'videos2'+index">
                                <span  class="border-image mt-1 caret" @click="setVideoModal">
                                    <!-- <img :src="item" style="width: 100px;" class="card-img-top" :alt="'Produto '+index"> -->
                                    <!--  -->
                                    <video muted style="width: 100px;" :poster="itemSelected.images[0]" class="card-img-top" :alt="'video'">
                                        <source :src="itemSelected.videos[0]" :type="getVideoType('video/mp4')">
                                    </video>
                                    <i class="fa fa-play fa-4x" style="position: absolute;left: 50px;top: 555px;color: white;" aria-hidden="true"></i>
                                </span>
                                <br>
                            </div>
                        </b-col>
                        <b-col v-if="!ShowVideo">
                            <img v-b-modal.modal-1 :src="imageSelected"  class="card-img-top" alt="Video 1">
                        </b-col>
                        <b-col v-if="ShowVideo">
                            <video controls autoplay :poster="itemSelected.images[0]" class="card-img-top" :alt="'video'">
                                <source :src="itemSelected.videos[0]" :type="getVideoType('video/mp4')">
                                Video.
                            </video>
                        </b-col>
                        <b-col cols="12">
                            <hr>
                            <pre class="h6 mb-3">
{{itemSelected.info}}
                            </pre>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col>
                            <a :href="itemSelected.link" class="btn btn-success mt-2 w-100" target="_blank" block>Ir para a loja</a>
                        </b-col>
                    </b-row>
                </b-modal>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                imageSelected: '',
                itemSelected: '',
                selectedColumns: [],
                columns: [],
                product: [],
                productCount: 0,
                ShowVideo: false,
                perPage: 8,
                currentPage: 1,
            }
        },
        props:{
            session_user: Object,
        },
        created() {
            this.$root.$refs.wrapper = this;
            this.bannerRotate();
            this.getColumns();
            this.getProducts();
        },
        methods: {
            capsM(value){
                return value.toUpperCase();
            },
            searchRooms(){
                if(this.selectedColumns.length == 0){
                    return this.getProducts();
                }
                axios.get('get-column-product-id',{
                    params: {
                        selectedColumns: this.selectedColumns,
                    },
                }).then(res => {
                    if(res.data.success){
                        this.product = res.data.value;
                    }
                })
                .catch(err => {
                    console.error(err); 
                });
            },
            getColumns(){
                axios.get('get-column-product',{
                }).then(res => {
                    if(res.data.success){
                        this.columns = res.data.value;
                    }
                })
                .catch(err => {
                    console.error(err); 
                });
            },
            getProducts(){
                axios.get('get-products',{
                    params: {
                        page: this.currentPage,
                        perPage: this.perPage,
                    },
                })
                .then(res => {
                    if(res.data.success){
                        this.product = res.data.value;
                        this.productCount = res.data.count;
                    }
                })
                .catch(err => {
                    console.error(err); 
                });
            },
            isItemNew(item) {
                const createdDate = new Date(item.created_at);
                const currentDate = new Date();
                const differenceInMilliseconds = currentDate - createdDate;
                const differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);

                return differenceInDays < 3;
            },
            truncateText(text, maxLength) {
                if (text.length > maxLength) {
                    return text.slice(0, maxLength) + "...";
                } else {
                    return text;
                }
            },
            getVideoType(url) {
                // A
                return 'video/mp4';
            },
            bannerRotate(){
                $(document).ready(function () {
                    $('.flexslider').flexslider({
                        animation: 'slide', // ou 'fade' para efeito de fade
                        slideshowSpeed: 2500, // Tempo de exibição de cada slide em milissegundos (2 segundos no exemplo)
                        animationSpeed: 600, // Tempo da animação em milissegundos
                        controlNav: false, // Mostrar botões de navegação (anterior/próximo)
                        directionNav: false, // Mostrar setas de navegação
                        pauseOnHover: false // Pausar a reprodução automática quando o mouse estiver sobre o slider
                    });
                });
            },
            openModal(item) {
                this.$bvModal.show('modal-1');
                this.itemSelected = item;
                this.setImageModal(item.images[0]);
            },
            handleModalShow() {
                // Adiciona a classe 'modal-open' ao corpo da página ao abrir o modal
                document.body.classList.add('modal-open');
            },
            handleModalHidden() {
                // Remove a classe 'modal-open' do corpo da página ao fechar o modal
                document.body.classList.remove('modal-open');
            },
            setImageModal(value){
                this.imageSelected = value;
                this.ShowVideo = false;
            },
            setVideoModal(){
                this.ShowVideo = true;
            },
        },
        watch: {
            currentPage(newvalue){
                this.getProducts();
            },
            selectedColumns(newvalue){
                this.searchRooms();
            },
            '$store.state.productsItems': {
                handler: function() {
                    // Faça alguma coisa quando $store.state.productsItems mudar
                    this.product = this.$store.state.productsItems;
                    this.$store.state.filterSearch = false;
                },
            }
        },
        computed: {
            rows() {
                return this.productCount;
            }
        }
    }
</script>

<style scoped>
    .bdshadow{
        box-shadow: 4px 3px 20px 0px rgb(223 223 223 / 50%);
    }
    .fw-bd{
        font-weight: bold !;
    }
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
        color: #0d6efd !important;
    }
    
    .menu-h:hover{
        font-weight: bolder;
    }

    .banner0 {
        height: 400px;
        background-image: url('/images/7.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner1 {
        height: 400px;
        background-image: url('/images/slide3.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }

    .banner2 {
        height: 400px;
        background-image: url('/images/4.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner3 {
        height: 400px;
        background-image: url('/images/6.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner4 {
        height: 400px;
        background-image: url('/images/3.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Outras propriedades opcionais, como background-color, podem ser adicionadas conforme necessário */
    }
    .banner0::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Altere o valor do último número (de 0 a 1) para ajustar a opacidade */
    }
    .banner1::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7); /* Altere o valor do último número (de 0 a 1) para ajustar a opacidade */
    }
    .banner2::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7); /* Altere o valor do último número (de 0 a 1) para ajustar a opacidade */
    }
    .banner3::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7); /* Altere o valor do último número (de 0 a 1) para ajustar a opacidade */
    }
    .banner4::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7); /* Altere o valor do último número (de 0 a 1) para ajustar a opacidade */
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
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 1); /* Sombra do texto */
    }

    /* pre {
        font-family: 'Helvetica', 'Arial', sans-serif;
    } */
</style>


