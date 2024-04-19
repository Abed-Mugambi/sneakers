<template>
    <div class="product-form">
      <h2>Create Product</h2>
      <form @submit.prevent="submitForm">

        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="formData.name" required>
        </div>

        <div class="form-group">
          <label for="detail">Details:</label>
          <textarea id="detail" v-model="formData.detail" required></textarea>
        </div>

        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" id="price" v-model="formData.price" required>
        </div>

        <div class="form-group">
          <label for="stock">Stock:</label>
          <input type="number" id="stock" v-model="formData.stock" required>
        </div>

        <div class="form-group">
          <label for="discount">Discount:</label>
          <input type="number" id="discount" v-model="formData.discount" required>
        </div>

        


        <div class="form-group">
          <label for="image">Image:</label>
          <input 
          type="file"
           id="image" 
          accept="image/*"
           @change="handleImageUpload"
            required 
            class="image-input">

          <div v-if="formData.image" class="image-preview">
            <img :src="formData.image" alt="Product Image">
          </div>
        </div>

        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import axios from "axios";

  export default {
    name: 'createProduct',
    data(){
      return {
        formData: {
          name: '',
          detail: '',
          price: '',
          stock: '',
          discount: '',
          image: null
        }
      };
    },

    methods: {
      submitForm(){
            // Handle form submission, e.g., send data to server
            //             .then(res=> {

            // console.log(res)
            // this.products = res.data;
            // console.log('Form submitted:', this.formData);

            // })
            axios.post('http://localhost:8000/api/products', this.formData)
        .then((response) => {
            console.log('Success:', response.data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });

        // handleImageUpload(event) {
        //     const file = event.target.files[0];
        //     this.formData.image = URL.createObjectURL(file);
        // };

    },
  },

  // image upload
  methods: {
  handleImageUpload(event) {
    const file = event.target.files[0];
    this.formData.image = file;
  },

  submitForm() {
    const formData = new FormData();
    for (let key in this.formData) {
      formData.append(key, this.formData[key]);
    }
    formData.append('image', this.formData.image);
    axios.post('http://localhost:8000/api/products', formData)
      .then((response) => {
        console.log('Success:', response.data);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
},
// end of image upload
  
}

  </script>
  
  <style scoped>
  .image-input {
      color: #007bff;
  }
  .product-form {
    max-width: 400px;
    margin: 0 auto;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  label {
    display: block;
    font-weight: bold;
  }
  
  input[type="text"],
  input[type="number"],
  textarea {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
  }
  
  textarea {
    resize: vertical;
  }
  
  button {
    padding: 0.5rem 1rem;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  
  input[type="file"] {
    display: none; /* Hide the file input */
  }
  
  /* Style the file input label to look like a button */
  input[type="file"] + label {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  /* Style file input label on hover */
  input[type="file"] + label:hover {
    background-color: #0056b3;
  }
  
  /* Style the image preview */
  .image-preview {
    margin-top: 0.5rem;
  }
  
  .image-preview img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 0.25rem;
  }
  </style>
  