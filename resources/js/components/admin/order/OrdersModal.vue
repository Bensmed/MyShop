<template>

      <div class="modal fade show" data-backdrop="true" :id='"orderId_" + id' aria-modal="true" role="dialog" style=" margin-top:-100px;padding-right: 10px; display: none;" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content px-2">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Ordre(s)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body contact-form">

                           <table class=" table table-hover" style="background-color: white;color: #1E1E1E;">
                <thead >
                    <tr>
                        <th scope="col">Id de produit</th>
                        <th scope="col">Nom de produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="product in orders" :key="product.id">
                        <td class="text-center"><strong>{{product.product_id}}</strong></td>
                        <td class="text-center">{{product.product_name}}</td>
                        <td class="text-center">{{product.price + ' ' + currency}}</td>
                        <td class="text-center">{{product.quantity}}</td>
                    </tr>
                </tbody>
            </table>
                                    </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



</template>

<script>
export default {
    data() {
        return {
           id: '',
           orders: '',
           currency: '',

        };
    },
    props: [
        "orderId",
        "ordersDetails",
        "storeCurrency"

    ],
    methods: {
        initProps() {
            this.id = this.orderId;
            this.orders = this.ordersDetails;
            this.currency = this.storeCurrency;

        },


    },
    created() {
        this.initProps();
    },
};
</script>
