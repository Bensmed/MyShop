<template>
  <section class="product-page" style="margin-top: 150px;">
        <div class="container">
            <div class="row">
                  <div class="col-md-6">
                      <div class="showcase-active">
                          <div class="single-showcase">
                              <img :src='"/images/products/" + image_name' >

                          </div> <!-- single showcase -->

                           <!-- single showcase -->
                      </div> <!-- showcase active -->

              </div> <!-- col -->
                <div class="col-md-6">
                    <div class="product-page-texts">
                        <h2 class="resp">{{prodName}}</h2>

                        <!-- <div class="show-rates">
                            <div class="stars stars-5" style="display: inline-block"></div>
                            <span>(10)</span>
                        </div> -->
                        <p v-if="sale==1"> <span class="current-price" >{{sale_price + " " + currency}} </span>
                            <span class="old-price">
                            {{price + " " + currency}}
                            </span>
                        </p>
                        <p v-else>
                            <span class="current-price" >{{price + " " + currency}}</span>

                        </p>
                        <p>
                            <span class="in-stock" :class="stockColor">{{stock}}</span>
                        </p>
                        <p class="my-4">{{description}}</p>


                        <div class="product-payement-quantity mt-5">
                            <!-- skin 2 -->
                            <div class="num-block skin-2">
                                <div class="num-in">
                                    <span class="minus dis" @click.prevent="minusQuantity()" ></span>
                                    <input type="text" name="quantity" class="in-num" v-model="quantity" readonly>
                                    <span class="plus" @click.prevent="plusQuantity()"></span>
                                </div>
                            </div>
                            <!-- / skin 2 -->


                            <button class="btn btn-shake buy-button" style="padding-right:20px;padding-left: 20px;" data-toggle="modal" data-target="#buy-now">
                                <i class="fa-regular fa-credit-card mr-2"></i>
                                <span> Acheter maintenant</span></button>

                        </div>
                        <div class="product-item-content my-4">
                         <add-to-cart-button custom-class="btn btn-danger" :product-id= id
                          :user-id= userId :total-quantity= quantity />
                            <!-- <button type="submit" form="card-form" class="btn btn-c-dark"><i class="fa-solid fa-cart-plus mr-2"></i>  Ajouter au panier</button> -->
                            <!-- <button type="submit" form="wishlist-form" class="btn btn-c-dark">
                                <i class="bx bx-heart"></i>
                                Add to Wishlist</button> -->
                        </div>

                        <p class="category-tags">
                            <span>Catégorie : </span>
                            <a :href='"/categorie/" + category_id + "/" + category_slug '>{{category_name}}</a>
                        </p>
                        <!-- <p class="category-tags">
                            <span>Keywords : </span>
                            <b></b>
                        </p> -->
                        <!-- <p class="category-tags">
                            <span>Share :</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://codma.ma/demo/product/4" class="social-share-link"><i class="bx bxl-facebook-circle"></i></a>
                            <a href="https://www.twitter.com/share?url=https://codma.ma/demo/product/4" class="social-share-link"><i class="bx bxl-twitter"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://codma.ma/demo/product/4" class="social-share-link"><i class="bx bxl-linkedin-square"></i></a>
                        </p> -->
                    </div>
                </div>
            </div>
            <!-- PRODUCT DESCRIPTION -->
            <!-- <div class="product-description text-center">
                <h4>Description</h4>
                <p>{{description}}</p>


            </div> -->
            <!-- PRODUCT DESCRIPTION -->

            <!-- PRODUCT REVIEWS -->
            <!-- <div class="product-reviews">
                <h4 class="mb-4">
                    Product Reviews
                                    </h4>
                                <div class="all-reviews">


                                                    <div class="review-text mb-2">
                                <h5>
                                    <span class="rev-user-name">admin</span>
                                    <span class="user-rate">
                                        <div class="stars stars-5"></div>
                                    </span>
                                </h5>
                                <p>test</p>
                                                                <div class="text-muted">
                                    <span>2022-02-02 14:19:40</span>
                                    <p>
                                                                            </p>
                                </div>
                            </div>
                            <br>
                                                    <div class="review-text mb-2">
                                <h5>
                                    <span class="rev-user-name">admin</span>
                                    <span class="user-rate">
                                        <div class="stars stars-5"></div>
                                    </span>
                                </h5>
                                <p>test 2</p>
                                                                <div class="text-muted">
                                    <span>2022-02-02 17:49:21</span>
                                    <p>
                                                                            </p>
                                </div>
                            </div>
                            <br>
                                                            </div>
                <div class="all-reviews">

                </div>
            </div> -->
            <!-- PRODUCT REVIEWS -->

            <!-- RELATED PRODUCTS -->
            <!-- <div class="related-products">
                <h4>Related Products</h4>

                <div id="related-products" dir="ltr" class="swiper swipers swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-421d836c818b9855" aria-live="off" style="transform: translate3d(0px, 0px, 0px);">
                                                                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/2/Apple-iPhone-11-Pro-Max-%2864GB%29---Fully-Unlocked">
                                                <img src="https://codma.ma/demo/img/uploads/b9c36cab8273d0adfbaf1a43aa18564e.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form2">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="2">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form2">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="2">
                                                    </form>
                                                    <button type="submit" form="wishlist-form2"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form2"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/2/Apple-iPhone-11-Pro-Max-%2864GB%29---Fully-Unlocked">Apple iPhone 11 Pro Max (64GB) - Fully Unlocked</a>
                                            </h5>

                                                                                        <div class="stars stars-3"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    879.99MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            920.00MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/3/Apple-11-inch-iPad-Pro-%282021%29-Wi-Fi-128GB---fully-unlocked">
                                                <img src="https://codma.ma/demo/img/uploads/a324af834934445d4fd59d78d9a6892d.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form3">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="3">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form3">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="3">
                                                    </form>
                                                    <button type="submit" form="wishlist-form3"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form3"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/3/Apple-11-inch-iPad-Pro-%282021%29-Wi-Fi-128GB---fully-unlocked">Apple 11-inch iPad Pro (2021) Wi-Fi 128GB - fully unlocked</a>
                                            </h5>

                                                                                        <div class="stars stars-4"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    1220.00MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            1300.00MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="swiper-slide" role="group" aria-label="3 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/6/Watch-Charger-Magnetic-Charging-Cable-for-iWatch">
                                                <img src="https://codma.ma/demo/img/uploads/e0f9ecb3bce8c75bdd3d751ce6479794.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form6">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="6">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form6">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="6">
                                                    </form>
                                                    <button type="submit" form="wishlist-form6"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form6"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/6/Watch-Charger-Magnetic-Charging-Cable-for-iWatch">Watch Charger Magnetic Charging Cable for iWatch</a>
                                            </h5>

                                                                                        <div class="stars stars-4"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    69.99MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            75.99MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="swiper-slide" role="group" aria-label="4 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/1/Garmin-Vivo-smart-3-Activity-Tracker---3D-Screen">
                                                <img src="https://codma.ma/demo/img/uploads/cc48d1bd495b4716bb2f2796ac384731.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form1">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="1">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form1">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="1">
                                                    </form>
                                                    <button type="submit" form="wishlist-form1"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form1"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/1/Garmin-Vivo-smart-3-Activity-Tracker---3D-Screen">Garmin Vivo smart 3 Activity Tracker - 3D Screen</a>
                                            </h5>

                                                                                        <div class="stars stars-4"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    49.99MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            60.00MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="swiper-slide" role="group" aria-label="5 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/5/Cubitt-Smart-Watch-CT2S-Waterproof-Fitness-Tracker">
                                                <img src="https://codma.ma/demo/img/uploads/306e4f43f00778aa2c9322b9b8b327a5.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form5">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="5">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form5">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="5">
                                                    </form>
                                                    <button type="submit" form="wishlist-form5"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form5"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/5/Cubitt-Smart-Watch-CT2S-Waterproof-Fitness-Tracker">Cubitt Smart Watch CT2S Waterproof Fitness Tracker</a>
                                            </h5>

                                                                                        <div class="stars stars-5"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    250.00MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            320.00MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="swiper-slide" role="group" aria-label="6 / 6" style="width: 186.667px; margin-right: 50px;">
                                    <div class="card">
                                        <div class="product-img">
                                            <a href="https://codma.ma/demo/product/4/Apple-iPhone-11-%284GB-64GB%29-Yellow---Fully-Unlocked">
                                                <img src="https://codma.ma/demo/img/uploads/7558f207b6ba1cb4f00b4767fa2bd5dc.webp" class="card-img-top p-img" alt="">
                                                <div class="floating-buttons">
                                                    <form action="https://codma.ma/demo/card" method="post" id="card-form4">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="4">
                                                    </form>
                                                    <form action="https://codma.ma/demo/wishlist" method="post" id="wishlist-form4">
                                                        <input type="hidden" name="_token" value="2rd2JrmcFAmTITEFZRt8JGAz3yYVU3nQgO5Hsmf1">                                                        <input type="hidden" name="p_id" value="4">
                                                    </form>
                                                    <button type="submit" form="wishlist-form4"><i class="bx bx-cart"></i></button>
                                                    <button type="submit" form="card-form4"><i class="bx bx-heart"></i></button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p class="cat-name">Audio &amp; Home</p>
                                            <h5 class="card-title">
                                                <a href="https://codma.ma/demo/product/4/Apple-iPhone-11-%284GB-64GB%29-Yellow---Fully-Unlocked">Apple iPhone 11 (4GB-64GB) Yellow - Fully Unlocked</a>
                                            </h5>

                                                                                        <div class="stars stars-5"></div>

                                            <div class="prices">
                                                <p class="current-price">
                                                    650.00MAD
                                                </p>
                                                <p class="old-price">
                                                                                                            730.00MAD
                                                                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                            </div>

                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div> -->
            <!-- RELATED PRODUCTS -->
        </div>
<div class="modal fade show" data-backdrop="true" id="buy-now" aria-modal="true" role="dialog" style="padding-right: 10px; display: none;" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content px-2">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Acheter Maintenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body contact-form">

                       <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fullName">Nom et prénom</label>
                                    <input type="text" class="form-control" name="fullName" required="" placeholder="Nom et prénom .." v-model="fullName">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" pattern="[0-9]{10}" class="form-control" name="phone" required placeholder="Téléphone .." v-model="phone">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">Adresse</label>
                                    <textarea class="form-control" name="address" required placeholder="Adresse .." style="height: 111px;" v-model="address"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="wilaya">Wilaya</label>
                                    <input type="text" class="form-control" name="wilaya" required placeholder="Wilaya .." v-model="wilaya">
                                </div>

                                  <div class="form-group col-md-12">
                                    <label for="commune">Commune</label>
                                    <input type="text" class="form-control" name="commune" required placeholder="Commune .." v-model="commune">
                                </div>
                            </div>

                            <h4><b class="total-price text-danger">Prix total : </b> <b>{{total_sale_price + " " + currency}}</b></h4>

                                    </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" @click.prevent="orderNow()">Commander</button>
                </div>
            </div>
        </div>
    </div>
    </section>

</template>

<script>

export default {
    data() {
        return {
            id: '',
            prodName: '',
            description: '',
            image_name: '',
            price: '',
            sale_price: '',
            quantity: 1,
            total_sale_price: '',
            category_id: '',
            category_name: '',
            category_slug: '',
            stock:'',
            stockColor:'text-success',
            sale:'',
            currency:'',

            userId: '',
            fullName:'',
            phone:'',
            address:'',
            wilaya:'',
            commune:'',
            item: [],
        }
    },
     props: ['value', 'user', 'storeCurrency'],
    methods: {
        initProduct(){
            this.currency = this.storeCurrency;
            this.id = this.value.id;
            this.prodName = this.value.name;
            this.description = this.value.description;
            this.image_name = this.value.image_name;
            this.price = this.value.price;
            this.sale_price = this.value.sale_price;
            this.category_id = this.value.category_id;
            this.category_name = this.value.category_name;
            this.category_slug = this.value.category_slug;
            if(this.value.in_stock == 1){
                this.stock = "En stock.";
            }else{
                this.stock = "En rupture de stock.";
                this.stockColor= "text-danger";
            }

            this.sale = this.value.on_sale;

            this.userId = this.user;


        },
        minusQuantity(){
            if(this.quantity > 1){
                this.quantity -= 1;
                this.total_sale_price = this.sale_price * this.quantity;
            }

        },
        plusQuantity(){
             if(this.quantity < 10){
            this.quantity += 1;
             this.total_sale_price = this.sale_price * this.quantity;
        }
        },
        async orderNow(){

            let response = await axios.post('/produit/get/article', {
                'id':this.id,
                'quantity': this.quantity });
            console.log(response.data);

            this.item = response.data;

            // const orderArray = [];
            // orderArray['id'] = this.item['id'];
            // orderArray['sale_price'] = this.item['price'];
            // orderArray['quantity'] = this.quantity;



            if(this.fullName != '' && this.address != '' && this.phone != '' && this.wilaya != '' && this.commune != ''){
                if(this.validatePhoneNumber(this.phone)){
                      let response = await axios.post('/processus/utilisateur/commande', {
                        'fullName':this.fullName,
                        'phone':this.phone,
                        'address':this.address,
                        'wilaya':this.wilaya,
                        'commune':this.commune,
                        'order':this.item,
                        'amount':this.total_sale_price,
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
                     this.$toastr.e('Téléphone incorrecte !');
                }

                }else{
                    this.$toastr.e('Informations incomplètes !')
                }
        },
            validatePhoneNumber(input) {
                var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

                 return re.test(input);
            }
    },
    created() {
            this.initProduct();
            this.total_sale_price = this.sale_price;
    }
}
</script>
