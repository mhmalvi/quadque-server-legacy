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
            style="height: 47px;
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
              {{ this.is_editing ? "Update Clients" : "Create Clients" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <!-- {{ description }} -->
              <div class="form-group">
                <label for="thumbnail">Clients image</label>
                <input
                  type="file"
                  class="form-control"
                  id="thumbnail"
                  @change="uploadfile"
                />
                <div class="text-danger" v-if="this.thumbnailError">
                  {{ this.thumbnailError }}
                </div>
                <p class="my-2 text-center" v-if="this.temp_thumbnail_url">
                  <img
                    :src="$base+this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
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
        <h4>Clients Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Our Clients</th>
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
              <td colspan="3">
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
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      image:""
      // blog_no: 1,
    };
  },
  methods: {
    disable_button() {
      this.meta_keyword=""
    },
    fetchAll() {
      console.log("fetch");
      axios
        .get("/admin/about-us/get")
        .then((response) => {
          console.log(response);
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
        url = `/admin/about-us/update/`;
      } else {
        url = `/admin/about-us/store`;
      }
      fd=new FormData()
      fd.append("client_images", this.image);
      fd.append("meta_keyword", this.meta_keyword);
      fd.append("id", this.temporary_id);
      axios
        .post(url,fd)
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
            
            this.meta_keyword = "";
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
        });
    },

    editList(list_id) {
      this.temporary_id = list_id;

      axios
        .get(`/admin/about-us/edit/${this.temporary_id}`)
        .then((response) => {
          console.log(response);
          this.meta_keyword = response.data.meta_keyword;
          this.temp_thumbnail_url=response.data.client_images
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/about-us/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.fetchAll();
        this.meta_keyword = ""
        this.is_editing=false
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
