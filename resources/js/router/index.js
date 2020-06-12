
import Vue from 'vue'
import Router from 'vue-router'

import DashBoard from '../components/DashBoard'
import Doner from '../components/Doner'

Vue.use(Router)

const mainRoutes = [
    { path: '/', component: DashBoard },
    { path: '/doners', component: Doner },

]

export default new Router({
    // mode: 'history',
    routes: mainRoutes
})