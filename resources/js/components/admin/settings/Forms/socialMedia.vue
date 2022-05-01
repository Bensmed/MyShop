<template>
     <form @submit.prevent="update" method="post">

                                        <div class="form-group">
                                            <div class="form-group row mb-4">
                                                <label for="facebook" class="col-sm-3 col-form-label text-dark"><i class="fa-brands fa-facebook mr-2 "></i>Facebook:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="facebook" required
                                                        placeholder="https://www.facebook.com/page"
                                                        v-model="facebook">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="twitter" class="col-sm-3 col-form-label text-dark"><i class="fa-brands fa-twitter mr-2"></i>Twitter:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="twitter" required
                                                        placeholder="https://www.twitter.com/page" v-model="twitter">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-5">
                                                <label for="instagram" class="col-sm-3 col-form-label text-dark"><i class="fa-brands fa-instagram mr-2"></i>Instagram:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="instagram" required
                                                        placeholder="https://www.instagram.com/page" v-model="instagram">
                                                </div>
                                            </div>


                                            <div class="form-group row mb-4 ">
                                                <div class="col-sm-3"></div>

                                                <button type="submit" class="btn btn-success col-sm-9"><i class="fa-solid fa-share-nodes mr-2"></i>Sauvgarder</button>
                                            </div>
                                        </div>
                                    </form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            facebook:'',
            twitter:'',
            instagram:'',


        }
    },props:['exFacebook', 'exTwitter', 'exInstagram'],
    methods: {
        initProps(){
            this.facebook = this.exFacebook;
            this.twitter = this.exTwitter;
            this.instagram = this.exInstagram;

        },
        async update(){
            if(this.facebook != this.exFacebook || this.twitter != this.exTwitter || this.instagram != this.exInstagram ){


                    var data = new FormData;
                    data.append('facebook', this.facebook);
                    data.append('twitter', this.twitter);
                    data.append('instagram', this.instagram);


            let response = await axios.post('/admin/parametres/media-sociaux/sauvgarder', data);

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

