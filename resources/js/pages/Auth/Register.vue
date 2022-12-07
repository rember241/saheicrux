<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="6">
            <v-card class="elevation-12">
                  <v-row>
                    <v-col cols="12" md="12">
                      <v-card-text class="mt-5">
                        <h1
                          class="text-center display-2 blue-grey--text text--accent-3"
                        >Create New Account</h1>
                        <v-form>
                          <v-text-field
                            v-model="form.name"
                            label="Name"
                            name="Name"
                            prepend-icon="mdi-account"
                            type="text"
                            color="teal accent-3"
                          />
                          <v-text-field
                            v-model="form.email"
                            label="Email"
                            name="Email"
                            prepend-icon="mdi-email"
                            type="text"
                            color="teal accent-3"
                          />

                          <v-text-field
                            v-model="form.password"
                            id="password"
                            label="Password"
                            name="password"
                            prepend-icon="mdi-lock"
                            type="password"
                            color="teal accent-3"
                          />

                          <v-text-field
                            v-model="form.password_confirmation"
                            id="confirm-password"
                            label="Confirm Password"
                            name="confirm password"
                            prepend-icon="mdi-lock"
                            type="password"
                            color="teal accent-3"
                          />
                        </v-form>
                      </v-card-text>
                      <div class="text-center ma-3">
                        <v-btn @click.prevent="register" rounded color="blue-grey accent-3" dark>Register</v-btn>
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
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }),
        }
    },
    methods: {
      register() {
        this.$store.dispatch('Auth/register', this.form);
      }
  }
};
</script>