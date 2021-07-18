<template>
    <div>
        <h1 v-if="!this.edit" class="title">Nova indicação</h1>
        <h1 v-if="this.edit" class="title">Editar indicação</h1>
        <div class="form">
            <div class="row">
                <!-- NOME -->
                <div class="form-group col-12 col-md" :class="{ 'form-group-add-error' : errors.name }">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" v-model="newIndication.name" />
                    <small v-if="errors.name" class="form-text text-muted">{{errors.name[0]}}</small>
                </div>  
                <!-- E-MAIL -->
                <div class="form-group col-12 col-md" :class="{ 'form-group-add-error' : errors.email }">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" v-model="newIndication.email" />
                    <small v-if="errors.email" class="form-text text-muted">{{errors.email[0]}}</small>
                </div>                
            </div>   
            <div class="row">
                <!-- CELULAR -->
                <div class="form-group col-12 col-md" :class="{ 'form-group-add-error' : errors.phone }">
                    <label for="phone">Celular</label>
                    <the-mask type="text" masked :mask="['(##)####-####','(##)#####-####']" class="form-control" id="phone" v-model="newIndication.phone" placeholder="(000)00000-0000"></the-mask>
                    <small v-if="errors.phone" class="form-text text-muted">{{errors.phone[0]}}</small>
                </div>  
                <!-- CPF -->
                <div class="form-group col-12 col-md" :class="{ 'form-group-add-error' : errors.cpf }">
                    <label for="cpf">CPF</label>
                    <the-mask type="text" masked :mask="['###.###.###-##']" class="form-control" id="cpf" v-model="newIndication.cpf" placeholder="000.000.000-00"></the-mask>
                    <small v-if="errors.cpf" class="form-text text-muted">{{errors.cpf[0]}}</small>
                </div>                
            </div>            
            <div class="d-flex">
                <!-- CRIAR -->
                <button v-if="!this.edit" class="btn btn-send d-block ml-auto" v-on:click="createIndication()">Indicar</button>
                <!-- REMOVER -->
                <button v-if="this.edit" class="btn btn-remove d-block mr-auto" v-on:click="removeIndication()">Apagar</button>
                <!-- ALTERAR -->
                <button v-if="this.edit" class="btn btn-send d-block ml-auto" v-on:click="updateIndication()">Editar</button>
            </div>
        </div>

    </div>

</template>

<script>

import { TheMask } from 'vue-the-mask';
import { api } from '@/services/api.js';

export default {
    name: 'FormnewIndication',
    components:{
        TheMask
    },
    props: {
        id: String,
        getIndications: Function,
    },
    data(){
        return{
            edit: false,
            newIndication:{
                name: null,
                email: null,
                cpf: null,
                phone: null,
            },
            errors:{
                name: null,
                email: null,
                cpf: null,
                phone: null,
            },
        }
    },
    created(){
        if(this.id){
            this.getIndication(this.id);
        }
    },
    methods: {
        createIndication(){
            // LIMPAR ERROS
            this.clearErrors(); 
            // MÉTODO AXIOS - CRIAR INDICAÇÃO
            api.post(`indications`, 
            {
                name: this.newIndication.name, 
                email: this.newIndication.email, 
                cpf: this.newIndication.cpf, 
                phone: this.newIndication.phone, 
            })
            .then(response => {
                if(response.status == 201){
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'success',
                        text: 'Indicação registrada!',
                        position: 'top right'
                    });
                    // LIMPAR ERROS
                    this.clearErrors();
                    // LIMPAR DADOS
                    this.newIndication.name = null;
                    this.newIndication.email = null;
                    this.newIndication.cpf = null;
                    this.newIndication.phone = null;
                    // REINICIAR LISTAGEM
                    this.getIndications();
                }else{
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'error',
                        text: 'Houve algum erro ao cadastrar a indicação!',
                        position: 'top right'
                    });
                }
            })
            .catch(e => {
                // PEGAR OS ERROS
                this.errors = e.response.data.errors;
                // NOTIFICAÇÃO
                this.$notify({
                    closeOnClick: true,
                    type: 'error',
                    text: 'Houve algum erro ao cadastrar a indicação!',
                    position: 'top right'
                });
            });
        },
        updateIndication(){
            // LIMPAR ERROS
            this.clearErrors();
            // MÉTODO AXIOS - EDITAR INDICAÇÃO
            api.patch(`indications/`+this.id, 
            {
                name: this.newIndication.name, 
                email: this.newIndication.email, 
                cpf: this.newIndication.cpf, 
                phone: this.newIndication.phone
            })
            .then(response => {
                if(response.status == 200){
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'success',
                        text: 'Indicação cadastrada com sucesso!',
                        position: 'top right'
                    });
                    // RETORNAR PARA A HOME
                    this.$router.push('/');
                }else{
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'error',
                        text: 'Houve algum erro ao atualizar a indicação!',
                        position: 'top right'
                    });
                }
            })
            .catch(e => {
                // PEGAR OS ERROS
                this.errors = e.response.data.errors;
                // NOTIFICAÇÃO
                this.$notify({
                    closeOnClick: true,
                    type: 'error',
                    text: 'Houve algum erro ao atualizar a indicação!',
                    position: 'top right'
                });
            });
        },
        getIndication(id){
            // MÉTODO AXIOS - PEGAR INDICAÇÕES
            api.get(`indications/`+id)
            .then(response => {
                // PEGAR OS DADOS DA INDICAÇÃO
                this.edit = true;
                this.newIndication.name = response.data.name;
                this.newIndication.email = response.data.email;
                this.newIndication.cpf = response.data.cpf;
                this.newIndication.phone = response.data.phone;
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
        removeIndication(){
            // MÉTODO AXIOS - REMOVER INDICAÇÃO
            api.delete(`indications/`+this.id)
            .then(response => {
                // SE HOUVER ERRO NA REMOÇÃO
                if(response.data.errors){
                    this.errors = response.data.errors;
                }else{
                    // NOTIFICAÇÃO
                    this.$notify({
                        closeOnClick: true,
                        type: 'success',
                        text: 'Indicação removida com sucesso!',
                        position: 'top right'
                    });
                    // RETORNAR PARA O DASHBOARD
                    this.$router.push('/');
                }
                
            })
            .catch(e => {
                // NOTIFICAÇÃO
                this.$notify({
                    closeOnClick: true,
                    type: 'error',
                    text: 'Houve algum erro ao cadastrar a indicação!',
                    position: 'top right'
                });
            });
        },
        clearErrors(){
            this.errors.name = null;
            this.errors.email = null;
            this.errors.cpf = null;
            this.errors.phone = null;
        }
    }
}
</script>

<style scoped>



</style>