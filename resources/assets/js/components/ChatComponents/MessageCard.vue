<template lang="html">

    <div class="card_wrapper">
        <div :class="{'space': (this.myMsg == true)}"></div>

        <div class="message ":class="{'send': (this.myMsg == true),
                                       'received': (this.myMsg == false) }">
          <p>{{this.messageTex}}</p>
        </div>

        <div :class="{'space': (this.myMsg == false)}"></div>   
    </div>
</template>

<script>
export default {
  data(){
    return{
      messageTex: "",
      myMsg: true,
    }
  },
  props:[
    'messageProp',
    'myMsgProp',
  ],
  created(){
    this.messageTex = this.messageProp;
    this.myMsg = this.myMsgProp;
  },
}
</script>

<style lang="css">
  @import "../../../css/messageCard.css";
</style>
