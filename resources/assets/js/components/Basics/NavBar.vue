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
              <p>Home</p>
          </router-link>
        </li>

        <li>
          <router-link class="link "
           :to="{ path: '/about' }">
            <p>About</p>
         </router-link>
        </li>

        <li>
          <router-link class="link "
           :to="{ path: '/news' }">
            <p>News</p>
         </router-link>
        </li>

        <li>
            <router-link class="link "
            :to="{ path: '/people' }">
              <p>Find new friends</p>
            </router-link>
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
