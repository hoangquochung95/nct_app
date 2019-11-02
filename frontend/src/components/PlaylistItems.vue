<template>
  <div>
    <div v-if="info">
      <div class="row">
        <img :src="info.data[0].image" class="rounded mx-auto d-block" width="300" height="300" />
      </div>
      <div class="row">
        <div class="col align-self-center">
          <p class="text-center">
            <b>Tên bài hát : {{info.data[0].name}}</b>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col align-self-center">
          <p class="text-center">Tác giả : {{info.data[0].artists}}</p>
        </div>
      </div>
      <div class="row">
        <div class="col align-self-center">
          <ul class="list-group" v-for="item of info.data[1]" :key="item.id">
            <li class="list-group-item">
              <router-link :to="'/audio/'+item.id">{{item.title}} - {{item.artists}}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "PlaylistItems",
  data() {
    return {
      info: null
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/playlist/" + this.$route.params.id, {
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
