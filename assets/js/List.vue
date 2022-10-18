<script>

export default {

    props: {
        info : Array
    },
  computed: {
        // id() {
        //     return this.$store.state.id
        // }
  },
  methods: {
        sendUpdateId(newId) {
            this.$store.dispatch('updateId', newId);
    },
}
}
</script>

<template>

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
      
          <tr v-for="product in this.info">
              <td>{{ product.reference }}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.price }}€</td>
              <td>
                <router-link :to="{ name: 'Show', params: { id: product.id}}"  @click.native='sendUpdateId(product.id)'>Go to Home</router-link>
              </td>
          </tr>
      </tbody>
    </table>
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