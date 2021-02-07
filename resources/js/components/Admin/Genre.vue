<template>
    <v-container >
 <v-data-table
   
    :headers="headers"
    :items="genres"
    sort-by="calories"
    class="elevation-3"
     item-key="name"

     :loading="loading"
  >
    <template v-slot:top>
      <v-toolbar
   elevation="0"
          flat
      >
        <v-toolbar-title>Gestion des genres</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="dark"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Ajouter un genre
            </v-btn>
          </template>
          <v-card          
          elevation="0"
           outlined
           
           >
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="12"
                    
                  >
                    <v-text-field
                      v-model="editedItem.nom"
                      label="Nom"
                    ></v-text-field>
                  </v-col>

                </v-row>
              </v-container>
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
         <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
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
        medium
        class="mr-5"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
         medium
         color="red"
        @click="deleteGenre(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  
  </v-data-table>

    <v-snackbar
                v-model="snackbar"
        >
            {{text}}
            <v-btn
                    color="error"
                    text
                    @click="snackbar = false"
            >
                Close
            </v-btn>
        </v-snackbar>


    
  </v-container>
  

</template>

<script>


 export default {
    data: ()  => ({
    
      menu: false,
    
      loading: false,
      snackbar: false,
      text:'',
      dialog: false,
      dialogDelete: false,
      headers: [
         { text: 'Identifiant', value: 'id' },
        { text: 'Nom', value: 'nom' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      genres: [],
      editedIndex: -1,
      editedItem: {
        nom: '',
      },
      defaultItem: {
        nom: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Ajouter un genre' : 'Editer un genre'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
      date (val) {
        this.dateFormatted = this.formatDate(this.date)
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
          
                axios.interceptors.request.use((config) => {
                    this.loading = true;
                    return config;
                }, (error) => {
                    this.loading = false;
                    return Promise.reject(error);
                });
                // Add a response interceptor
                axios.interceptors.response.use((response) => {
                    this.loading = false;
                    return response;
                }, (error) => {
                    this.loading = false;
                    return Promise.reject(error);
                });

         axios.get('/api/genre',{})
        .then(response => this.genres = response.data.genres)
      },

     

      editItem (item) {
        this.editedIndex = this.genres.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

       deleteGenre (item) {
     const index = this.genres.indexOf(item)
            axios.delete('/api/genre/'+item.id)
              .then(response => {
                  
                 
                   this.text = "Le genre a été supprimé"; 
                  this.snackbar = true; 
                 this.genres.splice(index,1)
   
                 
                 this.initialize()
              })
              .catch(err =>  {
                  console.log(err.response)
                  this.text = "Une erreur à été trouvé"; 
                  this.snackbar = true; 
              })
      },

      deleteItemConfirm () {
        this.genres.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
   
      save () {

          if(this.editedIndex > -1){
              const index = this.editedIndex
              axios.put('/api/genre/'+this.editedItem.id, this.editedItem)
              .then(response => {
                  this.text = "Le genre a été modifié"; 
                  this.snackbar = true; 
                //   Object.assign(this.genres.data[index], response.data.genre)
                //    this.genres.push(response.data.genre)
              })
              .catch(err =>  {
                  console.log(err.response)
                  this.text = "Une erreur à été trouvé"; 
                  this.snackbar = true; 
              })
          }else {
               axios.post('/api/genre',this.editedItem)
                .then(response => {
                  this.text = "Le genre a été ajouté"; 
                  this.snackbar = true; 
                  this.genres.push(response.data.genre)
              })
              .catch(err => {
                  console.log(err.response)
                  this.text = "Une erreur à été trouvé"; 
                  this.snackbar = true; 
              })
          }

           this.initialize()
        this.close()
          
      },

    },
  }
</script>