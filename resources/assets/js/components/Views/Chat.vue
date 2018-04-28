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
        <!--for debuging dummy data in local-->
        <div  v-for="n in 15">
          <friend-card :userProp="friendTest"> </friend-card>
        </div>

    </div>

    <div class="chat_flex_mid conversation_wrapper">
        <div class="messages"></div>

        <form class="input_msg">
          <input class="input_area" type="text" placeholder="Start typing...">

          <input class="send_BTN" type="submit" value="Send">
        </form>

    </div>

    <div class="chat_flex_side scrollbar">
        <!--for debuging dummy data in local-->
        <div  v-for="n in 16">
          <request-card :userProp="requestTest"> </request-card>
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
    }
  },
  mounted(){
    //console.log(this.userTest.name);
  }
}
</script>

<style scoped lang="css">
  @import "../../../css/chat.css";
</style>
