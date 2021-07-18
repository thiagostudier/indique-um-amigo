<template>
  <header>
    <div class="container">
      <img src="/static/images/header-logo.png" /> 
      <div class="buttons-header">
        <router-link class="btn btn-login" to="/">Tela Inicial</router-link>
      </div>
    </div>
  </header>
</template>

<script>

export default {
  name: 'HeaderVue',
  data(){
    return{
      
    }
  },
}
</script>

<style scoped>

  header{
    margin-bottom: 25px;
    padding: 15px 0px;
    background: #a7a7a7;
  }

  img{
    height: 18px;
  }

  .buttons-header{
    margin-left: auto;
  }

  div.container{
    display: flex;
    align-items: center;
  }

  span{
    font-family: rubik,Sans-serif;
    padding: 12px 24px;
  }

</style>
