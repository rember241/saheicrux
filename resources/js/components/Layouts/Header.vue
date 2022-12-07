<template>
    <v-app-bar app color="white">
        <v-app-bar-nav-icon @click.stop="$emit('toggle-drawer')"></v-app-bar-nav-icon>
        <v-spacer></v-spacer>
        <!-- <v-btn icon>
        <v-icon>mdi-bell</v-icon>
        </v-btn> -->

        <v-btn icon>
        <v-icon> mdi-format-list-bulleted</v-icon>
        </v-btn>
        
        <v-menu
        open-on-hover
        close-on-content-click
        
        >
        <template v-slot:activator="{ on }">
            <v-btn
            color="grey darken-3"
            text
            v-on="on"
            >
                <v-icon left>mdi-account-cog</v-icon>{{userLogIn.name}}<v-divider class="px-2" vertical></v-divider>
                <v-icon right>mdi-chevron-down</v-icon> 
            </v-btn>
        </template>
        <v-list>
          <v-list-item>
                <form @submit.prevent="logout" class="d-inline-flex align-center">
                    <v-btn text type="submit" class="sideButton">
                        <v-icon>mdi-logout</v-icon>
                        Logout
                    </v-btn>
                </form>
          </v-list-item>
        </v-list>
        </v-menu>
    </v-app-bar>
</template>
<script>
export default {
      data: () => ({
  }),

  computed:{
    userLogIn() {
      return this.$store.getters['User/getUserLogIn'];
    },
  },

    methods: {
      logout(){
          axios.post('logout').then((response) => {
              localStorage.removeItem('authUserData')
              this.$router.go('/login')
          }).catch((errors) => {
              console.log(errors)
          })
      }
    },
}
</script>
