<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="6">
            <v-card class="elevation-12">
                  <v-row>
                    <v-col cols="12" md="8">
                      <v-card-text class="mt-5">
                        <h1
                          class="text-center display-2 blue-grey--text text--accent-3"
                        >Log in to Admin</h1>
                        <v-form>
                          <v-text-field
                            v-model="formLogin.email"
                            label="Email"
                            name="Email"
                            prepend-icon="mdi-email"
                            type="text"
                            color="blue-grey accent-3"
                          />

                          <v-text-field
                            v-model="formLogin.password"
                            id="password"
                            label="Password"
                            name="password"
                            prepend-icon="mdi-lock"
                            type="password"
                            color="blue-grey accent-3"
                          />
                        </v-form>
                        <h3 class="text-center mt-4">Forgot your password ?</h3>
                      </v-card-text>
                      <div class="text-center ma-3">
                        <v-btn rounded color="blue-grey accent-3" @click.prevent="login" dark>LOG IN</v-btn>
                      </div>
                    </v-col>
                    <v-col cols="12" md="4" class="blue-grey accent-3">
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Lorem, Ipsum!</h1>
                        <h5
                          class="text-center"
                        >Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, molestias!</h5>
                      </v-card-text>
                      <div class="text-center">
                        <v-btn rounded outlined dark :to="{ name: 'register' }">Register Now!</v-btn>
                      </div>
                    </v-col>
                  </v-row>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
    data() {
      return {
        formLogin: new Form({
          email: '',
          password: '',
        }),
      }
    },

    methods: {
      login() {
        this.$store.dispatch('Auth/login', this.formLogin);
      },
    },
};
</script>