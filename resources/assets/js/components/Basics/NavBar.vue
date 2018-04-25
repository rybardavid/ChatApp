<template lang="html">
  <div class="navbar">
        <ul>
          <li>
            <router-link class="link " :class="{ active: isActive == 'home' }"
            v-on:click.native="active('home')"
            :to="{ path: '/' }">
            Home</router-link>
          </li>

          <li>
            <router-link class="link " :class="{ active: isActive == 'about' }"
             v-on:click.native="active('about')"
             :to="{ path: '/about' }">
             About</router-link>
          </li>

          <li>
            <router-link class="link " :class="{ active: isActive == 'news' }"
             v-on:click.native="active('news')"
             :to="{ path: '/news' }">
             News</router-link>
          </li>

          <li>
            <router-link class="link " :class="{ active: isActive == 'people' }"
            v-on:click.native="active('people')"
            :to="{ path: '/people' }">
            Find new friends</router-link>
          </li>
        </ul>
      </div>
</template>

<script>
export default {

  methods:{
  active: function(activeEl){
    this.isActive = activeEl;
  },
  setActive: function()
  {
    let route =  this.$route.path;

    while( route.charAt( 0 ) === '/' )
      route = route.slice( 1 );

    this.isActive = route === '' ? "home" : route;
  },
  mounted()
  {
    this.setActive();
  },

},
}
</script>

<style lang="css">
   @import "../../../css/navbar.css";
</style>
