<template>
<form @submit.prevent="addOrModifyAProduct" method="POST" enctype="multipart/form-data">
     <div class="row">
            <div class="col-md-8">
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

                            <div class="form-group row mb-4">
                                <label for="price" class="col-sm-3 col-form-label text-dark">Prix: <span
                                        style="color: red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price" required
                                        placeholder="Prix de produit .." v-model="price">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="sale_price" class="col-sm-3 col-form-label text-dark">En solde:
                                </label>
                                 <div class="col-sm-9">
                                    <toggle-button :value="onSaleValue" :color="{checked: '#FE7865' }" @change="onSaleToggle" :sync="true"/>
                                </div>
                            </div>

                            <div class="form-group row mb-4" v-if="onSaleValue">
                                <label for="sale_price" class="col-sm-3 col-form-label text-dark">Prix de solde:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="sale_price" required
                                        placeholder="Prix de solde .." v-model="sale_price">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="description" class="col-sm-3 col-form-label text-dark">Description:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" required placeholder="Description .." style="height: 200px;" v-model="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="image_name" class="col-sm-3 text-dark">Image:</label>

                                <div class="col-sm-9">
                                    <div class="custom-file ">

                                        <input type="file" class="custom-file-input" id="image_name" @change="getSelectedImage">
                                        <label for="image_name" class="custom-file-label text-dark" ><i>{{image_name}}</i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-center" v-if="image_preview">

                                <img :src="image_preview" alt="image" class="figure-img img-fluid rounded" style="max-height:300px">
                            </div>
                            </div>
                            <!-- <div class="form-group row mb-5 ">
                                <label for="image_name" class="col-sm-3 col-form-label text-dark">Image:</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" id="image_name" @change="getSelectedImage" required>
                                </div>
                            </div> -->

                            <div class="form-group row mb-4 ">
                                <div class="col-sm-3"></div>

                                <button type="submit" class="btn btn-success col-sm-9" >{{submit_btn}}</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h4 class="text-center"> <strong>Catégories</strong></h4>
                    <hr>
                    <div class="card-body">

                        <div class="form-check mb-3" v-for="category in categories" :key="category.id" >
                            <input class="" type="radio" :id='"categoryId_" + category.id'
                                :value='category.id' v-model="selectedCategory" name="categories" style="cursor: pointer;">
                            <label class="form-check-label" :for='"categoryId_" + category.id'>
                                {{category.name}}
                            </label>
                        </div>

                        <br>
                        <hr>
                        <h4 class="text-center"> <strong>Stock</strong></h4>

                    <hr>
                    <br>

                        <div class="form-group mb-5">
                        <select class="form-control" v-model="inStock" >
                            <option value=''  disabled>Séléctionner une option ... </option>
                            <option value=1 >En stock</option>
                            <option value=0 >En rupture de stock</option>
                        </select>
                        </div>
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
            price:'',
            sale_price:'',
            selectedCategory:'',
            image_name:'',


            image: null,
            image_preview: null,
            categories: '',
            product:'',
            product_edited_id: 0,
            submit_btn: 'Sauvgarder',
            image_changed: 0,

            onSale:0,
            onSaleValue: false,
            product_sale_price:'',
            inStock: '',
        }
    },props:['allCategories','editProduct'],
    methods: {
        initProps(){
            this.categories = this.allCategories;
            this.product = this.editProduct;

            if(this.product !== 'new'){
                this.product_edited_id = this.product.id;
                this.name= this.product.name;
                this.description= this.product.description;
                this.price= this.product.price;
                this.product_sale_price = this.product.sale_price;
                this.onSale = this.product.on_sale;

                this.selectedCategory= this.product.category_id;
                this.inStock= this.product.in_stock;
                this.image = this.image_name = this.product.image_name;
                this.image_preview= "/images/products/" + this.product.image_name;
                this.submit_btn = 'Modifier';

                if(this.onSale === 0){
                    this.onSaleValue = false;
                    this.sale_price= '';
                    this.product_sale_price = '';
                }else{
                    this.onSaleValue = true;
                    this.sale_price= this.product_sale_price;
                }

            }
        },
        onSaleToggle(){
            this.onSaleValue = !this.onSaleValue;
            if(this.onSaleValue === true){

                this.onSale = 1;
            } else{
                this.onSale = 0;
                this.sale_price = '';
            }

        },
        getSelectedImage(event){

            if(event.target.files.length === 0){
                return;
            }
            this.image_changed = 1;
            this.image = event.target.files[0];
            this.image_name = this.image.name;

            let reader = new FileReader();
            reader.readAsDataURL(this.image);

            reader.onload = event => {
                this.image_preview = event.target.result;
            }

        },
        async addOrModifyAProduct(){


            if(this.name != '' && this.description != '' && this.price != '' && this.inStock != '' && this.selectedCategory != '' && this.image != null){

                if(this.onSaleValue){
                    if(this.sale_price == ''){
                        this.$toastr.e('Remplissez le prix de solde!');

                        return;
                    }
                }

                var data = new FormData;
                    data.append('name', this.name);
                    data.append('description', this.description);
                    data.append('price', this.price);
                    data.append('sale_price', this.sale_price);
                    data.append('on_sale', this.onSale);
                    data.append('category', this.selectedCategory);
                    data.append('in_stock', this.inStock);
                    data.append('image', this.image);


                if(this.product === 'new'){
                    var response = await axios.post("/admin/produits/ajouter/sauvgarder", data);



            }else{

                      if(this.name !== this.product.name || this.description !== this.product.description || this.price !== this.product.price || this.sale_price !== this.product.sale_price || this.inStock !== this.product.in_stock || this.selectedCategory !== this.product.category_id || this.image_changed === 1){

                        data.append('image_changed', this.image_changed);

                    var response = await axios.post("/admin/produits/modifier/" + this.product_edited_id + "/sauvgarder", data);


                    }else{
                        return;
                    }


            }
                   if(response.data.success){
                        this.$toastr.s(response.data.success);
                    }else{
                        this.$toastr.e(response.data.error);
                    }

                    setTimeout(() => {
                        window.location.href = '/admin/produits';
                        }, 2000);


         }else{
             this.$toastr.e('Remplissez tous les champs non vides et sélectionnez une catégorie.');
         }


        }

    },
    created() {
        this.initProps();
    },
}
</script>
