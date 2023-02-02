<template>
  <div>
    <lottie-vue-player
      v-if="loader"
      :src="`./9582-liquid-4-dot-loader.json`"
      style="top: 40%; position: sticky; background: transparent; z-index: 100"
    >
    </lottie-vue-player>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Services</button>
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
                  @change="get_slug"
                  placeholder="Enter service name"
                  required
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Service Short Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  v-model="service_short_description"
                  placeholder="Enter service short description"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Service Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="service_title"
                  placeholder="Enter service title"
                  required
                />
                <!-- <div class="text-danger" v-if="this.service_titleError">
                  {{ this.service_titleError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="title">Slug</label
                ><input
                  @click="get_slug"
                  class="ml-4"
                  type="checkbox"
                  v-model="checked"
                />
                <label style="color: blue"
                  >select to get based on service name</label
                >
                <input
                  type="string"
                  class="form-control"
                  v-model="slug"
                  placeholder="Enter slug"
                  required
                />
                <!-- <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div> -->
              </div>

              <div class="form-group">
                <label for="thumbnail">Service File</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  required
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.fileError">
                  {{ this.fileError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_thumbnail_url">
                  <img
                    :src="$base + this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="title">Service Description</label><br />
                <textarea
                  v-model="description"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <!-- <froala :tag="'textarea'" v-model="description"></froala> -->

                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Identity Design Description </label>
                <textarea
                  v-model="identity_design_des"
                  class="form-control"
                  cols="30"
                  rows="10"
                ></textarea>
                <!-- <el-tiptap
                  v-model="identity_design_des"
                  :extensions="extensions"
                /> -->
                <div class="text-danger" v-if="this.identity_design_desError">
                  {{ this.identity_design_desError }}
                </div>
              </div>
              <!-- <a class="btn btn-primary" style="height: 40px;" @click="addIdentityMenu">Add (+)</a> -->
              <div class="form-group mt-4">
                <label for="title">Project Count</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="project_count"
                  placeholder="Enter project count"
                  required
                />
                <div class="text-danger" v-if="this.project_countError">
                  {{ this.project_countError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Happy Clients Count</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="happy_clients"
                  placeholder="Enter count"
                  required
                />
                <div class="text-danger" v-if="this.happy_clientsError">
                  {{ this.happy_clientsError }}
                </div>
              </div>

              <!-- <h1>Why Choose Us</h1> -->
              <div class="form-group">
                <label for="title">Content </label>
                <select class="summernote" v-model="content"></select>
                <!-- <textarea
                  v-model="content"
                  class="form-control"
                  id="summernote"
                  required
                ></textarea> -->
                <div class="text-danger" v-if="this.contentError">
                  {{ this.contentError }}
                </div>
              </div>

              <!-- <h1>Design Service Capabilities</h1> -->
              <!-- <h4>Service capabilities Menus</h4> -->
              <div class="form-group">
                <!-- <div v-for="(data, index) in service_capability_menus" :key="index"> -->
                <label for="title"
                  >Service capabilities Menus
                  <span style="color: red"
                    >(use comma (,) separated names)</span
                  ></label
                >
                <textarea
                  type="text"
                  class="form-control"
                  v-model="service_capability_menu"
                  placeholder="Enter menu name"
                  required
                ></textarea>
                <!-- <a style="cursor:pointer;height: 40px;color:red;" @click="removeServiceCapabilityMenu(index)">Remove
                    menu</a> -->
                <!-- </div> -->
                <div
                  class="text-danger"
                  v-if="this.service_capability_menuError"
                >
                  {{ this.service_capability_menuError }}
                </div>
              </div>
              <!-- <a class="btn btn-primary" style="height: 40px;" @click="addServiceCapabilityMenu">Add menu</a> -->
              <div class="form-group mt-4">
                <label for="title">Service Deliver Title </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="service_deliver_title"
                  placeholder="Enter title"
                  required
                />
                <div class="text-danger" v-if="this.service_deliver_titleError">
                  {{ this.service_deliver_titleError }}
                </div>
              </div>

              <div class="form-group">
                <label for="title">Service Deliver Description</label>
                <textarea
                  v-model="service_deliver_description"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div
                  class="text-danger"
                  v-if="this.service_deliver_descriptionError"
                >
                  {{ this.service_deliver_descriptionError }}
                </div>
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
        <h4>Services List</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Thumbnail</th>
              <!-- <th>identity description</th>
              <th style="width: 36%">Description</th> -->

              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="(list, index) in lists" :key="index">
              <td style="vertical-align: middle; font-weight: 500">
                {{ index + 1 }}.
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.service_name }}
              </td>

              <td style="vertical-align: middle">
                <img :src="$base + list.file" width="100" height="100" />
              </td>
              <!-- <td v-html="list.identity_design_des"></td>
              <td v-html="list.content"></td> -->

              <td style="vertical-align: middle; width: 15%; color: white">
                <button
                  type="button"
                  id="edit"
                  class="btn btn-primary text-white"
                  @click="editList(list.id), topFunction()"
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
import Loading from "vue-loading-overlay";
export default {
  // name:"service-component",
  components: {
    // 'lottie': Lottie
    Loading,
  },
  data() {
    return {
      loader: false,
      lists: [],
      service_name: "",
      meta_keyword: "",
      file: "",
      description: "",
      isLoading: true,
      fullPage: true,
      loader: "bars",
      identity_design_des: "",
      identity_design_menus: "",
      project_count: "",
      happy_clients: "",
      content: "",
      service_capability_menu: "",
      service_deliver_title: "",
      service_deliver_description: "",
      service_title: "",
      service_nameError: "",
      descriptionError: "",
      fileError: "",
      descriptionError: "",
      identity_design_titleError: "",
      identity_design_desError: "",
      identity_design_menusError: "",
      project_countError: "",
      happy_clientsError: "",
      contentError: "",
      service_capability_menuError: "",
      service_deliver_titleError: "",
      service_deliver_descriptionError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      service_short_description: "",
      temp_thumbnail_url: "",
      slug: "",
      checked: false,
      agency_img_tmp: "",
      options: {
        minimizable: false,
        playerSize: "standard",
        backgroundColor: "#fff",
        backgroundStyle: "color",
        theme: {
          controlsView: "standard",
          active: "light",
          light: {
            color: "#3D4852",
            backgroundColor: "#fff",
            opacity: "0.7",
          },
          dark: {
            color: "#fff",
            backgroundColor: "#202020",
            opacity: "0.7",
          },
        },
      },
      // agency_img: [],
      // multi_img: "",
      // multiple_img:""
    };
  },
  // computed: {
  //   slug() {
  //     let data = this.service_name.replace(/\s+/g, "-").toLowerCase();
  //       return data.replace(/\//g, "-");
  //     }
  // },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.checked = false;
      this.service_name = "";
      this.description = "";
      this.file = "";
      (this.identity_design_title = ""), (this.service_short_description = "");
      this.agency_img_tmp = "";
      (this.identity_design_des = ""),
        (this.project_count = ""),
        (this.happy_clients = ""),
        (this.content = ""),
        (this.service_capability_menu = ""),
        (this.service_deliver_title = ""),
        (this.service_deliver_description = ""),
        (this.temp_thumbnail_url = "");
      this.meta_keyword = "";
      this.service_title = "";
      document.getElementById("thumbnail").value = "";
      $(".summernote").summernote("code", "");
    },
    get_slug() {
      console.log(this.checked);
      if (this.is_editing == true && this.checked == true) {
        this.slug = localStorage.getItem("slug_tmp");
      } else {
        this.slug = this.service_name.replace(/\s+/g, "-").toLowerCase();
        return this.slug.replace(/\//g, "-");
      }
    },
    fetchAll() {
      // console.log("fetch");
      this.loader = true;
      axios
        .get("/admin/service/get")
        .then((response) => {
          // this.isLoading = false;

          this.lists = response.data.data;
          console.log(this.lists);
          this.loader = false;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.file = e.target.files[0];
      this.temp_thumbnail_url = "";
    },

    save() {
      let url;
      this.loader = true;
      if (this.is_editing) {
        url = `/admin/service/update`;
      } else {
        url = `/admin/service/store`;
      }

      this.content = $(".summernote").summernote("code");
      // var menuList = {
      //   'identity_menu_list': this.identity_menus,
      //   'services_capabilities_menu_list':this.service_capability_menus
      // }
      let fd = new FormData();
      fd.append("service_name", this.service_name);
      fd.append("service_title", this.service_title);
      fd.append("description", this.description);
      fd.append("service_short_description", this.service_short_description);
      fd.append("file", this.file);

      fd.append("identity_design_des", this.identity_design_des);

      fd.append("project_count", this.project_count);
      fd.append("happy_clients", this.happy_clients);
      fd.append("slug", this.slug);
      fd.append("meta_keyword", this.meta_keyword);
      fd.append("content", this.content);
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
            this.loader = false;
            this.checked = false;
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.service_name = "";
            this.description = "";
            this.file = "";
            $(".summernote").summernote("code", "");
            (this.agency_img_tmp = ""((this.identity_design_title = ""))),
              (this.identity_design_des = ""),
              (this.project_count = ""),
              (this.happy_clients = ""),
              (this.content = ""),
              (this.service_capability_menu = ""),
              (this.service_deliver_title = ""),
              (this.service_deliver_description = ""),
              (this.service_short_description = ""(
                (this.temp_thumbnail_url = "")
              ));
            this.meta_keyword = "";

            this.is_editing = false;
          } else if (this.success == "updated") {
            this.is_editing = true;
            this.loader = false;
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Updated",
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
          console.log(error.response);
          if (error.response.data.errors.service_name) {
            console.log("here");
            console.log(error.response.data.errors.service_name);
            this.service_nameError = error.response.data.errors.service_name[0];
          } else {
            this.service_nameError = "";
          }
          if (error.response.data.errors.slug) {
            this.loader = false;
            alert("Slug already exists");
          }

          if (error.response.data.errors.title) {
            this.descriptionError = error.response.data.errors.title[0];
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
      this.loader = true;
      axios
        .get(`/admin/service/edit/${this.temporary_id}`)
        .then((response) => {
          this.loader = false;
          this.service_name = response.data.service_name;
          // this.file = response.data.file;
          this.service_name = response.data.service_name;
          this.description = response.data.description;
          this.service_short_description = response.data.short_description;

          this.identity_design_title = response.data.identity_design_title;

          this.content = response.data.content;
          this.identity_design_des = response.data.identity_design_des;
          this.identity_design_menus = response.data.identity_design_menus;
          this.slug = response.data.slug;

          this.project_count = response.data.project_count;
          this.happy_clients = response.data.happy_clients;
          this.service_title = response.data.service_title;
          this.services_capabilities_title =
            response.data.services_capabilities_title;
          this.services_capabilities_des =
            response.data.services_capabilities_des;
          this.service_capability_menu =
            response.data.services_capabilities_menu;
          $(".summernote").summernote("code", this.content);

          this.service_deliver_title = response.data.service_deliver_title;
          this.service_deliver_description = response.data.service_deliver_des;

          this.temp_thumbnail_url = response.data.file;
          this.meta_keyword = response.data.meta_keyword;

          localStorage.setItem("slug_tmp", this.slug);
          // this.get_slug = localStorage.getItem('slug_tmp')
          // console.log(this.get_slug)
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      this.loader = true;
      axios.get(`/admin/service/delete/${list_id}`).then((response) => {
        this.loader = false;
        this.fetchAll();
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        (this.is_editing = false((this.identity_design_title = ""))),
          (this.checked = false((this.identity_design_des = ""))),
          (this.identity_design_menus = ""),
          (this.project_count = ""),
          (this.happy_clients = ""),
          (this.services_capabilities_menus = ""),
          (this.service_deliver_title = ""),
          (this.service_deliver_description = ""),
          (this.temp_thumbnail_url = "");
        this.meta_keyword = "";

        this.service_short_description = "";
      });
    },
  },
  mounted() {
    // this.isLoading = true;
    this.fetchAll();
    this.get_slug();
  },
};
let mybutton = document.getElementById("edit");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<style scoped>
@import "../../../css/app.css";

div {
  letter-spacing: 1px;
  font-family: sans-serif;
}

/* .loader{
  justify-content: center;
  position: absolute;
  top: 40%;
  left: 30%;
} */

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

.table-striped > tbody > tr:nth-of-type(odd) > * {
  --bs-table-accent-bg: rgb(229 231 255);
  color: var(--bs-table-striped-color);
  border: none;
}
</style>
