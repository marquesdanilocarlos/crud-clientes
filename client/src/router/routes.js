import error404 from 'srcFolder/components/errors/404'
import loginPage from 'srcFolder/components/login/Index'
import clientsList from 'srcFolder/components/clients/Index'
import clientsCreate from 'srcFolder/components/clients/Create'
import clientsEdit from 'srcFolder/components/clients/Edit'
import registerPage from 'srcFolder/components/user/Register'

export default [
    { path: '/', redirect: '/clientes' },

    { path: '*',  component: error404 },

    //Login
    { path: '/login', name: 'login', component: loginPage, meta: { guest: true } },
    { path: '/cadastro', name: 'cadastro', component: registerPage, meta: { guest: true } },

    // Clients
    { path: '/clientes', name: 'clients', component: clientsList, meta: { auth: true } },
    { path: '/clientes/novo', name: 'create', component: clientsCreate, meta: { auth: true } },
    { path: '/clientes/editar/:id', name: 'edit', component: clientsEdit, meta: { auth: true } },
]
