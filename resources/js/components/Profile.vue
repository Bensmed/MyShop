<template>
  <div class="fixed-page contact-page">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true"><i class="bx bx-cog"></i> Générale</a>
                    </li>
                   <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false"><i class="bx bx-key"></i> Password</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false"><i class="bx bx-image"></i> Avatar</a>
                    </li>  -->
                </ul>
                <div class="tab-content" id="sign-tabsContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-at"></i></span>
                                </div>
                                <input type="email" class="form-control rounded-0" v-model="email" name="email"
                                    required="" placeholder="Email" readonly>
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" v-model="name" name="name" required=""
                                    placeholder="Nom et prénom">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" v-model="phone" name="phone" required=""
                                    placeholder="Téléphone">
                            </div>


                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-location-crosshairs"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" v-model="address" name="address" required=""
                                    placeholder="Adresse">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-circle-nodes"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" v-model="state" name="state" required=""
                                    placeholder="Wilaya">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fa-solid fa-city"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" v-model="city" name="city" required=""
                                    placeholder="Commune">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-info" @click="updateProfile()"><i class="fa-regular fa-floppy-disk mr-1"></i>
                                    Sauvgarder</button>
                            </div>

                    </div>
                     <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="https://codma.ma/demo/user/1" method="post">
                            <input type="hidden" name="_token" value="EjeBRelPxNJWY17skinKLctZAN3JmdxecxkBcIOh"> <input
                                type="hidden" name="_method" value="PUT">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="bx bx-key"></i></span>
                                </div>
                                <input type="password" class="form-control rounded-0" name="cpassword" required=""
                                    placeholder="Current Password">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="bx bx-key"></i></span>
                                </div>
                                <input type="password" class="form-control rounded-0" name="npassword" required=""
                                    placeholder="New Password">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="bx bx-key"></i></span>
                                </div>
                                <input type="password" class="form-control rounded-0" name="rnpassword" required=""
                                    placeholder="Confirm Password">
                            </div>

                            <input type="hidden" name="formcase" value="passwordinfo">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="bx bx-lock-alt"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <form action="https://codma.ma/demo/user/1" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="EjeBRelPxNJWY17skinKLctZAN3JmdxecxkBcIOh"> <input
                                type="hidden" name="_method" value="PUT">

                            <div class="filepond--root pond filepond--hopper" data-style-button-remove-item-position="left"
                                data-style-button-process-item-position="right" data-style-load-indicator-position="right"
                                data-style-progress-indicator-position="right" data-style-button-remove-item-align="false">
                                <input class="filepond--browser" type="file" id="filepond--browser-06fzkbs0s" name="avatar"
                                    aria-controls="filepond--assistant-06fzkbs0s"
                                    aria-labelledby="filepond--drop-label-06fzkbs0s" accept="image/*">
                                <div style="height: 100%;"></div><a class="filepond--credits" aria-hidden="true"
                                    href="https://pqina.nl/" target="_blank" rel="noopener noreferrer">Powered by PQINA</a>
                                <div class="filepond--drop-label"
                                    style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label
                                        for="filepond--browser-06fzkbs0s" id="filepond--drop-label-06fzkbs0s"
                                        aria-hidden="true">Drag &amp; Drop your files or <span
                                            class="filepond--label-action" tabindex="0">Browse</span></label></div>
                                <div class="filepond--list-scroller">
                                    <ul class="filepond--list" role="list"></ul>
                                </div>
                                <div class="filepond--panel filepond--panel-root" data-scalable="true">
                                    <div class="filepond--panel-top filepond--panel-root"></div>
                                    <div class="filepond--panel-center filepond--panel-root"></div>
                                    <div class="filepond--panel-bottom filepond--panel-root"></div>
                                </div>
                                <div class="filepond--drip"></div><span class="filepond--assistant"
                                    id="filepond--assistant-06fzkbs0s" role="status" aria-live="polite"
                                    aria-relevant="additions"></span>
                                <fieldset class="filepond--data"></fieldset>
                            </div>


                            <input type="hidden" name="formcase" value="avatarinfo">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="bx bx-lock-alt"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>  -->
                </div>

            </div>
        </div>
</template>


<script>
import axios from 'axios';
export default {
    data() {
        return {
            id: 0,
            name: '',
            phone:'',
            email: '',
            address: '',
            state: '',
            city: '',

            oldName: '',
            oldPhone:'',
            oldAddress: '',
            oldState: '',
            oldCity: '',
        }
    },
    props: ['myId', 'myName','myPhone', 'myEmail', 'myAddress', 'myState', 'myCity'],
    methods: {
        initProps(){
            this.id = this.myId;
            this.name = this.myName;
            this.phone = this.myPhone
            this.email = this.myEmail;
            this.address = this.myAddress;
            this.state = this.myState;
            this.city = this.myCity;

            this.setOldValues();
        },
        async updateProfile(){

            if(this.name != this.oldName || this.phone != this.oldPhone || this.address != this.oldAddress || this.state != this.oldState || this.city != this.oldCity){

                if(this.validatePhoneNumber(this.phone)){


                let response = await axios.post("/profil/modifier/sauvgarder", {
                    'name': this.name,
                    'phone':this.phone,
                    'address': this.address,
                    'state': this.state,
                    'city': this.city,
                });


                 if(response.data.success){

                    this.setOldValues();

                    this.$toastr.s(response.data.success);
                }else{
                     this.$toastr.e(response.data.error);
                }
            }else{
                this.$toastr.e('Téléphone incorrecte !')
            }
            }
        },
        setOldValues(){
            this.oldName = this.name;
            this.oldPhone = this.phone
            this.oldAddress = this.address;
            this.oldState = this.state;
            this.oldCity = this.city;
        },
        validatePhoneNumber(input) {
            var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

            return re.test(input);
        }
    },
    created() {
        this.initProps();
    },
}
</script>
