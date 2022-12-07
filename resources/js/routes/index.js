import Dashboard from '../pages/Dashboard.vue'
import Login from '../pages/Auth/Login.vue'
import Register from '../pages/Auth/Register.vue'
import User from '../pages/Settings/Users.vue'
import Role from '../pages/Settings/Roles.vue'
import Permission from '../pages/Settings/Permission.vue'
import Menu from '../pages/Settings/Menus.vue'

export default {
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            // meta: { requiresAuth: true }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { guest: true }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: { guest: true }
        },
        {
            path: '/users',
            name: 'users',
            component: User,
            meta: { requiresAuth: true }
        },
        {
            path: '/roles',
            name: 'roles',
            component: Role,
            meta: { requiresAuth: true }
        },
        {
            path: '/permissions',
            name: 'permissions',
            component: Permission,
            meta: { requiresAuth: true }
        },
        {
            path: '/menus',
            name: 'menus',
            component: Menu,
            meta: { requiresAuth: true }
        },
    ]
}
