import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Home from './components/Home.vue'
import Audio from './components/Audio.vue'
import Playlist from './components/Playlist.vue'
import AudioItems from './components/AudioItem.vue'
import PlaylistItems from './components/PlaylistItems.vue'
import 'bootstrap'; 
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.config.productionTip = false
Vue.use(VueRouter)
const router = new VueRouter({
  routes: [
    // dynamic segments start with a colon
    { path: '/', component: Home },
    { path: '/audio', component: Audio },
    { path: '/playlist', component: Playlist },
    { path: '/audio/:id', component: AudioItems, name: 'AudioItems' },
    { path: '/playlist/:id', component: PlaylistItems, name: 'PlaylistItems' }
  ]
})

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
