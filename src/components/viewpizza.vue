<template>
    <div>
        <viewpizza />
        <axios/>
    </div>  
</template>

<script>
import axios from 'axios';



export default {
    name: "viewpizza",
    
    data (){
    return {
      viewpizza: ''
    }
  },
  
    methods:{
    lue() {
    axios.get("http://localhost/koulu/kokeilut/pizza-editor/src/php/luepizzat.php").then(response => this.response);
    
    // console.log(123);
    }
}
}
</script>

<style>

</style>