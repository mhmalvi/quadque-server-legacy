<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div v-if="this.is_editing == true" @click="disable_button()" class="mt-3">
        <button class="btn btn-primary">Create Services</button>
      </div>
      <div class="col-md-6 mt-4">
        <!-- <div class="alert alert-success" v-if="this.success">
          {{ this.success }}
        </div> -->
        <div class="card">
          <div class="card-header text-center" style="
              height: 47px;
              background-image: linear-gradient(
                to right,
                rgb(242, 112, 156),
                rgb(255, 148, 114)
              );
            ">
            <h4 class="card-title text-white text-center" style="margin-top: 1%">
              {{ this.is_editing ? "Update Service" : "Create Service" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="title">Service Name</label>
                <input type="text" class="form-control" v-model="service_name" placeholder="Enter service name" required/>
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="thumbnail">Service File</label>
                <input type="file" class="form-control" id="thumbnail" required @change="uploadfile" />
                <div class="text-danger" v-if="this.fileError">
                  {{ this.fileError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_thumbnail_url">
                  <img :src="this.temp_thumbnail_url" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="title">Service Description</label><br />
                <!-- <vue-editor useCustomImageHandler v-model="content" /> -->
                <!-- <textarea
                  v-model="design"
                  class="form-control summernote"
                  rows="4"

                  required
                ></textarea> -->
                <textarea v-model="description" class="form-control" rows="4" required></textarea>

                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <h4>Identity Menus</h4>
              <div class="form-group">
                <!-- <div v-for="(data, index) in identity_menus" :key="index"> -->
                <label for=""> Menus <span style="color:red;">(use comma (,) separated names)</span> </label>
                <textarea type="string" @keydown.space.prevent id="identity_design_menus" class="form-control" v-model="identity_design_menus"
                  placeholder="Enter menus" required></textarea>
                <!-- <a style="height: 40px;cursor:pointer;color:red;" @click="removeIdentityMenu(index)">Remove (-)</a> -->
                <!-- </div> -->
                <div class="text-danger" v-if="this.identity_design_menusError">
                  {{ this.identity_design_menusError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Identity Design Title</label>
                <input type="text" class="form-control" v-model="identity_design_title" placeholder="Enter title" required />
                <div class="text-danger" v-if="this.identity_design_titleError">
                  {{ this.identity_design_titleError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Identity Design Description </label>
                <textarea v-model="identity_design_des" class="form-control" required></textarea>
                <div class="text-danger" v-if="this.identity_design_desError">
                  {{ this.identity_design_desError }}
                </div>
              </div>
              <!-- <a class="btn btn-primary" style="height: 40px;" @click="addIdentityMenu">Add (+)</a> -->
              <div class="form-group mt-4">
                <label for="title">Project Count</label>
                <input type="number" class="form-control" v-model="project_count" placeholder="Enter project count" required/>
                <div class="text-danger" v-if="this.project_countError">
                  {{ this.project_countError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Happy Clients Count</label>
                <input type="number" class="form-control" v-model="happy_clients" placeholder="Enter count" required/>
                <div class="text-danger" v-if="this.happy_clientsError">
                  {{ this.happy_clientsError }}
                </div>
              </div>

              <!-- <h1>Why Choose Us</h1> -->
              <div class="form-group">
                <label for="title">Content </label>
                <textarea v-model="content" class="form-control" id="summernote" required></textarea>
                <div class="text-danger" v-if="this.contentError">
                  {{ this.contentError }}
                </div>
              </div>

              <!-- <h1>Design Service Capabilities</h1> -->
              <!-- <h4>Service capabilities Menus</h4> -->
              <div class="form-group">

                <!-- <div v-for="(data, index) in service_capability_menus" :key="index"> -->
                <label for="title">Service capabilities Menus <span style="color:red;">(use comma (,) separated names)</span></label>
                <textarea @keydown.space.prevent type="text" class="form-control" v-model="service_capability_menu"
                  placeholder="Enter menu name" required></textarea>
                <!-- <a style="cursor:pointer;height: 40px;color:red;" @click="removeServiceCapabilityMenu(index)">Remove
                    menu</a> -->
                <!-- </div> -->
                <div class="text-danger" v-if="this.service_capability_menuError">
                  {{ this.service_capability_menuError }}
                </div>
              </div>
              <!-- <a class="btn btn-primary" style="height: 40px;" @click="addServiceCapabilityMenu">Add menu</a> -->
              <div class="form-group mt-4">
                <label for="title">Service Deliver Title </label>
                <input type="text" class="form-control" v-model="service_deliver_title" placeholder="Enter title" required/>
                <div class="text-danger" v-if="this.service_deliver_titleError">
                  {{ this.service_deliver_titleError }}
                </div>
              </div>

              <div class="form-group">
                <label for="title">Service Deliver Description</label>
                <textarea v-model="service_deliver_description" class="form-control" rows="4" required></textarea>
                <div class="text-danger" v-if="this.service_deliver_descriptionError">
                  {{ this.service_deliver_descriptionError }}
                </div>
              </div>

              <div>
                <button type="button" class="btn btn-block btn-save text-white" @click="save">
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

              <td style="vertical-align: middle" v-html="list.description"></td>

              <td style="vertical-align: middle">
                <img :src="list.file" width="100" height="100" />
              </td>

              <td style="vertical-align: middle; width: 15%; color: white">
                <button type="button" class="btn btn-primary text-white" @click="editList(list.id)">
                  Edit</button><button type="button" class="btn btn-danger ml-1" @click="destroyList(list.id)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="3">
                <h3 class="text-center">There have no services...!</h3>
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
import { VueEditor } from "vue2-editor";
export default {
  // name:"service-component",
  components: {
    VueEditor,
  },
  data() {
    return {
      lists: [],
      service_name: "",
      file: "",
      description: "",
      identity_design_title: "",
      identity_design_des: "",
      identity_design_menus: "",
      project_count: "",
      happy_clients: "",
      content: "",
      service_capability_menu: "",
      service_capability_menus: [],
      identity_menus: [],
      service_deliver_title: "",
      service_deliver_description: "",

      // our_latest_work_title: "",

      service_nameError: "",
      descriptionError: "",
      fileError: "",
      descriptionError:"",
      identity_design_titleError:"",
      identity_design_desError:"",
      identity_design_menusError:"",
      project_countError:"",
      happy_clientsError:"",
      contentError:"",
      service_capability_menuError:"",
      service_deliver_titleError:"",
      service_deliver_descriptionError:"",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",

      // blog_no: 1,
    };
  },
  methods: {
    // addIdentityMenu: function () {
    //   this.identity_menus.push({
    //     identity_design_menus: '',
    //   });
    // },
    // removeIdentityMenu: function (index) {
    //   this.identity_menus.splice(index, 1);
    // },

    // addServiceCapabilityMenu: function () {
    //   this.service_capability_menus.push({
    //     service_capability_menu: '',
    //   });
    // },
    // removeServiceCapabilityMenu: function (index) {
    //   this.service_capability_menus.splice(index, 1);
    // },
    disable_button() {
      this.is_editing = false;
      this.service_name = "";
      this.description = "";
      this.file = "";
      $("#summernote").summernote("code", "");

      (this.identity_design_title = ""),
        (this.identity_design_des = ""),
        (this.identity_design_menus = ""),
        (this.project_count = ""),
        (this.happy_clients = ""),
        (this.content = ""),
        (this.service_capability_menu = ""),
        (this.service_deliver_title = ""),
        (this.service_deliver_description = ""),
        (this.temp_thumbnail_url = "");
    },
    fetchAll() {
      // console.log("fetch");
      axios
        .get("/admin/service/get")
        .then((response) => {
          console.log(response);
          this.lists = response.data;
        })
        .catch((error) => { });
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

      this.content = $("#summernote").summernote("code");
      // var menuList = {
      //   'identity_menu_list': this.identity_menus,
      //   'services_capabilities_menu_list':this.service_capability_menus
      // }
      let fd = new FormData();
      fd.append("service_name", this.service_name);
      fd.append("description", this.description);
      fd.append("file", this.file);

      fd.append("identity_design_title", this.identity_design_title);
      fd.append("identity_design_des", this.identity_design_des);
      fd.append("identity_design_menus", this.identity_design_menus);

      fd.append("project_count", this.project_count);
      fd.append("happy_clients", this.happy_clients);

      // fd.append('identity_menus[]', menuList)

      // fd.append('menus',menuList);
      fd.append("content", this.content);
      // for (let m = 0; m < this.service_capability_menus.length; m++) {
      //   var cap_menus = JSON.stringify(this.service_capability_menus[m])
      fd.append("service_capability_menus", this.service_capability_menu);
      // }
      fd.append("service_deliver_title", this.service_deliver_title);
      fd.append(
        "service_deliver_description",
        this.service_deliver_description
      );

      fd.append("id", this.temporary_id);
      console.log(fd);
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
          $("#summernote").summernote("code", this.content);
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
          if (error.response.data.errors.identity_design_titleError) {
            this.fileError = error.response.data.errors.file[0];
          } else {
            this.fileError = "";
          }
          if (error.response.data.errors.identity_design_desError) {
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

          this.identity_design_title = response.data.identity_design_title;
          this.identity_design_des = response.data.identity_design_des;
          this.identity_design_menus = response.data.identity_design_menus;

          this.project_count = response.data.project_count;
          this.happy_clients = response.data.happy_clients;
          this.content = response.data.content;

          this.services_capabilities_title =
            response.data.services_capabilities_title;
          this.services_capabilities_des =
            response.data.services_capabilities_des;
          this.service_capability_menu =
            response.data.services_capabilities_menu;

          this.service_deliver_title = response.data.service_deliver_title;
          this.service_deliver_description = response.data.service_deliver_des;

          $("#summernote").summernote("code", this.content);
          this.temp_thumbnail_url = response.data.file;
        })
        .catch((error) => { });
    },
    destroyList(list_id) {
      axios.get(`/admin/service/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        (this.identity_design_title = ""),
          (this.identity_design_des = ""),
          (this.identity_design_menus = ""),
          (this.project_count = ""),
          (this.happy_clients = ""),
          (this.services_capabilities_menus = ""),
          (this.service_deliver_title = ""),
          (this.service_deliver_description = ""),
          (this.temp_thumbnail_url = "");
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
  background-image: linear-gradient(to right,
      rgb(242, 112, 156),
      rgb(255, 148, 114));
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

.fa-solid,
.fas {
  font-size: 2rem;
  padding: 10px;
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

.table-striped>tbody>tr:nth-of-type(odd)>* {
  --bs-table-accent-bg: rgb(229 231 255);
  color: var(--bs-table-striped-color);
  border: none;
}
</style>
