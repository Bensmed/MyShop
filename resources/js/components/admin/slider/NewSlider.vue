<template>
<form @submit.prevent="addOrModifyASlider"  method="POST" enctype="multipart/form-data">
     <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <h4 class="text-center"> <strong>Informations</strong></h4>
                    <hr>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row mb-4">
                                <label for="title" class="col-sm-3 col-form-label text-dark">Titre: <span
                                        style="color: red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" required
                                        placeholder="Titre .." v-model="title">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="paragraph" class="col-sm-3 col-form-label text-dark">Paragraph:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" title="paragraph" required placeholder="Paragraphe ..." style="height: 150px;" v-model="paragraph"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="badge" class="col-sm-3 col-form-label text-dark">Badge:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="badge" required
                                        placeholder="Badge .." v-model="badge">
                                </div>
                            </div>

                            <br>
                            <hr>

                            <h4 class="text-center"> <strong>Bouton</strong></h4>

                            <hr>
                            <br>

                            <div class="form-group row mb-4">
                                <label for="button" class="col-sm-3 col-form-label text-dark">Nom:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="button" required
                                        placeholder="Nom du bouton .." v-model="button">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="link" class="col-sm-3 col-form-label text-dark">Lien:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="link" required
                                        placeholder="Lien du bouton .." v-model="link">
                                </div>
                            </div>

                            <br>
                            <hr>

                            <h4 class="text-center"> <strong>Image</strong></h4>

                            <hr>
                            <br>

                            <div class="form-group row mb-5">
                                <label for="image_name" class="col-sm-3 text-dark">Image:</label>

                                <div class="col-sm-9">
                                    <div class="custom-file ">

                                        <input type="file" class="custom-file-input" id="image_name" @change="getSelectedImage">
                                        <label for="image_name" class="custom-file-label text-dark" ><i>{{image_name}}</i></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-center" v-if="image_preview">

                                <img :src="image_preview" alt="image" class="figure-img img-fluid rounded" style="max-height:300px">
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
            title:'',
            paragraph:'',
            badge:'',

            button:'',
            link:'',

            image_name:'Dimensions supportée: ( 770 x 950) px',
            image: null,
            image_preview: null,

            submitButton:'Sauvgarder',
            editedSlider_id: 0,
            slider:'',
            image_changed: 0,
        }
    },props:['editSlider'],
    methods: {
        initProps(){
            this.slider = this.editSlider;

            if(this.slider !== 'new'){
                this.editedSlider_id = this.slider.id;
                this.title= this.slider.title;
                this.paragraph= this.slider.paragraph;
                this.badge= this.slider.badge;
                this.button= this.slider.button;
                this.link= this.slider.link;
                this.image = this.image_name = this.slider.image_name;
                this.image_preview= "/images/sliders/" + this.slider.image_name;
                this.submitButton = 'Modifier';
            }
        },
        getSelectedImage(event){

            if(event.target.files.length === 0){
                return;
            }
            this.image_changed = 1;
            this.image = event.target.files[0];
            this.image_name = this.image.name;

            let reader = new FileReader();
            reader.readAsDataURL(this.image);

            reader.onload = event => {
                this.image_preview = event.target.result;
            }
        },
        async addOrModifyASlider(){

            if(this.title != '' && this.paragraph != '' && this.badge != '' && this.button != '' && this.link != '' && this.image != null){

                var data = new FormData;
                    data.append('title', this.title);
                    data.append('paragraph', this.paragraph);
                    data.append('badge', this.badge);
                    data.append('button', this.button);
                    data.append('link', this.link);
                    data.append('image', this.image);

                if(this.slider === 'new'){
                    var response = await axios.post("/admin/sliders/ajouter/sauvgarder", data);


            }else{

                    if(this.title !== this.slider.title || this.paragraph !== this.slider.paragraph || this.badge !== this.slider.badge || this.button !== this.slider.button || this.link !== this.slider.link || this.image_changed === 1){

                        data.append('image_changed', this.image_changed);

                        var response = await axios.post("/admin/sliders/modifier/" + this.editedSlider_id + "/sauvgarder", data);


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
                        window.location.href = '/admin/sliders';
                        }, 2000);


         }else{
             this.$toastr.e('Remplissez tous les champs non vides et sélectionnez une catégorie.');
         }

        }

    },
    created() {
        this.initProps();
    },
}
</script>
