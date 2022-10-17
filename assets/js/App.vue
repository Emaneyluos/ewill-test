<script>
export default {
  data() {
    return {
      info: null
    }
  },
  methods: {
   
  },
  mounted () {
    axios
      .get('/api/products')
      .then(response => (this.info = response.data));
  }
}
</script>

<template>
<div class="main">
  <div class="list">
    <table class="table">
      <thead>
          <tr>
              <th>Reference</th>
              <th>Name</th>
              <th>Price</th>
          </tr>
      </thead>
      <tbody>
      
          <tr v-for="product in info">
              <td>{{ product.reference }}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.price }}€</td>
              <td>
                <router-link :to="{ name: 'Show', params: { id: product.id}}">Go to Home</router-link>
              </td>
          </tr>

      </tbody>
    </table>
  </div>

  <div class="product">
  <router-view>
  </router-view>
  </div>

</div>
</template>

<style>
.main {
  display: flex;
}

.list {
  width: 50vw;
}
</style>