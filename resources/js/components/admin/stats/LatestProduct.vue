<template>
   <div class="card" >
       <div class="table-responsive">
            <table class=" table table-hover dash-table" style="background-color: white;color: #1E1E1E;">

                <caption style="background: #007B70;">
                           <h4><i class="fa-solid fa-box mr-2"></i> Dernières produits</h4></caption>
                <thead style="background-color:#D5E5E6">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="product in latest" :key="product.id">
                    <th scope="row">{{product.id}}</th>
                    <td>{{product.name}}</td>
                    <td>{{product.category_name }}</td>
                    <td>{{product.in_stock ? 'En stock': 'En rupture de stock'}}</td>
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
            latest: [],
        }
    },
    methods: {
        async getLatestProducts(){
            let response = await axios.get('/admin/statistique/dernieresProduits');

            if(response.data.success){
                this.latest = response.data.values;
            }
        }

    },
    mounted() {
        this.getLatestProducts();
    },

}
</script>
