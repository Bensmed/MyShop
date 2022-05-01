<template>
    <tr v-if="!deleted" >
        <th scope="row">{{ id }}</th>
        <td>{{ code }}</td>
        <td>{{ type }}</td>
        <td>{{ value }}</td>
        <td>{{ used }}</td>
        <td>{{ max_usage }}</td>
        <td>{{ expiration }}</td>
         <td>
            <a class="btn btn-sm btn-primary" :href='"/admin/coupons/modifier/" + id' ><i class="fas fa-edit"></i> Modifier</a>
            <button class="btn btn-sm btn-danger"  @click.prevent="deleteCoupon(id)"><i class="fa-solid fa-trash-can"></i> Supprimer</button>
        </td>

    </tr>

</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            id: '',
            code: '',
            type: '',
            value: '',
            used: 0,
            max_usage: 0,
            expiration: '',

            deleted: false,
        };
    },
    props: [
        'coupon'
    ],
    methods: {
        initProps() {
            this.id = this.coupon.id;
            this.code = this.coupon.code;
            this.type = this.coupon.type;
            this.value = this.coupon.value;
            this.used = this.coupon.used;
            this.max_usage = this.coupon.max_usage;
            this.expiration = this.coupon.expiration_date;

        },


    async deleteCoupon(id){
            let response = await axios.post("/admin/coupons/supprimer/" + id);

            if(response.data.success){
                    this.$toastr.s(response.data.success);
                    this.deleted = true;
                }else{
                    this.$toastr.e(response.data.error);
                }

        },
    },
    created() {
        this.initProps();

    },
};
</script>
