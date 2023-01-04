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
              <h1>Identity Design</h1>
              <div class="form-group">
                <label for="title">Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_title"
                  placeholder="Enter service name"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Description</label><br />
                <textarea
                  v-model="identity_design_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Menus</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_1"
                  placeholder="Enter menus"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_2"
                  placeholder="Enter menus"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_3"
                  placeholder="Enter menus"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_4"
                  placeholder="Enter menus"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_5"
                  placeholder="Enter menus"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="identity_design_menus_6"
                  placeholder="Enter menus"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Project Count</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="project_count"
                  placeholder="Enter project count"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Happy Clients Count</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="happy_clients"
                  placeholder="Enter count"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Best Service title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="best_service_title"
                  placeholder="Enter title"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Best Service Header</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="best_service_header"
                  placeholder="Enter header"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Best Service image</label>
                <input
                  type="file"
                  class="form-control"
                  @change="image_best_service"
                />
                <p class="my-2 text-center" v-if="this.best_service_img_tmp">
                  <img
                    :src="this.best_service_img_tmp"
                    width="150"
                    height="150"
                  />
                </p>
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Best Service description</label><br />
                <textarea
                  v-model="best_service_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <h1>Why Choose Us</h1>
              <div class="form-group">
                <label for="title">Why choose us title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="why_choose_us_title"
                  placeholder="why choose us"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Why choose us image</label>
                <input
                  type="file"
                  class="form-control"
                  @change="image_why_choose_us"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
                <p class="my-2 text-center" v-if="this.why_choose_us_img_tmp">
                  <img
                    :src="this.why_choose_us_img_tmp"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group">
                <label for="title">Why choose us description</label><br />
                <textarea
                  v-model="why_choose_us_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <h1>Services Capabilities</h1>
              <div class="form-group">
                <label for="title">Services Capabilities Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_title"
                  placeholder="Title"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Services Capabilities Description</label
                ><br />
                <textarea
                  v-model="services_capabilities_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Services Capabilities Menu</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_1"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_2"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_3"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_4"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_5"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_6"
                  placeholder="Enter menu name"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="services_capabilities_menus_7"
                  placeholder="Enter menu name"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <h1>Services Deliver</h1>
              <div class="form-group">
                <label for="title">Services Deliver Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="service_deliver_title"
                  placeholder="Title"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Services Deliver Description</label><br />
                <textarea
                  v-model="service_deliver_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <h1>Our lates Work</h1>
              <div class="form-group">
                <label for="title">Our latest work title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="our_latest_work_title"
                  placeholder="Title"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Our latest work images</label><br />
                <input
                  type="file"
                  class="form-control"
                  placeholder="why choose us"
                  @change="image_our_work"
                />
                <p class="my-2 text-center" v-if="this.our_latest_work_img_tmp">
                  <img
                    :src="this.our_latest_work_img_tmp"
                    width="150"
                    height="150"
                  />
                </p>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <h1>About Us</h1>
              <div class="form-group">
                <label for="title">About Us Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="about_us_title"
                  placeholder="Enter title"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">About Us Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="about_us_name"
                  placeholder="Enter name"
                />
                <div class="text-danger" v-if="this.service_nameError">
                  {{ this.service_nameError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">About Us Description</label><br />
                <textarea
                  v-model="about_us_des"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.descriptionError">
                  {{ this.descriptionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">About Us Image</label><br />
                <input
                  type="file"
                  class="form-control"
                  @change="image_about_us"
                />
                <p class="my-2 text-center" v-if="this.about_us_img_tmp">
                  <img :src="this.about_us_img_tmp" width="150" height="150" />
                </p>
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
        <div v-html="hello"></div>
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
export default {
  // name:"service-component",
  data() {
    return {
      hello: "<h3>There have no blogs...!</h3>",
      lists: [],
      service_name: "",
      file: "",
      description: "",

      identity_design_title: "",
      identity_design_des: "",
      identity_design_menus_1: "",
      identity_design_menus_2: "",
      identity_design_menus_3: "",
      identity_design_menus_4: "",
      identity_design_menus_5: "",
      identity_design_menus_6: "",
      project_count: "",
      happy_clients: "",
      best_service_title: "",
      best_service_header: "",
      best_service_des: "",
      why_choose_us_title: "",
      why_choose_us_des: "",
      services_capabilities_title: "",
      services_capabilities_des: "",
      services_capabilities_menus_1: "",
      services_capabilities_menus_2: "",
      services_capabilities_menus_3: "",
      services_capabilities_menus_4: "",
      services_capabilities_menus_5: "",
      services_capabilities_menus_6: "",
      services_capabilities_menus_7: "",

      service_deliver_title: "",
      service_deliver_des: "",

      our_latest_work_title: "",

      about_us_title: "",
      about_us_name: "",
      about_us_des: "",

      service_nameError: "",
      descriptionError: "",
      fileError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",

      best_service_img: "",
      why_choose_us_img: "",
      our_latest_work_img: "",
      about_us_img: "",

      best_service_img_tmp: "",
      why_choose_us_img_tmp: "",
      our_latest_work_img_tmp: "",
      about_us_img_tmp: "",

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

      this.identity_design_title= "",
      this.identity_design_des= "",
      this.identity_design_menus_1= "",
      this.identity_design_menus_2= "",
      this.identity_design_menus_3= "",
      this.identity_design_menus_4= "",
      this.identity_design_menus_5= "",
      this.identity_design_menus_6= "",
      this.project_count= "",
      this.happy_clients= "",
      this.best_service_title= "",
      this.best_service_header= "",
      this.best_service_des= "",
      this.why_choose_us_title= "",
      this.why_choose_us_des= "",
      this.services_capabilities_title= "",
      this.services_capabilities_des= "",
      this.services_capabilities_menus_1= "",
      this.services_capabilities_menus_2= "",
      this.services_capabilities_menus_3= "",
      this.services_capabilities_menus_4= "",
      this.services_capabilities_menus_5= "",
      this.services_capabilities_menus_6= "",
      this.services_capabilities_menus_7= "",

      this.service_deliver_title= "",
      this.service_deliver_des= "",

      this.our_latest_work_title= "",

      this.about_us_title= "",
      this.about_us_name= "",
      this.about_us_des= "",

      this.temp_thumbnail_url = "";
      this.best_service_img = "";
      this.why_choose_us_img = "";
      this.our_latest_work_img = "";
      this.about_us_img = "";

      this.best_service_img_tmp = "";
      this.why_choose_us_img_tmp = "";
      this.our_latest_work_img_tmp = "";
      this.about_us_img_tmp = "";
    },
    fetchAll() {
      // console.log("fetch");
      axios
        .get("/admin/service/get")
        .then((response) => {
          console.log(response);
          this.lists = response.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.file = e.target.files[0];
      this.temp_thumbnail_url = "";
    },
    image_best_service(e) {
      this.best_service_img = e.target.files[0];
    },
    image_why_choose_us(e) {
      this.why_choose_us_img = e.target.files[0];
    },
    image_our_work(e) {
      this.our_latest_work_img = e.target.files[0];
    },
    image_about_us(e) {
      this.about_us_img = e.target.files[0];
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

      fd.append("identity_design_title", this.identity_design_title);
      fd.append("identity_design_des", this.identity_design_des);
      fd.append("identity_design_menus_1", this.identity_design_menus_1);
      fd.append("identity_design_menus_2", this.identity_design_menus_2);
      fd.append("identity_design_menus_3", this.identity_design_menus_3);
      fd.append("identity_design_menus_4", this.identity_design_menus_4);
      fd.append("identity_design_menus_5", this.identity_design_menus_5);
      fd.append("identity_design_menus_6", this.identity_design_menus_6);

      fd.append("project_count", this.project_count);
      fd.append("happy_clients", this.happy_clients);

      fd.append("best_service_title", this.best_service_title);
      fd.append("best_service_header", this.best_service_header);
      fd.append("best_service_des", this.best_service_des);

      fd.append("why_choose_us_title", this.why_choose_us_title);
      fd.append("why_choose_us_des", this.why_choose_us_des);

      fd.append(
        "services_capabilities_title",
        this.services_capabilities_title
      );
      fd.append("services_capabilities_des", this.services_capabilities_des);
      fd.append(
        "services_capabilities_menus_1",
        this.services_capabilities_menus_1
      );
      fd.append(
        "services_capabilities_menus_2",
        this.services_capabilities_menus_2
      );
      fd.append(
        "services_capabilities_menus_3",
        this.services_capabilities_menus_3
      );
      fd.append(
        "services_capabilities_menus_4",
        this.services_capabilities_menus_4
      );
      fd.append(
        "services_capabilities_menus_5",
        this.services_capabilities_menus_5
      );
      fd.append(
        "services_capabilities_menus_6",
        this.services_capabilities_menus_6
      );
      fd.append(
        "services_capabilities_menus_7",
        this.services_capabilities_menus_7
      );

      fd.append("service_deliver_title", this.service_deliver_title);
      fd.append("service_deliver_des", this.service_deliver_des);

      fd.append("our_latest_work_title", this.our_latest_work_title);

      fd.append("about_us_title", this.about_us_title);
      fd.append("about_us_name", this.about_us_name);
      fd.append("about_us_des", this.about_us_des);

      fd.append("best_service_img", this.best_service_img);
      fd.append("why_choose_us_img", this.why_choose_us_img);
      fd.append("our_latest_work_img", this.our_latest_work_img);
      fd.append("about_us_img", this.about_us_img);

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

          this.identity_design_title = response.data.identity_design_title;
          this.identity_design_des = response.data.identity_design_des;
          this.identity_design_menus_1 = response.data.identity_design_menus_1;
          this.identity_design_menus_2 = response.data.identity_design_menus_2;
          this.identity_design_menus_3 = response.data.identity_design_menus_3;
          this.identity_design_menus_4 = response.data.identity_design_menus_4;
          this.identity_design_menus_5 = response.data.identity_design_menus_5;
          this.identity_design_menus_6 = response.data.identity_design_menus_6;

          this.project_count = response.data.project_count;
          this.happy_clients = response.data.happy_clients;

          this.best_service_title = response.data.best_service_title;
          this.best_service_header = response.data.best_service_header;
          this.best_service_des = response.data.best_service_des;

          this.why_choose_us_title = response.data.why_choose_us_title;
          this.why_choose_us_des = response.data.why_choose_us_des;

          this.services_capabilities_title =
            response.data.services_capabilities_title;
          this.services_capabilities_des =
            response.data.services_capabilities_des;
          this.services_capabilities_menus_1 =
            response.data.services_capabilities_menus_1;
          this.services_capabilities_menus_2 =
            response.data.services_capabilities_menus_2;
          this.services_capabilities_menus_3 =
            response.data.services_capabilities_menus_3;
          this.services_capabilities_menus_4 =
            response.data.services_capabilities_menus_4;
          this.services_capabilities_menus_5 =
            response.data.services_capabilities_menus_5;
          this.services_capabilities_menus_6 =
            response.data.services_capabilities_menus_6;
          this.services_capabilities_menus_7 =
            response.data.services_capabilities_menus_7;

          this.service_deliver_title = response.data.service_deliver_title;
          this.service_deliver_des = response.data.service_deliver_des;

          this.our_latest_work_title = response.data.our_latest_work_title;

          this.about_us_title = response.data.about_us_title;
          this.about_us_name = response.data.about_us_name;
          this.about_us_des = response.data.about_us_des;

          this.best_service_img_tmp = response.data.best_service_img;
          this.why_choose_us_img_tmp = response.data.why_choose_us_img;
          this.our_latest_work_img_tmp = response.data.our_latest_work_img;
          this.about_us_img_tmp = response.data.about_us_img;

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
        this.identity_design_title= "",
      this.identity_design_des= "",
      this.identity_design_menus_1= "",
      this.identity_design_menus_2= "",
      this.identity_design_menus_3= "",
      this.identity_design_menus_4= "",
      this.identity_design_menus_5= "",
      this.identity_design_menus_6= "",
      this.project_count= "",
      this.happy_clients= "",
      this.best_service_title= "",
      this.best_service_header= "",
      this.best_service_des= "",
      this.why_choose_us_title= "",
      this.why_choose_us_des= "",
      this.services_capabilities_title= "",
      this.services_capabilities_des= "",
      this.services_capabilities_menus_1= "",
      this.services_capabilities_menus_2= "",
      this.services_capabilities_menus_3= "",
      this.services_capabilities_menus_4= "",
      this.services_capabilities_menus_5= "",
      this.services_capabilities_menus_6= "",
      this.services_capabilities_menus_7= "",

      this.service_deliver_title= "",
      this.service_deliver_des= "",

      this.our_latest_work_title= "",

      this.about_us_title= "",
      this.about_us_name= "",
      this.about_us_des= "",

      this.temp_thumbnail_url = "";
      this.best_service_img = "";
      this.why_choose_us_img = "";
      this.our_latest_work_img = "";
      this.about_us_img = "";

      this.best_service_img_tmp = "";
      this.why_choose_us_img_tmp = "";
      this.our_latest_work_img_tmp = "";
      this.about_us_img_tmp = "";
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
