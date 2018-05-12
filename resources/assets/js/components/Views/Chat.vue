<template lang="html">
<div class="chat_wrappper">

  <div class="chat_header">
      <div class="chat_flex_side">
          <p>Contacts</p>
      </div>
      <div class="chat_flex_mid">
          <p>{{this.conversation.name}}</p>
      </div>
      <div class="chat_flex_side">
          <p>Requests</p>
      </div>
  </div>

  <div class="chat_content">
    <div class="chat_flex_side scrollbar">

        <div class="data_status" v-if="typeof(this.friends) == 'string'">
            <p>
              {{this.friends}}
              <router-link class="link_firends"  :to="{ path: '/people' }">friends.</router-link>
            </p>
        </div>
        <div v-else>
            <div  v-for="(friend, index) in friends" :key="index">
              <friend-card  :indexProp="index"
                            :userProp="friend"
                            v-on:openConvEvent="openConversation"
                            v-on:removeFriendEvent="removeFriend">
                            </friend-card>
            </div>
        </div>

    </div>

    <div class="chat_flex_mid conversation_wrapper">
        <div class="messages">
            <div  v-for="(msg, index) in messages" :key="msg.messageID">
              <message-card :messageProp="msg.message"
                            :myMsgProp="msg.myMsg">
                            </message-card>
            </div>
        </div>

        <form class="input_msg" v-on:submit.prevent='sendMessage()'>

            <input class="input_area" type="text" placeholder="Start typing..." v-model="inputText">
            <input class="send_BTN" type="submit" value="Send">
        </form>

    </div>

    <div class="chat_flex_side scrollbar">

        <div class="data_status" v-if="typeof(this.requests) == 'string'">
            <p>{{this.requests}}</p>
        </div>
        <div v-else>
            <div  v-for="(request, index) in requests" :key="index">
              <request-card :indexProp="index"
                            :requestProp="request"
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
      requests:{},
      friends:{},
      conversation:{
        name: "",
        userID: 0,
        id: 0,
      },
      inputText: "",
    /*  messages:{
        0:{
          msg:"lbla bla bla motherfucker! you undestand ? ",
          myMsg: false
        },
        1:{
          msg:"fhndusfgfsdjdnsjf  you know what ia mean :D  ",
          myMsg: true
        },
        2:{
          msg:"another message oooh jeeeez, plesae can we go home rick ? ia don like this chat ",
          myMsg: true
        },
        3:{
          msg:"shut your mouth morty! you are dump and anoying like your father, i have better stuff to do then go home",
          myMsg: false
        },
        4:{
          msg:"lbla bla bla motherfucker! you undestand ? ",
          myMsg: false
        },
        5:{
          msg:"fhndusfgfsdjdnsjf  you know what ia mean :D  ",
          myMsg: true
        },
        6:{
          msg:"another message oooh jeeeez, plesae can we go home rick ? ia don like this chat ",
          myMsg: true
        },
        7:{
          msg:"shut your mouth morty! you are dump and anoying like your father, i have better stuff to do then go home",
          myMsg: false
        },
      },*/
      messages: [],
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
      /*if(typeof(this.friends) == 'string')
      {
        this.friends = {};
      }

      let newContact = this.requests[index].requester;
      let test = Object.getOwnPropertyNames(this.friends);
      this.friends[test.length] = newContact;*/


      delete this.requests[index];
      //this.$forceUpdate();
      this.getFriends();
      this.initConversation();
    },
    getFriends: function()
    {
      axios.get(this.$path + '/getconversations')
          .then(response => {
            if(response.status == 200){
               this.friends = response.data;
            }
            else if(response.status == 204) {
                this.friends = 'We can help you with finding new';
              }
            this.initConversation();
          });
    },
    removeFriend: function(index)
    {
      this.friends.splice(index,1);
      if(this.$objIsEmpty(this.friends)){
        this.friends = 'We can help you with finding new';
      }
      this.$forceUpdate();
    },
    initConversation: function()
    {
        if(typeof(this.friends) == 'string')
        {
          this.conversation.name = "Chat";
        }
        else
        {
          let firstIndex = Object.keys(this.friends);
          this.conversation.name = this.friends[firstIndex[0]].conversationName;
          this.conversation.id = this.friends[firstIndex[0]].conversationID;
          this.conversation.userID =  this.friends[firstIndex[0]].userID;
        }
    },
    openConversation: function(index)
    {
        let user = this.friends[index];
        this.conversation.name = user.conversationName;
        this.conversation.id = user.conversationID;
        this.conversation.userID = user.userID;
        this.getMesages(user.conversationID);
    },
    sendMessage: function()
    {

        if(this.inputText != '')
        {
          let objMsg =  {
            message:this.inputText,
            messageID: this.messages.length,
            myMsg: true
          };
          if(this.messages[0] == null)
          {
            this.messages = new Array(objMsg);
          }
          else
          {
            this.messages.unshift(objMsg);
          }
          this.messages = this.messages;
          this.$forceUpdate();

          axios.post(this.$path + '/sendmessage',
          {
              message: this.inputText,
              convID: this.conversation.id,
              friendUserID: this.conversation.userID,
          })
          .then(response => {
              if(response.status == 200)
              {
                console.log('message was sent');
              }
              else {
                console.log('sending message faild');
              }

          });
        }

        this.inputText = '';
    },
    getMesages: function(chatID)
    {
        this.messages = {};

        axios.post(this.$path + '/getmesages',
        {
            chatID: chatID,
            pageID: 0,
        })
        .then(response => {

            if(response.status == 200){
               this.messages = Object.values(response.data);
            }

        });
    },
  },
  created(){

      //seet larravel echo url
      let authURL = this.$path + Echo.connector.pusher.config.authEndpoint;
      Echo.connector.pusher.config.authEndpoint = authURL;
  },
  mounted(){
    Echo.private('MessageChanel' + this.$user.id)
        .listen('MessageEvent', e=>{
              console.log(e);
    });

    this.getRequests();
    this.getFriends();
    this.getMesages(this.conversation.id);
  },
  beforeUpdate () {
    //console.log(this.messages);
  },

}
</script>

<style scoped lang="css">
  @import "../../../css/chat.css";
</style>
