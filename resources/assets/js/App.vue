<template lang="html">
  <div class="app_wrapper">
    <navbar></navbar>
    <router-view ref='routeView'> </router-view>
    <notifications ref='notifiComp'></notifications>
  </div>
</template>

<script>
export default {
  props:[
    'userProp',
    'projectRouteProp',
    'routeDestProp',
    'appNameProp',
  ],
  methods:{
    projectPath: function(urlAtr,word){
      let url = urlAtr;
      let found = url.match(word);
      found.index--;
      url = url.slice(0,found.index);
      return url;
    },

  },
  created(){
    Vue.prototype.$appName = this.appNameProp;
    Vue.prototype.$user = JSON.parse(this.userProp);
    Vue.prototype.$path = this.projectPath(this.projectRouteProp,
                                           this.routeDestProp);
    Vue.prototype.$objIsEmpty = function(obj)
    {
      for(var prop in obj){
            if(obj.hasOwnProperty(prop))
                return false;
      }
      return true;
    };

    Echo.private('NotifyChanel.' + this.$user.id)
        .listen('NotifyPrivateEvent', e=>{            
              let notification = {
                type:e.notification.type,
                name:e.notification.name,
              };
              this.$refs.notifiComp.refTest(notification);

              if(e.notification.type == "acceptReuqest"){
                  if(this.$route.path == "/chat"){
                    let conv = e.notification.conversation;
                    let conversations = e.notification.conversations;
                    let requests = e.notification.requests;
                    this.$refs.routeView.updateCards(requests,conversations);
                  }
              }
              else if(e.notification.type == "removedFriend")
              {
                if(this.$route.path == "/chat"){
                  let conversations = e.notification.conversations;
                  let requests = e.notification.requests;
                  this.$refs.routeView.updateCards(requests,conversations);
                }
              }
              else if(e.notification.type == "updateRequests")
              {
                if(this.$route.path == "/chat"){
                  let req = e.notification.request;
                  let conversations = e.notification.conversations;
                  let requests = e.notification.requests;
                  this.$refs.routeView.updateCards(requests,conversations);
                }
              }

          });
  }
}
</script>

<style lang="css" >
  @import "../css/main.css";
</style>
