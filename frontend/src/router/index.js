import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
import UpdateIndication from '@/pages/UpdateIndication'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/update-indication/:id',
      name: 'UpdateIndication',
      props: true,
      component: UpdateIndication,
    }
  ]
})
