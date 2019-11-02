<template>
  <div>
    <div class="row title">
      <p class="title">
        <b>Audio</b>
      </p>
    </div>
    <div class="row audio" v-if="info">
      <div v-for="item of info.data" class="col-md-4" :key="item.id">
        <div class="row">
          <router-link :to="'/audio/'+item.id">
            <img :src="item.image" class="rounded avatar" />
          </router-link>
        </div>
        <div class="row text-center">
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
  name: "Audio",
  data() {
    return {
      info: null
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/audio", {
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS"
        }
      })
      .then(response => (this.info = response));
  }
};
</script>

