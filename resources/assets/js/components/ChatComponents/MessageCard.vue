<template lang="html">

    <div class="card_wrapper">
        <div :class="{'space': (this.myMsg == true)}"></div>

        <div class="message ":class="{'send': (this.myMsg == true),
                                       'received': (this.myMsg == false) }">
          <p>{{this.messageTex}}</p>

          <div v-if="timeStamp != null">
              <small>{{ timeStamp | moment("MMMM Do YYYY, H:mm") }}</small>
          </div>
          <div v-else>
              <small>{{ new Date() | moment("MMMM Do YYYY, H:mm") }}</small>
          </div>

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
      timeStamp: null,
    }
  },
  props:[
    'messageProp',
    'myMsgProp',
    'timeStampProp'
  ],
  created(){
    this.messageTex = this.messageProp;
    this.myMsg = this.myMsgProp;
    this.timeStamp = this.timeStampProp;
  },
}
</script>

<style lang="css">
  @import "../../../css/messageCard.css";
</style>
