<template>
<form @submit.prevent="addOrModifyACollection"  method="POST" >
     <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <h4 class="text-center"> <strong>Informations</strong></h4>
                    <hr>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark">Nom: <span
                                        style="color: red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" required
                                        placeholder="Nom de produit .." v-model="name">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="description" class="col-sm-3 col-form-label text-dark">Description:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" required placeholder="Description .." style="height: 200px;" v-model="description"></textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-4 ">
                                <div class="col-sm-3"></div>
                                <button type="submit" class="btn btn-success col-sm-9" >{{submitButton}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="card">
                    <h4 class="text-center"> <strong>Produits</strong></h4>
                    <hr>
                    <div class="card-body">
                           <table class=" table" style="background-color: white;color: #1E1E1E;">
                <thead style="background-color: rgba(253, 120, 101, 0.7)">
                    <tr>
                        <th></th>
                        <th scope="col">Id</th>
                        <th scope="col">Nom de produit</th>
                        <th scope="col">Catégorie</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index" >
                        <th >
                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" :value="product.id" :id='"prodId_" + product.id' @change="getValueCheck(product.id)" checked v-if="old_selected_products_id.includes(product.id)">

                                <input class="form-check-input" type="checkbox" :value="product.id" :id='"prodId_" + product.id' @change="getValueCheck(product.id)"  v-else>
                            </div>
                        </th>
                        <th scope="row"><label :for='"prodId_" +product.id'>{{ product.id }}</label></th>
                        <td><label :for='"prodId_" +product.id'>{{ product.name }}</label></td>
                        <td><label :for='"prodId_" +product.id'>{{ product.category_name }}</label></td>
                    </tr>

                </tbody>
            </table>

                <!-- <ul class="pagination justify-content-center">

                <li class= 'page-item' :class="{'disabled': products.prev_page_url == null}"><a class="page-link"
                        :href='products.prev_page_url'>Précédent</a></li>

                    <li v-for="i in products.last_page" :key="i" class= 'page-item' :class="{'active': products.current_page == i }"><a class="page-link"
                            :href='"?page=" + i'>{{ i }}</a></li>


                <li class= 'page-item'>

                    <a class="page-link" :class="{'disabled': products.next_page_url == null}" :href='products.next_page_url'>Suivant</a>
                </li>

            </ul> -->
                    </div>
                </div>
            </div>
        </div>
</form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            name:'',
            description:'',

            products:'',
            collection:'',
            submitButton:'Sauvgarder',
            editedCollection_id: 0,
            old_selected_products_id: [],

            selected_products_id: [],
        }
    },props:['editCollection', 'allProducts', 'selectedProducts'],
    methods: {
        arrayRemove(arr, value) {

            return arr.filter(function(updated){
                return updated != value;
            });

        },
        getValueCheck(id){
            if(document.getElementById('prodId_'+id).checked){
                this.selected_products_id.push(id);
            }else{
                this.selected_products_id = this.arrayRemove(this.selected_products_id, id)

            }
        },


        initProps(){
            this.collection = this.editCollection;
            this.products = this.allProducts;

            if(this.collection !== 'new'){
                this.submitButton = 'Modifier';
                this.editedCollection_id = this.collection.id;
                this.name= this.collection.name;
                this.description = this.collection.description;
                this.old_selected_products_id = this.selectedProducts;
                this.selected_products_id = this.selectedProducts;
            }
        },

        async addOrModifyACollection(){


        if(this.name != '' && this.description != '' && Object.keys(this.selected_products_id).length != 0){

            console.log(this.name);
            console.log(this.description);
            console.log(this.selected_products_id);
            if(this.collection === 'new'){

                var response = await axios.post("/admin/collections/ajouter/sauvgarder", {
                    'name': this.name,
                    'description': this.description,
                    'selected_products_id': this.selected_products_id

                });

            }else{

                    var response = await axios.post("/admin/collections/modifier/" + this.editedCollection_id + "/sauvgarder", {
                        'name': this.name,
                        'description': this.description,
                        'selected_products_id': this.selected_products_id,

                    });
            }

                 if(response.data.success){
                            this.$toastr.s(response.data.success);
                        }else{
                            this.$toastr.e(response.data.error);
                        }

                setTimeout(() => {
                    window.location.href = '/admin/collections';
                }, 2000);

         }else{
             this.$toastr.e('Remplissez tous les champs non vides.');
         }

        }

    },
    created() {
        this.initProps();
    },
    watch: {

    }
}
</script>
