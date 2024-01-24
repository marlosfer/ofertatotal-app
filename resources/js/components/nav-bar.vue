<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/#">
                    <img src="/images/ofertatotal.png" alt="CaserioBr" width="40" /> Oferta Total
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul v-if="session_user" class="navbar-nav me-auto">
                        Produtos
                    </ul>
                    <ul v-if="session_user" class="navbar-nav me-auto">
                        Cursos
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul v-if="session_user" class="navbar-nav ms-auto">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/">marlos</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <b-link class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ session_user.name }}
                            </b-link>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                title: 'teste',
            }
        },
        props:{
            session_user: String,
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            sair(){
                console.log('saiu')
            }
        },
    }
</script>
