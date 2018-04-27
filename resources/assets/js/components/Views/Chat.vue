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
          <request> </request>
        </div>
    </div>

    <div class="chat_flex_mid"></div>

    <div class="chat_flex_side scrollbar">
        <div  v-for="n in 40">
          <request> </request>
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
