<template lang="html">

  <div class="people">
      <div class="content">
        <h1>Find new friends</h1>

        <div class="accounts">
            <account-card v-for="n in 10" :key="n"> </account-card>
        </div>
        
      </div>
  </div>

</template>

<script>
export default {
}
</script>

<style lang="css">
  @import "../../../css/people.css";
</style>
