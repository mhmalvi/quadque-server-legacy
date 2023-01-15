<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Add about us</button>
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
              {{ this.is_editing ? "Update About Us" : "Create About Us" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <!-- {{ description }} -->
              <div v-if="this.is_editing" class="form-group">
                <label for="title">Slug</label>
                <input type="string" v-model="slug" value="title" class="form-control" />
                <!-- <div class="text-danger" v-if="this.titleError">
                  {{ this.titleError }}
                </div> -->
              </div>
              <div class="form-group">
                <label for="title">Our Vision</label><br />
                <textarea
                  v-model="our_vision"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.our_visionError">
                  {{ this.our_visionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Our Mission</label><br />
                <textarea
                  v-model="our_mission"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.our_missionError">
                  {{ this.our_missionError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Our Goal</label><br />
                <textarea
                  v-model="our_goal"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.our_goalError">
                  {{ this.our_goalError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Our Objective</label><br />
                <textarea
                  v-model="our_objective"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.our_objectiveError">
                  {{ this.our_objectiveError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Who we are</label><br />
                <textarea
                  v-model="who_we_are"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.who_we_areError">
                  {{ this.who_we_areError }}
                </div>
              </div>
              <div class="form-group">
                <label for="title">Why choose us</label><br />
                <textarea
                  v-model="why_choose_us"
                  class="form-control"
                  rows="4"
                  required
                ></textarea>
                <div class="text-danger" v-if="this.why_choose_usError">
                  {{ this.why_choose_usError }}
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
        <h4>About Us Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Our Vision</th>
              <th>Our Mission</th>
              <th>Our Goal</th>
              <th>Our Objective</th>
              <th>Who we are</th>
              <th>Why choose us</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="(list, index) in lists" :key="index">
              <td style="vertical-align: middle; font-weight: 500">
                {{ index + 1 }}.
              </td>
              <td
                style="vertical-align: middle; font-weight: 500"
                v-html="list.our_vision"
              >
                <!-- {{ list.our_vision }} -->
              </td>
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.our_mission }}
              </td>

              <td style="vertical-align: middle">
                {{ list.our_goal }}
              </td>

              <td style="vertical-align: middle">
                {{ list.our_objective }}
              </td>

              <td style="vertical-align: middle">
                <!-- {{  }} -->{{ list.who_we_are }}
              </td>

              <td style="vertical-align: middle">
                {{ list.why_choose_us }}
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
              <td colspan="8">
                <h3 class="text-center">There have nothing about us...!</h3>
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
      our_vision: "",
      our_mission: "",
      our_goal: "",
      our_objective: "",
      who_we_are: "",
      why_choose_us: "",
      our_visionError: "",
      our_missionError: "",
      our_goalError: "",
      our_objectiveError: "",
      who_we_areError: "",
      why_choose_usError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      // blog_no: 1,
    };
  },
  computed: {
        slug(){
            return this.title.replace(/\s+/g, '-').toLowerCase();
        }
    },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.our_vision = "";
      this.our_mission = "";
      this.our_goal = "";
      this.our_objective = "";
      this.who_we_are = "";
      this.why_choose_us = "";
      // $("#summernote1").summernote1("code1", "");
      // $("#summernote2").summernote2("code2", "");
      // $("#summernote3").summernote3("code3", "");
      // $("#summernote4").summernote4("code4", "");
      // $("#summernote5").summernote5("code5", "");
      // $("#summernote6").summernote6("code6", "");
      // this.temp_thumbnail_url = "";
    },
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/about-us/get")
        .then((response) => {
          
          this.lists = response.data.data;
          console.log(this.lists);
        })
        .catch((error) => {});
    },
    // uploadfile(e) {
    //   this.image = e.target.files[0];
    //   this.temp_thumbnail_url = "";
    // },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/about-us/update/`;
      } else {
        url = `/admin/about-us/store`;
      }

      // this.description = $("#summernote").summernote("code");
      // let fd = new FormData();
      // fd
      // fd.append("our_vision", this.our_vision);
      // fd.append("our_mission", this.our_mission);
      // fd.append("our_goal", this.our_goal);
      // fd.append("our_objective", this.our_objective);
      // fd.append("who_we_are", this.who_we_are);
      // fd.append("why_choose_us", this.why_choose_us);
      axios
        .post(url, {
          our_vision: this.our_vision,
          our_mission: this.our_mission,
          our_goal: this.our_goal,
          our_objective: this.our_objective,
          who_we_are: this.who_we_are,
          why_choose_us: this.why_choose_us,
          id: this.temporary_id,
        })
        .then((response) => {
          this.success = response.data.success;
          this.fetchAll();
          if (this.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "About us Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
            this.is_editing = false;
            this.our_vision = "";
            this.our_mission = "";
            this.our_goal = "";
            this.our_objective = "";
            this.who_we_are = "";
            this.why_choose_us = "";
            this.temporary_id = "";
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "About us Updated",
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
          // console.log(error.response);
          if (error.response.data.errors.our_vision) {
            console.log("here");
            console.log(error.response.data.errors.our_vision);
            this.our_visionError = error.response.data.errors.our_vision[0];
          } else {
            this.our_visionError = "";
          }

          if (error.response.data.errors.our_mission) {
            this.our_missionError = error.response.data.errors.our_mission[0];
          } else {
            this.our_missionError = "";
          }

          if (error.response.data.errors.our_goal) {
            this.our_goalError = error.response.data.errors.our_goal[0];
          } else {
            this.our_goalError = "";
          }
          if (error.response.data.errors.our_objective) {
            this.our_objectiveError =
              error.response.data.errors.our_objective[0];
          } else {
            this.our_objectiveError = "";
          }
          if (error.response.data.errors.who_we_are) {
            this.who_we_areError = error.response.data.errors.who_we_are[0];
          } else {
            this.who_we_areError = "";
          }
          if (error.response.data.errors.why_choose_us) {
            this.why_choose_usError =
              error.response.data.errors.why_choose_us[0];
          } else {
            this.why_choose_usError = "";
          }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.our_vision = "";
      this.our_mission = "";
      this.our_goal = "";
      this.our_objective = "";
      this.who_we_are = "";
      this.why_choose_us = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/about-us/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.our_vision = response.data.our_vision;
          this.our_mission = response.data.our_mission;
          this.our_goal = response.data.our_goal;
          this.our_objective = response.data.our_objective;
          this.who_we_are = response.data.who_we_are;
          this.why_choose_us = response.data.why_choose_us;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/about-us/delete/${list_id}`).then((response) => {
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
