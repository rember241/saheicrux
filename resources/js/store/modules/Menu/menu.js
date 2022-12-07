export default {
    namespaced: true,

    state:
    {
        menus: [],
        editedIndex: -1,
        defaultItem: {
          menu_id: '',
          title: '',
          icon: '',
          path: '',
          parent_id: 0,
          isActive: true,
          color: ''
        },
        editedItem: {
            menu_id: '',
            title: '',
            icon: '',
            parent_id: '',
            parent: 0,
            isActive: true,
            color: ''
          },
        selectedId: null,

    },

    getters:{
        menus: state => {
            return state.menus
        },
        editedIndex: state => {
            return state.editedIndex
        },
        defaultItem: state => {
            return state.defaultItem
        },
        editedItem: state => {
            return state.editedItem
        }
    },

    mutations: 
    {
        updateDialog: (state,payload) =>{
            state.dialog = payload
        },
        updateDialogDelete: (state,payload) =>{
            state.dialogDelete = payload
        },
        updateEditedIndex: (state,payload) =>{
            state.editedIndex = payload
        },
        updateDefaultItem: (state,payload) =>{
            state.defaultItem = payload
        },
        updateEditItem: (state,payload) =>{
            state.editedItem = payload
        },
        add_menu(state,data){
            state.menus.push(data)
        },
        update_menu(state,data){
            const index = state.menus.findIndex(menu => menu.menu_id === data.menu_id);
            if(index !== -1) {
                state.menus.splice(index, 1, data);
            }
        },
        set_menus(state,data){
            state.menus = data.filter(menu => menu.menu_id);
        },
        changeAdmin:(state,roles) => {
            let index = roles.findIndex(role => role.role_id == state.selectedId)
            console.log(index)
            let permission = roles[index].permission
            console.log(permission)
            // if(!permission){
            //     state.menus = state.defaultResourcesPermission
            // }else{
            //     state.menus = JSON.parse(permission)
            // }
        },     
    },

    actions: 
    {
        updateDialog({commit},payload){
            commit('updateDialog',payload);
        },
        updateDialogDelete({commit},payload){
            commit('updateDialogDelete',payload);
        },
        updateEditedIndex({commit},payload){
            commit('updateEditedIndex',payload);
        },
        updateDefaultItem({commit},payload){
            commit('updateDefaultItem',payload);
        },
        updateEditItem({commit},payload){
            commit('updateEditItem',payload);
        },
        addMenu({commit}, data) {
            axios.post('menu/create', data)
                .then(response => {
                // toast.fire({
                //     icon: 'success',
                //     title: "menu create succefully"
                // })
                location.reload();
                commit('add_role', response.data)
                })
                .catch(error => console.log(error))
            },
            updateMenu({commit},data){
                axios.put(`/menu/update/${data.menu_id}`,data).then((response) =>{
                    // toast.fire({
                    //     icon: 'success',
                    //     title: "menu successfully updated"
                    // })
                    location.reload();
                    commit('update_menu', response.data)
                }).catch(error => console.log(error))
            },
            changeAdmin({commit},roles){
                commit('changeAdmin',roles);
            },
          getMenus({commit}){
            axios.get('menus').then((response) =>{
                commit('set_menus', response.data)
            }).catch(error => console.log(error))
        },

    },

  };
