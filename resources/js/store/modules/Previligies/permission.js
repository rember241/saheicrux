export default {
    namespaced: true,

    state:
    {
      selectedId: null,
      userPermission: []
    },

    getters:{
      selectedId(state){
          return state.selectedId
      },
      getPermisssion(state){
        return state.userPermission
      }
    },

    mutations: 
    {
        updateResources: (state,payload) =>{
            state.resources = payload
        },
        updateId: (state,payload) =>{
            state.selectedId = payload
        },
        assignRoles: (state,menus) => {
            let data = JSON.stringify(menus)
            const res = axios.post('assign/permission', {'permission' : data, role_id: state.selectedId})
            if(res.status==200){
                this.success('Role has been assigned successfully!')
                // let index = this.roles.findIndex(role => role.role_id == state.selectedId)
                // state.roles[index].permission = data
                // this.$toastr.s("assign role succefully", "Assign");
            }else{
                this.$toastr.e("Cannot assign roles", "Error");
            }
        },
        setUserPermission(state, data){
          state.userPermission = data
      }
    },

    actions: 
    {
      updateResources({commit},payload){
          commit('updateResources',payload);
      },
      updateId({commit},payload){
          commit('updateId',payload);
      },
      assignRoles({commit},menus){
          location.reload();
          commit('assignRoles',menus);
      },
      getUserPermission({commit}){
        axios.get('permissions').then((response) =>{
          // commit('setUserPermission', response.data)
          console.log(response.data)
      }).catch(error => console.log(error))
      }
    },
  };
