<template>
    <div>
    <hr>
        <button :class="myClass" @click.prevent="addProductToCart()">
         <i class="fa-solid fa-cart-plus mr-1"></i> Ajouter au panier
        </button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                myClass: ''
            }
        },
        props: ['productId', 'userId', 'totalQuantity', 'customClass'],
        methods:{
            async addProductToCart(){

                //checking if user logged in.

                if(this.userId == 0){
                    this.$toastr.e('Vous devez vous connecter, Pour ajouter ce produit au panier.');

                     setTimeout(() => {
                        window.location.href = '/login';
                    }, 2500);

                    return;
                }

                // if user logged in then add product to cart.

                let response = await axios.post('/mon-panier/ajouter', {
                    'product_id': this.productId,
                    'quantity': this.totalQuantity,
                });


                if(response.data.error){
                        this.$toastr.e(response.data.error);
                }else {

                        this.$root.$emit('changeInCart', response.data.items);
                        this.$toastr.s("Le produit a été ajouté au panier.");
                }
        },

        },
        created(){
            this.myClass = this.customClass;

        }
    }
</script>
