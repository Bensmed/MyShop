<template>
<form @submit.prevent="addOrModifyACoupon"  method="POST" >
     <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <h4 class="text-center"> <strong>Informations</strong></h4>
                    <hr>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row mb-5">
                                <label for="code" class="col-sm-3 col-form-label text-dark">Code:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="code" required
                                        placeholder="Code .." v-model="code">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="type" class="col-sm-3 col-form-label text-dark">Type:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" v-model="type" id="type">
                                        <option value=''  disabled>Séléctionner une option ... </option>
                                        <option value='fixed' >Fixe</option>
                                        <option value='percent' >Pourcentage</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="value" class="col-sm-3 col-form-label text-dark">Valeur:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="value" required
                                        placeholder="Valeur .." v-model="value">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="max_usage" class="col-sm-3 col-form-label text-dark">Max d'utilisation:
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="max_usage" required
                                        placeholder="Max d'utilisation .." v-model="max_usage">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="expiration" class="col-sm-3 col-form-label text-dark">Date d'expiration:
                                </label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" class="form-control" id="expiration" required
                                        placeholder="Date d'expiration .." v-model="expiration">
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
            code: '',
            type: '',
            value: '',
            max_usage: '',
            expiration: null,

            submitButton:'Sauvgarder',
            editedCoupon_id: 0,
            coupon:'',
        }
    },props:['editCoupon', 'expirationDate'],
    methods: {
        initProps(){
            this.coupon = this.editCoupon;
            if(this.coupon !== 'new'){
                this.editedCoupon_id = this.coupon.id;
                this.code= this.coupon.code;
                this.type= this.coupon.type;
                this.value= this.coupon.value;
                this.max_usage= this.coupon.max_usage;

                this.expiration = this.expirationDate;
                this.submitButton = 'Modifier';
            }
        },

        async addOrModifyACoupon(){

            if(this.code !== '' && this.type !== '' && this.value !== '' && this.max_usage !== '' && this.expiration !== null ){

                var data = new FormData;
                    data.append('code', this.code);
                    data.append('type', this.type);
                    data.append('value', this.value);
                    data.append('max_usage', this.max_usage);
                    data.append('expiration_date', this.expiration);

                if(this.coupon === 'new'){
                    var response = await axios.post("/admin/coupons/ajouter/sauvgarder", data);


            }else{

                    if(this.code !== this.coupon.code || this.type !== this.coupon.type || this.value !== this.coupon.value || this.max_usage !== this.coupon.max_usage || this.expiration !== this.expirationDate){

                        var response = await axios.post("/admin/coupons/modifier/" + this.editedCoupon_id + "/sauvgarder", data);

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
                        window.location.href = '/admin/coupons';
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
