<template>
    <header class="ot-header">
        <nav class="ot-nav">
            <a class="ot-brand" href="#" @click.prevent="irPara('inicio')">
                <img src="/images/ofertatotal.png" alt="OfertaTotal" class="ot-brand-logo" />
                <span class="ot-brand-text">OfertaTotal</span>
            </a>

            <button
                class="ot-toggler"
                type="button"
                :aria-expanded="menuAberto ? 'true' : 'false'"
                aria-label="Abrir menu"
                @click="menuAberto = !menuAberto"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="ot-nav-collapse" :class="{ 'is-open': menuAberto }">
                <ul class="ot-nav-links">
                    <li>
                        <a
                            href="#produtos"
                            class="ot-link"
                            :class="{ active: secaoAtiva === 'produtos' }"
                            @click.prevent="irPara('produtos')"
                        >
                            Produtos
                        </a>
                    </li>
                    <li>
                        <a
                            href="#cursos"
                            class="ot-link"
                            :class="{ active: secaoAtiva === 'cursos' }"
                            @click.prevent="irPara('cursos')"
                        >
                            Cursos
                        </a>
                    </li>
                    <li>
                        <a
                            href="#contato"
                            class="ot-link"
                            :class="{ active: secaoAtiva === 'contato' }"
                            @click.prevent="irPara('contato')"
                        >
                            Contato
                        </a>
                    </li>
                </ul>

                <div class="ot-nav-actions">
                    <div class="ot-user" @click="dropdownAberto = !dropdownAberto">
                        <span class="ot-avatar">M</span>
                        <span class="ot-user-name">Marlos</span>
                        <svg class="ot-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div v-show="dropdownAberto" class="ot-dropdown" @click.stop>
                            <a href="/logout" class="ot-dropdown-item" @click.prevent="sair">
                                Sair da conta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        data() {
            return {
                menuAberto: false,
                dropdownAberto: false,
                secaoAtiva: 'produtos',
            }
        },
        mounted() {
            document.addEventListener('click', this.fecharDropdown)
        },
        beforeDestroy() {
            document.removeEventListener('click', this.fecharDropdown)
        },
        methods: {
            irPara(secao) {
                this.secaoAtiva = secao === 'inicio' ? 'produtos' : secao
                this.menuAberto = false

                const mapa = {
                    inicio: 'inicio',
                    produtos: 'produtos',
                    cursos: 'cursos',
                    contato: 'contato',
                }

                const el = document.getElementById(mapa[secao] || secao)
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' })
                }

                this.$root.$emit('navegar-secao', secao)
            },
            sair() {
                this.dropdownAberto = false
                window.location.href = '/logout'
            },
            fecharDropdown(e) {
                if (!this.$el.contains(e.target)) {
                    this.dropdownAberto = false
                }
            },
        },
    }
</script>

<style scoped>
    .ot-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .ot-nav {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .ot-brand {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        text-decoration: none;
        flex-shrink: 0;
    }

    .ot-brand-logo {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .ot-brand-text {
        font-family: 'Segoe UI', 'Nunito', sans-serif;
        font-weight: 800;
        font-size: 1.15rem;
        letter-spacing: -0.02em;
        color: #0f766e;
    }

    .ot-toggler {
        display: none;
        margin-left: auto;
        width: 42px;
        height: 42px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #fff;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
    }

    .ot-toggler span {
        display: block;
        width: 18px;
        height: 2px;
        background: #0f172a;
        border-radius: 2px;
    }

    .ot-nav-collapse {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex: 1;
        gap: 1rem;
    }

    .ot-nav-links {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .ot-link {
        display: inline-flex;
        align-items: center;
        padding: 0.55rem 0.95rem;
        border-radius: 999px;
        text-decoration: none;
        color: #475569;
        font-weight: 600;
        font-size: 0.92rem;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .ot-link:hover,
    .ot-link.active {
        background: #ecfdf5;
        color: #0f766e;
    }

    .ot-nav-actions {
        margin-left: auto;
    }

    .ot-user {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        padding: 0.35rem 0.7rem 0.35rem 0.35rem;
        border-radius: 999px;
        border: 1px solid #e2e8f0;
        background: #fff;
        cursor: pointer;
        user-select: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .ot-user:hover {
        border-color: #99f6e4;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.08);
    }

    .ot-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f766e, #14b8a6);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .ot-user-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.9rem;
    }

    .ot-chevron {
        color: #64748b;
    }

    .ot-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 180px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
        padding: 0.4rem;
        z-index: 20;
    }

    .ot-dropdown-item {
        display: block;
        padding: 0.7rem 0.85rem;
        border-radius: 8px;
        text-decoration: none;
        color: #b91c1c;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .ot-dropdown-item:hover {
        background: #fef2f2;
    }

    @media (max-width: 768px) {
        .ot-toggler {
            display: inline-flex;
        }

        .ot-nav-collapse {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            flex-direction: column;
            align-items: stretch;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem 1.25rem;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        .ot-nav-collapse.is-open {
            display: flex;
        }

        .ot-nav-links {
            flex-direction: column;
            align-items: stretch;
        }

        .ot-nav-actions {
            margin-left: 0;
            margin-top: 0.75rem;
        }

        .ot-user {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>
