<template lang="html">
  <div class="body">
    <div class="welcome_card">
      <h1 class="welcome_sign">Welcome back</h1>
      <p class="name_home">{{this.$user.name}}</p>
      <p class="email_home">{{this.$user.email}}</p>
    </div>
  </div>


</template>

<script>
export default {
}
</script>

<style lang="css">
.body{
  background-color: #b5b5b5;
  height: 100%;
  display: flex;

}
.welcome_card{
  color: white;
  margin: auto;
  text-align: center;
}

.welcome_sign{
  font-size: 48px;
  margin: 0;
}
.name_home{
  font-size: 36px;
  margin: 0;
}
.email_home{
  margin-top: 12px;
  font-size: 24px;
}
</style>
