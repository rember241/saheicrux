<template>
  <v-data-table
    :headers="table_headers"
    :items="dataArray"
    :search="table_search"
    :options.sync="options"
    :footer-props="footerProps"
    :server-items-length="totalItems"
    :loading="loading"
    loading-text="Loading... Please wait"
    class="elevation-5 pa-5"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>{{table_title}}</v-toolbar-title>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="primary"
              dark
              class="mb-1 mr-2"
              v-bind="attrs"
              v-on="on"
              x-large
            >mdi-plus-circle</v-icon>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <slot :field="field"> </slot>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
        v-model="table_search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-dialog v-model="dialogDelete" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
  </v-data-table>
</template>

<script>
  export default {
    props:{
        table_title: {
            default: () => '',
            type: String
        },
        newFormTitle: {
            default: () => '',
            type: String
        },
        editFormTitle: {
            default: () => '',
            type: String
        },
        table_headers: {
            default: () => [],
            type: Array
        },
        editedItem: {
            default: () => {},
            type: Object
        },
        defaultItem: {
            default: () => {},
            type: Object
        },
    },

    data () {
      return{
        totalItems: 0,
        loading: true,
        options: {},
        dialog: false,
        dialogDelete: false,
        dataArray: [],
        field: this.editedIndex === -1 ? this.editedItem : this.defaultItem,
        editedIndex: -1,
        table_search: '',
        footerProps: {'items-per-page-options': [25, 50, 100]}
      }
    },
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? this.newFormTitle : this.editFormTitle
      },
      getModalObj() {
        return this.$store.getters['Crud/getModalObj'];
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
      options: {
        handler () {
          this.getDataPaginationFromApi()
        },
        deep: true,
      },
    },

    methods: 
    {
    getDataPaginationFromApi () {
      this.$emit('showDataWithPagination', {obj:this.getModalObj});
        this.loading = true
        const { sortBy, sortDesc, page, itemsPerPage } = this.options
        // console.log(itemsPerPage);
        axios.get(this.getModalObj.apiUrl, {
          params: {
          sortBy: sortBy[0],
          sortDesc: sortDesc[0],
          page: page,
          itemsPerPage: itemsPerPage
      }
      }).then((response) =>{
          this.dataArray = response.data.data
          this.totalItems = response.data.total
          this.loading = false

      }).catch(error => console.log(error))
      },
        editItem (item) {
          this.editedIndex = this.dataArray.indexOf(item)
          this.field = Object.assign({}, item)
          this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.dataArray.indexOf(item)
        this.field = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.$emit('remove', {obj:this.getModalObj,field:this.field});
        this.dataArray.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.field = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.field = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          this.$emit('update', {obj:this.getModalObj,field:this.field});
          Object.assign(this.dataArray[this.editedIndex], this.field)
        } else {
          this.dataArray.push(this.field)
          this.$emit('add', {obj:this.getModalObj,field:this.field});
        }
        this.close()
      },
    }
  }
</script>