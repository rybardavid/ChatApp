<template lang="html">
  <div class="card">
      <a href="">
        <div class="name">
            <p>{{this.user.name}}</p>
        </div>
      </a>

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
      index:0,
      isOnline: 0,
      user:{},
    }
  },
  props:[
    'userProp',
    'indexProp',
  ],
  created(){
    this.isOnline = Boolean(Math.floor(Math.random() * 2));
    this.user = this.userProp;
    this.index = this.indexProp;
  },
}
</script>

<style scoped lang="css">
  @import "../../../css/friendCard.css";
</style>
