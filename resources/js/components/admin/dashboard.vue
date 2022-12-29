<template>
  <div>
    <h1 style="font-weight: 600;" class="mt-3"> Dashbaord</h1>
    <div class="mt-3" style="margin-left:20%;">
      <h4>Hello {{ name }}</h4>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      name: "",
      role:""
    };
  },
  methods: {
    current_user: function () {
      axios.get("/admin/current").then((res) => {
        console.log(res);
        this.role=res.data.role
        this.name = res.data.name;
      });
    },
  },
  created() {
    this.current_user();
  },
};
</script>