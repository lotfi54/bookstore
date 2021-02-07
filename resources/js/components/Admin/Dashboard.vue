<template>
<div>
 <v-app>
     <v-app>
<Nav/>
  


  <!-- Sizes your content based upon application components -->
<v-main>
        <v-container
        >
      
           
            <router-view></router-view>
           
         
        </v-container>
</v-main>
 </v-app>
 </v-app>
</div>
</template>

<script>

import Nav from './Nav'


export default {
    components:{
        Nav,

    }
}
</script>