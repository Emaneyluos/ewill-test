<script>
import List from './List.vue';

export default {
    data() {
        return {
          info: null,
        }
    },
    mounted () {
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
    components: { List }
}
</script>

<template>
<div class="main">

  <List :info="info"></List>

  <div class="product">
  <router-view @refreshList="refresh">
  </router-view>
  </div>

</div>
</template>

<style>
.main {
  display: flex;
}

</style>