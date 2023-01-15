<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Add speak of clients</button>
      </div>
      <div class="col-md-12 mt-4">
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
              {{
                this.is_editing ? "Update Client Speak" : "Create Client Speak"
              }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="title">Client Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="name"
                  placeholder="Enter client name"
                />
                <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div>
              </div>
              <!-- <div class="form-group" v-if="this.is_editing">
                <label for="title">slug</label>
                <input
                  type="string"
                  class="form-control"
                  v-model="slug"
                  placeholder="Enter slug"
                  required
                />
              </div> -->
              <!-- {{ designation }} -->
              <div class="form-group">
                <label for="title">Client Designation</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="designation"
                  placeholder="Enter designation"
                />
                <div class="text-danger" v-if="this.designationError">
                  {{ this.designationError }}
                </div>
              </div>
              <div class="form-group">
                <label for="thumbnail">Client Image</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.fileError">
                  {{ this.fileError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_thumbnail_url">
                  <img
                    :src="this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <!-- {{ description }} -->
              <div class="form-group">
                <label for="title">Client Opinion</label><br />
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
        <h4>Client Opinion Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Designation</th>
              <th style="width: 36%">Description</th>
              <th>Thumbnail</th>

              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="(list, index) in lists" :key="index">
              <td style="vertical-align: middle; font-weight: 500">
                {{ index + 1 }}.
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.name }}
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.designation }}
              </td>

              <td style="vertical-align: middle" v-html="list.description">
                <!-- {{  }} -->
              </td>

              <td style="vertical-align: middle">
                <img :src="list.image" width="100" height="100" />
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
              <td colspan="6">
                <h3 class="text-center">There have no client speaks...!</h3>
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
      name: "",
      image: "",
      description: "",
      designation: "",
      nameError: "",
      descriptionError: "",
      designationError: "",
      fileError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      // blog_no: 1,
    };
  },
  // computed: {
  //       slug(){
  //           return this.name.replace(/\s+/g, '-').toLowerCase();
  //       }
  //   },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.name = "";
      this.designation = "";
      this.description = "";
      this.file = "";
      // this.slug=""
      // $("#summernote").summernote("code", "");
      this.temp_thumbnail_url = "";
    },
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/client-speak/get")
        .then((response) => {
          // console.log(response);
          this.lists = response.data.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.image = e.target.files[0];
      this.temp_thumbnail_url = "";
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/client-speak/update/`;
      } else {
        url = `/admin/client-speak/store`;
      }

      this.description = $("#summernote").summernote("code");
      let fd = new FormData();
      fd.append("name", this.name);
      fd.append("designation", this.designation);
      fd.append("description", this.description);
      fd.append("image", this.image);
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
            this.is_editing = false;
            this.name = "";
            this.description = "";
            this.designation = "";
            $("#summernote").summernote("code", this.description);
            document.getElementById("image").value = "";
            this.temporary_id = "";
            this.temp_thumbnail_url = "";
            this.image = "";
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Updated",
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
          console.log(error.response);
          if (error.response.data.errors.name) {
            console.log("here");
            console.log(error.response.data.errors.name);
            this.nameError = error.response.data.errors.name[0];
          } else {
            this.nameError = "";
          }

          if (error.response.data.errors.description) {
            this.descriptionError = error.response.data.errors.description[0];
          } else {
            this.descriptionError = "";
          }

          if (error.response.data.errors.designation) {
            this.designationError = error.response.data.errors.designation[0];
          } else {
            this.designationError = "";
          }
          if (error.response.data.errors.image) {
            this.fileError = error.response.data.errors.image[0];
          } else {
            this.fileError = "";
          }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.nameError = "";
      this.fileError = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/client-speak/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.name = response.data.name;
          this.designation = response.data.designation;
          this.description = response.data.description;
          $("#summernote").summernote("code", this.description);
          this.temp_thumbnail_url = response.data.image;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/client-speak/delete/${list_id}`).then((response) => {
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
