<template lang="html">

  <div class="notifications">
      {{notification}}
      <ul v-if="notifications.length > 0">
        <li v-for="(notif, index) in notificationsComp" :key="index">
          {{notif}}

        </li>
      </ul>
  </div>

</template>

<script>
export default {
  data(){
    return{
      notifications:[],
    }
  },
  methods:{
    remNotifi: function()
    {
      console.log('removing');
       this.notifications.splice(0,1);
    },
    refTest: function()
    {
      console.log('test');
    }
  },
  computed:{
    notification(){
      var noitfi = this.$store.getters.notification;
      if(noitfi !== "")
      {
        console.log(noitfi);
        this.notifications.push('accept'+this.notifications.length);
        setTimeout(() => {this.remNotifi()},10000);
      }
      this.$store.commit('setNotification',"");
      return;
    },
    notificationsComp(){
      return this.notifications;
    },
  }

}
</script>

<style lang="css">
  @import "../../../css/notificationarea.css";
</style>
