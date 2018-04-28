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
        <div  v-for="n in 40">
          <friend-card> </friend-card>
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
        <div  v-for="n in 40">
          <request-card> </request-card>
        </div>
    </div>
  </div>

</div>
</template>

<script>
export default {
}
</script>

<style scoped lang="css">
  @import "../../../css/chat.css";
</style>
