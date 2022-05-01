<template>


                        <div class="col-lg-6 mx-auto" v-if="!deleted">
                            <div class="single-discount-product mt-30" style="border: 1px solid grey ">
                                <div class="product-image">
                                    <img :src='"/images/banners/" + image_name' alt="banner">
                                </div> <!-- product image -->
                                <div class="product-content">
                                    <h4 class='content-title mb-15' :class='"text-" + type'> {{ title }} <br>
                                        {{ paragraph }}
                                    </h4>
                                    <a :href='"/" + link' :class='"text-" + type'>{{ button }}
                                        <i class="lni-chevron-right"></i></a>

                                </div> <!-- product content -->
                            </div> <!-- single discount product -->
                             <div class="slider-social " >
                <div class="row justify-content-end" >
                    <div class="col-lg-7 col-md-6">
                        <ul class="social text-right">
                            <li><a :href='"/admin/banner/modifier/" + id' class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a></li>
                            <li><button class="btn btn-sm btn-danger" @click.prevent="deleteBanner()"><i class="fa-solid fa-trash-can"></i> </button></li>
                        </ul>
                    </div>
                </div>
                </div>
                        </div>




</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            id: '',
            title: '',
            paragraph: '',
            type: '',
            button: '',
            link:'',
            image_name:'',

            deleted: false,


        }
    },props:['banner'],
    methods: {
        initProps(){
            this.id = this.banner.id;
            this.title = this.banner.title;
            this.paragraph = this.banner.paragraph;
            this.type = this.banner.type;
            this.button = this.banner.button;
            this.link = this.banner.link;
            this.image_name = this.banner.image_name;
        },
        async deleteBanner(){

            let response = await axios.post("/admin/banner/supprimer/" + this.id);

            if(response.data.success){
                    this.$toastr.s(response.data.success);
                    this.deleted = true;
                }else{
                    this.$toastr.e(response.data.error);
                }

        },
    },
    created() {
        this.initProps();
    },
}
</script>
