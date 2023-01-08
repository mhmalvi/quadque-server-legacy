<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div v-if="this.is_editing == true" @click="disable_button()" class="mt-3">
        <button class="btn btn-primary">Create Case Study</button>
      </div>
      <div class="col-md-12 mt-4">
        <div class="card">
          <div class="card-header" style="
              height: 47px;
              background-image: linear-gradient(
                to right,
                rgb(242, 112, 156),
                rgb(255, 148, 114)
              );
            ">
            <h4 style="margin-top: 1%" class="card-title text-white text-center">
              {{ this.is_editing ? "Update Case Study for Desktop View" : "Create Case Study  for Desktop View" }}
            </h4>
          </div>
          <div class="card-body">
            <!-- <div class="alert alert-success" v-if="this.success">
              {{ this.success }}
            </div> -->
            <form @submit.prevent="save">
              <div class="form-group">
                <label for="company_name">Create Case Study Name</label>
                <input type="text" class="form-control" id="company_name" v-model="name" />
                <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div>
              </div>

              <div class="form-group">
                <label for="company_image">Create Case Icon</label>
                <input type="file" class="form-control" id="company_image" @change="uploadfile" />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">First Summary</label>
                <textarea type="text" class="form-control" id="summary1" v-model="summary1"></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="company_image">Group Images</label>
                <input type="file" class="form-control" id="company_image" @change="group_img_1" />
                <p class="my-2 text-center" v-if="this.group_images_1_tmp">
                  <img :src="this.group_images_1_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_2" />
                <p class="my-2 text-center" v-if="this.group_images_2_tmp">
                  <img :src="this.group_images_2_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_3" />
                <p class="my-2 text-center" v-if="this.group_images_3_tmp">
                  <img :src="this.group_images_3_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_4" />
                <p class="my-2 text-center" v-if="this.group_images_4_tmp">
                  <img :src="this.group_images_4_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_5" />
                <p class="my-2 text-center" v-if="this.group_images_5_tmp">
                  <img :src="this.group_images_5_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_6" />
                <p class="my-2 text-center" v-if="this.group_images_6_tmp">
                  <img :src="this.group_images_6_tmp" width="150" height="150" />
                </p>
                <input type="file" class="form-control" id="company_image" @change="group_img_7" />
                <p class="my-2 text-center" v-if="this.group_images_7_tmp">
                  <img :src="this.group_images_7_tmp" width="150" height="150" />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Second Summary</label>
                <textarea type="text" class="form-control" id="summary1" v-model="summary2"></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <!-- <h4>Select service</h4>
              <div class="form-group" v-for="(service, index) in service_lists" :key="index">
                <input type="checkbox" :value="service.id" v-model="selected_services"> <label for="">{{ service.service_name }}</label>
              </div> -->
              <!-- <h1>Content</h1> -->
              <div class="form-group">
                <label for="company_name">Content</label>
                <select class="summernote" v-model="content"></select>
                <!-- <textarea type="string" class="form-control summernote1" v-model="content" id="summernote">
                </textarea> -->
                <!-- <vue-editor v-model="content"></vue-editor> -->
              </div>



              <div class="form-group" id="my-strictly-unique-vue-upload-multiple-image">
                <label for="company_image">Agency Multi Images</label>
                <input type="file" class="form-control" id="company_image" @change="agency" multiple />
                <!-- <vue-upload-multiple-image
                  @upload-success="save"
                  @before-remove="beforeRemove"
                  @edit-image="editImage"
                  :data-images="images"
                  dragText=""
                  primaryText=""
                  browseText="Select Image"
                ></vue-upload-multiple-image> -->
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div>
              <div>
                <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor> -->
                <button type="submit" class="btn btn-block btn-save text-white" >
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
              <th>Company Description</th>
              <th>Company Icon</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="list in lists" :key="list.id">
              <td>{{ list.com_name }}</td>
              <td v-html="list.content"></td>
              <td>
                <img :src="list.com_image" width="100" height="100" />
              </td>
              <td>
                <button type="button" class="btn btn-primary text-white" @click="editList(list.id)">
                  Edit</button><button type="button" class="btn btn-danger ml-1" @click="destroyList(list.id)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="4">
                <h3 class="text-center">No Case Study</h3>
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
import VueUploadMultipleImage from "vue-upload-multiple-image";
// import { VueEditor } from "vue2-editor";
// import Loading from "vue-loading-overlay";

export default {
  
  data() {
    return {
      isLoading: false,
      fullPage: true,
      loader: "bars",
      lists: [],
      service_lists: [],
      selected_services:[],
      name: "",
      agency_images: [],
      image: "",
      summary1: "",
      summary2: "",
      group_images_1: "",
      group_images_2: "",
      group_images_3: "",
      group_images_4: "",
      group_images_5: "",
      group_images_6: "",
      group_images_7: "",
      content: "",
      group_images_1_tmp: "",
      group_images_2_tmp: "",
      group_images_3_tmp: "",
      group_images_4_tmp: "",
      group_images_5_tmp: "",
      group_images_6_tmp: "",
      group_images_7_tmp: "",
      nameError: "",
      imageError: "",
      description: "",
      descriptionError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_image_url: "",
      // loading: false,
      // return { value: '' }
      // value:''
      background: "#fff",
      opacity: 0.5,
    };
  },
  components: {
    VueUploadMultipleImage,
    // VueEditor
    // Loading,
  },
  methods: {

    addField(value, fieldType) {
      fieldType.push({ value: "" });
    },
    removeField(index, fieldType) {
      fieldType.splice(index, 1);
    },
    group_img_1(e) {
      this.group_images_1 = e.target.files[0];
      this.group_images_1_tmp=""
    },
    group_img_2(e) {
      this.group_images_2 = e.target.files[0];
      this.group_images_2_tmp=""
    },
    group_img_3(e) {
      this.group_images_3 = e.target.files[0];
      this.group_images_3_tmp=""
    },
    group_img_4(e) {
      this.group_images_4 = e.target.files[0];
      this.group_images_4_tmp=""
    },
    group_img_5(e) {
      this.group_images_5 = e.target.files[0];
      this.group_images_5_tmp=""
    },
    group_img_6(e) {
      this.group_images_6 = e.target.files[0];
      this.group_images_6_tmp=""
    },
    group_img_7(e) {
      this.group_images_7 = e.target.files[0];
      this.group_images_7_tmp=""
    },
      disable_button() {
        $(".summernote").summernote("code", "");
      this.is_editing = false;
      this.name = "";
      this.image = "";
      this.summary1 = "";
      this.summary2 = "";
      this.content = "";

      this.temp_image_url = "";

      this.group_images_1 = "";
      this.group_images_2 = "";
      this.group_images_3 = "";
      this.group_images_4 = "";
      this.group_images_5 = "";
      this.group_images_6 = "";
      this.group_images_7 = "";
      this.group_images_1_tmp = "";
      this.group_images_2_tmp = "";
      this.group_images_3_tmp = "";
      this.group_images_4_tmp = "";
      this.group_images_5_tmp = "";
      this.group_images_6_tmp = "";
      this.group_images_7_tmp = "";
      document.getElementById("image").value = "";
      document.getElementById("group_images_1").value = "";
      document.getElementById("group_images_2").value = "";
      document.getElementById("group_images_3").value = "";
      document.getElementById("group_images_4").value = "";
      document.getElementById("group_images_5").value = "";
      document.getElementById("group_images_6").value = "";
      document.getElementById("group_images_7").value = "";
      
    },
    fetchAll() {
      axios
        .get("/admin/case-study-desktop/get")
        .then((response) => {
          this.lists = response.data;
          console.log(this.lists);
        })
        .catch((error) => { });
    },
    fetchAllServices() {
      // console.log("fetch");
      axios
        .get("/admin/service/get")
        .then((response) => {

          this.service_lists = response.data;
          console.log(this.service_lists);
        })
        .catch((error) => { });
    },
    uploadfile(e) {
      this.image = e.target.files[0];
      this.temp_image_url = "";
    },
    
    // group_images() {
    //   this.gr_images = this.$refs.group_images.files[0];
    // },
    agency(e) {
      this.agency_images = e.target.files;
      console.log(this.agency_images);
    },

    save:function(event) {
      // this.uploadImageSuccess()
      // console.log("data", formData, index, fileList);
      let url;
      this.isLoading = true;
      if (this.is_editing) {
        url = `/admin/case-study-desktop/update/`;
      } else {
        url = `/admin/case-study-desktop/store`;
      }
      this.content = $(".summernote").summernote("code");
      let fd = new FormData();
      fd.append("name", this.name);
      fd.append("summary1", this.summary1);
      fd.append("summary2", this.summary2);
      for (let i = 0; i < this.agency_images.length; i++) {
        fd.append("agency_images[]", this.agency_images[i]);
      }
      for (let j = 0; j < this.selected_services.length; j++) {
        fd.append("selected_services[]", this.selected_services[j]);
      }
      // fd.append("group_images", this.gr_images);
      fd.append("content", this.content);
      fd.append("group_images_1", this.group_images_1);
      fd.append("group_images_2", this.group_images_2);
      fd.append("group_images_3", this.group_images_3);
      fd.append("group_images_4", this.group_images_4);
      fd.append("group_images_5", this.group_images_5);
      fd.append("group_images_6", this.group_images_6);
      fd.append("group_images_7", this.group_images_7);

      fd.append("image", this.image);
      fd.append("id", this.temporary_id);
      console.log(fd);
      axios
        .post(url, fd)
        .then((response) => {
          this.fetchAll();
          this.isLoading = false;
          // this.success = response.data.success;
          $(".summernote").summernote("code", this.content);
          // document.getElementById("thumbnail").value = "";
          if (response.data.success == "created") {
            this.is_editing = false;
            this.name = "";
            this.image = "";
            this.summary1 = "";
            this.summary2 = "";
            this.content = "";
            this.group_images_1 = "";
            this.group_images_2 = "";
            this.group_images_3 = "";
            this.group_images_4 = "";
            this.group_images_5 = "";
            this.group_images_6 = "";
            this.group_images_7 = "";
            this.group_images_1_tmp = "";
            this.group_images_2_tmp = "";
            this.group_images_3_tmp = "";
            this.group_images_4_tmp = "";
            this.group_images_5_tmp = "";
            this.group_images_6_tmp = "";
            this.group_images_7_tmp = "";
            

            $(".summernote").summernote("code", "");
            this.temp_image_url = "";
            this.temporary_id = "";
            event.target.reset()
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            document.getElementById("image").value = "";
            this.isLoading = false;
          } else if (response.data.success == "updated") {
            this.is_editing = true;
            this.isLoading = false;
            // this.isLoading = false;
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Service Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }
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
        .get(`/admin/case-study-desktop/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.name = response.data.com_name;
          this.temp_image_url = response.data.com_image;
          this.summary1 = response.data.summary1;
          this.summary2 = response.data.summary2;
          this.content = response.data.content;
          $(".summernote").summernote("code", this.content);
          // $(".summernote").summernote("code", this.second_content);
          this.group_images_1_tmp = response.data.group_images_1;
          this.group_images_2_tmp = response.data.group_images_2;
          this.group_images_3_tmp = response.data.group_images_3;
          this.group_images_4_tmp = response.data.group_images_4;
          this.group_images_5_tmp = response.data.group_images_5;
          this.group_images_6_tmp = response.data.group_images_6;
          this.group_images_7_tmp = response.data.group_images_7;
        })
        .catch((error) => { });
    },
    destroyList(list_id) {
      axios.get(`/admin/case-study-desktop/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        this.name = "";
            this.image = "";
            this.summary1 = "";
            this.summary2 = "";
            this.content = "";
            this.group_images_1 = "";
            this.group_images_2 = "";
            this.group_images_3 = "";
            this.group_images_4 = "";
            this.group_images_5 = "";
            this.group_images_6 = "";
            this.group_images_7 = "";
            this.group_images_1_tmp = "";
            this.group_images_2_tmp = "";
            this.group_images_3_tmp = "";
            this.group_images_4_tmp = "";
            this.group_images_5_tmp = "";
            this.group_images_6_tmp = "";
            this.group_images_7_tmp = "";
        document.getElementById("image").value = "";
        document.getElementById("case_con_1_img").value = "";
        document.getElementById("con_2_img_1").value = "";
        document.getElementById("con_2_img_2").value = "";
        document.getElementById("con_2_img_3").value = "";
        this.temp_image_url = "";
        this.temporary_id = "";
      });
    },
  },
  mounted() {
    this.fetchAll();
    this.fetchAllServices()
  },
};
</script>
<style scoped>
/* @import "../../../css/summernote.css"; */
#my-strictly-unique-vue-upload-multiple-image {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

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
  background-image: linear-gradient(to right,
      rgb(242, 112, 156),
      rgb(255, 148, 114));
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

.table-striped>tbody>tr:nth-of-type(odd)>* {
  --bs-table-accent-bg: rgb(229 231 255);
  color: var(--bs-table-striped-color);
  border: none;
}

.note-editor.note-airframe .note-editing-area .note-editable,
.note-editor.note-frame .note-editing-area .note-editable {
  padding: 10px;
  overflow: auto;
  word-wrap: break-word;
  background: aliceblue;
}

#summernote {
  background: aliceblue;
}
</style>
