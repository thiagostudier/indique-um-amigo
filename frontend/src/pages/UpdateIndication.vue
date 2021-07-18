<template>
    <!-- TEMPLATE -->
    <site-template>
        <!-- FORMULÁRIO DE INDICAÇÃO -->
        <form-indication :id="id"></form-indication>
    </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate';
import FormIndication from '@/components/FormIndication';

export default {
    name: 'UpdateIndication',
    components: {
        SiteTemplate,
        FormIndication,
    },
    props: ['id']
}
</script>

<style scoped>
</style>
