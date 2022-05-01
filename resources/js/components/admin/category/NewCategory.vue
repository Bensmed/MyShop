<template>
<form @submit.prevent="addOrModifyACategory"  method="POST" >
     <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <h4 class="text-center"> <strong>Informations</strong></h4>
                    <hr>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark">Nom: <span
                                        style="color: red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" required
                                        placeholder="Nom de produit .." v-model="name">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="description" class="col-sm-3 col-form-label text-dark">Description:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" required placeholder="Description .." style="height: 200px;" v-model="description"></textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-4 ">
                                <div class="col-sm-3"></div>
                                <button type="submit" class="btn btn-success col-sm-9" >{{submitButton}}</button>
                            </div>
                        </div>
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
            name:'',
            description:'',

            category:'',
            submitButton:'Sauvgarder',
            editedCategory_id: 0,
        }
    },props:['editCategory'],
    methods: {

        initProps(){
            this.category = this.editCategory;

            if(this.category !== 'new'){
                this.submitButton = 'Modifier';
                this.editedCategory_id = this.category.id;
                this.name= this.category.name;
                this.description = this.category.description;
            }
        },
        // getSelectedImage(event){

        //     if(event.target.files.length === 0){
        //         return;
        //     }

        //     this.image = event.target.files[0];
        //     this.image_name = this.image.name;

        //     let reader = new FileReader();
        //     reader.readAsDataURL(this.image);

        //     reader.onload = event => {
        //         this.image_preview = event.target.result;
        //     }

        // },
        async addOrModifyACategory(){


        if(this.name != '' && this.description != ''){

            let data = new FormData;
            data.append('name', this.name);
            data.append('description', this.description);

            if(this.category === 'new'){

                var response = await axios.post("/admin/categories/ajouter/sauvgarder", data);



            }else{

                if(this.name !== this.category.name || this.description !== this.category.description){

                    var response = await axios.post("/admin/categories/modifier/" + this.editedCategory_id + "/sauvgarder", data);

                }else{
                    return;
                }

            }

                 if(response.data.success){
                            this.$toastr.s(response.data.success);
                        }else{
                            this.$toastr.e(response.data.error);
                        }

                setTimeout(() => {
                    window.location.href = '/admin/categories';
                }, 2000);

         }else{
             this.$toastr.e('Remplissez tous les champs non vides.');
         }

        }

    },
    created() {
        this.initProps();
    },
}
</script>
