<template lang="html">
  <div class="wrapper_flex_collumn">

    <div class="flex_1 border_debug_red">
        <navbar></navbar>
    </div>

    <div class="flex_25 border_debug_green">
        <router-view> </router-view>
    </div>

  </div>
</template>

<script>
export default {
  props:[
    'userProp',
    'projectRouteProp',
    'routeDestProp',
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
    Vue.prototype.$user = JSON.parse(this.userProp);
    Vue.prototype.$path = this.projectPath(this.projectRouteProp,
                                           this.routeDestProp);
  }
}
</script>

<style lang="css" >
  @import "../css/main.css";
</style>
