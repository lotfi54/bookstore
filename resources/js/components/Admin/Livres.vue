<template>
    <v-container>
        <v-toolbar
        flat
      >
  <v-toolbar-title 
  >Liste des livres</v-toolbar-title>

  <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
         <v-dialog
          v-model="dialog"
          max-width="500px"
          scrollable
        >
        
        <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="indigo"
              outlined
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Ajouter un livre
            </v-btn>
          </template>
      
          <v-card>
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
                      v-model="editedItem.titre"
                      label="Titre du livre"
                    ></v-text-field>
                  </v-col>

           
      <v-col cols="12">
          <v-autocomplete
            v-model="editedItem.auteur"
            :items="auteurs"
            label="L'auteur"
          >
          </v-autocomplete>
        </v-col>

    <v-col cols="12">
          <v-autocomplete
            v-model="editedItem.genre"
            :items="genres"

            label="Le genre"
            
            
          ></v-autocomplete>
        </v-col>
         <v-col
      cols="12"
  
    >
      <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="date"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="editedItem.date_achat"
            label="Date d'achat"
           
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="editedItem.date_achat"
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            @click="modal = false"
          >
            Cancel
          </v-btn>
          <v-btn
            text
            color="primary"
            @click="$refs.dialog.save(date)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
    </v-col>

          <v-col
      cols="12"
  
    >
      <v-dialog
        ref="dialog2"
        v-model="modal2"
        :return-value.sync="date2"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="editedItem.date_parution"
            label="Date de parution"
           
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="editedItem.date_parution"
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            @click="modal2 = false"
          >
            Cancel
          </v-btn>
          <v-btn
            text
            color="primary"
            @click="$refs.dialog2.save(date2)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
    </v-col>

                   <v-col
                    cols="12"
                    sm="12"
                    >
                    <v-text-field
                      v-model="editedItem.langue_livre"
                      label="Langue du livre"
                    ></v-text-field>
                  </v-col>

                    <v-col
                    cols="12"
                    sm="12"
                    >
                    <v-text-field
                      v-model="editedItem.isbn"
                      label="ISBN"
                    ></v-text-field>
                  </v-col>

                     <v-col
                    cols="12"
                    sm="12"
                    >
                    <v-text-field
                      v-model="editedItem.annee"
                      label="Année"
                    ></v-text-field>
                  </v-col>

                   <v-col
                    cols="12"
                    sm="12"
                    >
                    <v-text-field
                      v-model="editedItem.nbr_pages"
                      label="Nombre de pages"
                    ></v-text-field>
                  </v-col>

     
             

                     

                  <v-col
                    cols="12"
                    sm="12"
                    >
                    <v-file-input 
                    v-model="editedItem.photo"
                    change="onFileSelected"
                    show-size
                    accept="image/*"
                    label="File input"
                ></v-file-input>
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
     
<v-expansion-panels flat>
    <v-expansion-panel>
        <v-expansion-panel-header disable-icon-rotate>
          <span class="font-weight-bold">FILTRER</span>
    
          <template v-slot:actions>
            <v-icon large color="dark">
              mdi-filter-variant
            </v-icon>
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>


    <v-row class="text-center">
     
       
          <v-col cols="8" xl="2" lg="3" sm="6" md="4" v-for="n in 12" :key="n" class="pa-2 mt-10" outlined tile>
<v-card
    class="mx-auto"
    max-width="344"
  >
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
    ></v-img>

    <v-card-title>
      Top western road trips
    </v-card-title>

    <v-card-subtitle>
      1,000 miles of wonder
    </v-card-subtitle>

    

    
  </v-card>

          </v-col>
       
    
    </v-row>
 
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
    data: () => ({
      snackbar: false,
      text:'',
      date:'',
      date2:'',
      menu:false,
      modal: false,
      modal2: false,
      dialog: false,
      dialogDelete: false,
      auteurs:[],
      genres:[],
      livres: [],
      editedIndex: -1,
      editedItem: {
         titre: '',
        auteur:'',
        genre:'',
        langue_livre:'', 
        isbn:'', 
        annee:'', 
        nbr_pages:'', 
        date_achat:'', 
        date_parution:'', 
        photo:[],  
      },
      defaultItem: {
        auteur:'',
        genre:'',
        titre: '',
        langue_livre:'', 
        isbn:'', 
        annee:'', 
        nbr_pages:'', 
        date_achat:'', 
        date_parution:'', 
        photo:[],  
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Ajouter un livre' : 'Editer un livre'
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

         axios.get('/api/livre',{})
        .then(response => {
             this.genres = response.data.genres
        this.auteurs = response.data.auteurs
        })
        .catch(err=> {
            console.log(err.response.data)
        })
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
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


      onFileSelected(event){
        let file = event.target.files[0];
          if(file.size > 1048770)
                {
                     this.snackbar = true; 
                     this.text = "L'image ne doit pas être > 2MB"; 
                }else{
                    let reader = new FileReader(); 
                    reader.onload = event => {
                      this.editedItem.photo = event.target.result
                      console.log(event.target.result); 
                    }; 
                    reader.readAsDataURL(file); 
                }

      },


      save () {

          if(this.editedIndex > -1){
              const index = this.editedIndex
              axios.put('/api/livre/'+this.editedItem.id, this.editedItem)
              .then(response => {
                  this.text = "Le genre a été modifié"; 
                  this.snackbar = true; 
                //   Object.assign(this.livres.data[index], response.data.livre)
                //    this.genres.push(response.data.livre)
              })
              .catch(err =>  {
                  console.log(err.response)
                  this.text = "Une erreur à été trouvé"; 
                  this.snackbar = true; 
              })
          }else {
               axios.post('/api/livre',this.editedItem)
                .then(response => {
                  this.text = "Le livre a été ajouté"; 
                  this.snackbar = true; 
                  this.livres.push(response.data.livre)
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