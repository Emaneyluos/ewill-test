<script>
import List from './List.vue';

export default {
    data() {
        return {
          info: null,
          infoFiltered: null,
          searchName: ''
        }
    },
   

  beforeMount() {
    axios
      .get('/api/products')
      .then(response => {
        this.info = response.data
        this.infoFiltered = this.info
      });

  },

  methods: {
    refresh (){
      axios
      .get('/api/products')
      .then(response => (this.info = response.data));
    }
  },
    
  beforeUpdate() {
      this.infoFiltered = this.info.filter(produit =>
       produit.name.toLowerCase().match(this.searchName.toLowerCase())); 
  },

    components: { List },
    
}
</script>

<template>

<div class="main">

  <div class="list">
    <div class="search">
      <label for="searchName">Recherche par nom: </label>
      <input type="text" name="searchName" id="searchName" v-model="searchName">
    </div>

    <List :infoFiltered="infoFiltered"></List>
  </div>

  <div class="product">
  <router-view @refreshList="refresh">
  </router-view>
  </div>

</div>
</template>

<style>
.main {
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.list {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.search {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product {
  display: flex;
  flex-direction: column;
  align-items: center;
}

</style>