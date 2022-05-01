<template>
     <form @submit.prevent="update" method="post">

                                        <div class="form-group">
                                            <div class="form-group row mb-4">
                                                <label for="primary" class="col-sm-3 col-form-label text-dark">Couleur primaire:
                                                </label>
                                                <div class="col-sm-9">
                                                   <color-picker v-model="primary" ></color-picker>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="hover" class="col-sm-3 col-form-label text-dark">Couleur de survol:
                                                </label>
                                                <div class="col-sm-9">
                                                    <color-picker v-model="hover"></color-picker>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-5">
                                                <label for="transparent" class="col-sm-3 col-form-label text-dark">Couleur transparent:
                                                </label>
                                                <div class="col-sm-9">
                                                   <color-picker v-model="transparent"></color-picker>

                                                </div>
                                            </div>


                                            <div class="form-group row mb-4 ">
                                                <div class="col-sm-3"></div>

                                                <button type="submit" class="btn btn-success col-sm-9"><i class="fa-solid fa-palette mr-2"></i>Sauvgarder</button>
                                            </div>
                                        </div>
                                    </form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            primary:'',
            hover:'',
            transparent:'',


        }
    },props:['exPrimaryColor', 'exHoverColor', 'exTransparentColor'],
    methods: {
        initProps(){
            this.primary = this.exPrimaryColor;
            this.hover = this.exHoverColor;
            this.transparent = this.exTransparentColor;

        },
        async update(){

            if(this.primary != this.exPrimaryColo || this.hover != this.exHoverColor || this.transparent != this.exTransparentColor ){


                    var data = new FormData;
                    data.append('primary', this.primary);
                    data.append('hover', this.hover);
                    data.append('transparent', this.transparent);


            let response = await axios.post('/admin/parametres/couleurs/sauvgarder', data);

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

