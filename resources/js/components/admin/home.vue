<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Video</button>
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
                <div class="text-danger" v-if="this.video_nameError">
                  {{ this.video_nameError }}
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
                <div class="text-danger" v-if="this.fileError">
                  {{ this.fileError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_video_url">
                  <!-- <img
                    :src="this.temp_video_url"
                    width="150"
                    height="150"
                  /> -->
                  <video class="video-js" width="400" height="200" controls>
                    <source :src="this.temp_video_url" />
                  </video>
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Meta Keyword</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  v-model="meta_keyword"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
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
                <!-- {{ $assetbase }} -->
                <video class="video-js" width="200" height="100" controls>
                  <source :src="list.file" />
                </video>
              </td>

              <td style="vertical-align: middle; width: 15%">
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
// import VueSweetalert2 from "vue-sweetalert2";
export default {
  data() {
    return {
      lists: [],
      video_name: "",
      file: "",
      video_nameError: "",
      fileError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_video_url: "",
      meta_keyword:""
      // blog_no: 1,
    };
  },
  methods: {
    disable_button(e) {
      this.is_editing = false;
      this.video_name = "";
      this.temp_video_url = "";
      this.meta_keyword=""
      this.file = "";
      e.target.files[0] = "";
    },
    fetchAll() {
      console.log("hello");
      axios
        .get("/admin/home/get")
        .then((response) => {
          // console.log(response.data[0].file);
          this.lists = response.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.file = e.target.files[0];
      this.temp_video_url = "";
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/home/update`;
      } else {
        url = `/admin/home/store`;
      }

      let fd = new FormData();
      // console.log(this.video_name);
      fd.append("name", this.video_name);
      fd.append("file", this.file);
      fd.append("meta_keyword", this.meta_keyword);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          // console.log(response)
          this.fetchAll();
          this.success = response.data.success;
          // console.log(this.$swal);

          if (this.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Video Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.video_name = "";

          this.temporary_id = "";
          this.file = "";
          this.temp_video_url = "";
          this.is_editing = false;
          this.meta_keyword=""
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Video Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }

          // console.log(this.success)
          
          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          // console.log(error.response)
          if (error.response.data.errors.name) {
            this.video_nameError = error.response.data.errors.name[0];
          } else {
            this.video_nameError = "";
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
      this.video_nameError = "";
      this.fileError = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/home/edit/${this.temporary_id}`)
        .then((response) => {
          // console.log(response);
          this.video_name = response.data.name;
           this.meta_keyword = response.data.meta_keyword;
          this.temp_video_url = response.data.file;
          // console.log()
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      // try {
      axios.get(`/admin/home/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
        this.video_name = "";

          this.temporary_id = "";
          this.file = "";
          this.temp_video_url = "";
          this.is_editing = false;
          this.meta_keyword=""
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
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
.card{
      border-top: none;
}
.card-header{
  border: none;
}
.table-striped > tbody > tr:nth-of-type(odd) > * {
  --bs-table-accent-bg: rgb(229 231 255);
  color: var(--bs-table-striped-color);
  border: none;
}
.btn-edit {
  background: #0093e9;
}
.btn-save {
  background: #5a67ff;
}
.btn-save:hover {
  background: #0093e9;
  transition: 2s ease;
}
</style>