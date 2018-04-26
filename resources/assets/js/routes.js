import VueRouter from 'vue-router';

let routes =[

  {
    path:'/',
    component: require('./components/Views/Home')
  },

  {
    path:'/news',
    component: require('./components/Views/News')
  },

  {
    path:'/chat',

    component: require('./components/Views/Chat')
  },

  {
    path:'/people',
    component: require('./components/Views/People')
  }


];

export default new VueRouter({
  routes
});
