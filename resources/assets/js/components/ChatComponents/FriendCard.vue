<template lang="html">
  <div class="card">
      <div class="name">
          <p>Frenk Hoolan</p>
      </div>

      <div class="bottom_wraper">
          <div class="bottom">

              <div class="removeBTN">
                <a href=""><p>Remove friend</p></a>
              </div>
              <div class="status"
                  :class="{'online': (isOnline == true),
                           'offline': (isOnline == false) }">
                <p> </p>
              </div>

          </div>
      </div>

  </div>
</template>

<script>
export default {
  data(){
    return{
      isOnline: 0,
    }
  },
  created(){
    this.isOnline = Boolean(Math.floor(Math.random() * 2));
  },
}
</script>

<style scoped lang="css">
  @import "../../../css/friendCard.css";
</style>
