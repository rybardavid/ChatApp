<template lang="html">
<div class="flex_25 wrapper_flex_collumn">

  <div class="header flex_1 wrapper_flex_row">
    <div class="flex_1">
        <p>Contacts</p>
      </div>

      <div class="flex_2_3">
        <p>John Doe</p>
      </div>

      <div class="flex_1">
        <p>Requests</p>
      </div>
  </div>

  <div class="content flex_25 wrapper_flex_row">
    <div class="flex_1">

      <div class="scrollbar">
        <div  v-for="n in 40">
          <request> </request>
        </div>
      </div>

    </div>

    <div class="flex_2_3">

    </div>

    <div class="flex_1">

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
