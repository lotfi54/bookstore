<template>
    <v-container >
 <v-data-table
   
    :headers="headers"
    :items="auteurs"
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
        <v-toolbar-title>Gestion des auteurs</v-toolbar-title>
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
              Ajouter un auteur
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
                  <v-col
                    cols="12"
                  
                  >
                    <v-text-field
                      v-model="editedItem.prenom"
                      label="Prénom"
                    ></v-text-field>
                  </v-col>
             <v-col
        cols="12"
        
      >
       <v-menu
    ref="menu"
    v-model="menu"
    :close-on-content-click="false"
    transition="scale-transition"
    offset-y
    min-width="auto"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
        v-model="editedItem.date_naissance"
        label="Date de naissance"
        
        readonly
        v-bind="attrs"
        v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker
      ref="picker"
      v-model="editedItem.date_naissance"
      :max="new Date().toISOString().substr(0, 10)"
      min="1950-01-01"
   
    ></v-date-picker>
  </v-menu>
      </v-col>
                  <v-col
                    cols="12"
                 
                  >

                    <v-text-field
                      v-model="editedItem.nationalite"
                      label="Nationalité"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    
                  >
                   
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
       
        @click="deleteAuteur(item.id)"
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
    <v-snackbar
                v-model="snackbar"
        >
            Record deleted successfully...
            <v-btn
                    color="error"
                    text
                    @click="snackbar = false"
            >
                Close
            </v-btn>
        </v-snackbar>
  </v-data-table>




    
  </v-container>
  

</template>

<script>


 export default {
    data: ()  => ({
    
      menu: false,
  
      loading: false,
      snackbar: false,
      dialog: false,
      dialogDelete: false,
      headers: [
         { text: 'Identifiant', value: 'id' },
        { text: 'Nom', value: 'nom' },
        { text: 'prénom', value: 'prenom' },
        { text: 'Date de naissance', value: 'date_naissance' },
        { text: 'Nationalité', value: 'nationalite' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      auteurs: [],
      editedIndex: -1,
      editedItem: {
        nom: '',
        prenom: '',
        date_naissance: '',
        nationalite: '',
        
      },
      defaultItem: {
        nom: '',
        prenom: '',
        date_naissance: '',
        nationalite: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Ajouter un auteur' : 'Editer un auteur'
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

         axios.get('/api/auteur',{})
        .then(response => this.auteurs = response.data.auteurs)
      },

     

      editItem (item) {
        this.editedIndex = this.auteurs.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      
      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

    deleteAuteur(id){
           Swal.fire({
              title: 'Etes vous sur de supprimé cet auteur?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Oui, je veux !'
            }).then((response)=>{
            axios.delete('/api/auteur/'+id)
            .then((response) => {
              Swal.fire(
                
                  "L'auteur à été supprimé",
                  'success'
                )
                this.initialize()
            })
            .catch((error) => {
              Swal.fire({
                type:'error',
                title:'Oooops',
                text: error
              })

            })
            
        })
                

  }, 
      save () {

        if (this.editedIndex > -1) {
          axios.put('/api/auteur/'+this.editedItem.id, this.editedItem)
          .then(response => axios.put('/api/auteur/'+this.editedItem.id, this.editedItem))
          //  .then(res =>  this.auteurs.push(res.data.auteur))
          .catch(err => console.log(err.response))
          // Object.assign(this.auteurs[this.editedIndex], this.editedItem)
        } else {
          axios.post('/api/auteur',this.editedItem)
          .then(response =>  this.auteurs.push(response.data.auteur))
          // .catch(err => console.log(err.response.data))
          .catch((error) => {
              Swal.fire({
                type:'error',
                title:'Oooops',
                text: error.response.data
              })
          })
         
        }
        this.initialize()
        this.close()
      },

    },
  }
</script>