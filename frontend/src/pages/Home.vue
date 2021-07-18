<template>
    <!-- TEMPLATE -->
    <site-template>
        <!-- FORMULÁRIO DE INDICAÇÃO -->
        <form-indication :getIndications="getIndications"></form-indication>
        <br />
        <!-- INDICAÇÕES -->
        <div class="container mb-4">
            <div v-for="indication in indications.data" :key="indication.id">
                <indication :indication="indication"></indication>
            </div>
        </div>
    </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate';
import FormIndication from '@/components/FormIndication';
import Indication from '@/components/Indication';
import { api } from '@/services/api.js';

export default {
    name: 'Home',
    components: {
        SiteTemplate,
        FormIndication,
        Indication
    },
    data(){
        return{
            id: null,
            indications: []
        }
    },
    created(){
        this.init();
    },
    methods:{
        init(){
            this.getIndications();
        },
        getIndications(){
            // MÉTODO AXIOS - PEGAR INDICAÇÕES
            api.get(`indications`)
            .then(response => {
                this.indications = response.data;
                console.log(this.indications);
            })
            .catch(e => {
                // NOTIFICAÇÃO
                this.$notify({
                    closeOnClick: true,
                    type: 'error',
                    text: 'Indicação não localizada!',
                    position: 'top right'
                });
            });
        },
    }
}
</script>

<style scoped>
</style>
