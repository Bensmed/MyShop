<template>
   <div class="card">
       <div class="table-responsive">

            <table class=" table table-hover dash-table" style="background-color: white;color: #1E1E1E;">

                <caption style="background: #334155;">
                           <h4><i class="fa-solid fa-bag-shopping mr-2"></i> Dernières ventes</h4></caption>
                <thead style="background-color:#007b711a" >
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix total</th>
                        <th scope="col">Wilaya</th>
                        <th scope="col">Commune</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="order in latest" :key="order.id">
                    <th scope="row">{{order.id}}</th>
                    <td>{{order.client_name}}</td>
                    <td>{{order.amount + " " + currency }}</td>
                    <td>{{order.client_wilaya}}</td>
                    <td>{{order.client_commune}}</td>
                    </tr>
                </tbody>
            </table>
       </div>
        </div>


</template>

<script>
import axios from 'axios';
export default {
   data() {
        return {
            currency: '',
            latest: [],
        }
    },
    methods: {
        async getLatestSales(){
            let response = await axios.get('/admin/statistique/dernieresVentes');

            if(response.data.success){
                this.currency = response.data.currency;
                this.latest = response.data.values;
            }
        }

    },
    mounted() {
        this.getLatestSales();
    },

}
</script>
