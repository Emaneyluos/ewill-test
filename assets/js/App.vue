<script>
import List from './List.vue';

export default {
    data() {
        return {
          info: null,
          searchReference: null,
          searchName: null
        }
    },
    beforeMounte () {
    axios
      .get('/api/products')
      .then(response => (this.info = response.data));
  },
    methods: {
      refresh (){
        axios
        .get('/api/products')
        .then(response => (this.info = response.data));
      }
    },
    components: { List },

    computed: {
      productName(){
        return this.info.filter(name => name == searchName)
      }
    }
}
</script>

<template>

<div class="main">

  <div class="list">
    <div class="search">
      <label for="searchRef">Recherche par reference: </label>
      <input type="text" name="searchRef" id="searchRef" v-model="searchReference">
      <label for="searchName">Recherche par nom: </label>
      <input type="text" name="searchName" id="searchName" v-model="searchName">
    </div>

    <li v-for="test in productName">
      <p>{{ test.price }}</p>
    </li>

    <List :info="info"></List>
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