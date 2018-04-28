<template lang="html">

  <div class="card">
      <div class="name">
          <p>{{this.user.name}}<span>{{this.user.mail}}</span></p>
      </div>

      <div class="acceptBTN">
          <a href="">Accept Request</a>
      </div>
  </div>

</template>

<script>
export default {
  data(){
    return{
      user:{}
    }
  },
  props:[
    'userProp',
  ],
  created(){
    this.user = this.userProp;
  }
}
</script>

<style scoped lang="css">
  @import "../../../css/requestCard.css";
</style>
