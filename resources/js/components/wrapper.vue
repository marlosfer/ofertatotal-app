<template>
    <div class="wrapper">
        <div v-show="$store.state.showBanner" class="flexslider" style="margin-bottom: 0;">
            <ul class="slides">
                <li>
                    <div class="image-container">
                        <div class="banner1"></div>
                        <div class="text-overlay">Texto Sobre a Imagem 1: {{ $store.state.companyselect }}</div>
                    </div>
                </li>
                <li>
                    <div class="image-container">
                        <div class="banner2"></div>
                        <div class="text-overlay">Texto Sobre a Imagem 2</div>
                    </div>
                </li>
                <li>
                    <div class="image-container">
                        <div class="banner3"></div>
                        <div class="text-overlay">Texto Sobre a Imagem 3</div>
                    </div>
                </li>
                <li>
                    <div class="image-container">
                        <div class="banner4"></div>
                        <!-- <div class="text-overlay">Texto Sobre a Imagem 4</div> -->
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
    
        <b-row :class="$store.state.showBanner ? '': 'mt-2'" style="justify-content: center;">
            <b-col cols="12"> 
                <span style="display: flex;justify-content: center;">
                    <span class="menusuperior caret menu-h active-h">Produtos</span>
                    <span class="menusuperior caret menu-h">Cursos</span>
                    <span class="menusuperior caret menu-h">Ofertas Especiais</span>
                    <span class="menusuperior caret menu-h">Novidades</span>
                    <span class="menusuperior caret menu-h">Mais Vendidos</span>    
                </span>
            </b-col>
        </b-row>
        <b-row class="mt-3">
            <b-col cols="auto"> 
                <b-list-group>
                    <b-list-group-item class="bd-none"><center><b>Cômodos</b></center></b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" v-model="comodos.salaEstar" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Sala de Estar
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-2" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-2" class="custom-control-label">
                                Sala de Jantar
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-3" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-4" class="custom-control-label">
                                Cozinha
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Banheiro Principal
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Quarto Principal
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Quarto de Hóspedes
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Banheiro de Hóspedes
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Escritório
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Lavanderia
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Garagem
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Sótão
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Porão
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Quarto de Crianças
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Banheiro de Crianças
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Sala de TV / Home Theater
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Varanda ou Terraço
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Corredor ou Hall de Entrada
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Closet
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Despensa
                            </label>
                        </div>
                    </b-list-group-item>
                    <b-list-group-item class="bd-none">
                        <div  class="dp-flex">
                            <input id="checkbox-1" type="checkbox" name="checkbox-1" class="custom-control-input ajust-check" value="true">
                            <label for="checkbox-1" class="custom-control-label">
                                Banheiro Social
                            </label>
                        </div>
                    </b-list-group-item>
                </b-list-group>
            </b-col>

            <b-col>
                <b-row class="jc-c card-itens">
                    <!-- <div class="input-group mb-3" style="margin-top: 10px;">
                        <input type="text" class="form-control" placeholder="Pesquisar produto...">
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" style="margin-left: 10px;" type="button">Pesquisar</button>
                        </div>
                    </div> -->
                    <b-col cols="auto" class="dp-flex sizeCard">
                        <div class="card product bd-none">
                            <div class="h-100">
                                <img 
                                    class="card-img-top caret"
                                    @click="openModal('https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e')" 
                                    src="https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e" 
                                    alt="Produto 1"
                                >
                                <div class="card-body">
                                    <h6 class="card-title"><b>Máquina De Cortar Cabelo Para Barba Masculina Designer Aleatório Elétrico Profissional</b></h6>
                                    <p class="card-text">
                                        Máquina de Aparador De Cabelo Profissional De Cabelo T9 Aparador Elétrico Para Man Barber De Corte De Cabelo Homem Barber
                                    </p>
                                </div>
                            </div>
                            <a href="https://shope.ee/3VLQP2t3dy" class="btn btn-primary w-90 mg-10" target="_blank">Ver Detalhes</a>

                            <b-modal class="text-center" id="modal-1" 
                                hide-header-close hide-footer size="lg" 
                                title="Máquina De Cortar Cabelo Para Barba Masculina Designer Elétrico Profissional"
                            >
                                <b-row>
                                    <b-col cols="auto">
                                        <span class="border-image mt-1 caret">
                                            <img @click="setImageModal('https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e')" src="https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e" style="width: 100px;" class="card-img-top" alt="Produto 1">
                                        </span>
                                        <br>
                                        <span class="border-image mt-1 caret">
                                            <img @click="setImageModal('https://down-br.img.susercontent.com/file/a0466039c04a805c5c8bade1b5fac19f')" src="https://down-br.img.susercontent.com/file/a0466039c04a805c5c8bade1b5fac19f" style="width: 100px;" class="card-img-top" alt="Produto 1">
                                        </span>
                                    </b-col>
                                    <b-col>
                                        <img v-b-modal.modal-1 :src="imageSelected"  class="card-img-top" alt="Produto 1">
                                    </b-col>
                                    <b-col>
                                        <pre class="h6 mb-3">
Parâmetros do produto:

Potência: 5W
Bateria: 18650 Bateria Li-ion, Com carregador de bateria USB, pode ser usado em 
qualquer ocasião
Tempo de carregamento: 3 horas
Tensão nominal: 3V-5v
Tempo de uso: 3 horas
Método de carregamento: carregamento da bateria
Regulagem fina de cabeça cortador duplauso: ajustável zero ajustável
Tipo de Ferramenta: Dentes de Segurança Aguda de Dense
                                </pre>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <a href="https://shope.ee/3VLQP2t3dy" class="btn btn-success mt-2 w-100" target="_blank" block>Ir para a loja</a>
                                    </b-col>
                                </b-row>
                            </b-modal>
                        </div>
                    </b-col>
                    <b-col cols="auto" class="dp-flex sizeCard">
                        <div class="card product bd-none">
                            <div class="h-100">
                                <img src="https://down-br.img.susercontent.com/file/588eea9b630cf18620fc565d5c98ac1e" class="card-img-top" alt="Produto 1">
                                <div class="card-body">
                                    <h6 class="card-title"><b>Mini Processador Elétrico de Alimentos Portátil com 3 lâminas de aço inox USB 250 ml Bivolt</b></h6>
                                    <p class="card-text">
                                        {{'É de fácil utilização, bastando somente pressionar o botão para que o triturador faça seu trabalho, trazendo conforto na hora de fazer aquela receita. A bateria com bastante autonomia, carregamento via USB e tamanho portátil é perfeita para levar a qualquer lugar.'.substring(0, 110)+'...'}}
                                    </p>
                                </div>
                            </div>
                            <a href="https://shope.ee/LOOfQXhal" class="btn btn-primary w-90 mg-10" target="_blank">Ver Detalhes</a>
                        </div>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                imageSelected: '',
                comodos: {
                    salaEstar: false,
                }
            }
        },
        props:{
            session_user: Object,
        },
        mounted() {
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
        methods: {
            openModal(value) {
                this.$bvModal.show('modal-1');
                this.setImageModal(value);
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
        color: #0d6efd !important;
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


