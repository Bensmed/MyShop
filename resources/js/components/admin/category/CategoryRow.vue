<template>
   <tr v-if="!deleted">
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>{{ description }}</td>
        <td>
             <a class="btn btn-sm btn-warning" :href='"/categorie/" + id + "/" + slug'><i class="fas fa-eye mr-1"></i>Consulter</a>
            <a class="btn btn-sm btn-primary" :href='"/admin/categories/modifier/" + id'><i class="fas fa-edit"></i> Modifier</a>
            <button class="btn btn-sm btn-danger"  @click.prevent="deleteCategory(id)"><i class="fa-solid fa-trash-can"></i> Supprimer</button>
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
            description:'',

            deleted:false,
        }
    },
    props:['categoryId', 'categoryName', 'categorySlug', 'categoryDescription'],
    methods: {
        initProps(){
            this.id = this.categoryId;
            this.name = this.categoryName;
            this.slug = this.categorySlug;
            this.description = this.categoryDescription;

        },


        async deleteCategory(id){
            let response = await axios.post("/admin/categories/supprimer", {
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
