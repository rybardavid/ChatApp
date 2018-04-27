<template lang="html">
  <div class="app_wrapper">
    <navbar></navbar>
    <router-view> </router-view>
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

  }
}
</script>

<style lang="css" >
  @import "../css/main.css";
</style>
