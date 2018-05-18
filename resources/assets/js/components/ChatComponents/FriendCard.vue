<template lang="html">
  <div class="card">
      <a href="" v-on:click.prevent='openConversation()'>
        <div class="name">
            <p>{{this.user.userName}}</p>
        </div>
      </a>

      <div class="bottom_wraper">
          <div class="bottom">

              <div class="removeBTN">
                <a href="" v-on:click.prevent='removeFriend()'><p>Remove friend</p></a>
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
  methods:{
    removeFriend: function()
    {
        axios.post(this.$path +'/removefriend',
          {
            id: this.user.userID
          })
          .then(response => {
             if(response.status == 200){
                let data = response.data;
                this.$emit('updateCards', data.requests, data.conversations);
             }
          });

    },
    openConversation: function()
    {
      this.$emit('openConvEvent', this.index);
    },
  },
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
