<template lang="html">

  <div class="people">
      <div class="content">
        <h1>Find new friends</h1>

        <div class="accounts">
            <account-card v-for="(user, index) in people" :key="index"
                          :userProp="user"
                          :indexProp="index">
            </account-card>
        </div>
        
      </div>
  </div>

</template>

<script>
export default {
  data(){
    return{
      people:{},
    }
  },
  methods:{
    getPeople: function()
    {
      axios.get(this.$path+'/getpeople')
           .then(response => this.people = response.data);
    },
  },
  created(){
    this.getPeople();
  },
  mounted(){
    /*console.log(this.people);*/
    console.log(this.$path+'/getpeople');
  }


}
</script>

<style lang="css">
  @import "../../../css/people.css";
</style>
