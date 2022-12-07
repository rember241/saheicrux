export default {
    namespaced: true,

    state:
    {
        roles: [],
    },

    getters:{
        roles: state => {
            return state.roles
        },
    },

    mutations: 
    {
        set_roles(state,data)
        {
            state.roles = data
        },     
    },

    actions: 
    {
        getRoles({commit})
        {
            axios.get('roles').then((response) =>{
                commit('set_roles', response.data)
            }).catch(error => console.log(error))
        },
    },

  };
