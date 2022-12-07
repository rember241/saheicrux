export default {
    namespaced: true,

    state:
    {
      token: null,
      userId: null,
    },

    mutations: 
    {
      authUser (state, userData) {
        state.token = userData.token
        state.userId = userData.userId
      },
    },

    actions: 
    {
      login ({commit}, authData) {
        axios.post('login', authData)
          .then(res => {
            location.reload();
            var userData = {
              "token": res.data.token,
               "userId": res.data.user.id,
              }
            localStorage.setItem("authUserData", JSON.stringify(userData));
            commit('authUser', {
              token: res.data.token,
              userId: res.data.user.id,
            })
          })
          .catch(error => console.log(error))
      },

      register ({commit}, authData) {
        axios.post('register', authData)
          .then(res => {
            console.log(res)
            location.reload();
            commit('authUser', {
              token: res.data.token,
            })
            localStorage.setItem('token', res.data.token)
          })
          .catch(error => console.log(error))
      }
    },
  };
