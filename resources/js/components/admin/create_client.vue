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
        <button class="btn btn-primary">Create Clients</button>
      </div>
      <div class="col-md-12 mt-4">
        <!-- <div class="alert alert-success" v-if="this.success">
          {{ this.success }}
        </div> -->
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
              style="margin:auto;"
              class="card-title text-white text-center"
            >
              {{
                this.is_editing ? "Update Client List" : "Create Client List"
              }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="thumbnail">Client Thumbnails</label>
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
                    :src="$base + this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
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
        <h4>Client Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <td>No.</td>
              <th>Thumbnail</th>
              <th>Meta Keyword</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="(list, index) in lists" :key="index">
              <td style="vertical-align: middle; font-weight: 500">
                {{ index + 1 }}.
              </td>

              <td>
                <!-- {{ list.thumbnail }} -->
                <img
                  :src="$base + list.client_images"
                  width="100"
                  height="100"
                />
              </td>
              <td>
                <!-- {{ list.thumbnail }} -->
                {{ list.meta_keyword }}
              </td>

              <td style="vertical-align: middle; color: white">
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
                <h3 class="text-center">There have no client list...!</h3>
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
  // components: {
  //   'el-tiptap': ElementTiptap,
  // },
  // name:"createClient-component",
  data() {
    return {
      loader: false,
      lists: [],
      images: [],
      title: "",
      thumbnail: "",
      meta_keyword: "",
      text: "",
      titleError: "",
      textError: "",
      thumbnailError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      blog_no: 1,

      // extensions: [
      //   new Doc(),
      //   new Text(),
      //   new Paragraph(),
      //   new Heading({ level: 5 }),
      //   new Bold({ bubble: true }), // render command-button in bubble menu.
      //   new Underline({ bubble: true, menubar: false }), // render command-button in bubble menu but not in menubar.
      //   new Italic(),
      //   new Strike(),
      //   new ListItem(),
      //   new BulletList(),
      //   new OrderedList(),
      //   new Image(), new Iframe(), new CodeBlock(), new Blockquote(),new TodoItem(),new TodoList (),new TextAlign(),new Indent(),new LineHeight(),new HorizontalRule(),new HardBreak(),new TrailingNode(),new History(),new Table(),new TableHeader(),new TableCell(),new TableRow(),new FormatClear(),new TextColor(),new TextHighlight(),new Preview(),new Print(),new Fullscreen(),new SelectAll(),new FontType(),new FontSize(),new CodeView()
      // ],
    };
  },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.title = "";
      this.text = "";
      this.meta_keyword = "";
      this.thumbnail = "";
      this.temp_thumbnail_url = "";
      // $(".summernote").summernote("code", "");
    },
    fetchAll() {
      this.loader = true;
      axios
        .get("/admin/clients/get")
        .then((response) => {
          this.loader = false;
          this.lists = response.data.data;
          console.log(lists);
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.thumbnail = e.target.files[0];
      this.temp_thumbnail_url = "";
    },

    save() {
      this.loader = true;
      let url;
      if (this.is_editing) {
        url = `/admin/clients/update`;
      } else {
        url = `/admin/clients/store`;
      }

      let fd = new FormData();
      fd.append("client_images", this.thumbnail);
      fd.append("meta_keyword", this.meta_keyword);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          this.loader = false;
          this.success = response.data.message;

          if (this.success == "created") {
            this.fetchAll();
            document.getElementById("thumbnail").value = "";
            this.temporary_id = "";
            this.meta_keyword = "";
            this.temp_thumbnail_url = "";
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Clients Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
          } else if (this.success == "updated") {
            this.is_editing = true;
            this.fetchAll();
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Clients Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }

          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          this.loader=false
          console.log(error.response);
          if (error.response.data.errors.client_images) {
            this.thumbnailError = error.response.data.errors.client_images[0];
            this.$swal.fire({
              // position: "top-end",
              // icon: "success",
              title: this.thumbnailError,
              showConfirmButton: true,
              // timer: 1500,
            });
          } else {
            this.thumbnailError = "";
          }
          // if (error.response.data.errors.thumbnail) {
          //   this.thumbnailError = error.response.data.errors.thumbnail[0];
          // } else {
          //   this.thumbnailError = "";
          // }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.titleError = "";
      this.thumbnailError = "";
      this.temporary_id = list_id;
      this.loader = true;
      axios
        .get(`/admin/clients/edit/${this.temporary_id}`)
        .then((response) => {
          this.loader = false;
          this.thumbnail = response.data.client_images;
          this.temp_thumbnail_url = response.data.client_images;
          this.meta_keyword = response.data.meta_keyword;
          console.log(this.temp_thumbnail_url);
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      this.loader=true
      axios.get(`/admin/clients/delete/${list_id}`).then((response) => {
        this.loader=false
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
        this.thumbnail = "";
        this.temp_thumbnail_url = "";
        this.meta_keyword = "";
        this.fetchAll();
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
  border: none;
}

.btn-edit:hover {
  color: black;
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

/* .note-editor.note-airframe.fullscreen, .note-editor.note-frame.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 32rem !important;
    z-index: 1050;
}
.note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
    padding: 10px;
    overflow: auto;
    word-wrap: break-word;
    width: 32rem !important;
} */
</style>
