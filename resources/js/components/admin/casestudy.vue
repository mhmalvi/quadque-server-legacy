<template>
  <div>
    <!-- v-if="loader" -->
    <lottie-vue-player
      v-if="loader"
      :src="`./9582-liquid-4-dot-loader.json`"
      style="top: 40%; position: sticky; background: transparent; z-index: 100"
      :theme="options.theme"
      :player-size="options.playerSize"
      :player-controls="true"
    >
    </lottie-vue-player>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Case Study</button>
      </div>
      <div class="mt-4">
        <div class="card" style="">
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
            <h4 style="margin: auto" class="card-title text-white text-center">
              {{ this.is_editing ? "Update Case Study" : "Create Case Study" }}
            </h4>
          </div>
          <div class="card-body">
            <!-- <div class="alert alert-success" v-if="this.success">
              {{ this.success }}
            </div> -->
            <form @submit.prevent="save">
              <div class="form-group">
                <label for="company_name">Create Case Study Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="company_name"
                  v-model="name"
                  required
                />
                <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Slug</label>
                <input
                  type="checkbox"
                  @click="get_slug"
                  v-model="checked"
                  class="ml-3"
                  placeholder="Enter slug"
                />
                <label style="color: blue"
                  >select to get based on case study name</label
                >
                <input
                  type="string"
                  v-model="slug"
                  value="title"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label for="company_image">Create Case Icon</label>
                <input
                  type="file"
                  class="form-control"
                  id="case_icon"
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img
                    :src="$base + this.temp_image_url"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <!-- <div class="form-group">
                <label for="company_name">Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  v-model="description"
                  required
                ></textarea>
              </div> -->
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
              <div class="form-group">
                <label for="group_img">Group Images</label>
                <input type="file" class="form-control" @change="group_img" />
                <p class="my-2 text-center" v-if="this.group_images_1_tmp">
                  <img
                    :src="$base + this.group_images_1_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="long_image">Desktop Image</label>
                <input type="file" class="form-control" @change="long_image" />
                <p class="my-2 text-center" v-if="this.long_banner_tmp">
                  <img
                    :src="$base + this.long_banner_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="short_image">Mobile Image</label>
                <input type="file" class="form-control" @change="short_image" />
                <p class="my-2 text-center" v-if="this.short_banner_tmp">
                  <img
                    :src="$base + this.short_banner_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Second Summary</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="summary1"
                  v-model="summary2"
                ></textarea>
              </div>
              <!-- <h4>Select service</h4>
              <div class="form-group" v-for="(service, index) in service_lists" :key="index">
                <input type="checkbox" :value="service.id" v-model="selected_services"> <label for="">{{ service.service_name }}</label>
              </div> -->
              <!-- <h1>Content</h1> -->
              <div class="form-group">
                <label for="company_name"
                  >Content
                  <span style="font-weight: 800"
                    ><a
                      target="_blank"
                      href="https://docs.google.com/document/d/1URIvTzR961eMYoU_T6gn5INLL1CQvApAlPvlqlWhjio/edit?usp=sharing"
                    >
                      (Please click on this link </a
                    >and create content in google docs and then copy and paste
                    in the editor)</span
                  ></label
                >
                <select class="summernote" v-model="content"></select>
                <!-- <textarea type="string" class="form-control summernote1" v-model="content" id="summernote">
                </textarea> -->
                <!-- <vue-editor v-model="content"></vue-editor> -->
              </div>
              <div class="form-group">
                <label for="company_name">Our Content Header</label>
                <input
                  type="string"
                  class="form-control"
                  id="company_name"
                  v-model="our_content_header"
                />
              </div>
              <div class="form-group">
                <label for="company_name">Testimonial</label>
                <input
                  type="string"
                  class="form-control"
                  id="company_name"
                  v-model="title_1"
                />
                <div class="text-danger" v-if="this.title_1_Error">
                  {{ this.title_1_Error }}
                </div>
              </div>
              <div class="form-group">
                <label for="upload_first_image"
                  >Our Content First Image(Only for mobile)</label
                >
                <input
                  type="file"
                  class="form-control"
                  @change="upload_first_image"
                />
                <p class="my-2 text-center" v-if="this.image_1_tmp">
                  <img
                    :src="$base + this.image_1_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Testimonial Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  v-model="description_1"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>

              <div class="form-group">
                <label for="company_name">Key Takeaways </label>
                <input
                  type="string"
                  class="form-control"
                  id="company_name"
                  v-model="title_2"
                />
              </div>
              <div class="form-group">
                <label for="upload_second_image"
                  >Our Content Second Image(Only for mobile)</label
                >
                <input
                  type="file"
                  class="form-control"
                  @change="upload_second_image"
                />
                <p class="my-2 text-center" v-if="this.image_2_tmp">
                  <img
                    :src="$base + this.image_2_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name">Key Takeaways Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  v-model="description_2"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
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
              <div class="form-group">
                <label for="company_name">What we have Learnt </label>
                <input
                  type="string"
                  class="form-control"
                  id="company_name"
                  v-model="title_3"
                />
              </div>
              <div class="form-group">
                <label for="upload_third_image"
                  >Our Content Third Image (Only for mobile)</label
                >
                <input
                  type="file"
                  class="form-control"
                  @change="upload_third_image"
                />
                <p class="my-2 text-center" v-if="this.image_3_tmp">
                  <img
                    :src="$base + this.image_3_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="company_name"
                  >What we have Learnt Description</label
                >
                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  v-model="description_3"
                ></textarea>
                <!-- <div class="text-danger" v-if="this.nameError">
                  {{ this.nameError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="thumbnail">Agency Files</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  @change="agencyFiles"
                />
                <p class="my-2 text-center" v-if="this.agency_img_tmp">
                  <img
                    :src="$base + this.agency_img_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="company_image">Agency Images</label>
                <input
                  type="file"
                  class="form-control"
                  id="company_image"
                  @change="upload_third_image"
                />
                <div class="text-danger" v-if="this.imageError">
                  {{ this.imageError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_image_url">
                  <img :src="this.temp_image_url" width="150" height="150" />
                </p>
              </div>
              <div>
                <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor> -->
                <button type="submit" class="btn btn-block btn-save text-white">
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
            <tr v-for="(list, index) in lists" :key="index">
              <td>{{ list.com_name }}</td>
              <!-- <td v-html="list.content"></td> -->
              <td v-if="list.com_image != ''">
                <img :src="$base + list.com_image" width="100" height="100" />
              </td>
              <td v-else>
                <p>No image</p>
              </td>
              <td v-if="list.agency != ''">
                <img
                  width="150"
                  height="150"
                  :src="$base + list.agency"
                  alt=""
                />
              </td>
              <td v-else>
                <p>No image</p>
              </td>
              <td>
                <button
                  type="button"
                  class="btn btn-primary text-white"
                  @click="editList(list.id)"
                >
                  Edit
                </button>
                <!-- <button
                  type="button"
                  class="btn btn-primary text-white"
                  @click="editList(list.id)"
                >
                  view content
                </button> -->
                <button
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

export default {
  // computed: {
  //   slug() {
  //     let data = this.name.replace(/\s+/g, "-").toLowerCase();
  //     let datas = data.replace(/\s+/g, "-")
  //     return datas.replace(/\?+/g, " ")
  //   },
  // },
  data() {
    return {
      loader: false,
      agency: "",
      lists: [],
      service_lists: [],
      meta_keyword: "",
      name: "",
      slug: "",
      checked: false,
      agency_images: [],
      image: "",
      summary1: "",
      summary2: "",
      group_images: "",
      long_banner: "",
      short_banner_img: "",
      content: "",
      our_content_header: "",
      title_1: "",
      image_1: "",
      description_1: "",
      title_2: "",
      image_2: "",
      description_2: "",
      title_3: "",
      image_3: "",
      description_3: "",
      group_images_1_tmp: "",
      image_1_tmp: "",
      image_2_tmp: "",
      image_3_tmp: "",
      long_banner_tmp: "",
      short_banner_tmp: "",
      nameError: "",
      imageError: "",
      description: "",
      descriptionError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_image_url: "",
      title_1_Error: "",
      // loading: false,
      // return { value: '' }
      // value:''
      background: "#fff",
      opacity: 0.5,
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
    };
  },
  components: {
    VueUploadMultipleImage,
    // VueEditor
    // Loading,
  },
  methods: {
    // addField(value, fieldType) {
    //   fieldType.push({ value: "" });
    // },
    // removeField(index, fieldType) {
    //   fieldType.splice(index, 1);
    // },
    agencyFiles(e) {
      this.agency = e.target.files[0];
      // console.log(this.agency)
    },
    group_img(e) {
      this.group_images = e.target.files[0];
      this.group_images_1_tmp = "";
    },
    upload_first_image(e) {
      this.image_1 = e.target.files[0];
      this.image_1_tmp = "";
    },
    upload_second_image(e) {
      this.image_2 = e.target.files[0];
      this.image_2_tmp = "";
    },
    upload_third_image(e) {
      this.image_3 = e.target.files[0];
      this.image_3_tmp = "";
    },
    long_image(e) {
      this.long_banner = e.target.files[0];
      this.long_banner_tmp = "";
    },
    short_image(e) {
      this.short_banner_img = e.target.files[0];
      this.short_banner_tmp = "";
    },
    get_slug() {
      console.log(this.checked);
      if (this.is_editing == true && this.checked == true) {
        this.slug = localStorage.getItem("case_study_slug");
      } else {
        this.slug = this.name.replace(/\s+/g, "-").toLowerCase();
        return this.slug.replace(/\//g, "-");
      }
    },
    disable_button() {
      $(".summernote").summernote("code", "");
      this.is_editing = false;
      this.checked = false;
      this.name = "";
      this.image = "";
      this.summary1 = "";
      this.summary2 = "";
      this.long_banner = "";
      this.short_banner_img = "";
      this.slug = "";
      this.content = "";
      (this.our_content_header = ""),
        (this.title_1 = ""),
        (this.image_1 = ""),
        (this.description_1 = ""),
        (this.title_2 = ""),
        (this.image_2 = ""),
        (this.description_2 = ""),
        (this.title_3 = ""),
        (this.image_3 = ""),
        (this.description_3 = ""),
        (this.temp_image_url = "");
      (this.image_1_tmp = ""),
        (this.image_2_tmp = ""),
        (this.image_3_tmp = ""),
        (this.group_images = "");
      this.group_images_1_tmp = "";
      this.long_banner_tmp = "";
      this.short_banner_tmp = "";
      this.meta_keyword = "";
      this.agency_img_tmp = "";
      document.getElementById("image").value = "";
      document.getElementById("group_images").value = "";
      // $(".summernote").summernote("code", "");
    },
    fetchAll() {
      this.loader = true;
      axios
        .get("/admin/case-study/get")
        .then((response) => {
          this.loader = false;
          this.lists = response.data;
          console.log(this.lists);
        })
        .catch((error) => {});
    },
    fetchAllServices() {
      // console.log("fetch");
      axios
        .get("/admin/service/get")
        .then((response) => {
          this.service_lists = response.data;
          console.log(this.service_lists);
        })
        .catch((error) => {});
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

    save: function (event) {
      // this.uploadImageSuccess()
      // console.log("data", formData, index, fileList);
      this.loader = true;
      let url;
      this.isLoading = true;
      if (this.is_editing) {
        url = `/admin/case-study/update`;
      } else {
        url = `/admin/case-study/store`;
      }
      this.content = $(".summernote").summernote("code");
      let fd = new FormData();
      fd.append("name", this.name);
      fd.append("summary1", this.summary1);
      fd.append("summary2", this.summary2);
      fd.append("slug", this.slug);
      // fd.append("description", this.description);
      fd.append("content", this.content);
      fd.append("agency", this.agency);
      fd.append("meta_keyword", this.meta_keyword);
      fd.append("group_images", this.group_images);
      fd.append("long_banner", this.long_banner);
      fd.append("short_banner", this.short_banner_img);
      fd.append("our_content_header", this.our_content_header);
      fd.append("title_1", this.title_1);
      fd.append("image_1", this.image_1);
      fd.append("description_1", this.description_1);
      fd.append("title_2", this.title_2);
      fd.append("image_2", this.image_2);
      fd.append("description_2", this.description_2);
      fd.append("title_3", this.title_3);
      fd.append("image_3", this.image_3);
      fd.append("description_3", this.description_3);
      fd.append("image", this.image);
      fd.append("id", this.temporary_id);
      console.log(fd);
      axios
        .post(url, fd)
        .then((response) => {
          this.fetchAll();
          this.loader = false;

          // this.success = response.data.success;
          $(".summernote").summernote("code", this.content);
          this.name = "";
          this.image = "";
          this.summary1 = "";
          this.summary2 = "";
          this.content = "";
          this.group_images = "";
          (this.long_banner = ""),
            (this.short_banner_img = ""),
            (this.our_content_header = ""),
            (this.title_1 = ""),
            (this.image_1 = ""),
            (this.description_1 = ""),
            (this.title_2 = ""),
            (this.image_2 = ""),
            (this.description_2 = ""),
            (this.title_3 = ""),
            (this.image_3 = ""),
            (this.description_3 = ""),
            (this.temp_image_url = "");
          this.meta_keyword = "";
          // document.getElementById("thumbnail").value = "";
          if (response.data.success == "created") {
            this.checked = false;
            this.is_editing = false;
            this.name = "";
            this.image = "";
            this.summary1 = "";
            this.summary2 = "";
            this.content = "";
            this.group_images = "";
            (this.long_banner = ""),
              (this.short_banner_img = ""),
              (this.our_content_header = ""),
              (this.title_1 = ""),
              (this.image_1 = ""),
              (this.description_1 = ""),
              (this.title_2 = ""),
              (this.image_2 = ""),
              (this.description_2 = ""),
              (this.title_3 = ""),
              (this.image_3 = ""),
              (this.description_3 = ""),
              (this.temp_image_url = "");
            this.meta_keyword = "";
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Case Study Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            // document.getElementById("image").value = "";
            // document.getElementById("group_images").value = "";
            $(".summernote").summernote("code", "");
            this.temp_image_url = "";
            this.temporary_id = "";
            event.target.reset();

            this.isLoading = false;
          } else if (response.data.success == "updated") {
            this.is_editing = true;
            this.isLoading = false;

            // this.isLoading = false;
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Case Study Updated",
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
            alert(error.response.data.errors.name[0]);
            // this.nameError = error.response.data.errors.name[0];
          } else {
            this.nameError = "";
          }
          if (error.response.data.errors.slug) {
            this.loader = false;
            alert("Slug already exists");
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
      this.loader = true;
      axios
        .get(`/admin/case-study/edit/${this.temporary_id}`)
        .then((response) => {
          this.loader = false;
          console.log(response);
          this.name = response.data.com_name;
          this.temp_image_url = response.data.com_image;
          this.summary1 = response.data.summary1;
          this.summary2 = response.data.summary2;
          this.content = response.data.content;
          this.slug = response.data.slug;
          // this.description = response.data.description;
          this.our_content_header = response.data.our_content_header;
          this.title_1 = response.data.title_1;
          this.title_2 = response.data.title_2;
          this.title_3 = response.data.title_3;
          this.description_1 = response.data.description_1;
          this.description_2 = response.data.description_2;
          this.description_3 = response.data.description_3;
          this.meta_keyword = response.data.meta_keyword;
          this.long_banner_tmp = response.data.long_banner;
          this.short_banner_tmp = response.data.short_banner;
          this.image_1_tmp = response.data.image_1;
          console.log(this.image_1_tmp);
          this.image_2_tmp = response.data.image_2;
          this.image_3_tmp = response.data.image_3;
          this.agency_img_tmp = response.data.agency;
          localStorage.setItem("case_study_slug", this.slug);
          $(".summernote").summernote("code", this.content);
          // $(".summernote").summernote("code", this.second_content);
          this.group_images_1_tmp = response.data.group_images;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      this.loader = true;
      axios.get(`/admin/case-study/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
        this.loader = false;
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        this.name = "";
        this.image = "";
        this.summary1 = "";
        this.summary2 = "";
        this.content = "";
        this.group_images = "";
        this.con_2_img_1 = "";
        this.con_2_img_2 = "";
        this.con_2_img_3 = "";
        this.agency_img_tmp = "";
        this.meta_keyword = "";
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
    this.fetchAllServices();
  },
};
</script>
<style scoped>
/* div lottie-player #animation-container #animation .error {
  display: none !important;
  margin-left: -40%;
} */
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
