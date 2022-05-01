<template>
   <tr v-if="!deleted">
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>{{ description }}</td>
        <td>
             <a class="btn btn-sm btn-warning" :href='"/collections/" + id + "/" + slug'><i class="fas fa-eye mr-1"></i>Consulter</a>
            <a class="btn btn-sm btn-primary" :href='"/admin/collections/modifier/" + id'><i class="fas fa-edit"></i> Modifier</a>
            <button class="btn btn-sm btn-danger"  @click.prevent="deleteCollection()"><i class="fa-solid fa-trash-can"></i> Supprimer</button>
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
            decription:'',

            deleted:false,
        }
    },
    props:['collection'],
    methods: {
        initProps(){
            this.id = this.collection.id;
            this.name = this.collection.name;
            this.slug = this.collection.slug;
            this.description = this.collection.description;

        },


        async deleteCollection(){
            let response = await axios.post("/admin/collections/supprimer/" + this.id);

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
