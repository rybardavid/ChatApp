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
    path:'/about',

    component: require('./components/Views/About')
  },

  {
    path:'/people',
    component: require('./components/Views/People')
  }


];

export default new VueRouter({
  routes
});
