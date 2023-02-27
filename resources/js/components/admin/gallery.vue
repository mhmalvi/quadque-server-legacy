<template>
  <div>
    <lottie-vue-player
      v-if="loader"
      :src="`./9582-liquid-4-dot-loader.json`"
      style="
        top: 40%;
        position: sticky;
        background: transparent;
        z-index: 100;
        margin-left: -5%;
      "
    >
    </lottie-vue-player>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Add Gallery Images</button>
      </div>
      <div class="col-md-6 mt-4">
        <div class="card">
          <div
            class="card-header text-center"
            style="
              height: 47px;
              background-image: linear-gradient(
                to right,
                rgb(242, 112, 156),
                rgb(255, 148, 114)
              );
            "
          >
            <h4 class="card-title text-white text-center" style="margin: auto">
              {{ this.is_editing ? "Update Gallery" : "Create Gallery" }}
            </h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="save()" method="post">
              <div class="form-group">
                <label for="title">Album Title</label><br />
                <input
                  type="text"
                  class="form-control"
                  v-model="title"
                  required
                />
                <div class="text-danger" v-if="this.titleError">
                  {{ this.titleError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Album Caption</label><br />
                <textarea
                  class="form-control"
                  v-model="album_caption"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.albumError">
                  {{ this.albumError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Album Images</label><br />
                <input
                  type="file"
                  class="form-control"
                  @change="image_handler"
                  ref="fileUpload"
                  required
                  multiple
                />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
              </div>
              <div>
                <button
                  type="button"
                  class="btn btn-block btn-save text-white"
                  @click="save"
                >
                  {{ this.is_editing ? "Update" : "Save" }}
                </button>
              </div>
              <div v-if="is_editing == true">
                <form
                  v-for="(image, index) in gallery_images"
                  :key="index"
                  class="mt-3"
                >
                  <a @click.prevent="get_img_id(image.id, album_id)" class="btn"
                    >X</a
                  >
                  <img style="width: 20%" :src="$base + image.images" alt="" />
                  <form method="post" class="my-3">
                    <input
                      type="file"
                      @change="update_image"
                      class="form-control mb-2"
                    />
                    <button
                      @click.prevent="update(image.id, album_id)"
                      class="btn btn-success"
                      type="submit"
                    >
                      Update
                    </button>
                  </form>
                </form>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col-md-12">
        <h4>Gallery List</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>gallery title</th>
              <th>gallery caption</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="(list, index) in lists" :key="index">
              <td style="vertical-align: middle; font-weight: 500">
                {{ index + 1 }}.
              </td>

              <td style="vertical-align: middle; font-weight: 500">
                {{ list.album_title }}
              </td>

              <td style="vertical-align: middle">
                {{ list.album_caption }}
              </td>
              <td style="vertical-align: middle; width: 15%; color: white">
                <button
                  type="button"
                  class="btn btn-primary text-white"
                  @click="editList(list.id)"
                >
                  Edit</button
                ><button
                  type="button"
                  class="btn btn-danger ml-1"
                  @click="destroyList(list.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="8">
                <h3 class="text-center">Gallery is empty...!</h3>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { exit } from "process";
export default {
  data() {
    return {
      is_editing: false,
      loader: false,
      lists: [],
      album_id: "",
      gallery_images: [],
      title: "",
      album_caption: "",
      image_replace: [],
      //   image_caption: "",
      images: [],
      temporary_id: "",
      titleError: "",
      replace_image: "",
      replace_id: "",
      title_Error: "",
      albumError: "",
      imageError: "",
    };
  },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.album_caption = "";
      (this.image_caption = ""), (this.title = "");
      this.images = [];
      this.image_Error = "";
      this.image_caption_Error = "";
      this.title_Error = "";
      this.album_Error = "";
      this.imageError = "";
    },
    fetchAll() {
      this.loader = true;
      console.log("fetch");
      axios
        .get("/admin/gallery/get")
        .then((response) => {
          this.lists = response.data;
          this.loader = false;
          console.log(this.lists);
        })
        .catch((error) => {});
    },

    update_image(e) {
      this.replace_image = e.target.files[0];
      console.log(this.replace_image);
    },
    update(id, album_id) {
      let formData = new FormData();
      formData.append("images", this.replace_image);
      formData.append("id", id);
      axios.post("/admin/gallery/update-image", formData).then((res) => {
        alert("updated");
        this.editList(album_id);
      });
    },

    get_img_id(id, album_id) {
      console.log(album_id);
      confirm("Are you sure?");
      axios
        .get(`/admin/gallery/delete-image/${id}`)
        .then((response) => {
          this.editList(album_id);
          alert("Deleted");
        })
        .catch((error) => {});
    },

    image_handler(e) {
      this.images = e.target.files;
      console.log(this.images);
    },

    save() {
      let url;
      this.loader = true;
      if (this.is_editing) {
        url = `/admin/gallery/update`;
      } else {
        url = `/admin/gallery/store`;
      }
      let formdata = new FormData();
      // console.log(this.temporary_id)
      formdata.append("title", this.title);
      formdata.append("album_caption", this.album_caption);
      formdata.append("id", this.temporary_id);
      //   formdata.append("image_caption", "this.image_caption");
      for (let i = 0; i < this.images.length; i++) {
        formdata.append("images[]", this.images[i]);
      }
      axios
        .post(url, formdata)
        .then((response) => {
          this.loader = false;
          
          this.albumError = "";
          this.titleError = "";
          this.imageError = "";
          this.success = response.data.message;
          this.fetchAll();
          if (this.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Gallery Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.is_editing = false;
            // e.target.files=[]
            
            this.album_caption = "";
            (this.image_caption = ""), (this.title = "");
            this.images = [];
            this.$refs.fileUpload.value=null;
            this.image_Error = "";
            // this.image_caption = "";
            this.image_caption_Error = "";
            this.title_Error = "";
          } else if (this.success == "updated") {
            this.fetchAll();
            // e.target.files=[]
            this.is_editing = false;
            this.$refs.fileUpload.value=null;
            this.album_caption = "";
            (this.image_caption = ""), (this.title = "");
            this.images = [];
            this.image_Error = "";
            // this.image_caption = "";
            this.image_caption_Error = "";
            this.title_Error = "";
            // this.editList(this.temporary_id);
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Gallery Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
            // this.is_editing = true;
          }

          // console.log(this.success)

          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          this.loader = false;
          if (error.response.data.errors.title) {
            this.loader = false;
            console.log(error.response.data.errors.our_vision);
            this.titleError = error.response.data.errors.title[0];
          } else {
            this.titleError = "";
          }
          if (error.response.data.errors.album_caption) {
            this.loader = false;
            console.log(error.response.data.errors.album_caption);
            this.albumError = error.response.data.errors.album_caption[0];
          } else {
            this.albumError = "";
          }
          if (error.response.data.errors.images) {
            this.loader = false;
            console.log(error.response.data.errors.images);
            this.imageError = error.response.data.errors.images[0];
          } else {
            this.imageError = "";
          }
        });
    },

    editList(list_id) {
      this.loader = true;
      this.is_editing = true;
      (this.titleError = ""), (this.temporary_id = list_id);

      axios
        .get(`/admin/gallery/edit/${this.temporary_id}`)
        .then((response) => {
          this.loader = false;
          this.title = response.data.data.album.album_title;
          this.album_caption = response.data.data.album.album_caption;
          this.album_id = response.data.data.album.id;
          this.gallery_images = response.data.data.images;
          // console.log(this.gallery_images);
          // this.our_goal = response.data.our_goal;
          // this.our_objective = response.data.our_objective;
          // this.who_we_are = response.data.who_we_are;
          // this.why_choose_us = response.data.why_choose_us;
          // this.meta_keyword = response.data.meta_keyword;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      this.loader = true;
      axios.get(`/admin/gallery/delete/${list_id}`).then((response) => {
        this.loader = false;
        this.is_editing = false;
        this.fetchAll();
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        this.album_caption = "";
        (this.image_caption = ""), (this.title = "");
        this.images = [];
        this.image_Error = "";
        // this.image_caption = "";
        this.image_caption_Error = "";
        this.title_Error = "";
      });
    },
  },
  mounted() {
    this.fetchAll();
  },
};
</script>
<style scoped>
div {
  letter-spacing: 1px;
  font-family: sans-serif;
}

.btn-edit {
  background: #0093e9;
}

.card-header {
  background-image: linear-gradient(
    to right,
    rgb(242, 112, 156),
    rgb(255, 148, 114)
  );
}

thead {
  /* background: #84a4ff; */
  background-image: linear-gradient(to right, #0093e9, #80d0c7);
  color: white;
  border: none;
}

.card {
  border-top: none;
}

.card-header {
  border: none;
}

.btn-save {
  background: #5a67ff;
}

.btn-save:hover {
  background: #0093e9;
  transition: 2s ease;
}

.table-striped > tbody > tr:nth-of-type(odd) > * {
  --bs-table-accent-bg: rgb(229 231 255);
  color: var(--bs-table-striped-color);
  border: none;
}
</style>
