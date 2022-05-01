<template>
     <form @submit.prevent="update" method="post">

                                        <div class="form-group">
                                            <div class="form-group row mb-4">
                                                <label for="currency" class="col-sm-3 col-form-label text-dark">Devise:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="currency" required
                                                        placeholder="Devise .."
                                                        v-model="currency">
                                                </div>
                                            </div>

                                        <div class="form-group row mb-4">
                                                <label for="facebook_pixel" class="col-sm-3 col-form-label text-dark">Facebook pixel:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="facebook_pixel"
                                                        placeholder="Facebook pixel ID .."
                                                        v-model="facebook_pixel">
                                                </div>
                                            </div>


                                            <div class="form-group row mb-4 ">
                                                <div class="col-sm-3"></div>

                                                <button type="submit" class="btn btn-success col-sm-9"><i class="fa-solid fa-ellipsis mr-2"></i>Sauvgarder</button>
                                            </div>
                                        </div>
                                    </form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            currency:'',
            facebook_pixel: '',


        }
    },props:['exCurrency', 'exFacebook_pixel'],
    methods: {
        initProps(){
            this.currency = this.exCurrency;
            this.facebook_pixel = this.exFacebook_pixel;
        },
        async update(){
            if(this.currency != this.exCurrency || this.facebook_pixel != this.exFacebook_pixel){


                    var data = new FormData;
                    data.append('currency', this.currency);
                    data.append('facebook_pixel', this.facebook_pixel);



            let response = await axios.post('/admin/parametres/plus-parametres/sauvgarder', data);

            if(response.data.success){
                        this.$toastr.s(response.data.success);
                    }else{
                        this.$toastr.e(response.data.error);
                    }

                     setTimeout(() => {
                        window.location.href = '/admin/parametres';
                        }, 500);
     }

        },
    },
    created() {
        this.initProps();
    },
}
</script>

