<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/images/ofertatotal.png" alt="CaserioBr" width="40" /> <span class="color-custom2"><b>OFERTA TOTAL</b></span> 
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-1 w-100">
                        <div class="input-group mb-2" style="margin-top: 10px;">
                            <input type="text" class="form-control"
                                @focus="onInputFocus"
                                @blur="onInputBlur"
                                @keyup.enter="searchItens" 
                                v-model="search" 
                                placeholder="Pesquisar produto..."
                            >
                            <div class="input-group-append">
                            <button class="btn btn-outline-primary" @click="searchItens" style="margin-top:1px;margin-left: -46px;border: none;z-index: 10;" type="button">
                                <b-icon icon="search" aria-hidden="true"></b-icon>
                            </button>
                            </div>
                        </div>
                    </ul> 
                    <!-- <ul v-if="is_login" class="navbar-nav mx-1">
                        Cursos
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul v-if="is_login" class="navbar-nav ms-auto">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/">marlos</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <b-link class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ session_user.name }}
                            </b-link>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/admin" @click="sair">
                                    Gerenciamento de Produtos
                                </a>
                                <a class="dropdown-item" href="/logout" @click="sair">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                is_login: Object.keys(this.session_user).length > 0,
                search: '',
            }
        },
        props:{
            session_user: Object,
        },
        mounted() {
            
        },
        methods: {
            onInputFocus(){
                var vm = this;
                if(vm.search.trim() != ''){
                    vm.$store.state.showBanner = false;
                }
            },
            onInputBlur(){
                var vm = this;
                if(vm.search.trim() == ''){
                    vm.$store.state.showBanner = true;
                }
            },
            searchItens(){
                var vm = this;
                // alert('buscou o item: ' + this.search);
                if(vm.search.trim() == ''){
                    vm.$store.state.showBanner = true;
                    vm.$root.$refs.wrapper.getProducts();
                    return vm.$store.state.filterSearch = true;
                }else{
                    this.$store.state.showBanner = false;
                }
                axios.get('get-product-name',{
                    params: {
                        search: vm.search,
                    },
                }).then(res => {
                    if(res.data.success){
                        vm.$store.state.productsItems = res.data.value;
                    }
                })
                .catch(err => {
                    console.error(err); 
                });
            },
            sair(){
                console.log('saiu')
            }
        },
    }
</script>

<style scoped>
    .color-custom1{
        color: #2d6125;
    }
    .color-custom2 {
        color: #3f0606;
        font-weight: bold;
    }

    /* Adiciona transição suave para a mudança de cor ao passar o mouse */
    .color-custom2:hover {
        color: #0d6e9c; /* Nova cor ao passar o mouse (tom de azul) */
        transition: color 0.3s ease-in-out;
    }
</style>
