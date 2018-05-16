<template lang="html">

  <div class="notifications ">
      <ul v-if="notifications.length > 0">
        <li v-for="(notif, index) in notifications" :key="index">
            <notification-card :contentProp="notif.user.name"
                               :typeProp="type"
                               :indexProp="index"
                               v-on:removeMe="remNotifi">
            </notification-card>
        </li>
      </ul>
  </div>

</template>

<script>
export default {
  data(){
    return{
      notificationType: {},
      notifications:[],
    }
  },
  methods:{
    remNotifi: function(index)
    {
       this.notifications.splice(index,1);
    },
    refTest: function(obj)
    {
      //console.log(obj);
      this.notificationType = obj.type;
      this.notifications.push(obj);
      //this.notificationType = this.$store.getters.notification;
      setTimeout(() => {this.remNotifi(0)},10000);
    }
  },
  computed:{

    type(){
      var type = this.notificationType;

      if (type)
      {
        if(type == "acceptReuqest"){
          return "acceptFriend";
        }
        else if(type == "removedFriend"){
          return "removedFriend";
        }
        else if(type == "updateRequests"){
          return "updateRequests";
        }
      }

    },

  }

}
</script>

<style lang="css">
  @import "../../../css/notificationarea.css";
</style>
