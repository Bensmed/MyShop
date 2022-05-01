<template>

    <div class="container-fluid position-relative" v-if="!deleted">
                        <div class="single-slider mb-5">
                            <div class="slider-bg">
                                <div class="row no-gutters align-items-center " style="border: 1px solid grey ">
                                    <div class="col-lg-4 col-md-5">
                                        <div class="slider-product-image d-none d-md-block">
                                            <img :src='"/images/sliders/" + image_name' alt="Slider">
                                            <div class="slider-discount-tag">
                                                <p>{{badge}}</p>
                                            </div>
                                        </div> <!-- slider product image -->
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        <div class="slider-product-content">
                                            <h1 class="slider-title mb-10" data-animation="fadeInUp" data-delay="0.3s" style="font-size: 65px">
                                                <span>{{title}}</span>
                                            </h1>
                                            <p class="mb-25" data-animation="fadeInUp" data-delay="0.9s">
                                                {{paragraph}}</p>
                                            <a class="main-btn" :href='"/" + link'
                                                data-animation="fadeInUp" data-delay="1.5s">{{button}} <i
                                                    class="lni-chevron-right"></i></a>

                                        </div> <!-- slider product content -->

                                </div> <!-- row -->
                            </div> <!-- container -->
                        </div> <!-- single slider -->

                </div> <!-- slider active -->
         <div class="slider-social">
                <div class="row justify-content-end">
                    <div class="col-lg-7 col-md-6">
                        <ul class="social text-right">
                            <li><a :href='"/admin/sliders/modifier/" + id' class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a></li>
                            <li><button class="btn btn-sm btn-danger" @click.prevent="deleteSlider(id)"><i class="fa-solid fa-trash-can"></i> </button></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div> <!-- container fluid -->

</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            id: '',
            title: '',
            paragraph: '',
            badge: '',
            button: '',
            link:'',
            image_name:'',

            deleted: false,


        }
    },props:['slider'],
    methods: {
        initProps(){
            this.id = this.slider.id;
            this.title = this.slider.title;
            this.paragraph = this.slider.paragraph;
            this.badge = this.slider.badge;
            this.button = this.slider.button;
            this.link = this.slider.link;
            this.image_name = this.slider.image_name;
        },
        async deleteSlider(){

            let response = await axios.post("/admin/sliders/supprimer/" + this.id);

            if(response.data.success){
                    this.$toastr.s(response.data.success);
                    this.deleted = true;
                }else{
                    this.$toastr.e(response.data.error);
                }

        },
        //  getSelectedImage(event){



        //     if(event.target.files.length === 0){
        //         return;
        //     }
        //     this.image_changed = true;
        //     this.image = event.target.files[0];
        //     this.image_name = this.image.name;

        //     let reader = new FileReader();
        //     reader.readAsDataURL(this.image);

        //     reader.onload = event => {
        //         this.image_preview = event.target.result;
        //     }

        // },


    },
    created() {
        this.initProps();
    },
}
</script>
