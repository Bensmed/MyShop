<template>
   <tr v-if="!deleted">
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>{{ email }}</td>
        <td>{{ address }}</td>
        <td>{{ wilaya }}</td>
        <td>{{ city }}</td>
        <td>
            <button class="btn btn-sm" :class='adminBtnColor' @click.prevent="userAdmin(id)"><i class="fa-solid fa-hammer"></i> {{adminBtn}}</button>
            <button class="btn btn-sm btn-danger"  @click.prevent="deleteUser(id)"><i class="fa-solid fa-trash-can"></i> Supprimer</button>
        </td>
    </tr>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            id: '',
            name:'',
            email:'',
            address:'',
            wilaya:'',
            city:'',
            role:'',

            adminBtn:'',
            adminBtnColor: 'btn-warning',

            deleted:false,
        }
    },
    props:['userId', 'userName', 'userEmail', 'userAddress', 'userWilaya', 'userCity', 'userRole'],
    methods: {
        initProps(){
            this.id = this.userId;
            this.name = this.userName;
            this.email = this.userEmail;
            this.address = this.userAddress;
            this.wilaya = this.userWilaya;
            this.city = this.userCity;
            this.role = this.userRole;
        },
        initAdminBtn(){
            if(this.role == 'Admin'){
                this.adminBtn = 'Remove admin';
                this.adminBtnColor = 'btn-primary';

            }else if(this.role == 'User'){
                this.adminBtn = 'Set as Admin';
                this.adminBtnColor = 'btn-warning';

            }
        },
        async userAdmin(id){
             if(this.role == 'Admin'){
                let response = await axios.post("/admin/utilisateurs/setAsUser", {
                    'id': id,
                    'name':this.name,
                    'role': 'User',
                });
                if(response.data.success){
                    this.role = 'User';
                    this.adminBtn = 'Set as Admin'
                    this.adminBtnColor = 'btn-warning';
                    this.$toastr.s(response.data.success);
                }else{
                    this.$toastr.e(response.data.error);
                }

            }else if(this.role == 'User'){
                let response = await axios.post("/admin/utilisateurs/setAsAdmin", {
                    'id':this.id,
                    'name':this.name,
                    'role': 'Admin',
                });
                if(response.data.success){
                    this.role = 'Admin';
                    this.adminBtn = 'Remove Admin'
                     this.adminBtnColor = 'btn-primary';
                    this.$toastr.s(response.data.success);
                }else{
                    this.$toastr.e(response.data.error);
                }

            }
        },
        async deleteUser(id){
            let response = await axios.post("/admin/utilisateurs/supprimer", {
                'id': id,
            });

              if(response.data.success){
                    this.$toastr.s(response.data.success);
                    this.deleted = true;
                }else{
                    this.$toastr.e(response.data.error);
                }

        }
    },
    created() {
        this.initProps();
        this.initAdminBtn();
    },
}
</script>
