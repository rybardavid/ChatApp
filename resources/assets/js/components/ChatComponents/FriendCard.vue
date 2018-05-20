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
                  :class="{'online': (statusComp == true),
                           'offline': (statusComp == false) }">
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
  computed:{
    statusComp(){
      return this.isOnline;
    }
  },
  created(){
    this.user = this.userProp;
    this.isOnline = this.user.status;
    this.index = this.indexProp;
    console.log(this.user);

    Echo.private('UserStatusChanel.' + this.user.userID)
        .listen('UserStatusEvent', e=>{
            this.isOnline = e.status;
        });
  },

}
</script>

<style scoped lang="css">
  @import "../../../css/friendCard.css";
</style>
