<template lang="html">
<div class="chat_wrappper">

  <div class="chat_header">
      <div class="chat_flex_side">
          <p>Contacts</p>
      </div>
      <div class="chat_flex_mid">
          <p>John Doe</p>
      </div>
      <div class="chat_flex_side">
          <p>Requests</p>
      </div>
  </div>

  <div class="chat_content">
    <div class="chat_flex_side scrollbar">
        <!--for debuging dummy data in local
        <div  v-for="n in 15">
          <friend-card :userProp="friendTest"> </friend-card>
        </div>-->

        <div class="data_status" v-if="typeof(this.friends) == 'string'">
            <p>
              {{this.friends}}
              <router-link class="link_firends"  :to="{ path: '/people' }">friends.</router-link>
            </p>
        </div>
        <div v-else>
            <div  v-for="(friend, index) in friends">
              <friend-card  :indexProp="index"
                            :userProp="friend">
                        <!--  v-on:removeFriendEvent='removeReq'> -->    
                            </friend-card>
            </div>
        </div>

    </div>

    <div class="chat_flex_mid conversation_wrapper">
        <div class="messages"></div>

        <form class="input_msg" v-on:submit.prevent='sendMessage()'>

            <input class="input_area" type="text" placeholder="Start typing...">
            <input class="send_BTN" type="submit" value="Send">
        </form>

    </div>

    <div class="chat_flex_side scrollbar">

        <div class="data_status" v-if="typeof(this.requests) == 'string'">
            <p>{{this.requests}}</p>
        </div>
        <div v-else>
            <div  v-for="(request, index) in requests">
              <request-card :indexProp="index"
                            :userProp="request['requester']"
                            v-on:removeReqEvent='removeReq'>
                            </request-card>
            </div>
        </div>

    </div>

  </div>

</div>
</template>

<script>
export default {
  data(){
    return{
      //Dummy data for testing
      friendTest:{
        name: "Frank Cordova",
        mail: "cordovafrank@mail.com",
        age: 42,
        id: 0,
      },
      requestTest:{
        name: "John Evans",
        mail: "evansjohn@mail.com",
        age: 32,
        id: 5,
      },
      //Dummy data for testing

      requests:{},
      friends:{},
    }
  },
  methods:{
    getRequests: function()
    {
        axios.get(this.$path + '/getrequests')
            .then(response => {
              if(response.status == 200){
                 this.requests = response.data;
              }
              else {
                  this.requests = 'You dont have any friend requests.'
                }
            });
    },
    removeReq: function(index)
    {
      delete this.requests[index];
      this.$forceUpdate();
    },
    getFriends: function()
    {
      axios.get(this.$path + '/getfriends')
          .then(response => {
            if(response.status == 200){
               this.friends = response.data;
            }
            else if(response.status == 204) {
                this.friends = 'We can help you with finding new';
              }
          });
    },
    sendMessage: function()
    {
      console.log(this.requests);
    }
  },
  created(){
      this.getRequests();
      this.getFriends();
  }
}
</script>

<style scoped lang="css">
  @import "../../../css/chat.css";
</style>
