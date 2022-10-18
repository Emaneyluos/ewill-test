<script>

export default {
  data() {
    return {
      product: null,
      url: null,
      lastId :null   
    }
  },

  methods: {
    deleteProduct(){
      axios
        .delete(this.url)
        .then(console.log("delete"));
      this.$emit('refreshList')
    }
  },
  
  beforeMount() {
    this.url = '/api/products/' + this.$store.state.id;
    axios
      .get(this.url)
      .then(response => (this.product = response.data));
    
  },

  beforeUpdate() {
    if (this.lastId !=  this.$store.state.id)
    {
      this.url = '/api/products/' + this.$store.state.id;
      axios
        .get(this.url)
        .then(response => (this.product = response.data));
      this.lastId = this.$store.state.id;
    } 
  },
  
}


</script>

<template>
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

<button @click="deleteProduct" class="btn btn-danger">Supprimer</button>

</template>

<style>

</style>