export default {
    namespaced: true,

    state:
    {
        userLogIn: '',
    },

    getters:{
        getUserLogIn(state){
            return state.userLogIn
          },
    },

    mutations: 
    {
        setUserLogin(state, data){
            state.userLogIn= data
        },       
    },

    actions: 
    {
        getUserLogIn({commit}){
            axios.get('getLogInUser').then((response) =>{
                // console.log(response.data)
                commit('setUserLogin', response.data)
            }).catch(error => console.log(error))
        },
    },

  };
