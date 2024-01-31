<template>
    <footer class="footer">
        <div>
            <section class="inner1" style="text-align: center;">
                <b-row>
                    <b-col>
                        <div v-if="!sendMessage">
                            <h2>Envie-nos suas Sugestões e Críticas!</h2>
                            <p>Se você tiver alguma sugestão, ideia ou crítica construtiva, não hesite em enviar-nos um e-mail. 
                            Estamos sempre abertos a receber feedback e valorizamos a sua contribuição.</p>
                        </div>

                        <div v-if="sendMessage">
                            <h2>Obrigado pela sua Contribuição!</h2>
                            <p>Agradecemos por compartilhar suas sugestões e críticas conosco. Seu feedback é extremamente valioso e nos ajuda a melhorar continuamente.</p>
                            <p>Se tiver mais alguma sugestão ou comentário, sinta-se à vontade para entrar em contato novamente. Estamos aqui para ouvir e melhorar.</p>
                        </div>

                    </b-col>
                    <b-col v-if="!sendMessage">
                        <b-form-group
                            id="input-group-1"
                            label-for="input-1"
                        >
                            <b-form-input
                            id="input-1"
                            v-model="form.email"
                            type="email"
                            placeholder="Seu email"
                            class="custom-input"
                            size="lg"
                            required
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col v-if="!sendMessage">
                        <b-form-group
                            id="input-group-2"
                            label-for="input-2"
                        >
                            <b-form-input
                            id="input-2"
                            v-model="form.description"
                            size="lg"
                            type="text"
                            placeholder="Sua sugestão"
                            class="custom-input"
                            required
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col v-if="!sendMessage">
                        <b-form-group
                            id="input-group-2"
                            label-for="input-2"
                        >
                            <b-button class="custom-input" style="width: 100%;" @click="sendSugestion" variant="outline-success">Enviar</b-button>
                        </b-form-group>
                    </b-col>
                </b-row>
            </section>
            <section class="inner2">
                <b-row>
                    <b-col>
                        <h4>Oferta Total</h4>
                        <p>Junte-se a nós e descubra um universo de ofertas exclusivas, promoções relâmpago e produtos de qualidade. Na Oferta Total, transformamos o conceito de compras online, tornando acessíveis as melhores oportunidades para todos os nossos seguidores.</p>
                    </b-col>
                    <b-col>
                        <pre>
                            <b>INSTITUCIONAL</b>
                            <b-link href="#">Sobre a Oferta Total</b-link>
                            <b-link href="#">Depoimentos de Clientes</b-link>
                            <b-link href="#">faq</b-link>
                            <b-link href="#">Fale Conosco</b-link>
                        </pre>


                    <!-- <p>
                        Oferta Total é a sua porta de entrada para oportunidades incríveis! Somos uma empresa especializada em potencializar a visibilidade de produtos acessíveis provenientes da Shopee e Hotmart através das redes sociais mais populares, como TikTok, Twitter e Instagram.

                        Nosso compromisso é conectar consumidores a ofertas irresistíveis, trazendo até você produtos de alta qualidade a preços acessíveis. Através de estratégias inovadoras de marketing digital, destacamos as melhores ofertas da Shopee e Hotmart, garantindo que você esteja sempre atualizado sobre as últimas tendências e promoções.

                        No TikTok, Twitter e Instagram, nossa equipe dedicada trabalha arduamente para criar conteúdo envolvente e informativo que destaca os produtos mais populares e vantajosos do momento. Seja você um entusiasta de tecnologia, moda, beleza ou qualquer outra categoria, a Oferta Total está aqui para fornecer uma experiência de compra única, economizando tempo e dinheiro.

                        Siga-nos nas redes sociais e embarque nessa jornada de economia e descobertas! Oferta Total - O melhor caminho para aproveitar o máximo em economia, qualidade e estilo!
                    </p> -->
                    </b-col>
                    <b-col>
                        <pre>
                            <b>ATENDIMENTO</b>
                            Contato
                            +55 (63) 9224-3968

                            Envie um e-mail
                            storeofertatotal@gmail.com

                            HORÁRIO DE ATENDIMENTO
                            Segunda a Sexta das 9h às 18h
                        </pre>
                    </b-col>
                    <!-- <b-col>
                        <pre>
                            FORMAS DE PAGAMENTO
                            Cartão Visa
                            Cartão Mastercard
                            Cartão Amex
                            Cartão Elo
                            Cartão Hipercard
                            Pix - Vindi
                            SELOS DE SEGURANÇA
                            Loja Protegida
                        </pre>
                    </b-col> -->
                    <b-col>
                        <pre>
                            <b>FOLLOW</b>
                            <b-link href="#">Twitter</b-link>
                            <b-link href="#">Facebook</b-link>
                            <b-link href="#">Instagram</b-link>
                            <b-link href="#">Dribbble</b-link>
                            <b-link href="#">GitHub</b-link>
                            <b-link href="#">500px</b-link>
                            <b-link href="#">Phone</b-link>
                            <b-link href="#">Email</b-link>
                        </pre>
                    </b-col>
                </b-row>
            </section>
            <span class="copyright">
                &copy; Untitled. All rights reserved Design: <a href="#">Insectoyde</a> 
            </span>
        </div>
    </footer>
</template>

<script>
    export default {
        data: function () {
            return {
                form: {
                    email: '',
                    description: '',
                },
                sendMessage: false,
            }
        },
        created() {
            // Para obter o valor e verificar se ainda está dentro do prazo de validade
            const storedData = JSON.parse(localStorage.getItem('ofertatotal_1'));
            if (storedData && storedData.expirationTime > new Date().getTime()) {
                this.sendMessage = storedData.value === 'true';
            } else {
                // O valor expirou ou não está presente
                this.sendMessage = false;
            }
        },
        methods: {
            sendSugestion(){
                axios.post('/send-sugestion',{
                    form: this.form,
                }).then(res => {
                    if(res.data.success){
                        this.form = {
                            email: '',
                            description: '',
                        }
                        const expirationTime = new Date().getTime() + 24 * 60 * 60 * 1000; // 24 horas em milissegundos
                        localStorage.setItem('ofertatotal_1', JSON.stringify({ value: 'true', expirationTime }));
                        this.sendMessage = true;
                    }else{
                        alert('erro ao salvar');
                    }
                }).catch(err => {
                    console.error(err); 
                })
            },
        },
    }
</script>

<style scoped>
    .copyright{
        display: flex;
        text-align: center;
        color: rgb(46, 46, 46);
        margin-left: 116px;
    }
    .footer{
        margin-top: 50px;
    }
    .custom-input{
        margin: 20px;
        margin-top: 40px;
        padding: 30px;
    }
    .custom-input:hover{
        border: 1px solid black;
    }
    .inner1{
        background-color: #9cd2bb;
        color: white;
        padding-left: 120px;
        padding-right: 140px;
        padding-top: 30px;
        padding-bottom: 30px;
    }
    .inner2{
        color: #314933;
        padding-left: 120px;
        padding-right: 120px;
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .btn-outline-success{
        color: #7da091; /* Cor do texto ao remover o efeito hover */
        border-color: #7da091; /* Cor da borda ao remover o efeito hover */
    }
    .btn-outline-success:hover {
        color: white; /* Cor do texto ao remover o efeito hover */
        background-color: #89d3b3;
        border-color: #707a70; /* Cor da borda ao remover o efeito hover */
    }
    pre {
        font-family: 'Helvetica', 'Arial', sans-serif;
        font-size: 16px;
        line-height: 1.5;
    }
</style>

        