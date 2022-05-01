<template>
    <tr >
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>{{ address }}</td>
        <td>{{ state }}</td>
        <td>{{ city }}</td>
        <td>{{ phone }}</td>
        <td>{{ amount + ' ' + currency }}</td>
        <td><button
                class="btn btn-sm btn-warning"
                data-toggle="modal" :data-target='"#orderId_" + id'><i class="fas fa-eye mr-1" ></i>Consulter</button
            ></td>
        <td>  <div class="form-group">
    <select class="form-control" v-model="order_status" @change.prevent="update_status(id, order_status)">
      <option v-for="option in select_order_status" :value="option" :key="option">{{option}}</option>
    </select>
  </div></td>

        <!-- <td>

            <button class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Modifier
            </button>
            <button
                class="btn btn-sm btn-danger"
                @click.prevent="deleteorder(id)"
            >
                <i class="fa-solid fa-trash-can"></i> Supprimer
            </button>
        </td> -->
    </tr>

</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            id: '',
            name: '',
            address: '',
            state: '',
            city:'',
            phone: '',
            amount: '',
            details: '',
            order_status: '',

            select_order_status: ['En attente', 'Validé', 'Expédié', 'Livré', 'Terminé', 'Annulé' ],


        };
    },
    props: [
        'order',
        'storeCurrency'
    ],
    methods: {
        initProps() {
            this.currency = this.storeCurrency;

            this.id = this.order.id;
            this.name = this.order.client_name;
            this.address = this.order.client_address;
            this.state = this.order.client_wilaya;
            this.city = this.order.client_commune;
            this.phone = this.order.client_phone;
            this.amount = this.order.amount;
            this.details = this.order.order_details;
            this.order_status =  this.order.status;


        },

        async update_status(id, status) {
            let response = await axios.post("/admin/ventes/statut", {
                id: id,
                status: status,
            });

            if (response.data.success) {
                this.$toastr.s(response.data.success);
                this.order_status = status;
            } else {
                this.$toastr.e(response.data.error);
            }
        },
    },
    created() {
        this.initProps();

    },
};
</script>
