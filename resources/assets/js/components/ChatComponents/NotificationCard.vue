<template lang="html">
  <div class="notification " v-bind:class="type">
      <div class="top_space">
        <a href="#" v-on:click.prevent="close()">
          <i class="far fa-times-circle"></i>
        </a>
      </div>
      <p>{{content}}, {{message}}</p>

  </div>
</template>

<script>
export default {
  data(){
    return{
      type:"",
      index:0,
      content:"",
    }
  },
  props:[
    'contentProp',
    'indexProp',
    'typeProp',
  ],
  computed:{
    message(){
      if(this.type == "acceptFriend"){
        return "accept your friend request."
      }
      else if(this.type == "removedFriend"){
        return "removed you from friends."
      }
      else if(this.type == "updateRequests"){
        return "wants be your friend."
      }
    }
  },
  methods:{
    close(){
      console.log('close');
      this.$emit('removeMe', this.index);
    }
  },
  created(){
    this.type = this.typeProp;
    this.index = this.indexProp;
    this.content = this.contentProp;
  }
}
</script>

<style lang="css">
</style>
