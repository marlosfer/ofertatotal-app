<template>
    <div style="height: 800px;">
        <h4><center>EM BREVE</center></h4>
        <b-table striped hover :items="items" :fields="fields">
            <template #cell(user)="row">
                {{ getBrowserInfo(row.item.user) }}
            </template>
            <template #cell(created_at)="row">
                {{ formater(row.item.created_at) }}
            </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                selectedRadio: 'A',
                fields: ['description', 'email', 'user', 'created_at'],
                fields: [
			        { key: 'description', sortable: true, sorter: null, label: 'Descrição' },
			        { key: 'email', sortable: true, sorter: null, label: 'Email' },
			        { key: 'user', sortable: true, sorter: null, label: 'Aparelho' },
			        { key: 'created_at', label: 'Data de envio' },
                ],
                items: [],
            }
        },
        mounted() {
            this.getSusgestions();
        },
        methods: {
            formater(created_at) {
                const date = new Date(created_at);

                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const year = date.getFullYear();
                const hours = date.getHours().toString().padStart(2, '0');
                const minutes = date.getMinutes().toString().padStart(2, '0');
                const seconds = date.getSeconds().toString().padStart(2, '0');

                return `${hours}:${minutes}:${seconds} - ${day}/${month}/${year}`;
            },
            getBrowserInfo(userAgent) {
                const browserInfo = this.parseUserAgent(userAgent);
                return `${browserInfo.name} ${browserInfo.version} em ${browserInfo.os}`;
            },
            parseUserAgent(userAgent) {
                const lowerAgent = userAgent.toLowerCase();

                if (lowerAgent.includes('chrome')) {
                    return { name: 'Chrome', version: '...', os: '...' };
                } else if (lowerAgent.includes('firefox')) {
                    return { name: 'Firefox', version: '...', os: '...' };
                }
                // Adicione mais verificações para outros navegadores conforme necessário

                // Caso padrão
                return { name: 'Desconhecido', version: '...', os: '...' };
            },
            getSusgestions() {
                axios.get('get-susgestions',{
                }).then(res => {
                    if(res.data.success){
                        this.items = res.data.value;
                    }
                })
                .catch(err => {
                    console.error(err); 
                });
            },
        },
        computed: {
            validateTextName() {
            },
        },
    }
</script>

<style scoped>
</style>


