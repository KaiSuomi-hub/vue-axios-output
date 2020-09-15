<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <div>
    <home/>

    <!-- <img alt="Vue logo" src="./assets/penis.png"> -->
    <viewpizza/>
    
    </div>

  </div>
  <router-view/>
  <viewpizza/>
</template>

<script>
import viewpizza from './components/viewpizza.vue';
import Home  from './views/Home.vue';
export default {
  viewpizza,
  Home
}


</script>


<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
