<template>
    <div class="ot-page">
        <section id="inicio" class="ot-hero">
            <div class="ot-hero-overlay"></div>
            <div class="ot-hero-content">
                <h1>Encontre os melhores produtos por cômodo</h1>
                <p class="ot-hero-sub">
                    Compare ofertas selecionadas e monte sua casa com praticidade.
                </p>
                <div class="ot-hero-actions">
                    <button type="button" class="ot-btn ot-btn-primary" @click="rolarPara('produtos')">
                        Ver produtos
                    </button>
                    <button type="button" class="ot-btn ot-btn-ghost" @click="selecionarCategoria('Cozinha')">
                        Ofertas da cozinha
                    </button>
                </div>
            </div>
        </section>

        <section class="ot-toolbar">
            <div class="ot-brand-row">
                <img src="/images/ofertatotal.png" alt="OfertaTotal" width="56" height="56" />
                <div>
                    <strong>OfertaTotal</strong>
                    <p>Catálogo de ofertas para o lar</p>
                </div>
            </div>

            <div class="ot-categories" role="tablist" aria-label="Categorias">
                <button
                    v-for="cat in categorias"
                    :key="cat"
                    type="button"
                    class="ot-chip"
                    :class="{ active: categoriaAtiva === cat }"
                    @click="selecionarCategoria(cat)"
                >
                    {{ cat }}
                </button>
            </div>
        </section>

        <section id="produtos" class="ot-main">
            <aside class="ot-sidebar">
                <div class="ot-sidebar-card">
                    <h2>Cômodos</h2>
                    <button
                        v-for="comodo in comodos"
                        :key="comodo"
                        type="button"
                        class="ot-room"
                        :class="{ active: comodoAtivo === comodo }"
                        @click="selecionarComodo(comodo)"
                    >
                        {{ comodo }}
                    </button>
                </div>
            </aside>

            <div class="ot-content">
                <form class="ot-search" @submit.prevent="pesquisar">
                    <input
                        v-model="busca"
                        type="search"
                        class="ot-search-input"
                        placeholder="Pesquisar produto..."
                        aria-label="Pesquisar produto"
                    />
                    <button type="submit" class="ot-btn ot-btn-primary ot-search-btn">
                        Pesquisar
                    </button>
                </form>

                <div class="ot-meta">
                    <h2>{{ comodoAtivo }}</h2>
                    <span>{{ produtosFiltrados.length }} produto{{ produtosFiltrados.length === 1 ? '' : 's' }}</span>
                </div>

                <div v-if="produtosFiltrados.length" class="ot-grid">
                    <article
                        v-for="produto in produtosFiltrados"
                        :key="produto.id"
                        class="ot-card"
                    >
                        <div class="ot-card-media">
                            <img :src="produto.imagem" :alt="produto.titulo" />
                        </div>
                        <div class="ot-card-body">
                            <span class="ot-badge">{{ produto.categoria }}</span>
                            <h3>{{ produto.titulo }}</h3>
                            <p>{{ truncar(produto.descricao, 110) }}</p>
                        </div>
                        <a
                            :href="produto.link"
                            class="ot-btn ot-btn-primary ot-card-cta"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Ver detalhes
                        </a>
                    </article>
                </div>

                <div v-else class="ot-empty">
                    <h3>Nenhum produto encontrado</h3>
                    <p>Tente outro termo ou escolha uma categoria diferente.</p>
                    <button type="button" class="ot-btn ot-btn-ghost" @click="limparFiltros">
                        Limpar filtros
                    </button>
                </div>
            </div>
        </section>

        <section id="cursos" class="ot-courses">
            <div class="ot-courses-inner">
                <div>
                    <h2>Cursos e dicas</h2>
                    <p>Aprenda a escolher melhor e aproveitar cada oferta com conteúdo prático.</p>
                </div>
                <div class="ot-course-list">
                    <button
                        v-for="curso in cursos"
                        :key="curso"
                        type="button"
                        class="ot-course-item"
                        @click="abrirCurso(curso)"
                    >
                        {{ curso }}
                        <span>Em breve</span>
                    </button>
                </div>
            </div>
        </section>

        <footer id="contato" class="ot-footer">
            <div class="ot-footer-grid">
                <div>
                    <strong class="ot-footer-brand">OfertaTotal</strong>
                    <p>Ofertas selecionadas para casa, organização e bem-estar.</p>
                </div>
                <div>
                    <h3>Navegação</h3>
                    <button type="button" class="ot-footer-link" @click="rolarPara('produtos')">Produtos</button>
                    <button type="button" class="ot-footer-link" @click="rolarPara('cursos')">Cursos</button>
                    <button type="button" class="ot-footer-link" @click="rolarPara('contato')">Contato</button>
                </div>
                <div>
                    <h3>Fale conosco</h3>
                    <form class="ot-contact" @submit.prevent="enviarContato">
                        <input v-model="contato.nome" type="text" placeholder="Seu nome" required />
                        <input v-model="contato.email" type="email" placeholder="Seu e-mail" required />
                        <textarea v-model="contato.mensagem" rows="3" placeholder="Mensagem" required></textarea>
                        <button type="submit" class="ot-btn ot-btn-primary">Enviar mensagem</button>
                        <p v-if="contatoEnviado" class="ot-success">Mensagem registrada. Em breve entraremos em contato.</p>
                    </form>
                </div>
            </div>
            <div class="ot-copy">
                © {{ anoAtual }} OfertaTotal. Todos os direitos reservados.
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                busca: '',
                categoriaAtiva: 'Todos',
                comodoAtivo: 'Sala de Estar',
                contatoEnviado: false,
                contato: {
                    nome: '',
                    email: '',
                    mensagem: '',
                },
                categorias: ['Todos', 'Sala', 'Cozinha', 'Banheiro', 'Quarto', 'Escritório', 'Área externa'],
                comodos: [
                    'Sala de Estar',
                    'Sala de Jantar',
                    'Cozinha',
                    'Banheiro Principal',
                    'Quarto Principal',
                    'Quarto de Hóspedes',
                    'Banheiro de Hóspedes',
                    'Escritório',
                    'Lavanderia',
                    'Garagem',
                    'Sótão',
                    'Porão',
                    'Quarto de Crianças',
                    'Banheiro de Crianças',
                    'Sala de TV / Home Theater',
                    'Varanda ou Terraço',
                    'Corredor ou Hall de Entrada',
                    'Closet',
                    'Despensa',
                    'Banheiro Social',
                ],
                cursos: [
                    'Como escolher eletrodomésticos',
                    'Organização de cômodos',
                    'Economia em compras online',
                ],
                produtos: [
                    {
                        id: 1,
                        titulo: 'Máquina De Cortar Cabelo Para Barba Masculina Designer Elétrico Profissional',
                        descricao: 'Máquina aparador de cabelo profissional T9, elétrica, ideal para uso masculino e barbearia.',
                        imagem: 'https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e',
                        link: 'https://shope.ee/3VLQP2t3dy',
                        categoria: 'Banheiro',
                        comodo: 'Banheiro Principal',
                    },
                    {
                        id: 2,
                        titulo: 'Mini Processador Elétrico de Alimentos Portátil USB 250 ml Bivolt',
                        descricao: 'É de fácil utilização, bastando somente pressionar o botão para que o triturador faça seu trabalho, trazendo conforto na hora de fazer aquela receita. A bateria com bastante autonomia, carregamento via USB e tamanho portátil é perfeita para levar a qualquer lugar.',
                        imagem: 'https://down-br.img.susercontent.com/file/588eea9b630cf18620fc565d5c98ac1e',
                        link: 'https://shope.ee/LOOfQXhal',
                        categoria: 'Cozinha',
                        comodo: 'Cozinha',
                    },
                    {
                        id: 3,
                        titulo: 'Aparador Profissional para Uso Doméstico e Barber',
                        descricao: 'Aparador elétrico com design compacto, ótimo para manutenção de barba e cabelo em casa.',
                        imagem: 'https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e',
                        link: 'https://shope.ee/3VLQP2t3dy',
                        categoria: 'Banheiro',
                        comodo: 'Banheiro Social',
                    },
                    {
                        id: 4,
                        titulo: 'Kit Organização para Sala de Estar',
                        descricao: 'Soluções práticas para manter a sala organizada com peças versáteis e modernas.',
                        imagem: 'https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e',
                        link: 'https://shope.ee/3VLQP2t3dy',
                        categoria: 'Sala',
                        comodo: 'Sala de Estar',
                    },
                    {
                        id: 5,
                        titulo: 'Acessórios Essenciais para Quarto Principal',
                        descricao: 'Itens selecionados para conforto, organização e praticidade no quarto principal.',
                        imagem: 'https://down-br.img.susercontent.com/file/83e72d752c263768d72a1e8bed73fc9e',
                        link: 'https://shope.ee/3VLQP2t3dy',
                        categoria: 'Quarto',
                        comodo: 'Quarto Principal',
                    },
                ],
            }
        },
        computed: {
            anoAtual() {
                return new Date().getFullYear()
            },
            produtosFiltrados() {
                const termo = this.busca.trim().toLowerCase()
                const categoriaDoComodo = this.categoriaDoComodo(this.comodoAtivo)

                return this.produtos.filter((produto) => {
                    const bateBusca =
                        !termo ||
                        produto.titulo.toLowerCase().includes(termo) ||
                        produto.descricao.toLowerCase().includes(termo)

                    if (!bateBusca) {
                        return false
                    }

                    if (this.categoriaAtiva !== 'Todos') {
                        return produto.categoria === this.categoriaAtiva
                    }

                    if (produto.comodo === this.comodoAtivo) {
                        return true
                    }

                    if (categoriaDoComodo !== 'Todos') {
                        return produto.categoria === categoriaDoComodo
                    }

                    return true
                })
            },
        },
        mounted() {
            this.$root.$on('navegar-secao', this.onNavegarSecao)
        },
        beforeDestroy() {
            this.$root.$off('navegar-secao', this.onNavegarSecao)
        },
        methods: {
            truncar(texto, limite) {
                if (!texto) return ''
                return texto.length > limite ? texto.substring(0, limite) + '...' : texto
            },
            categoriaDoComodo(comodo) {
                const mapa = {
                    'Sala de Estar': 'Sala',
                    'Sala de Jantar': 'Sala',
                    'Sala de TV / Home Theater': 'Sala',
                    'Cozinha': 'Cozinha',
                    'Despensa': 'Cozinha',
                    'Banheiro Principal': 'Banheiro',
                    'Banheiro de Hóspedes': 'Banheiro',
                    'Banheiro de Crianças': 'Banheiro',
                    'Banheiro Social': 'Banheiro',
                    'Quarto Principal': 'Quarto',
                    'Quarto de Hóspedes': 'Quarto',
                    'Quarto de Crianças': 'Quarto',
                    'Closet': 'Quarto',
                    'Escritório': 'Escritório',
                    'Varanda ou Terraço': 'Área externa',
                    'Garagem': 'Área externa',
                }
                return mapa[comodo] || 'Todos'
            },
            selecionarCategoria(cat) {
                this.categoriaAtiva = cat
                this.contatoEnviado = false

                if (cat !== 'Todos') {
                    const comodoRelacionado = this.comodos.find(
                        (c) => this.categoriaDoComodo(c) === cat
                    )
                    if (comodoRelacionado) {
                        this.comodoAtivo = comodoRelacionado
                    }
                }

                this.rolarPara('produtos')
            },
            selecionarComodo(comodo) {
                this.comodoAtivo = comodo
                this.categoriaAtiva = 'Todos'
                this.rolarPara('produtos')
            },
            pesquisar() {
                this.rolarPara('produtos')
            },
            limparFiltros() {
                this.busca = ''
                this.categoriaAtiva = 'Todos'
                this.comodoAtivo = 'Sala de Estar'
            },
            rolarPara(id) {
                const el = document.getElementById(id)
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' })
                }
            },
            onNavegarSecao(secao) {
                if (secao === 'inicio' || secao === 'produtos' || secao === 'cursos' || secao === 'contato') {
                    this.rolarPara(secao === 'inicio' ? 'inicio' : secao)
                }
            },
            abrirCurso(curso) {
                window.alert(`O curso "${curso}" estará disponível em breve.`)
            },
            enviarContato() {
                this.contatoEnviado = true
                this.contato = { nome: '', email: '', mensagem: '' }
            },
        },
    }
</script>

<style scoped>
    .ot-page {
        --ot-bg: #f3f7f6;
        --ot-surface: #ffffff;
        --ot-ink: #0f172a;
        --ot-muted: #64748b;
        --ot-brand: #0f766e;
        --ot-brand-dark: #0d5f59;
        --ot-accent: #ea580c;
        --ot-line: #e2e8f0;
        --ot-radius: 18px;
        background:
            radial-gradient(circle at top right, rgba(20, 184, 166, 0.12), transparent 28%),
            linear-gradient(180deg, #f8fbfa 0%, var(--ot-bg) 40%, #eef5f3 100%);
        color: var(--ot-ink);
        min-height: 100vh;
    }

    .ot-hero {
        position: relative;
        min-height: 360px;
        margin: 1rem 1.25rem 0;
        border-radius: 28px;
        overflow: hidden;
        background-image: url('/images/background1.webp');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-end;
    }

    .ot-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(15, 23, 42, 0.78) 10%, rgba(15, 118, 110, 0.55) 55%, rgba(15, 23, 42, 0.35) 100%);
    }

    .ot-hero-content {
        position: relative;
        z-index: 1;
        padding: 2.5rem;
        max-width: 640px;
        color: #fff;
    }

    .ot-hero h1 {
        margin: 0 0 0.75rem;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        line-height: 1.15;
        letter-spacing: -0.03em;
        font-weight: 800;
    }

    .ot-hero-sub {
        margin: 0 0 1.5rem;
        color: rgba(255, 255, 255, 0.88);
        font-size: 1.05rem;
        max-width: 34rem;
    }

    .ot-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .ot-btn {
        appearance: none;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.75rem 1.2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.92rem;
        text-decoration: none;
        transition: transform 0.15s ease, background 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
    }

    .ot-btn:active {
        transform: translateY(1px);
    }

    .ot-btn-primary {
        background: var(--ot-brand);
        color: #fff;
        box-shadow: 0 10px 24px rgba(15, 118, 110, 0.25);
    }

    .ot-btn-primary:hover {
        background: var(--ot-brand-dark);
        color: #fff;
    }

    .ot-btn-ghost {
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.28);
    }

    .ot-btn-ghost:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
    }

    .ot-toolbar {
        max-width: 1280px;
        margin: 1.5rem auto 0;
        padding: 0 1.25rem;
    }

    .ot-brand-row {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-bottom: 1rem;
    }

    .ot-brand-row img {
        width: 56px;
        height: 56px;
        object-fit: contain;
        background: #fff;
        border-radius: 14px;
        padding: 6px;
        border: 1px solid var(--ot-line);
    }

    .ot-brand-row strong {
        display: block;
        font-size: 1.15rem;
        color: var(--ot-brand);
    }

    .ot-brand-row p {
        margin: 0;
        color: var(--ot-muted);
        font-size: 0.9rem;
    }

    .ot-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 0.55rem;
    }

    .ot-chip {
        border: 1px solid var(--ot-line);
        background: var(--ot-surface);
        color: #334155;
        border-radius: 999px;
        padding: 0.55rem 1rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .ot-chip:hover {
        border-color: #99f6e4;
        color: var(--ot-brand);
    }

    .ot-chip.active {
        background: var(--ot-brand);
        border-color: var(--ot-brand);
        color: #fff;
        box-shadow: 0 8px 18px rgba(15, 118, 110, 0.2);
    }

    .ot-main {
        max-width: 1280px;
        margin: 1.5rem auto 0;
        padding: 0 1.25rem 2rem;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 1.25rem;
        scroll-margin-top: 90px;
    }

    .ot-sidebar-card {
        background: var(--ot-surface);
        border: 1px solid var(--ot-line);
        border-radius: var(--ot-radius);
        padding: 1rem;
        position: sticky;
        top: 88px;
        max-height: calc(100vh - 110px);
        overflow: auto;
    }

    .ot-sidebar-card h2 {
        margin: 0 0 0.85rem;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--ot-muted);
    }

    .ot-room {
        width: 100%;
        text-align: left;
        border: none;
        background: transparent;
        color: #334155;
        border-radius: 10px;
        padding: 0.7rem 0.8rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        margin-bottom: 0.25rem;
        transition: background 0.15s ease, color 0.15s ease;
    }

    .ot-room:hover {
        background: #f0fdfa;
        color: var(--ot-brand);
    }

    .ot-room.active {
        background: #ecfdf5;
        color: var(--ot-brand);
        box-shadow: inset 3px 0 0 var(--ot-brand);
    }

    .ot-search {
        display: flex;
        gap: 0.65rem;
        margin-bottom: 1rem;
    }

    .ot-search-input {
        flex: 1;
        border: 1px solid var(--ot-line);
        border-radius: 12px;
        padding: 0.85rem 1rem;
        background: var(--ot-surface);
        outline: none;
        font-size: 0.95rem;
    }

    .ot-search-input:focus {
        border-color: #5eead4;
        box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
    }

    .ot-search-btn {
        white-space: nowrap;
    }

    .ot-meta {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .ot-meta h2 {
        margin: 0;
        font-size: 1.35rem;
        letter-spacing: -0.02em;
    }

    .ot-meta span {
        color: var(--ot-muted);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .ot-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        background: rgba(255, 255, 255, 0.65);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 24px;
        padding: 1rem;
    }

    .ot-card {
        background: var(--ot-surface);
        border: 1px solid var(--ot-line);
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .ot-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.1);
    }

    .ot-card-media {
        aspect-ratio: 1 / 1;
        background: #f8fafc;
        overflow: hidden;
    }

    .ot-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .ot-card-body {
        padding: 1rem 1rem 0.5rem;
        flex: 1;
    }

    .ot-badge {
        display: inline-block;
        margin-bottom: 0.55rem;
        padding: 0.2rem 0.55rem;
        border-radius: 999px;
        background: #fff7ed;
        color: var(--ot-accent);
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .ot-card-body h3 {
        margin: 0 0 0.5rem;
        font-size: 1rem;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ot-card-body p {
        margin: 0;
        color: var(--ot-muted);
        font-size: 0.88rem;
        line-height: 1.45;
    }

    .ot-card-cta {
        margin: 0.85rem 1rem 1rem;
    }

    .ot-empty {
        background: var(--ot-surface);
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        padding: 2.5rem 1.5rem;
        text-align: center;
    }

    .ot-empty h3 {
        margin: 0 0 0.4rem;
    }

    .ot-empty p {
        margin: 0 0 1rem;
        color: var(--ot-muted);
    }

    .ot-empty .ot-btn-ghost {
        background: #f8fafc;
        color: var(--ot-brand);
        border: 1px solid var(--ot-line);
    }

    .ot-courses {
        scroll-margin-top: 90px;
        max-width: 1280px;
        margin: 0 auto 2rem;
        padding: 0 1.25rem;
    }

    .ot-courses-inner {
        background: linear-gradient(135deg, #0f766e 0%, #115e59 55%, #0f172a 120%);
        color: #fff;
        border-radius: 24px;
        padding: 1.75rem;
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 1.25rem;
    }

    .ot-courses-inner h2 {
        margin: 0 0 0.5rem;
        font-size: 1.5rem;
    }

    .ot-courses-inner p {
        margin: 0;
        color: rgba(255, 255, 255, 0.85);
    }

    .ot-course-list {
        display: grid;
        gap: 0.65rem;
    }

    .ot-course-item {
        width: 100%;
        text-align: left;
        border: 1px solid rgba(255, 255, 255, 0.18);
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        border-radius: 14px;
        padding: 0.9rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .ot-course-item:hover {
        background: rgba(255, 255, 255, 0.16);
    }

    .ot-course-item span {
        font-size: 0.75rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .ot-footer {
        scroll-margin-top: 90px;
        background: #0b1220;
        color: #e2e8f0;
        margin-top: 1rem;
        padding: 2.5rem 1.25rem 1.5rem;
    }

    .ot-footer-grid {
        max-width: 1280px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr 1.2fr;
        gap: 2rem;
    }

    .ot-footer-brand {
        display: block;
        font-size: 1.2rem;
        color: #5eead4;
        margin-bottom: 0.5rem;
    }

    .ot-footer h3 {
        margin: 0 0 0.75rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
    }

    .ot-footer-link {
        display: block;
        width: 100%;
        text-align: left;
        background: transparent;
        border: none;
        color: #e2e8f0;
        padding: 0.35rem 0;
        cursor: pointer;
        font-weight: 600;
    }

    .ot-footer-link:hover {
        color: #5eead4;
    }

    .ot-contact {
        display: grid;
        gap: 0.55rem;
    }

    .ot-contact input,
    .ot-contact textarea {
        width: 100%;
        border: 1px solid #1e293b;
        background: #111827;
        color: #fff;
        border-radius: 10px;
        padding: 0.7rem 0.85rem;
        outline: none;
    }

    .ot-contact input:focus,
    .ot-contact textarea:focus {
        border-color: #14b8a6;
    }

    .ot-success {
        margin: 0.25rem 0 0;
        color: #5eead4;
        font-size: 0.85rem;
    }

    .ot-copy {
        max-width: 1280px;
        margin: 2rem auto 0;
        padding-top: 1.25rem;
        border-top: 1px solid #1e293b;
        color: #94a3b8;
        font-size: 0.85rem;
    }

    @media (max-width: 980px) {
        .ot-main {
            grid-template-columns: 1fr;
        }

        .ot-sidebar-card {
            position: static;
            max-height: none;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 0.35rem;
        }

        .ot-sidebar-card h2 {
            grid-column: 1 / -1;
        }

        .ot-courses-inner,
        .ot-footer-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .ot-hero {
            min-height: 300px;
            margin: 0.75rem;
            border-radius: 20px;
        }

        .ot-hero-content {
            padding: 1.5rem;
        }

        .ot-search {
            flex-direction: column;
        }
    }
</style>
