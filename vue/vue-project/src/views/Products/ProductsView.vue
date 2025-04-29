<template>



    <div class="card">

        <div class="card-header">

            <h4>
                Products
                <RouterLink to="/products/create" class="btn btn-primary float-end">
                    Add Product

                </RouterLink>

            </h4>
        </div>

        <div class="card-body">



            <div v-for="(product, index) in this.products" :key="index" class="product">



                <div class="img">
                    <!-- <img :src="imageUrl" alt="Product Image"> -->
                    <!-- <img :src="'data:image/jpeg;base64,' + btoa(product.image)" alt="Product Image"> -->
                    <img :src="getBase64Image(product.image)" alt="Product Image">
                </div>
                <!-- <div>ID: {{ product.id }}</div> -->
                <div>Name: {{ product.name }}</div>
                <div>Description: {{ product.description }}</div>
                <div>Price: {{ product.totalPrice }}</div>
                <div>Stock: {{ product.stock }}</div>
                <div>Discount: {{ product.discount }}</div>
                <div>
                    <label for="quantity">Quantity:{{ product.quantity }} </label>
                     <input type="number" id="quantity" v-model="quantity" min="1">
                </div>

                <div class="action-buttons">

                    <!-- <RouterLink to="'/edit/' + product.id" 
                            class="btn btn-success float-end">
                            Edit

                            </RouterLink> -->

                            <!-- go to cart page , pull details of that item-->
                            <!-- edit qty -->
                            <!-- go to checkout -->
                    <RouterLink :to="{ name: 'cart', params:{ id: product.id } }">
                        <button @click="addToCart(product.id)" class="btn btn-success">
                            ADD TO CART
                        </button>

                    </RouterLink>


                </div>

            </div>

        </div>

    </div>

</template>


<script>

import axios from 'axios';
// import { router } from '@/router';

export default {
    name: 'products',
    data() {
        return {
            products: [],
            imageUrl: ''
        };
    },

    mounted() {
        this.getProducts();
        this.getImage();
        this.getBase64Image();
    },

    methods: {
        getProducts() {

            axios.get('http://localhost:8000/api/products').then(res => {


                this.products = res.data.data

                console.log(this.products)
            });
        },

        addToCart(productId,productName, details, price) {
           //  console.log("add to cart")
            console.log(productId)
            // console.log(product.id);
            // console.log(res.data.data);

            // create cart column -> id, name, desc, qty, price, img || run migrations
            // edit products, 


            // edit axios to post in that cart column
            // display from cart column to cartview page in a div
            // edit that div to add checkout button => checkout page
            // edit the div to have wishlist icon, edit qty

            this.$router.push({
            name: 'ProductDetail',
            params: { id: productId },
            props: { name: productName, desc: productDesc }
        });



            axios.post(`http://localhost:8000/api/cart/{ productId }` , {
                // what we are posting
                productId: productId,
                name: productName,
                details: details,
                quantity: quantity,
                price: price,
                // image:image


            }).then(res => {
                console.log(res)
            })
                .catch(error => {
                    console.error('Error adding product to cart:', error);
                })

        },


        // image
        getImage(product) {
            axios.get(`/products/${product}/image`) // Adjust the URL and product ID as needed
                .then(response => {
                    // Set the image URL using base64 encoding
                    this.imageUrl = 'data:image/jpeg;base64,' + btoa(response.data);
                })
                .catch(error => {
                    console.error('Error fetching image:', error);
                });
        },

        getBase64Image(image) {
            // Check if the image is not empty
            if (!image) return '';

            // Base64 encode the image data
            return 'data:image/jpeg;base64,' + this.base64Encode(image);
        },
        base64Encode(str) {
            let encodedString = btoa(unescape(encodeURIComponent(str)));
            return encodedString;
        },

    },


}
</script>

<style>
.img {
    border: 1px solid black;
    height: 200px;
    object-fit: cover;
}

.card-body {
    border: 1px solid #ddd;
    /* Add border to card-body */
    padding: 10px;
    /* Add padding for better spacing */
    margin-bottom: 10px;
    /* Add margin between card-body and card-footer */
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;

    /* flex-direction: row; */
    /* Set a maximum height */
    overflow-y: auto;
    /* Enable vertical scrolling */
}

.product {
    border: 1px solid #ddd;
    /* Add border to product cards */
    padding: 10px;
    /* Add padding for better spacing */
    margin-bottom: 10px;
    /* Add margin between product cards */
    height: 430px;
    width: 360px;
}

.action-buttons {
    margin-top: 10px;
    /* Add margin above action buttons */
}
</style>