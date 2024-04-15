
<script setup>

import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'

// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
// import { library } from '@fortawesome/fontawesome-svg-core';
// import { fas } from '@fortawesome/free-solid-svg-icons';

// library.add(fas); 
// Add all solid icons to the library

</script>

<!-- import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'; -->
<template>
  <header>

    <div class="wrapper">

      <!-- navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">

            <RouterLink class="navbar-brand" to="/">Home</RouterLink>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <!-- <li class="nav-item">
                  <RouterLink class="nav-link active" aria-current="page" to="/">Home</RouterLink>
                </li> -->

                <li class="nav-item">
                  <RouterLink class="nav-link active" aria-current="page" to="/cart">Cart</RouterLink>

                  <!-- <font-awesome-icon :icon="['fas', 'cart-shopping']" /> -->
                  <!-- add cart icon here -->

                  <i class="fas fa-search"></i>
                </li>

                <li class="nav-item">
                  <RouterLink class="nav-link active" aria-current="page" to="/products">Products</RouterLink>
                </li>

               
              
              
              </ul>
            
            </div>
          </div>
      </nav>
      <!-- end navbar -->

    
    </div>
  </header>

  <RouterView />
</template>

<style scoped>

</style>
