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
    }
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

              this.$refs.notifiComp.refTest(e.notification);

              if(e.notification.type == "acceptReuqest"){
                  if(this.$route.path == "/chat"){
                    let conv = e.notification.conversation;
                    this.$refs.routeView.addFriend(conv);
                  }
              }
              else if(e.notification.type == "removedFriend")
              {
                if(this.$route.path == "/chat"){
                  let conv = e.notification.conversation;
                  this.$refs.routeView.callRemoveFriend(conv);
                }
              }
              else if(e.notification.type == "updateRequests")
              {
                //console.log(e);
                if(this.$route.path == "/chat"){
                  let req = e.notification.request;
                  //console.log(req);
                  this.$refs.routeView.addReuqest(req);
                }
              }

          });
  }
}
</script>

<style lang="css" >
  @import "../css/main.css";
</style>
