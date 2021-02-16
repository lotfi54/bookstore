<template>
<div>
        <v-app-bar
        app
        flat
        color="white"
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Bookstore</v-toolbar-title>
      </v-app-bar>
     <v-navigation-drawer
        v-model="drawer"
        app
      >
        <v-list dense> 
            <router-link to='/books' exact>
          <v-list-item link>
            <v-list-item-action>
             
              <v-icon>mdi-book</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Books</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            </router-link>


            <router-link to='/auteur' exact>
          <v-list-item link>
            <v-list-item-action>
             
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Auteurs</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            </router-link>

        

         <router-link to='/genre' exact>
          <v-list-item link>
            <v-list-item-action>
             
              <v-icon>mdi-book-variant-multiple</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Genres</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            </router-link>

<router-link to='/livres' exact>
          <v-list-item link>
            <v-list-item-action>
             
              <v-icon>mdi-bookshelf</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Livres</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            </router-link>




        </v-list>

        
      </v-navigation-drawer>
  
</div>
</template>

<script>
     export default {
    data: () => ({
      
        right: null,
      drawer: true,
      group: null,
    }),

    watch: {
      group () {
        this.drawer = false
      },
    },
  }

</script>