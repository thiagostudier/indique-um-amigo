<template>
    <div class="indication">
        <h3>{{indication.name}}</h3>
        <p>{{indication.email}} | {{indication.cpf}} | {{indication.phone}}</p>
        <!-- ATUALIZAR STATUS DA INDICAÇÃO   -->
        <div class="status-meeting">
            <div class="status-meeting-items">
                <span :class="{ 'active' : indication.status.name == 'INICIADA' }">INICIADA</span>
                <span :class="{ 'active' : indication.status.name == 'EM PROCESSO' }">EM PROCESSO</span>
                <span :class="{ 'active' : indication.status.name == 'FINALIZADA' }">FINALIZADA</span>
            </div>
            <div class="status-meeting-buttom">
                <button class="status-meeting-button" v-on:click="updateStatus(indication.id)">AVANÇAR</button>
            </div>
        </div>
        <!-- BOTÃO DE EDITAR -->
        <div class="edit">
            <router-link :to="'/update-indication/'+indication.id"><i class="icon-edit fa fa-pencil" aria-hidden="true"></i> Editar</router-link>
        </div>
    </div>
</template>

<script>

import { api } from '@/services/api.js';

export default {
    name: 'Indication',
    props: ['indication'],
    data(){
        return{
        }
    },
    created(){
    },
    methods: {
        updateStatus(id){
            // MÉTODO AXIOS - ATUALIZAR STATUS DA INDICAÇÃO
            api.patch(`indications-status/`+id)
            .then(response => {
                if(response.data.errors){
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'error',
                        text: response.data.errors,
                        position: 'top right'
                    });
                }else{
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'success',
                        text: 'Ação realizada com sucesso!',
                        position: 'top right'
                    });
                    // ATUALIZAR STATUS
                    this.indication.status = response.data;
                }
            })
            .catch(e => {
                // NOTIFICAÇÃO
                this.$notify({
                    closeOnClick: true,
                    type: 'error',
                    text: 'Houve algum erro ao realizar a ação!',
                    position: 'top right'
                });
            });
        },
    }
}
</script>

<style scoped>

.indication{
    margin-bottom: 15px;
    border-left: 10px solid #d25a5a !important;
    padding: 5px 20px;
    border: 1px solid #f3f3f3;
    position: relative;
}

h3{font-family: rubik,Sans-serif;margin-bottom: 5px;}

p{margin-bottom: 0px;}

.author{font-size: 20px;margin-bottom: 2px;}

.edit{
    position: absolute;
    top: 0px;
    right: 11px;
    padding: 0px 4px;
}

.edit a{
    background: #fff;
    border: none;
    font-size: 14px;
    font-family: rubik,Sans-serif;
    font-weight: 500;
    color: #8e8282;
    cursor: pointer;
    text-decoration: none;
}

.status-meeting{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}

.status-meeting span{
    font-size: 14px;
    font-family: rubik,Sans-serif;
    color: #8e8282;
    font-weight: 500;
}

.status-meeting span.active{
    color: #16b316;
}

.status-meeting-button {
    background: #d25a5a;
    font-size: 14px;
    font-family: rubik,Sans-serif;
    font-weight: 500;
    color: #fff;
    cursor: pointer;
    border: 1px solid #f3f3f3;
    border-radius: 5px;
}

.icon-accept{color: #16b316;}
.icon-refuse{color: red}

</style>
