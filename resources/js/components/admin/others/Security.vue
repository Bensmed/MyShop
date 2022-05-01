<template>
     <form @submit.prevent="update" method="post">
                                     <div class="card">
                                         <div class="card-body">
                                        <div class="form-group">
                                        <div class="form-group row mb-5">
                                                <div class="col-sm-12">
                                                   <textarea id="securityPage" :value="security"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-4 ">
                                                <button type="submit" class="btn btn-success col-sm-9 mx-auto"><i class="fas fa-save mr-2"></i>Sauvgarder</button>
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
            security: '',
        }
    },props:['editSecurity'],
    methods: {
        initProps(){
            this.security = this.editSecurity;
        },
        async update(){
            let securityPage = tinymce.get('securityPage').getContent();

            let response = await axios.post("/admin/confidentialite/sauvgarder", {
                'content': securityPage
            });

               if(response.data.success){
                        this.$toastr.s(response.data.success);
                    }else{
                        this.$toastr.e(response.data.error);
                    }

                     setTimeout(() => {
                        window.location.href = '/admin/parametres';
                        }, 500);


        },
    },
    created() {
        this.initProps();
    },
}
</script>

