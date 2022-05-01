<template>

<section class="card-shop" style="margin-top: 130px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="make-order-form">
                        <h3 class="mb-4">Informations sur l'acheteur :</h3>

                            <div class="form-group">
                                <label for="fullName">Nom et prénom</label>
                                <input type="text" class="form-control" name="fullName" v-model="fullName" required placeholder="Nom et prénom ..">
                            </div>

                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="tel" pattern="[0-9]{10}"
                                class="form-control" name="phone" v-model="phone" required placeholder="Téléphone ..">
                            </div>

                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <textarea class="form-control" name="address" v-model="address" required  placeholder="Adresse .."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="wilaya">Wilaya</label>
                                <input type="text" class="form-control" name="wilaya" v-model="wilaya" required placeholder="Wilaya ..">
                            </div>

                              <div class="form-group">
                                <label for="commune">Commune</label>
                                <input type="text" class="form-control" name="commune" v-model="commune" required placeholder="Commune ..">
                            </div>

                            <h3 class="my-3" v-if="items.length != 0" id="priceTotal"><b class="text-danger">Prix total :</b>
                                <b>
                                {{totalAmount + ' ' + currency}}
                                </b>
                            </h3>

                        <button class="btn btn-danger my-2" @click.prevent="getUserAddress()" id="orderBtn">Commander</button>
                        <!-- <button v-else class="btn btn-danger my-2" disabled>Commander</button> -->
                    </div>

                </div>
                <div class="col-md-6">
                    <h3 class="mb-4">Produits :</h3>

                    <div v-for="item in items" :key="item.id" >
                        <div class="media m-2 px-2" v-if="item.name" :id='"item"+item.id'>
                            <a :href='"/produit/" + item.id + "/" + item.slug '>
                                <img :src='"/images/products/" + item.image_name' style="width: 60px; height: 60px;" class="mr-3" alt=""  >
                                </a>
                                <div class="media-body" >
                                    <h5 class="mt-0">
                                        <a :href='"/produit/" + item.id + "/" + item.slug '>{{item.name}}</a>
                                        <br>
                                        <label for="quantity" style="font-weight: 500;">Quantité : </label>
                                        <input type="number" class="card-quantity" :id='"product" + item.id' name="quantity" v-model="item.quantity" max="10" min="1" @click.prevent='setTotalPrice(item.sale_price, item.id)' >
                                    </h5>

                                </div>
                                <div class="price">
                                    <b class="mr-2" style="font-weight: 600;">{{item.sale_price + ' ' + currency}}</b>
                                    <input type="hidden" :id='"totalProduct"+ item.id' :value='item.sale_price * item.quantity '>
                                </div>
                                <div class="delete-wish mr-3" style="cursor: pointer;">
                                  <span @click="deleteItemFromCart(item.id)"> <i class="fa-regular fa-trash-can"></i></span>
                                </div>
                            </div>
                    </div>

                    <div class="mt-5" id="noProductAlert" v-show="items.length == 0">
                        <div class="alert alert-warning py-3">Aucun produit.</div>
                    </div>
                    <hr>
                    <div>
                    <h4 class="mb-4">Coupons :</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                            <input type="text" pattern="[0-9]{10}"
                            class="form-control" name="coupon" v-model="coupon" placeholder="Coupon ..">
                        </div>
                           <button class="btn btn-sm btn-primary float-right p-2" @click.prevent="applyCoupon()" id="applyCouponBtn">Appliquer</button>
                        </div>
                    </div>

                    </div>
                    </div>
            </div>
        </div>
    </section>
</template>

<script>import axios from "axios";

export default {
    data() {
        return {
            items: [],
            fullName:'',
            phone:'',
            address:'',
            wilaya:'',
            commune:'',
            quantity: '',
            totalAmount: '',
            itemCount: 0,
            currency: '',
            coupon: '',

            coupon_applied: false,
        }
    },props:['storeCurrency'],
    methods: {
        initProps(){
            this.currency = this.storeCurrency;
        },
        async getCartItems(){
            let response = await axios.get('/mon-panier/get/articles');
            this.items = response.data;
            this.totalAmount = this.items.totalAmount;

            if(this.items.length == 0){
                document.getElementById("orderBtn").disabled = true;
            }

            for(let item in this.items){
                if(item != "totalAmount"){

                    this.itemCount += 1;

                 }
            }
        },
         async getUserAddress(){
                if(this.fullName != '' && this.address != '' && this.phone != '' && this.wilaya != '' && this.commune != ''){
                    if(this.validatePhoneNumber(this.phone)){
                        let response = await axios.post('/processus/utilisateur/commande', {
                        'fullName':this.fullName,
                        'phone':this.phone,
                        'address':this.address,
                        'wilaya':this.wilaya,
                        'commune':this.commune,
                        'order':this.items,
                        'amount':this.totalAmount,
                    });

                    if(response.data.success){
                    this.$toastr.s(response.data.success);
                    }else{
                        this.$toastr.e(response.data.error);
                    }

                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2500);

                    }else{
                        this.$toastr.e('Téléphone incorrecte !')
                    }


                }else{
                    this.$toastr.e('Informations incomplètes !')
                }
            },
            setTotalPrice(price, id) {
                var quantity = document.getElementById("product" + id).value;
                let total = quantity * price;

                document.getElementById("totalProduct" + id).value = total;
                    var totalPrice = 0;

                for(let item in this.items){
                    if(item != "totalAmount"){

                      totalPrice += Number(document.getElementById("totalProduct" + item).value);

                    }
                }

                this.totalAmount = totalPrice;
            },
            async deleteItemFromCart(id){

                let response = await axios.post('/mon-panier/supprimer/article', {
                    'productId':id
                });

                if(response.data.success){
                    document.getElementById("item"+id).style.display = "none";
                    this.$toastr.s(response.data.success);
                    if(this.itemCount > 0){
                        this.itemCount -= 1;
                        if(this.itemCount == 0){
                            document.getElementById("noProductAlert").style.display = "initial";
                            document.getElementById("orderBtn").disabled = true;
                            document.getElementById("priceTotal").style.display = "none";

                        }
                        this.totalAmount -= Number(document.getElementById("totalProduct" + id).value);
                        delete this.items[id];

                    }

                    this.$root.$emit('changeInCart', this.itemCount);

                }else{
                     this.$toastr.e(response.data.error);
                }
            },
            validatePhoneNumber(input) {
                var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

                 return re.test(input);
            },
            async applyCoupon(){
                if(this.coupon != '' && !this.coupon_applied && this.items.length != 0){
                    console.log(this.coupon);

                     var data = new FormData;
                    data.append('code', this.coupon);

                   let response = await axios.get('/mon-panier/coupon/'+ this.coupon);
                    if(response.data.success){
                        this.coupon_applied = true;

                        this.$toastr.s(response.data.success);
                        if(response.data.type === 'fixed'){
                            if(this.totalAmount <= response.data.value){
                                this.totalAmount = 0;
                            }else{
                                this.totalAmount -= response.data.value;

                            }

                        }else{
                            let coupon_value = (this.totalAmount * response.data.value) / 100;
                            this.totalAmount -= coupon_value;
                        }
                    }else{
                        this.$toastr.e(response.data.error);
                    }

                }

            }

    },

    created() {
        this.initProps();
        this.getCartItems();


    },

}
</script>
