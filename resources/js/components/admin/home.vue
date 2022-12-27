<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 mt-4">
        <div class="alert alert-success" v-if="this.success">
          {{ this.success }}
        </div>
        <div class="card">
          <div class="card-header bg-success text-center" style="height: 47px">
            <h4
              class="card-title text-white text-center"
              style="margin-top: 1%"
            >
              {{ this.is_editing ? "Update Video" : "Create Video" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="title">Video Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="video_name"
                  placeholder="Enter video name"
                />
                <div class="text-danger" v-if="this.titleError">
                  {{ this.titleError }}
                </div>
              </div>
              <div class="form-group">
                <label for="thumbnail">Video File</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.thumbnailError">
                  {{ this.thumbnailError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_video_url">
                  <!-- <img
                    :src="this.temp_video_url"
                    width="150"
                    height="150"
                  /> -->
                  <video class="video-js" width="400" height="200" controls>
                  <source
                    :src="this.temp_video_url"
                  />
                </video>
                </p>
              </div>
              <!-- <div class="form-group">
                <label for="text">Service description</label>
                <textarea
                  v-model="text"
                  id="summernote"
                  class="form-control"
                  rows="10"
                ></textarea>
                <div class="text-danger" v-if="this.textError">
                  {{ this.textError }}
                </div>
              </div>  -->
              <!-- <div class="form-group">
                <label for="title">Service Description</label><br />
                <textarea
                  v-model="description"
                  id="summernote"
                  class="form-control"
                  rows="4"
                ></textarea>
                <div class="text-danger" v-if="this.titleError">
                  {{ this.titleError }}
                </div>
              </div> -->
              <div>
                <button
                  type="button"
                  class="btn btn-block btn-info text-white"
                  @click="save"
                >
                  {{ this.is_editing ? "Update" : "Save" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col-md-12">
        <h4>Video Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Video</th>

              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="list in lists" :key="list.id">
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.id }}.
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.name }}
              </td>
              <td style="vertical-align: middle">
                <!-- {{ list.file }} -->
                <!-- <video-player :options="videoOptions" /> -->
                <!-- <img
                  :src="`http://127.0.0.1:8000/assets/services/${list.file}`"
                  width="100"
                  height="100"
                /> -->
                <video class="video-js" width="100" height="50" controls>
                  <source
                    :src="`http://127.0.0.1:8000/assets/home_video/${list.file}`"
                  />
                </video>
              </td>

              <td style="vertical-align: middle; width: 15%">
                <button
                  type="button"
                  class="btn btn-warning"
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
              <td colspan="3">
                <h3 class="text-center">There have no videos...!</h3>
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
export default {
  data() {
    return {
      lists: [],
      video_name: "",
      file: "",
      description: "",
      titleError: "",
      textError: "",
      thumbnailError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_video_url: "",
      // blog_no: 1,
    };
  },
  methods: {
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/home/get")
        .then((response) => {
          console.log(response.data[0].file);
          this.lists = response.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.file = e.target.files[0];
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/home/update/`;
      } else {
        url = `/admin/home/store`;
      }

      let fd = new FormData();
      console.log(this.video_name);
      fd.append("name", this.video_name);
      fd.append("file", this.file);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          this.success = response.data.success;
          this.fetchAll();
          // console.log(this.success)
          this.name = "";

          this.temporary_id = "";
          this.temp_video_url = "";
          this.is_editing = false;
          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          if (error.response.data.errors.name) {
            this.nameError = error.response.data.errors.name[0];
          } else {
            this.nameError = "";
          }
          if (error.response.data.errors.file) {
            this.fileError = error.response.data.errors.file[0];
          } else {
            this.fileError = "";
          }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.temporary_id = list_id;

      axios
        .get(`/admin/home/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.video_name = response.data.name;
          this.temp_video_url = `http://127.0.0.1:8000/assets/home_video/${response.data.file}`;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/home/delete/${list_id}`).then((response) => {
        this.success = response.data.success;
        this.fetchAll();
      });
    },
  },
  mounted() {
    this.fetchAll();
  },
};
</script>
<style scoped>
</style>
