let userindex = require('./components/UserEnd/index.vue').default
let adminusers = require('./components/AdminEnd/users.vue').default
let adminhome = require('./components/AdminEnd/index.vue').default
let category = require('./components/AdminEnd/category.vue').default
let PageNotFound = require('./components/PageNotFound.vue').default
export const routes = [
    ///user side routes
    { path: '/', name: '/', component: userindex },
    { path: '/adminuser', name: '/adminuser', component: adminusers },
    { path: '/home', name: '/home', component: adminhome },
    { path: '/category', name: '/category', component: category },
    {
        path: '*',

        component: PageNotFound
    },
    //end of user side routes



]