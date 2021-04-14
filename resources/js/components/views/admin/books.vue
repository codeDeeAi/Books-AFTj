<template>
  <div>
    <div class="row">
      <button
        type="button"
        class="btn btn-primary btn-sm ml-4"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        Create New Book
      </button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(book, index) in books" :key="index">
          <th scope="row">{{ index }}</th>
          <td>{{ book.title }}</td>
          <td>{{book.user.name}}</td>
          <td>
            <router-link :to="'/book-'+book.title+'-'+book.id" class="btn btn-info btn-sm"
              >View</router-link
            >
            <a href="#!" @click="deleteBook(book, index)" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Body Ends -->
    <!-- Modals -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="title"
                  v-model="post.title"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Information</label>
                <textarea
                  class="form-control"
                  id="exampleFormControlTextarea1"
                  rows="3"
                  v-model="post.description"
                ></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="create()">
              Create Book
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modals End -->
  </div>
</template>
<script>
export default {
  components: {},
  data() {
    return {
      books: [],
      post: {
        title: "",
        description: "",
      },
    };
  },
  methods: {
    //   Method to get books from DB
    async getBooks() {
      const res = await this.callApi("get", "api/books", {});
      if (res.status == 200) {
        this.books = res.data.data;
      }
    },
    // Method to Create Book
    async create() {
      if (this.post.title.trim() == "") {
        this.toast("Title is required!", "error");
      } else if (this.post.description.trim() == "") {
        this.toast("A brief info is required!", "error");
      } else {
        const res = await this.callApi("post", "api/book", this.post);
        if (res.status == 200) {
          // Reset Form Fields
          (this.post.title = ""), (this.post.description = "");
          // Get Data
          this.getBooks();
        } else if (res.status == 422) {
          var errs = res.data.errors;
          this.toast(errs, "error");
        } else {
          //   Error Message
          this.toast("Server Error!", "error");
        }
      }
    },
    // Method to Delete Book
    async deleteBook(book, index) {
      if (!confirm("Are you sure you want to delete this book ?")) {
        // Alert User
        this.toast("Will not delete", "info");
      } else {
        const res = await this.callApi("delete", `api/book/${book.id}`);
        if (res.status == 200) {
          // Alert User
          this.toast("Book Deleted Successfully", "success");

          // Get Data
          this.getBooks();
        } else {
          // Alert User
          this.toast("Error", "error");
        }
      }
    },
  },
  created() {
    //   Get Books On Page Load
    this.getBooks();
  },
};
</script>
