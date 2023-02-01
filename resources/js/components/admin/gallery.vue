<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Add Gallery Images</button>
      </div>
      <div class="col-md-6 mt-4">
        <!-- <div class="alert alert-success" v-if="this.success">
          {{ this.success }}
        </div> -->
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
            <h4
              class="card-title text-white text-center"
              style="margin-top: 1%"
            >
              {{ this.is_editing ? "Update Gallery" : "Create Gallery" }}
            </h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="save()" method="post">
              <!-- {{ description }} -->
              <!-- <div v-if="this.is_editing" class="form-group">
                <label for="title">Slug</label>
                <input type="string" v-model="slug" value="title" class="form-control" />
              </div> -->
              <div class="form-group">
                <label for="title">Album Title</label><br />
                <input type="text" class="form-control" v-model="title" />
                <div class="text-danger" v-if="this.title_Error">
                  {{ this.title_Error }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Album Caption</label><br />
                <textarea
                  class="form-control"
                  v-model="album_caption"
                ></textarea>
                <div class="text-danger" v-if="this.album_caption_Error">
                  {{ this.album_caption_Error }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Album Images</label><br />
                <input
                  type="file"
                  class="form-control"
                  @change="image_handler"
                  multiple
                />
                <div class="text-danger" v-if="this.image_Error">
                  {{ this.image_Error }}
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="title">Image Caption</label><br />
                <textarea
                  class="form-control"
                  v-model="image_caption"
                ></textarea>
                <div class="text-danger" v-if="this.image_caption_Error">
                  {{ this.image_caption_Error }}
                </div>
              </div> -->

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
                <div
                  v-for="(image, index) in gallery_images"
                  :key="index"
                  class="col-md-12"
                >
                  <div class="row">
                    <div style="width: 30%" class="col-md-3 justify-content-center">
                      <img
                        style="width: 20%"
                        :src="$base + image.images"
                        alt=""
                      />
                    </div>
                  </div>
                </div>
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
              <!-- <th>gallery images</th> -->
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
              <!-- <td v-for="(image, index) in list.gallery_images" :key="index">
                <img
                  style="width: 20%; height: 20%"
                  :src="$base + image.images"
                  alt=""
                />
              </td> -->
              <!-- <td style="vertical-align: middle">
                {{ list.image_caption }}
              </td> -->

              <!-- <td style="vertical-align: middle">
                {{ list.who_we_are }}
              </td>

              <td style="vertical-align: middle">
                {{ list.why_choose_us }}
              </td> -->

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
                <h3 class="text-center">There have nothing about us...!</h3>
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
  // name:"service-component",
  data() {
    return {
      is_editing: false,
      lists: [],
      gallery_images: [],
      title: "",
      album_caption: "",
      //   image_caption: "",
      images: [],

      title_Error: "",
      album_caption_Error: "",
      image_Error: "",
      image_caption_Error: "",
      // blog_no: 1,
    };
  },
  //   computed: {
  //     slug() {
  //       return this.title.replace(/\s+/g, "-").toLowerCase();
  //     },
  //   },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.album_caption = "";
      (this.image_caption = ""), (this.title = "");
      this.images = [];
      this.image_Error = "";
      //   this.image_caption = "";
      this.image_caption_Error = "";
      this.title_Error = "";
    },
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/gallery/get")
        .then((response) => {
          this.lists = response.data;
          console.log(this.lists);
        })
        .catch((error) => {});
    },
    image_handler(e) {
      this.images = e.target.files;
      console.log(this.images);
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/gallery/update`;
      } else {
        url = `/admin/gallery/store`;
      }
      let formdata = new FormData();
      formdata.append("title", this.title);
      formdata.append("album_caption", this.album_caption);
      //   formdata.append("image_caption", "this.image_caption");
      for (let i = 0; i < this.images.length; i++) {
        formdata.append("images[]", this.images[i]);
      }
      console.log(formdata);
      // console.log(response)
      //   exit()
      axios
        .post(url, formdata)
        .then((response) => {
          console.log("response");
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
            this.album_caption = "";
            (this.image_caption = ""), (this.title = "");
            this.images = [];
            this.image_Error = "";
            // this.image_caption = "";
            this.image_caption_Error = "";
            this.title_Error = "";
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "About us Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.is_editing = true;
          }

          // console.log(this.success)

          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          console.log(error.response.data.data);
          //   if (error.response.data.data == "exist") {
          //     this.$swal.fire({
          //       // position: "top-end",
          //       icon: "failed",
          //       title: "Data already exist. Please go to edit section to edit.",
          //       showConfirmButton: true,
          //       // timer: 1500,
          //     });
          //   }
          if (error.response.data.errors.our_vision) {
            console.log("here");
            console.log(error.response.data.errors.our_vision);
            this.our_visionError = error.response.data.errors.our_vision[0];
          } else {
            this.our_visionError = "";
          }

          if (error.response.data.errors.our_mission) {
            this.our_missionError = error.response.data.errors.our_mission[0];
          } else {
            this.our_missionError = "";
          }

          if (error.response.data.errors.our_goal) {
            this.our_goalError = error.response.data.errors.our_goal[0];
          } else {
            this.our_goalError = "";
          }
          if (error.response.data.errors.our_objective) {
            this.our_objectiveError =
              error.response.data.errors.our_objective[0];
          } else {
            this.our_objectiveError = "";
          }
          if (error.response.data.errors.who_we_are) {
            this.who_we_areError = error.response.data.errors.who_we_are[0];
          } else {
            this.who_we_areError = "";
          }
          if (error.response.data.errors.why_choose_us) {
            this.why_choose_usError =
              error.response.data.errors.why_choose_us[0];
          } else {
            this.why_choose_usError = "";
          }
        });
    },

    editList(list_id) {
      console.log(list_id);
      this.is_editing = true;
      this.temporary_id = list_id;

      axios
        .get(`/admin/gallery/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.title = response.data.data.album.album_title;
          this.album_caption = response.data.data.album.album_caption;
          this.gallery_images = response.data.data.images;
          console.log(this.gallery_images);
          // this.our_goal = response.data.our_goal;
          // this.our_objective = response.data.our_objective;
          // this.who_we_are = response.data.who_we_are;
          // this.why_choose_us = response.data.why_choose_us;
          // this.meta_keyword = response.data.meta_keyword;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/gallery/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
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
