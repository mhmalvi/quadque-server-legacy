<template>
  <div>
    <h1>Hello</h1>
  </div>
</template>
<script>
import axios from "axios";
export default {
  // name:"service-component",
  // data() {
  //   return {
  //     lists: [],
  //     title: "",
  //     thumbnail: "",
  //     text: "",
  //     titleError: "",
  //     textError: "",
  //     thumbnailError: "",
  //     success: "",
  //     temporary_id: "",
  //     is_edititng: false,
  //     temp_thumbnail_url: "",
  //     blog_no: 1,
  //   };
  // },
  // methods: {
  //   fetchAll() {
  //     axios
  //       .get("/admin/service/get")
  //       .then((response) => {
  //         console.log(response)
  //         this.lists = response.data;
  //       })
  //       .catch((error) => {});
  //   },
  //   uploadfile(e) {
  //     this.thumbnail = e.target.files[0];
  //   },

  //   save() {
  //     let url;
  //     if (this.is_edititng) {
  //       url = `/admin/blog/update/`;
  //     } else {
  //       url = `/admin/blog/store`;
  //     }

  //     this.text = $("#summernote").summernote("code");
  //     let fd = new FormData();
  //     fd.append("title", this.title);
  //     fd.append("text", this.text);
  //     fd.append("thumbnail", this.thumbnail);
  //     fd.append("id", this.temporary_id);
  //     axios
  //       .post(url, fd)
  //       .then((response) => {
  //         this.success = response.data.success;
  //         this.title = "";
  //         this.text = "";
  //         $("#summernote").summernote("code", this.text);
  //         document.getElementById("thumbnail").value = "";
  //         this.temporary_id = "";
  //         this.temp_thumbnail_url = "";
  //         this.is_edititng = false;
  //         this.fetchAll();
  //         setTimeout(function () {
  //           this.success = "";
  //         }, 5000);
  //       })
  //       .catch((error) => {
  //         if (error.response.data.errors.title) {
  //           this.titleError = error.response.data.errors.title[0];
  //         } else {
  //           this.titleError = "";
  //         }

  //         if (error.response.data.errors.text) {
  //           this.textError = error.response.data.errors.text[0];
  //         } else {
  //           this.textError = "";
  //         }
  //         if (error.response.data.errors.thumbnail) {
  //           this.thumbnailError = error.response.data.errors.thumbnail[0];
  //         } else {
  //           this.thumbnailError = "";
  //         }
  //       });
  //   },

  //   editList(list_id) {
  //     this.is_edititng = true;
  //     this.temporary_id = list_id;

  //     axios
  //       .get(`/admin/blog/edit/${this.temporary_id}`)
  //       .then((response) => {
  //         this.title = response.data.title;
  //         this.text = response.data.text;
  //         $("#summernote").summernote("code", this.text);
  //         this.temp_thumbnail_url = `http://127.0.0.1:8000/assets/img/blogs/${response.data.thumbnail}`;
  //       })
  //       .catch((error) => {});
  //   },
  //   destroyList(list_id) {
  //     axios.get(`/admin/blog/delete/${list_id}`).then((response) => {
  //       this.success = response.data.success;
  //       this.fetchAll();
  //     });
  //   },
  // },
  // mounted() {
  //   this.fetchAll();
  // },
};
</script>
<style scoped>
</style>
