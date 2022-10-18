<script>
import axios from 'axios';


export default {
  data() {
    return {
      product: null,
      url: null,
      lastId: null,
      fieldIsOk : true  
    }
  },

  methods: {
    refresh(){
      if (this.$store.state.id !== 0)
      {
        this.url = '/api/products/' + this.$store.state.id;
        axios
          .get(this.url)
          .then(response => (this.product = response.data));
      }

      else
      {
        this.product = { name: null,
                    price: null,
                    reference: null};
      }

      this.lastId = this.$store.state.id;
    },

    deleteProduct(){
      axios
        .delete(this.url)
        .then(this.$emit('refreshList'));
    },

    modifyProduct(){
      axios
        .put(this.url, this.product)
        .then(this.$emit('refreshList'));

    },

    addProduct(){
      this.product.reference = Number(this.product.reference);
      axios
        .post('/api/products', this.product)
        .then(this.$emit('refreshList'));
    }
  },
  
  beforeMount() {
    this.refresh();
  },

  beforeUpdate() {
    if (this.lastId != this.$store.state.id ){
     this.refresh();
    }

    // if (this.product.reference != ""){
    //   if (this.product.price != ""){
    //     if (this.product.name != "") {this.fieldIsOk = true}
    //     else { this.fieldIsOk = false}}
    //   else { this.fieldIsOk = false}}
    // else { this.fieldIsOk = false}
  },
  
}


</script>

<template>
<div class="field">
  

<template v-if="this.$store.state.id != 0">
  <p>Reference: {{ product.reference }}</p>
</template>
  
<template v-else>
  <label for="name">Reference: </label>
  <input type="text" name="ref" id="ref" v-model="product.reference">
</template>

<label for="name">Nom du produit : </label>
<input type="text" name="name" id="name" v-model="product.name">

<label>Prix du produit:</label>
<input type="number" name="price" id="price" v-model="product.price">

</div>

<form action="/api/products/1" method="delete" ></form>

<template v-if="this.$store.state.id != 0">
  <button @click="modifyProduct"  class="btn btn-outline-primary" >Sauvegarder</button>
  <button @click="deleteProduct" class="btn btn-outline-danger">Supprimer</button>
</template>
  
<template v-else>
  <button @click="addProduct"  :class="{disabledButton: !fieldIsOk}"  class="btn btn-outline-success">Créer</button>
</template>

</template>

<style>

.field {
  display: flex;
  flex-direction: column;
}

.disabledButton {
  background-color: black;
  cursor: not-allowed;
}
</style>