



<template>

    

<div class="card">

    <div class="card-header">
        
        <h4>
            Products
            <RouterLink to="/products/create"
                class="btn btn-primary float-end">
                Add Product

            </RouterLink>

        </h4>
    </div>

        <div class="card-body">

                     
                          
                    <div v-for="(product, index) in this.products" :key="index" class="product">

                        
                        <div class="img">
                            <img :src="imageUrl" alt="Product Image">


                        </div>
                        <!-- <div>ID: {{ product.id }}</div> -->
                        <div>Name: {{ product.name }}</div>
                        <div>Description: {{ product.description }}</div>
                        <div>Price: {{ product.totalPrice }}</div>
                        <div>Stock: {{ product.stock }}</div>
                        <div>Discount: {{ product.discount }}</div>

                        <div class="action-buttons">
                           
                            <!-- <RouterLink to="'/edit/' + product.id" 
                            class="btn btn-success float-end">
                            Edit

                            </RouterLink> -->

                            <button @click="addToCart(product.id)" 
                            class="btn btn-success">ADD TO CART</button>

                        </div>

                    </div>
          
        </div>

</div>
    
</template>


<script>

import axios from 'axios';

export default  {
    name: 'products',
    data(){
        return {
            products: [],
            imageUrl: ''
        };
    },

    mounted(){
        this.getProducts();
        this.getImage();
    },

    methods: {
        getProducts() {

          axios.get('http://localhost:8000/api/products').then(res=> {
           this.products = res.data.data

            console.log(this.products)
          });
        },


        // image
        getImage() {
        axios.get(`/products/{product}/image`) // Adjust the URL and product ID as needed
      .then(response => {
        // Set the image URL using base64 encoding
        this.imageUrl = 'data:image/jpeg;base64,' + btoa(response.data);
      })
      .catch(error => {
        console.error('Error fetching image:', error);
      });
    }
    },

  
}
</script>

<style>

.img{
    border: 1px solid black;
    height: 200px;
    object-fit: cover;
}

.card-body {
        border: 1px solid #ddd; /* Add border to card-body */
        padding: 10px; /* Add padding for better spacing */
        margin-bottom: 10px; /* Add margin between card-body and card-footer */
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        /* flex-direction: row; */
         /* Set a maximum height */
    overflow-y: auto; /* Enable vertical scrolling */
    }

    .product {
        border: 1px solid #ddd; /* Add border to product cards */
        padding: 10px; /* Add padding for better spacing */
        margin-bottom: 10px; /* Add margin between product cards */
        height: 430px;
        width: 360px;
    }

    .action-buttons {
        margin-top: 10px; /* Add margin above action buttons */
    }


</style>