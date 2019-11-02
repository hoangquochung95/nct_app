<template>
  <div>
    <div class="row title">
      <p class="title">
        <b>Playlist</b>
      </p>
    </div>
    <div class="row playlist" v-if="info">
      <div v-for="item of info.data.playlist" class="col-md-4" :key="item.id">
        <div class="row">
          <router-link :to="'/playlist/'+item.id">
            <img :src="item.image" class="rounded avatar" />
          </router-link>
        </div>
        <div class="row">
          <div class="col align-self-center">
            <p class="text-center">{{item.name}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <p class="title">
        <b>Audio</b>
      </p>
    </div>
    <div class="row audio" v-if="info">
      <div v-for="item of info.data.mediaItems" class="col-md-4" v-bind:key="item.id">
        <div class="row">
          <router-link :to="'/audio/'+item.id">
            <img :src="item.image" class="rounded avatar" />
          </router-link>
        </div>
        <div class="row">
          <div class="col align-self-center">
            <p class="text-center">{{item.title}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Home",
  data() {
    return {
      info: null
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/home", {
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS"
        }
      })
      .then(response => (this.info = response));
  }
};
</script>

<style scope>
.avatar {
  width: 300px;
  height: 300px;
}
.row {
  margin-bottom: 10px;
}
.title {
  margin-left: 30px;
}
</style>
