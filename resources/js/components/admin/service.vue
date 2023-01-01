<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Services</button>
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
              {{ this.is_editing ? "Update Service" : "Create Service" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="title">Service Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="service_name"
                  placeholder="Enter service name"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="thumbnail">Service File</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  @change="uploadfile"
                  required
                />
                <textarea
                  v-model="description"
                  id="summernote"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.fileError">
                  {{ this.fileError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_thumbnail_url">
                  <!-- <textarea
                  v-model="description"
                  id="summernote2"
                  class="form-control"
                  rows="4"
                  required
                ></textarea> -->
                  <img
                    :src="this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="title">Service Description</label><br />
                <textarea
                  v-model="description"
                  id="summernote"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
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
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col-md-12">
        <h4>Services Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th style="width: 36%">Description</th>
              <th>Thumbnail</th>

              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="list in lists" :key="list.id">
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.id }}.
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.service_name }}
              </td>

              <td style="vertical-align: middle" v-html="list.description">
                <!-- {{  }} -->
              </td>

              <td style="vertical-align: middle">
                <img :src="list.file" width="100" height="100" />
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
              <td colspan="3">
                <h3 class="text-center">There have no blogs...!</h3>
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
  // name:"service-component",
  data() {
    return {
      lists: [],
      service_name: "",
      file: "",
      description: "",
      service_nameError: "",
      descriptionError: "",
      fileError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      // blog_no: 1,
    };
  },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.service_name = "";
      this.description = "";
      this.file = "";
      $("#summernote").summernote("code", "");
      $("#summernote1").summernote("code", "");
      $("#summernote2").summernote("code", "");
      this.temp_thumbnail_url = "";
    },
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/service/get")
        .then((response) => {
          // console.log(response);
          this.lists = response.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.file = e.target.files[0];
      this.temp_thumbnail_url = "";
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/service/update/`;
      } else {
        url = `/admin/service/store`;
      }

      this.description = $("#summernote").summernote("code");
      let fd = new FormData();
      fd.append("service_name", this.service_name);
      fd.append("description", this.description);
      fd.append("file", this.file);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          this.success = response.data.success;
          this.fetchAll();
          if (this.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }

          // console.log(this.success)
          this.service_name = "";
          this.description = "";
          $("#summernote").summernote("code", this.description);
          document.getElementById("file").value = "";
          this.temporary_id = "";
          this.temp_thumbnail_url = "";
          this.file = "";
          this.is_editing = false;
          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          console.log(error.response);
          if (error.response.data.errors.service_name) {
            console.log("here");
            console.log(error.response.data.errors.service_name);
            this.service_nameError = error.response.data.errors.service_name[0];
          } else {
            this.service_nameError = "";
          }

          if (error.response.data.errors.description) {
            this.descriptionError = error.response.data.errors.description[0];
          } else {
            this.descriptionError = "";
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
      this.service_nameError = "";
      this.fileError = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/service/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.service_name = response.data.service_name;
          this.description = response.data.description;
          $("#summernote").summernote("code", this.description);
          this.temp_thumbnail_url = response.data.file;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/service/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
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
.card{
      border-top: none;
}
.card-header{
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
