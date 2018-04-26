<template lang="html">

  <div id="split">
    <div class="branding">
      <h1>{{this.$appName}}</h1>
    </div>
    <nav>
      <ul>
        <li>
          <router-link class="link "
            :to="{ path: '/' }">
            Home</router-link>
        </li>

        <li>
          <router-link class="link "
           :to="{ path: '/about' }">
           About</router-link>
        </li>

        <li>
          <router-link class="link "
           :to="{ path: '/news' }">
           News</router-link>
        </li>

        <li>
            <router-link class="link "
            :to="{ path: '/people' }">
            Find new friends</router-link>
          </li>

        <li>
          <div class="button">
            <a :href="this.$path+'/logout'">Logout</a>
          </div>
        </li>
      </ul>
    </nav>

  </div>

</template>

<script>
export default {
}
</script>

<style lang="css">
   @import "../../../css/navbar.css";
</style>
