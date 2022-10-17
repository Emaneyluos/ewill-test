<script>
export default {
  data() {
    return {
      product: null,
      url: null
    }
  },
  methods: {
    callProduct(id) {
      this.url = '/api/products/' + id;
    axios
      .get(this.url)
      .then(response => (this.product = response.data));
      // console.log("refresh");

    },

    delete(){
      axios.delete(this.url);
    }
  },
}


</script>

<template>
{{ callProduct($route.params.id)}}
<div>
  <p>Reference: {{ product.reference }}</p>

  <form action="/api/products/1" method="PUT" id="form1">
  <label for="name">Nom du produit : </label>
  <input type="text" name="name" id="name" :value="product.name">

  <label>Prix du produit:</label>
  <input type="number" name="price" id="price" :value="product.price">

</form>
</div>

<form action="/api/products/1" method="delete" id="form2"></form>

<button form="form1" class="btn btn-primary" >Sauvegarder</button>

<button @click="delete" class="btn btn-danger" >Supprimer</button>

</template>

<style>

</style>