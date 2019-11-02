<template>
  <div id="app">
    <div class="fluid-container">
      <nav class="navbar bg-dark navbar-dark navbar-expand-sm">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
             <router-link to="/">Home</router-link>
          </li>
          <li class="nav-item">
             <router-link to="/audio">Audio</router-link>
          </li>
           <li class="nav-item">
             <router-link to="/playlist">Playlist</router-link>
          </li>
        </ul>
      </nav>
    </div>
    <div id="content">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'app',

}
</script>

<style scoped>
  #content{
    margin-top: 60px;
  }
  .nav-item{
    margin: 3px;
  }
  .nav-item a {
    color: aliceblue;
  }
</style>
