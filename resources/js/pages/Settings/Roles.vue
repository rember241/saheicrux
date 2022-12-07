<template>
  <data-table 
    :dataSource="roles"
    :table_headers="headers" 
    :table_title="'All Roles'" 
    :newFormTitle="'New Role'"
    :editFormTitle="'Edit Role'"
    :defaultItem="defaultItem"
    @add ="addItem"
    @update ="updateItem"
    @remove ="deleteItem"
    @showDataWithPagination ="showDataWithPagination"
    >
    <template v-slot="editedItem">
      <v-container v-if="editedItem.field">
        <v-row>
          <v-col
            cols="12"
            sm="12"
            md="12"
          >
            <v-text-field
                v-model="editedItem.field.roleName"
              label="Role Name"
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
      { text: 'Role Name', value: 'roleName' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    roles:[],
    defaultItem: {
      role_id: '',
      roleName: '',
    },
    editedItem: {
        role_id: '',
        roleName: '',
      },
  }),
  methods: {
    showDataWithPagination(data)
    {
        data.obj.apiUrl = 'rolesPagination'
    },
    addItem (data) {
        data.obj.toastSuccess = 'Role create succefully'
        data.obj.toastError = 'Cannot create Role, try again'
        data.obj.apiUrl = 'role/create'
        data.obj.data = data.field
        this.$store.commit('Crud/setAddModal');
    },
    updateItem (data) {
        data.obj.toastSuccess = 'Role updated succefully'
        data.obj.toastError = 'Cannot updated Role, try again'
        data.obj.apiUrl = `role/update/${data.field.role_id}`
        data.obj.data = data.field
        this.$store.commit('Crud/setUpdateModal');
    },
    deleteItem (data) {
        data.obj.toastSuccess = 'Role deleted succefully'
        data.obj.toastError = 'Cannot deleted Role, try again'
        data.obj.apiUrl = 'delete/role/'+data.field.role_id
        this.$store.commit('Crud/setDeleteModal');
    },
  },
  }
</script>