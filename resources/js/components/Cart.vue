<style>
.notification {

  background-color: transparent;
  position: relative;
  display: inline-block;

}



.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 2px 4px;
  border-radius: 100%;
  background: rgb(173, 0, 0);
  color: white;
  font-size: 10px;
}
</style>

<template>

<div>
   <li class="nav-item">
        <a href="/mon-panier"
        class="notification" >
        <span ><i class="fa fa-shopping-cart" ></i> </span>
        <span class="badge">{{itemCount}}</span>
          </a>
    </li>


</div>



</template>

<script>
    export default {
        data(){
            return {
                itemCount : '',
            }

        },
        mounted() {
           this.$root.$on('changeInCart', (item) => {
               this.itemCount = item;
           });

        },
        methods: {
            async getCardItemsOnPageLoad(){
                let response = await axios.post('/mon-panier/ajouter');
                this.itemCount =  response.data.items;

            }

        },
        created() {
            this.getCardItemsOnPageLoad();
        }
    }
</script>
