<script>
export default {
  data() {
    return {
      product: null
    }
  },
  methods: {
    callProduct(id) {
      let url = '/api/products/' + id;
    axios
      .get(url)
      .then(response => (this.product = response.data));
    }
  },
  mounted () {
  }
}
</script>

<template>
{{ callProduct($route.params.id)}}
<div>
  <p>Reference: {{ product.reference }}</p>

  <label for="name">Nom du produit : </label>
  <input type="text" name="name" id="name" :value="product.name">

  <label>Prix du produit:</label>
  <input type="number" name="price" id="price" :value="product.price">
</div>

<button class="btn btn-primary">Sauvegarder</button>

</template>

<style>

</style>