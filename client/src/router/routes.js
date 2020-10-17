import error404 from 'srcFolder/views/errors/404'
import loginPage from 'srcFolder/views/login/index'
import clientsPage from 'srcFolder/views/clients/index'

export default [
    { path: '/', redirect: '/clientes' },

    { path: '*',  component: error404 },

    { path: '/login', name: 'login', component: loginPage, meta: { guest: true } },

    // Admin
    { path: '/clientes', name: 'clients', component: clientsPage, meta: { auth: true } },
]