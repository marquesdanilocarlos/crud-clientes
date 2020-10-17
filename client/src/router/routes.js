import error404 from 'srcFolder/components/errors/404'
import loginPage from 'srcFolder/components/login/index'
import clientsPage from 'srcFolder/components/clients/index'
import registerPage from 'srcFolder/components/clients/register'

export default [
    { path: '/', redirect: '/clientes' },

    { path: '*',  component: error404 },

    { path: '/login', name: 'login', component: loginPage, meta: { guest: true } },
    { path: '/cadastro', name: 'cadastro', component: registerPage, meta: { guest: true } },

    // Admin
    { path: '/clientes', name: 'clients', component: clientsPage, meta: { auth: true } },
]
