<template lang="html">

  <div class="card">
      <div class="name">
          <p>{{this.user.name}}<span>{{this.user.mail}}</span></p>
      </div>

      <div class="acceptBTN">
          <a href="" v-on:click.prevent='acceptRequest()'>Accept Request</a>
      </div>
  </div>

</template>

<script>
export default {
  data(){
    return{
      user:{},
      index: 0,
    }
  },
  props:[
    'userProp',
    'indexProp',
  ],
  methods:{
    acceptRequest: function()
    {
      axios.post(this.$path + '/acceptrequest',
      {
          requester:this.user.id
      })
      .then(response => {
          if(response.status == 200)
          {
            this.$emit('removeReqEvent', this.index);
          }

      });
    }
  },
  created(){
    this.user = this.userProp;
    this.index = this.indexProp;    
  }
}
</script>

<style scoped lang="css">
  @import "../../../css/requestCard.css";
</style>
