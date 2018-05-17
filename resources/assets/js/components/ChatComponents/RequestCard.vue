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
      request:{},
      index: 0,
    }
  },
  props:[
    'requestProp',
    'indexProp',
  ],
  methods:{
    acceptRequest: function()
    {

      axios.post(this.$path + '/acceptrequest',
      {
          obj:this.request
      })
      .then(response => {
          if(response.status == 200)
          {
            
            this.$emit('removeReqEvent', this.index, response.data);
          }

      });
    }
  },
  created(){
    this.request = this.requestProp;
    this.index = this.indexProp;
    this.user = this.request.requester;
  }
}
</script>

<style scoped lang="css">
  @import "../../../css/requestCard.css";
</style>
