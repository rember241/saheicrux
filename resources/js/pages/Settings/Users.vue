<template>
  <data-table 
    :dataSource="users"
    :table_headers="headers" 
    :table_title="'All Users'" 
    :newFormTitle="'New User'"
    :editFormTitle="'Edit User'"
    :defaultItem="defaultItem"
    @showDataWithPagination ="showDataWithPagination"
    @add ="addItem"
    @update ="updateItem"
    @remove ="deleteItem"
    >
    <template v-slot="editedItem">
      <v-container v-if="editedItem.field">
        <v-row>
            <v-col
              cols="12"
              sm="6"
              md="12"
            >
              <v-text-field
                v-model="editedItem.field.name"
                label="Name"
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6"
              md="12"
            >
              <v-text-field
                v-model="editedItem.field.email"
                label="Email"
                :type="'email'"
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6"
              md="12"
            >
              <v-select
                v-model="editedItem.field.role_id"
                :items="roles"
                item-text="roleName"
                item-value="role_id"
                label="Select Role"
              ></v-select>
            </v-col>
            <v-col
              cols="12"
              sm="6"
              md="12"
            >
              <v-text-field
                v-model="editedItem.field.password"
                label="Password"
                :type="'password'"
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6"
              md="12"
            >
              <v-text-field
                v-model="editedItem.field.password_confirmation"
                label="Confirm Password"
                :type="'password'"
              ></v-text-field>
            </v-col>
        </v-row>
      </v-container>
    </template>
  </data-table>
</template>
<script>
export default {
    data: () => ({
      headers: [
        { text: 'Name', value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'roleName' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      users: [],
      defaultItem: {
          id: '',
          name: '',
          password: '',
          password_confirmation: '',
          email: '',
          role_id: 1,
        },
        editedItem: {
            id: '',
            name: '',
            password: '',
            password_confirmation: '',
            email: '',
            role_id: 1,
          },
    }),

    computed: {
      roles() {
        return this.$store.getters['Role/roles'];
      },
    },

    methods:{
    showDataWithPagination(data)
    {
        data.obj.apiUrl = 'usersPagination'
    },
    addItem (data) {
        data.obj.toastSuccess = 'User create succefully'
        data.obj.toastError = 'Cannot create User, try again'
        data.obj.apiUrl = 'user/create'
        data.obj.data = data.field
        this.$store.commit('Crud/setAddModal');
    },
    updateItem (data) {
        data.obj.toastSuccess = 'User updated succefully'
        data.obj.toastError = 'Cannot updated user, try again'
        data.obj.apiUrl = `user/update/${data.field.id}`
        data.obj.data = data.field
        this.$store.commit('Crud/setUpdateModal');
        console.log(this)
    },
    deleteItem (data) {
        data.obj.toastSuccess = 'User deleted succefully'
        data.obj.toastError = 'Cannot deleted User, try again'
        data.obj.apiUrl = 'delete/user/'+data.field.id
        this.$store.commit('Crud/setDeleteModal');
    },
    },

    created() {
      this.$store.dispatch('Role/getRoles');
    }
}
</script>