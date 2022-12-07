<template>
  <div>
    <v-breadcrumbs :items="breadcrums">
      <template v-slot:item="{ item }">
        <v-breadcrumbs-item :href="item.href" :disabled="item.disabled">
          {{ item.text.toUpperCase() }}
        </v-breadcrumbs-item>
      </template>
    </v-breadcrumbs>
    <v-card>
          <v-toolbar color="#2E3C56" dark extended flat class="pa-5">
            <v-autocomplete
              v-model="selectedId"
              label="Select a Role"
              :items="roles"
              :item-text="roleName"
              item-value="role_id"
              @change="changeAdmin"
              dense
              filled
            >
              <template v-slot:append-outer>
                <v-btn
                  class="text-caption"
                  small
                  color="primary"
                  v-show="selectedId"
                  @click="assignRoles"
                  >Apply Permission</v-btn
                >
              </template>
            </v-autocomplete>
          </v-toolbar>
                <v-sheet
        id="scrolling-techniques-6"
        class="overflow-y-auto"
        max-height="600"
      >
        <v-container style="height: 1000">
          <v-card
            class="mt-2"
            style="margin-top: -34px"
            v-for="item in filteredMenuParent"
            :key="item.menu_id"
          >
            <v-toolbar flat>
              <v-switch class="mt-5" v-model="item.is_read"></v-switch>
              <v-toolbar-title class="grey--text">
                {{item.title}}
              </v-toolbar-title>
            </v-toolbar>

            <v-divider></v-divider>

            <v-card-text>
              <v-row>
                <v-col
                  cols="12"
                  md="3"
                  lg="3"
                  v-for="(child, i) in filteredChildMenu"
                  :key="i"
                  v-if="item.menu_id === child.parent_id"
                >
                  <v-list nav dense>
                    <v-list-item-group color="primary">
                      <v-card>
                        <v-card-title class="text-overline"
                          >{{child.title}}
                          <v-spacer></v-spacer>
                          <v-btn
                            class="white--text ma-2"
                            x-small
                            color="info"
                            @click="child.is_read = child.is_create = child.is_edit = child.is_delete = true;"
                            >Select All</v-btn
                          >
                        </v-card-title>
                        <v-divider></v-divider>

                        <v-card-text>
                          <v-row>
                            <v-col cols="6" md="6" lg="6">
                              <v-checkbox
                                v-model="child.is_read"
                                label="read"
                              ></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                              <v-checkbox
                                v-model="child.is_create"
                                label="create"
                              ></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                              <v-checkbox
                                v-model="child.is_edit"
                                label="edit"
                              ></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                              <v-checkbox
                                v-model="child.is_delete"
                                label="delete"
                              ></v-checkbox>
                            </v-col>
                          </v-row>
                        </v-card-text>
                      </v-card>
                    </v-list-item-group>
                  </v-list>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-container>
      </v-sheet>
    </v-card>
  </div>
</template>

<script>
import draggable from 'vuedraggable'
export default {
    components: {
        draggable,
    },
  data(){
  return {
      breadcrums: [
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'Permissions',
          disabled: false,
        },
      ],
      rs_overlay: false,
      menusPermissions: [],
    }
  },
  computed: {
    roles() {
      return this.$store.getters['Role/roles'];
    },
    menus() {
      return this.$store.getters['Menu/menus'];
    },
    selectedId: {
      get() {
        return this.$store.getters['Permission/selectedId'];
      },
      set(id) {
        this.$store.dispatch('Permission/updateId',id)
      }
    },
    filteredMenuParent(){
        return this.menusPermissions.filter(menu => menu.parent_id === 0)
    },
      filteredChildMenu(){
          return this.menusPermissions.filter(menu => menu.parent_id != 0)
      },
  },
  methods: {
    roleName(item){
        return item.roleName;
    },
    changeAdmin(){
      let index = this.roles.findIndex(role => role.role_id == this.selectedId)
      let permission = this.roles[index].permission
      let combines = this.menus.concat(JSON.parse(permission));
      const uniqueObjects = [...new Map(combines.filter(item=>item).map(item => [item.menu_id,item])).values()]
      // console.log(uniqueObjects)
      this.rs_overlay = true;
      if(!permission){
          this.rs_overlay = false;
          this.menusPermissions = this.menus
      }else{
          this.rs_overlay = false
          this.menusPermissions = uniqueObjects
      }
    },
    async assignRoles(){
      this.$store.dispatch('Permission/assignRoles',this.menusPermissions);
    },
  },
  created() {
    this.selectedId = null
      this.$store.dispatch('Role/getRoles')
      this.$store.dispatch('Menu/getMenus')
  },
}
</script>
