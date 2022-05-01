<template>
     <form @submit.prevent="update" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <div class="form-group row mb-5">
                                            <label for="logo" class="col-sm-3 text-dark">Logo:</label>

                                            <div class="col-sm-9">
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input" id="logo"    @change="getSelectedLogo">
                                                    <label for="logo" class="custom-file-label text-dark" ><i>{{logo}}</i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-center" v-if="logo_preview">

                                            <img :src="logo_preview" alt="image" class="figure-img img-fluid rounded" style="max-height:300px">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-5">
                                            <label for="logo" class="col-sm-3 text-dark">Favicon:</label>

                                            <div class="col-sm-9">
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input" id="favicon"    @change="getSelectedFavicon">
                                                    <label for="favicon" class="custom-file-label text-dark" ><i>{{favicon}}</i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-center" v-if="favicon_preview">

                                            <img :src="favicon_preview" alt="image" class="figure-img img-fluid rounded" style="max-height:300px">
                                            </div>
                                        </div>


                                            <div class="form-group row mb-4 ">
                                                <div class="col-sm-3"></div>

                                                <button type="submit" class="btn btn-success col-sm-9"><i class="fa-solid fa-flag mr-2"></i>Sauvgarder</button>
                                            </div>
                                        </div>
                                    </form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            logo: '',
            favicon: '',

            logo_preview: '',
            favicon_preview: '',

            logo_changed: 0,
            favicon_changed: 0,

            logo_file: null,
            favicon_file: null,

        }
    },props:['exLogo', 'exFavicon'],
    methods: {
        initProps(){
            this.logo = this.exLogo;
            this.favicon = this.exFavicon;

            this.logo_preview = "/images/Logo/" + this.exLogo;
            this.favicon_preview = "/images/Logo/" + this.exFavicon;


        }, getSelectedLogo(event){

            if(event.target.files.length === 0){
                return;
            }
            this.logo_changed = 1;
            this.logo_file = event.target.files[0];
            this.logo = this.logo_file.name;

            let reader = new FileReader();
            reader.readAsDataURL(this.logo_file);

            reader.onload = event => {
                this.logo_preview = event.target.result;
            }

        }, getSelectedFavicon(event){

            if(event.target.files.length === 0){
                return;
            }
            this.favicon_changed = 1;
            this.favicon_file = event.target.files[0];
            this.favicon = this.favicon_file.name;

            let reader = new FileReader();
            reader.readAsDataURL(this.favicon_file);

            reader.onload = event => {
                this.favicon_preview = event.target.result;
            }

        },
        async update(){
            if(this.logo != '' && this.favicon != '' && (this.logo_changed == 1 || this.favicon_changed == 1) ){


                    var data = new FormData;
                    data.append('logo', this.logo_file);
                    data.append('favicon', this.favicon_file);
                    data.append('logo_changed', this.logo_changed);
                    data.append('favicon_changed', this.favicon_changed);

                    console.log(this.logo_file);
                    console.log(this.favicon_file);
            let response = await axios.post('/admin/parametres/logo/sauvgarder', data);

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

