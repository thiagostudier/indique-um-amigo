<template>
    <footer>
        <div class="container">
            <div class="row">
                <img src="/static/images/logo-footer.png" alt="Logo" class="logo-footer"/>
                <div>
                    <p class="text-footer">© 2021 Sistema de Indicação</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>

export default {
    name: 'FooterVue',
}
</script>

<style scoped>

    footer{
        margin-top: 50px;
        background: #d25a5a;
        padding: 15px 0px;
    }

    footer .row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    footer .logo-footer{
        height: 35px;
    }

    footer .text-footer{
        margin-bottom: 0px;
        color: white;
    }

</style>
