<template>
  <div>
    <div class="row d-flex justify-content-center">
      <div
        v-if="this.is_editing == true"
        @click="disable_button()"
        class="mt-3"
      >
        <button class="btn btn-primary">Create Blog</button>
      </div>
      <div class="col-md-6 mt-4">
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
              style="margin-top: 1%"
              class="card-title text-white text-center"
            >
              {{ this.is_editing ? "Update Blog" : "Create Blog" }}
            </h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="title">Blog Title</label>
                <textarea
                  v-model="title"
                  class="form-control"
                  rows="4"
                ></textarea>
                <div class="text-danger" v-if="this.titleError">
                  {{ this.titleError }}
                </div>
              </div>
              <div class="form-group">
                <label for="thumbnail">Blog Thumbnail</label>
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
                    :src="this.temp_thumbnail_url"
                    width="150"
                    height="150"
                  />
                </p>
              </div>
              <div class="form-group" style="width:32rem;">
                <label for="text">Blog Text</label>
                <!-- <textarea
                  v-model="text"
                  id="summernote"
                  class="form-control"
                  rows="10"
                ></textarea> -->
                <el-tiptap v-model="text" :extensions="extensions" />
                <div class="text-danger" v-if="this.textError">
                  {{ this.textError }}
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
        <h4>Blog Lists</h4>
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <td>No.</td>
              <th>Title</th>
              <th>Thumbnail</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="lists.length > 0">
            <tr v-for="list in lists" :key="list.id">
              <td style="vertical-align: middle; font-weight: 500">
                {{ list.id }}.
              </td>
              <td style="width: 70%; vertical-align: middle; font-weight: 500">
                {{ list.title }}
              </td>

              <td>
                <!-- {{ list.thumbnail }} -->
                <img :src="list.thumbnail" width="100" height="100" />
              </td>
              <td v-html="list.text"></td>

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
                <h3 class="text-center">There have no blogs...!</h3>
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
// import { ElementTiptap } from 'element-tiptap';

import {
  // necessary extensions
  Doc,
  Text,
  Paragraph,
  Heading,
  Bold,
  Underline,
  Italic,
  Strike,
  ListItem,
  BulletList,
  OrderedList,
  Image,Iframe,CodeBlock,Blockquote,TodoItem,TodoList,TextAlign,Indent,LineHeight,HorizontalRule,Table ,TableHeader,TableCell,TableRow,FormatClear,TextColor,TextHighlight,Preview,Print,Fullscreen,SelectAll,FontType,FontSize,CodeView 
} from 'element-tiptap';
export default {
  // components: {
  //   'el-tiptap': ElementTiptap,
  // },
  data() {
    return {
      lists: [],
      title: "",
      thumbnail: "",
      text: "",
      titleError: "",
      textError: "",
      thumbnailError: "",
      success: "",
      temporary_id: "",
      is_editing: false,
      temp_thumbnail_url: "",
      blog_no: 1,

      extensions: [
        new Doc(),
        new Text(),
        new Paragraph(),
        new Heading({ level: 5 }),
        new Bold({ bubble: true }), // render command-button in bubble menu.
        new Underline({ bubble: true, menubar: false }), // render command-button in bubble menu but not in menubar.
        new Italic(),
        new Strike(),
        new ListItem(),
        new BulletList(),
        new OrderedList(),
        new Image(), new Iframe(), new CodeBlock(), new Blockquote(),new TodoItem(),new TodoList (),new TextAlign(),new Indent(),new LineHeight(),new HorizontalRule(),new Table(),new TableHeader(),new TableCell(),new TableRow(),new FormatClear(),new TextColor(),new TextHighlight(),new Preview(),new Print(),new Fullscreen(),new SelectAll(),new FontType(),new FontSize(),new CodeView()
      ],
    };
  },
  methods: {
    disable_button() {
      this.is_editing = false;
      this.title = "";
      this.text = "";
      this.thumbnail = "";
      this.temp_thumbnail_url = "";
      $("#summernote").summernote("code", "");
    },
    fetchAll() {
      axios
        .get("/admin/blog/get")
        .then((response) => {
          console.log(response);
          this.lists = response.data;
        })
        .catch((error) => {});
    },
    uploadfile(e) {
      this.thumbnail = e.target.files[0];
      this.temp_thumbnail_url = "";
    },

    save() {
      let url;
      if (this.is_editing) {
        url = `/admin/blog/update/`;
      } else {
        url = `/admin/blog/store`;
      }

      this.text = $("#summernote").summernote("code");
      let fd = new FormData();
      fd.append("title", this.title);
      fd.append("text", this.text);
      fd.append("thumbnail", this.thumbnail);
      fd.append("id", this.temporary_id);
      axios
        .post(url, fd)
        .then((response) => {
          this.success = response.data.success;
          this.title = "";
          this.text = "";
          $("#summernote").summernote("code", this.text);
          document.getElementById("thumbnail").value = "";
          this.temporary_id = "";
          this.temp_thumbnail_url = "";
          this.is_editing = false;
          if (this.success == "created") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Blog Saved",
              showConfirmButton: true,
              // timer: 1500,
            });
          } else if (this.success == "updated") {
            this.$swal.fire({
              // position: "top-end",
              icon: "success",
              title: "Blog Updated",
              showConfirmButton: true,
              // timer: 1500,
            });
          }
          this.fetchAll();
          setTimeout(function () {
            this.success = "";
          }, 5000);
        })
        .catch((error) => {
          console.log(error.response);
          if (error.response.data.errors.title) {
            this.titleError = error.response.data.errors.title[0];
          } else {
            this.titleError = "";
          }

          if (error.response.data.errors.text) {
            this.textError = error.response.data.errors.text[0];
          } else {
            this.textError = "";
          }
          if (error.response.data.errors.thumbnail) {
            this.thumbnailError = error.response.data.errors.thumbnail[0];
          } else {
            this.thumbnailError = "";
          }
        });
    },

    editList(list_id) {
      this.is_editing = true;
      this.titleError = "";
      this.thumbnailError = "";
      this.temporary_id = list_id;

      axios
        .get(`/admin/blog/edit/${this.temporary_id}`)
        .then((response) => {
          this.title = response.data.title;
          this.text = response.data.text;
          $("#summernote").summernote("code", this.text);
          this.temp_thumbnail_url = response.data.thumbnail;
        })
        .catch((error) => {});
    },
    destroyList(list_id) {
      axios.get(`/admin/blog/delete/${list_id}`).then((response) => {
        // this.success = response.data.success;
        this.$swal.fire({
          icon: "error",
          text: "Deleted",
        });
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
.card{
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
