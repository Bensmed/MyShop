<template>
     <form @submit.prevent="update" method="post">

                                        <div class="form-group">
                                            <div class="form-group row mb-4">
                                                <label for="title" class="col-sm-3 col-form-label text-dark">Titre de Site
                                                    Web:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="title" required
                                                        placeholder="Titre de site web .."
                                                        v-model="title">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label text-dark">E-mail:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" required
                                                        placeholder="E-mail .." v-model="email">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-5">
                                                <label for="address"
                                                    class="col-sm-3 col-form-label text-dark">Adresse:</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="address" required placeholder="Adresse .."
                                                        style="height: 120px;" v-model="address"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="phone1" class="col-sm-3 col-form-label text-dark">Téléphone 1:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone1" required
                                                        placeholder="Téléphone 1 .."
                                                        v-model="phone1">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="phone2" class="col-sm-3 col-form-label text-dark">Téléphone 2:
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone2" required
                                                        placeholder="Téléphone 2 .."
                                                        v-model="phone2">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-5">
                                                <label for="description"
                                                    class="col-sm-3 col-form-label text-dark">Description:</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" required placeholder="Description .."
                                                        style="height: 200px;"
                                                        v-model="description"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4 ">
                                                <div class="col-sm-3"></div>

                                                <button type="submit" class="btn btn-success col-sm-9"><i
                                                        class="fa-solid fa-gear mr-2"
                                                       ></i>Sauvgarder</button>
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
            email:'',
            address:'',
            phone1:'',
            phone2:'',
            description:'',

        }
    },props:['exTitle', 'exEmail', 'exAddress', 'exPhone1', 'exPhone2', 'exDescription'],
    methods: {
        initProps(){
            this.title = this.exTitle;
            this.email = this.exEmail;
            this.address = this.exAddress;
            this.phone1 = this.exPhone1;
            this.phone2 = this.exPhone2;
            this.description = this.exDescription;
        },
        async update(){
            if(this.title != this.exTitle || this.email != this.exEmail || this.address != this.exAddress || this.phone1 != this.exPhone1 || this.phone2 != this.exPhone2 || this.description != this.exDescription){


                    var data = new FormData;
                    data.append('title', this.title);
                    data.append('email', this.email);
                    data.append('address', this.address);
                    data.append('phone1', this.phone1);
                    data.append('phone2', this.phone2);
                    data.append('description', this.description);

            let response = await axios.post('/admin/parametres/parametres-general/sauvgarder',data);

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

