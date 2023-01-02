<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Case Study</button>
      </div>
      <div class="col-md-6 mt-4">
        <div class="card">
          <div
            class="card-header"
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
              style="margin-top: 1%"
              class="card-title text-white text-center"
            >
              {{ this.is_editing ? "Update Case Study" : "Create Case Study" }}
            </h4>
          </div>
          <div class="card-body">
            <!-- <div class="alert alert-success" v-if="this.success">
              {{ this.success }}
            </div> -->
            <form>
              <div class="form-group">
                <label for="company_name">Company Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="company_name"
                  v-model="name"
                />
                <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div>
              </div>

              <div class="form-group">
                <label for="company_image">Company Icon</label>
                <input
                  type="file"
                  class="form-control"
                  id="company_image"
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">First Summary</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="summary1"
                  v-model="summary1"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <!-- <div class="form-group">
                <label for="company_image">Group Images</label>
                <input
                  type="file"
                  class="form-control"
                  ref="group_images"
                  id="company_image"
                  multiple
                  @change="group_images"
                />
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div> -->
              <div class="form-group">
                <label for="company_name">Second Summary</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="summary1"
                  v-model="summary2"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <h1>First Content</h1>
              <div class="form-group">
                <!-- <label for="company_name">First Title</label> -->
                <textarea
                  v-model="first_content"
                  id="summernote"
                  cols="30"
                  rows="10"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="company_image">First Content Image</label>
                <input
                  type="file"
                  class="form-control"
                  id="company_image"
                  @change="first_content_image"
                />
                <!-- <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div> -->
                <p class="my-2 text-center" v-if="this.case_con_1_img_tmp">
                  <img
                    :src="this.case_con_1_img_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <h1>Second Content</h1>
              <div class="form-group">
                <label for="company_name">First Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="company_name"
                  v-model="case_con_2_title_1"
                />
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_image">First Image</label>
                <input
                  type="file"
                  class="form-control"
                  id="company_image"
                  @change="case_con_2_img_1"
                />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
                <p class="my-2 text-center" v-if="this.con_2_img_1_tmp">
                  <img :src="this.con_2_img_1_tmp" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">First Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="case_con_1_des_1"
                  v-model="case_con_2_des_1"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_name">Second Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="case_con_1_title_2"
                  v-model="case_con_2_title_2"
                />
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_image">Second Image</label>
                <input
                  type="file"
                  class="form-control"
                  ref="case_con_2_img_2"
                  id="company_image"
                  @change="case_con_2_img_2"
                />
                <!-- <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div> -->
                <p class="my-2 text-center" v-if="this.con_2_img_2_tmp">
                  <img :src="this.con_2_img_2_tmp" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Second Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="case_con_1_des_2"
                  v-model="case_con_2_des_2"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_name">Third Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="case_con_1_title_3"
                  v-model="case_con_2_title_3"
                />
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_image">Third Image</label>
                <input
                  type="file"
                  class="form-control"
                  ref="case_con_2_img_3"
                  id="company_image"
                  @change="case_con_2_img_3"
                />
                <!-- <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div> -->
                <p class="my-2 text-center" v-if="this.con_2_img_3_tmp">
                  <img :src="this.con_2_img_3_tmp" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Third Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="case_con_1_des_3"
                  v-model="case_con_2_des_3"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <!-- <div class="form-group">
                <label for="company_image">Agency Multi Images</label>
                <input
                  type="file"
                  class="form-control"
                  ref="agency"
                  id="company_image"
                  @change="agency"
                  multiple
                />
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div> -->
              <div>
                <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor> -->
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
      <div class="col-md-8">
        <h4>Case Study Lists</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Company Name</th>
              <!-- <th>Company Description</th> -->
              <th>Company Icon</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="list in lists" :key="list.id">
              <td>{{ list.com_name }}</td>
              <!-- <td v-html="list.description"></td> -->
              <td>
                <img :src="list.com_image" width="100" height="100" />
              </td>
              <td>
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
              <td colspan="3"><h3 class="text-center">No Case Study</h3></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
// import { VueEditor } from "vue2-editor";
// import { VueEditor } from "vue2-editor/dist/vue2-editor.core.js";
export default {
  data() {
    return {
      lists: [],
      name: "",
      image: "",
      summary1: "",
      summary2: "",
      first_content: "",
      case_con_1_img: "",
      case_con_1_img_tmp: "",
      case_con_2_title_1: "",
      case_con_2_des_1: "",
      case_con_2_title_2: "",
      case_con_2_des_2: "",
      case_con_2_title_3: "",
      case_con_2_des_3: "",
      con_2_img_1: "",
      con_2_img_2: "",
      con_2_img_3: "",
      con_2_img_1_tmp: "",
      con_2_img_2_tmp: "",
      con_2_img_3_tmp: "",
      nameError: "",
      imageError: "",
      description: "",
      descriptionError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_image_url: "",
      // return { value: '' }
      // value:''
    };
  },
  components: {
    // Use the <ckeditor> component in this view.
    // ckeditor: CKEditor.component
    // VueEditor,
  },
  methods: {
    // onEditorBlur(quill) {
    //   console.log("editor blur!", quill);
    // },

    // onEditorFocus(quill) {
    //   console.log("editor focus!", quill);
    // },

    // onSelectionChange(range) {
    //   console.log("selection change!", range);
    // },
    disable_button() {
      this.is_editing = false;
      this.name = "";
      this.image = "";
      this.summary1 = "";
      this.summary2 = "";
      this.first_content = "";
      this.case_con_1_img = "";
      this.case_con_2_title_1 = "";
      this.case_con_2_des_1 = "";
      this.case_con_2_title_2 = "";
      this.case_con_2_des_2 = "";
      this.case_con_2_title_3 = "";
      this.case_con_2_des_3 = "";
      this.con_2_img_1 = "";
      this.con_2_img_2 = "";
      this.con_2_img_1_tmp = "";
      this.con_2_img_2_tmp = "";
      (this.con_2_img_3_tmp = ""), (this.temp_image_url = "");
      this.con_2_img_3 = "";
      $("#summernote").summernote("code", "");
    },
    fetchAll() {
      axios
        .get("/admin/case-study/get")
        .then((response) => {
          this.lists = response.data;
          console.log(this.lists);
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.image = e.target.files[0];
      this.temp_image_url = "";
    },
    first_content_image(e) {
      this.case_con_1_img = e.target.files[0];
    },
    case_con_2_img_1(e) {
      this.con_2_img_1 = e.target.files[0];
    },
    case_con_2_img_2(e) {
      this.con_2_img_2 = e.target.files[0];
    },
    case_con_2_img_3(e) {
      this.con_2_img_3 = e.target.files[0];
    },
    group_images() {
      this.gr_images = this.$refs.group_images.files[0];
    },
    agency() {
      this.agency = this.$refs.agency.files[0];
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/case-study/update/`;
      } else {
        url = `/admin/case-study/store`;
      }
      this.first_content = $("#summernote").summernote("code");
      let fd = new FormData();
      fd.append("name", this.name);
      fd.append("summary1", this.summary1);
      fd.append("summary2", this.summary2);
      // fd.append("group_images", this.gr_images);
      fd.append("first_content", this.first_content);
      fd.append("img1", this.case_con_1_img);
      fd.append("case_con_2_title_1", this.case_con_2_title_1);
      fd.append("case_con_2_des_1", this.case_con_2_des_1);
      fd.append("case_con_2_title_2", this.case_con_2_title_2);
      fd.append("case_con_2_des_2", this.case_con_2_des_2);
      fd.append("case_con_2_title_3", this.case_con_2_title_3);
      fd.append("case_con_2_des_3", this.case_con_2_des_3);
      fd.append("con_2_img_1", this.con_2_img_1);
      fd.append("con_2_img_2", this.con_2_img_2);
      fd.append("con_2_img_3", this.con_2_img_3);
      fd.append("image", this.image);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          // this.success = response.data.success;
          $("#summernote").summernote("code", this.first_content);
          // document.getElementById("thumbnail").value = "";
          if (response.data.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.name = "";
            this.image = "";
            this.summary1 = "";
            this.summary2 = "";
            this.first_content = "";
            this.case_con_1_img = "";
            this.case_con_2_title_1 = "";
            this.case_con_2_des_1 = "";
            this.case_con_2_title_2 = "";
            this.case_con_2_des_2 = "";
            this.case_con_2_title_3 = "";
            this.case_con_2_des_3 = "";
            this.con_2_img_1 = "";
            this.con_2_img_2 = "";
            this.con_2_img_3 = "";
            document.getElementById("image").value = "";
            document.getElementById("case_con_1_img").value = "";
            document.getElementById("con_2_img_1").value = "";
            document.getElementById("con_2_img_2").value = "";
            document.getElementById("con_2_img_3").value = "";
            this.temp_image_url = "";
            this.temporary_id = "";
          } else if (response.data.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }

          this.is_editing = false;
          this.fetchAll();
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

          if (error.response.data.errors.image) {
            this.imageError = error.response.data.errors.image[0];
          } else {
            this.imageError = "";
          }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.nameError = "";
      this.imageError = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/case-study/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.name = response.data.com_name;
          this.temp_image_url = response.data.com_image;
          this.summary1 = response.data.summary1;
          this.summary2 = response.data.summary2;
          this.first_content = response.data.first_content;
          $("#summernote").summernote("code", this.first_content);
          this.case_con_2_title_1 = response.data.case_con_2_title_1;
          this.case_con_2_des_1 = response.data.case_con_2_des_1;
          this.case_con_2_title_2 = response.data.case_con_2_title_2;
          this.case_con_2_des_2 = response.data.case_con_2_des_2;
          this.case_con_2_title_3 = response.data.case_con_2_title_3;
          this.case_con_2_des_3 = response.data.case_con_2_des_3;
          this.con_2_img_1_tmp = response.data.case_con_2_img_1;
          this.con_2_img_2_tmp = response.data.case_con_2_img_2;
          this.con_2_img_3_tmp = response.data.case_con_2_img_3;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/case-study/delete/${list_id}`).then((response) => {
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
.card {
  border-top: none;
}
.card-header {
  border: none;
  background-image: linear-gradient(
    to right,
    rgb(242, 112, 156),
    rgb(255, 148, 114)
  );
}
table tbody tr {
  line-height: 100px;
  text-align: center;
}
thead th {
  text-align: center;
}
thead {
  /* background: #84a4ff; */
  background-image: linear-gradient(to right, #0093e9, #80d0c7);
  color: white;
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
