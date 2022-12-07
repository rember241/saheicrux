<template>
    <v-navigation-drawer v-model="drawer" color="#3C4B64" app dark>
    <v-list-item>
        <v-list-item-content class="text-center pa-5">
          <v-list-item-title class="text-h6">
            <v-icon>mdi-account</v-icon> ADMIN
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      
      <v-divider></v-divider>
    <v-list dense>
        <v-list-group v-for="item in filteredMenuParents" :key="item.title" color="white">
          <template v-slot:activator>
            <v-list-item link exact :to=" item.path == '#' ? '' : item.path">
            <v-list-item-action>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title >{{item.title}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </template> 

          <v-list-item class="ml-8"
          v-for="child in filteredMenuChilds"
          :key="child.title" 
          :to="{ name: child.path }"
          v-if="item.menu_id == child.parent_id"
          >
            <v-list-item-action>
              <v-icon>{{child.icon}}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{child.title}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>   
              
        </v-list-group>
        </v-list>

        
    </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
      filteredMenuParents: [],
      filteredMenuChilds: []
    }
  },
  methods:{
    getMenus()
      {
        axios.get('permissions').then((response) =>{
          let data = response.data;
          this.filteredMenuParents = data.filter(menu => menu.parent_id === 0 && menu.is_read === true && menu.isActive === true);
          this.filteredMenuChilds = data.filter(menu => menu.parent_id && menu.is_read === true && menu.isActive === true);
        }).catch(error => console.log(error))
      },
  },
  created() {
    this.getMenus();
},
}
</script>
