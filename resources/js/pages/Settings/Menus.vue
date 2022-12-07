<template>
  <div>
          <v-breadcrumbs :items="breadcrums">
    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        :href="item.href"
        :disabled="item.disabled"
      >
        {{ item.text.toUpperCase() }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
    <v-container>
      <v-card class="overflow-hidden elevation pa-5">
        <v-card-title>
          Menu Management
        </v-card-title>
          <v-row class="pa-2">
            <v-col cols="12" sm="12" md="6">
              <v-card class="mx-auto mb-10 pa-5" max-width="750" outlined>
                <v-sheet
                  id="scrolling-techniques-7"
                  class="overflow-y-auto"
                  max-height="500"
                >
                  <v-container style="height: 100%">
                    <v-card-title>
                      Menu Active
                      <v-spacer></v-spacer>
                      <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                          <v-icon
                            color="primary"
                            dark
                            class="mb-1 mr-2"
                            v-bind="attrs"
                            v-on="on"
                            x-large
                            >mdi-plus-circle</v-icon
                          >
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                          </v-card-title>
                          <v-card-text>
                            <v-text-field
                              v-model="editedItem.title"
                              required
                              label="Title"
                            ></v-text-field>
                            <v-autocomplete
                              v-model="editedItem.parent_id"
                              label="Select a Parent Menu"
                              :items="filteredMenu"
                              :item-text="parentMenu"
                              item-value="menu_id"
                              dense
                              filled
                            >
                            </v-autocomplete>
                                  <v-menu offset-y>
                                    <template v-slot:activator="{ on }">
                                      <v-btn block
                                        v-show="editedItem.parent_id == 0"
                                        :color="editedItem.color"
                                        dark
                                        v-on="on"
                                        class="mb-5"
                                      >
                                      <span v-show="!editedItem.color">Select Color For Your Menu Module</span>
                                        <span v-show="editedItem.color">Change Color For Your Menu Module</span>   
                                      </v-btn>
                                    </template>
                                    <v-color-picker
                                    value="editedItem.color"
                                    v-model="editedItem.color"
                                    hide-canvas 
                                    hide-inputs 
                                    show-swatches
                                    class="mx-auto"
                                  ></v-color-picker>
                                </v-menu>
                            <!-- <v-text-field
                              v-model="editedItem.icon"
                              label="Icon"
                              required
                            ></v-text-field> -->
                            <v-autocomplete
                              v-model="editedItem.icon"
                              label="Select a Icon"
                              :items="icons"
                              :item-text="icon"
                              dense
                              filled
                            >
                              <template v-slot:selection="data">
                                  <v-avatar left>
                                    <v-icon>{{data.item.icon}}</v-icon>
                                  </v-avatar>
                                  {{ data.item.icon }}
                              </template>
                            <template v-slot:item="data">
                                  <v-avatar left>
                                    <v-icon>{{data.item.icon}}</v-icon>
                                  </v-avatar>
                                  {{ data.item.icon }}
                              </template>
                            </v-autocomplete>
                            
                            <v-autocomplete
                              v-model="editedItem.path"
                              label="Select a Path"
                              :items="paths"
                              :item-text="pathName"
                              dense
                              filled
                            ></v-autocomplete>
                            <!-- <v-text-field
                            v-show="editedItem.parent_id == 0"
                              v-model="editedItem.color"
                              label="Color"
                              required
                            ></v-text-field> -->

                            <v-checkbox
                              v-model="editedItem.isActive"
                              label="Active"
                              required
                            ></v-checkbox>
                          </v-card-text>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                              Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="save">
                              Save
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </v-card-title>


      <v-list>
        <v-list-group
          v-for="item in filteredMenu"
          :key="item.menu_id"
          v-if="item.isActive === true"
          v-model="item.active"
          no-action
        >
        <v-icon slot="prependIcon" :color="item.color">{{item.icon}}</v-icon>
          <template v-slot:activator>
            <v-list-item-content class="font-weight-black text-caption">
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
              <!-- <v-list-item-icon>
              <v-icon @click="editItem(item)"> mdi-pencil-box-outline</v-icon>
            </v-list-item-icon> -->
          </template>

          <v-list-item
            v-for="child in filteredChildMenu"
            :key="child.title"
            v-if="child.parent_id === item.menu_id"
          >
            <v-list-item-content>
              <v-list-item-title class="font-weight-bold text-overline" v-text="child.title"></v-list-item-title>
            </v-list-item-content>
                    <v-list-item-icon>
            <v-icon @click="editItem(child)"> mdi-pencil-box-outline</v-icon>
          </v-list-item-icon>
          </v-list-item>
        </v-list-group>
      </v-list>
                  </v-container>
                </v-sheet>
              </v-card>
            </v-col>

                        <v-col md="6" sm="12">
              <v-sheet
                id="scrolling-techniques-7"
                class="overflow-y-auto"
                max-height="500"
              >
                <v-card class="mx-auto pa-5" max-width="750" outlined>
                  <v-card-title>Menu Arragement</v-card-title>
                    <draggable v-model="menus" @change="updateSorting">
                      <transition-group>
                        <v-list-item
                          v-for="item in menus"
                          :key="item.menu_id"
                          v-if="item.isActive === true"
                        >
                          <v-list-item-content>
                            <v-card
                              max-width="500"
                              :color="item.color"
                              dark
                              v-if="item.parent_id == 0"
                            >
                              <v-card-actions>
                                <v-card-text class="font-weight-light">
                                  <v-icon> {{item.icon}}</v-icon>
                                  {{item.title}}</v-card-text
                                >
                                <v-spacer></v-spacer>
                                <v-btn icon @click="editItem(item)"
                                  ><v-icon>mdi-pencil</v-icon></v-btn
                                >
                              </v-card-actions>
                            </v-card>

                          </v-list-item-content>
                        </v-list-item>
                      </transition-group>
                    </draggable>
                </v-card>
              </v-sheet>
            </v-col>

            <!-- <v-col md="4" sm="12">
              <v-sheet
                id="scrolling-techniques-7"
                class="overflow-y-auto"
                max-height="500"
              >
                <v-card class="mx-auto pa-5" max-width="750" outlined>
                  <v-list-item three-line>
                    <v-list-item-content>
                      <v-list-item-title class="text-h5 mb-1">
                        Menu Inactive
                      </v-list-item-title>
                      <v-card
                        class="mx-auto mt-2"
                        max-width="500"
                        color="error"
                        dark
                        v-for="item in menus"
                        :key="item.title"
                        v-if="item.isActive == 0"
                      >
                        <v-card-actions>
                          <v-card-text class="font-weight-bold">
                            <v-icon> mdi-account</v-icon> {{item.title}}
                          </v-card-text>
                          <v-spacer></v-spacer>

                          <v-btn icon @click="editItem(item)">
                            <v-icon>mdi-replay</v-icon>
                          </v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-list-item-content>
                  </v-list-item>
                </v-card>
              </v-sheet>
            </v-col> -->
          </v-row>
      </v-card>
        <!-- overlay loader -->
        <v-overlay :value="rs_overlay" style="position:absolute;" light color="#ececec">
          <v-progress-circular :width="5" color="green" indeterminate></v-progress-circular>
        </v-overlay>
    </v-container>
  </div>

</template>
<script>
import draggable from 'vuedraggable'
export default {
    components: {
        draggable,
    },
    data() {
        return {
                  breadcrums: [
        {
          text: 'DASHBOARD',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'Menus',
          disabled: false,
        },
      ],
            menus: [],
            menusid:[],
            paths: [],
            dialog: false,
            rs_overlay: false,
            icons: [],
        }
    },
    computed : {
      formTitle () {
        return this.editedIndex === -1 ? 'Add New Menu' : 'Edit Menu'
      },
      filteredMenu(){
          return this.menus.filter(menu => menu.parent_id === 0 && menu.isActive === true)
      },
      filteredChildMenu(){
          return this.menusid.filter(menu => menu.parent_id != 0 && menu.isActive === true)
      },
    // menus: {
    //   get() {
    //     return this.$store.getters['Menu/menus'];
    //   },
    //   set() {
    //     return null
    //   }
    // },
      editedIndex: {
        get() {
          return this.$store.getters['Menu/editedIndex'];
        },
        set(index) {
          this.$store.dispatch('Menu/updateEditedIndex',index)
        },
      },

      defaultItem: {
        get() {
          return this.$store.getters['Menu/defaultItem'];
        },
        set(form) {
          this.$store.dispatch('Menu/updateDefaultItem',form)
         },
        },

      editedItem: {
        get() {
          return this.$store.getters['Menu/editedItem'];
        },
        set(form) {
          this.$store.dispatch('Menu/updateEditItem',form)
        },
      },
    },

    watch:
    {
      dialog (val)
      {
        val || this.close()
      },
    },

    methods:{
    getAllIcons () {
      axios.get(window.location.origin+'/icon.json')
        .then(response => {
          this.icons = response.data.materialDesignIcon;
        });
      },
      getMenus()
      {
        this.rs_overlay = true;
        axios.get('menus').then((response) =>{
          let data = response.data;
          this.menus = data.filter(menu => menu.parent_id === 0);
          this.menusid = data.filter(menu => menu.menu_id);
          this.rs_overlay = false
        }).catch(error => console.log(error))
      },
      editItem (item)
      {
        this.editedIndex = this.menusid.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

    updateSorting()
    {
        this.menus.map((menu, index) => {
            menu.sorting = index + 1;
            // console.log(menu.menu_id);
            // console.log(index + 1);
        })
        axios.put('menu/sorting', {
            menus: this.menus
        }).then((response) => {
            // success message
            this.$toastr.s("updated position successfully");
        })
    },
    close ()
    {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save ()
      {
        if (this.editedIndex > -1) {
          this.$store.dispatch('Menu/updateMenu', this.editedItem);
          Object.assign(this.menusid[this.editedIndex], this.editedItem)
        } else {
          this.menusid.push(this.editedItem)
           this.$store.dispatch('Menu/addMenu', this.editedItem);
        }
        this.close()
      },
      pathName(path){
        return path.name;
      },
      parentMenu (parent){
        return parent.title;
      },
      icon(item){
        return item.icon;
      },

    },
    created () {
        // this.$store.dispatch('Menu/getMenus')
        this.getMenus();
        this.$router.options.routes.forEach(route => {
            this.paths.push({
                    name: route.name
                })

        })
        this.getAllIcons()
        this.$store.dispatch('Menu/getMenus')
        console.log(this.$router.options.routes[0].admin)
      },

}
</script>
