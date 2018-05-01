<template lang="html">
  <div class="account_card">

      <div class="top_card">
          <p>{{this.user.name}}
            <br>
            <small>{{this.user.email}}</small>
          </p>
      </div>

      <div class="bottom_card">
          <div class="requestBTN">
            <a href="#"  v-on:click.prevent='sendFriendRequest()'> <p>Send friend request</p> </a>
          </div>
      </div>

  </div>
</template>

<script>
export default {
  props:[
    'userProp',
    'indexProp',
  ],
  data(){
    return{
      user: this.userProp,
      index: this.indexProp,
    }
  },
  methods:{
    sendFriendRequest: function(){
        axios.post(this.$path+'/sendrequest', {
                id:this.user.id
              })
              .then(response => {                
                if(response.status == 200){
                    this.$emit('requestSent', this.index);
                }
            });

    },
  },


}
</script>

<style lang="css">
  @import "../../../css/account.css";
</style>
