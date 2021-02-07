<template>
   <v-container>
    <v-row>
    <v-col cols="8" xl="3" lg="3" sm="6" md="4" v-for="index in 15" :key="index" >
        <ImageCard/>
    </v-col>
</v-row>
    
  </v-container>
</template>

<script>
import ImageCard from './Image'
export default {
    components:{ImageCard},
  data: () => ({
    
  }),
};
</script>