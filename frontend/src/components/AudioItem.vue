<template>
  <div>
    <div v-if="info">
      <div class="row">
        <img :src="info.data.image" class="rounded mx-auto d-block" width="300" height="300" />
      </div>
      <div class="row">
        <div class="col align-self-center">
          <p class="text-center">
            <b>Tên bài hát : {{info.data.title}}</b>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col align-self-center">
          <p class="text-center">Thể loại : {{info.data.type}}</p>
        </div>
      </div>
      <div class="row">
        <div class="col align-self-center">
          <p class="text-center">Tác giả : {{info.data.artists}}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AudioItem",
  data() {
    return {
      info: null
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/audio/" + this.$route.params.id, {
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
