<template>
    <v-app id="main">
        <navbar ref="navbar" v-if="token"></navbar>

        <app-header @toggle-drawer="$refs.navbar.drawer = !$refs.navbar.drawer" v-if="token"></app-header>

        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>

        <app-footer v-if="token"></app-footer>
    </v-app>

</template>

<script>
import Navbar from './Navbar'
import Header from './Header'
import Footer from './Footer'

export default {
    name: 'App',
    components: {
        'navbar': Navbar,
        'app-header': Header,
        'app-footer': Footer
    },
  data() {
    var userData = JSON.parse(localStorage.getItem("authUserData"))
    return {
      token: userData ? userData.token : null,
    };
  },
  created() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.token}`;

    if(this.token){
      this.$store.dispatch('User/getUserLogIn');
    }
  },
}
</script>
