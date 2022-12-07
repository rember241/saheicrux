import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import AuthModule from './modules/Auth/auth.js';
import CrudModule from './modules/Crud/crud.js';
import MenuModule from './modules/Menu/menu.js';
import PermissionModule from './modules/Previligies/permission.js';
import RoleModule from './modules/Previligies/role.js';
import UserModule from './modules/Previligies/user.js';


export default new Vuex.Store({
    modules: {
        Auth: AuthModule,
        Crud: CrudModule,
        Menu: MenuModule,
        Permission: PermissionModule,
        Role: RoleModule,
        User: UserModule,
    },
})
