<template>
   <tr v-if="!deleted">
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>{{ price }}</td>
        <td>{{ sale_price }}</td>
        <td>{{ category }}</td>
        <td>  <div class="form-group">
    <select class="form-control w-75" v-model="stock" @change.prevent="update_stock">
      <option value=1 >En stock</option>
      <option value=0 >En rupture de stock</option>
    </select>
  </div></td>
        <td>
             <a class="btn btn-sm btn-warning" :href='"/produit/" + id + "/" + slug'><i class="fas fa-eye mr-1"></i>Consulter</a>
            <a class="btn btn-sm btn-primary" :href='"/admin/produits/modifier/" + id' ><i class="fas fa-edit"></i> Modifier</a>
            <button class="btn btn-sm btn-danger"  @click.prevent="deleteProduct(id)"><i class="fa-solid fa-trash-can"></i> Supprimer</button>
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
            slug:'',
            price:'',
            sale_price:'',
            category:'',
            stock:'',

            deleted:false,
        }
    },
    props:['productId', 'productName', 'productSlug', 'productPrice', 'productSalePrice', 'productCategory','inStock', 'onSale', 'storeCurrency' ],
    methods: {
        initProps(){

            this.id = this.productId;
            this.name = this.productName;
            this.slug = this.productSlug;
            this.price = this.productPrice + ' ' + this.storeCurrency;
            if(this.onSale == 1){

                this.sale_price = this.productSalePrice + ' ' + this.storeCurrency;;
            }else{
                this.sale_price = '-';
            }

            this.category = this.productCategory;
            this.stock = this.inStock;

        },
        async update_stock(){

            let response = await axios.post("/admin/produits/"+ this.id + "/stock", {
                'stock': this.stock,
            });

             if(response.data.success){
                    this.$toastr.s(response.data.success);
                }else{
                    this.$toastr.e(response.data.error);
                }
        },

        async deleteProduct(id){
            let response = await axios.post("/admin/produits/supprimer", {
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
    },
}
</script>
