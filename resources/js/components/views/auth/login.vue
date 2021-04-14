<template>
  <div class="row">
    <div class="col"></div>
    <!-- Login Form -->
    <div class="card col-5 mt-20">
      <form class="container">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            v-model="post.email"
          />
          <small id="emailHelp" class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            v-model="post.password"
          />
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1"
            >Check me out</label
          >
        </div>
        <button type="button" @click="login()" class="btn btn-primary">
          Submit
        </button>
        <p class="font-serif text-sm py-2">
          Already a user? <router-link to="/signup">Signup</router-link>
        </p>
      </form>
    </div>
    <!-- Login Form Ends -->
    <div class="col"></div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      post: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async login() {
      if (this.post.email.trim() == "") {
        this.toast("email is required!", "error");
      } else if (this.post.password.trim() == "") {
        this.toast("Password is required!", "error");
      } else {
        const res = await this.callApi("post", "api/login", this.post);
        if (res.status == 200) {
          // Get API token
          localStorage.token = await res.data.token;
          //  Get Success Message
          var successMessage = res.data.message;
          this.toast(successMessage, "success");
          //   Reset Form fields
          this.post.email = "";
          this.post.password = "";

          //   Push to dashboard
          this.$router.push("/books")
          //   location.reload();
        } else if (res.status == 422) {
          var errs = res.data.errors;
          this.toast(errs, "error");
        } else {
          //   Error Message
          this.toast("Server Error!", "error");
        }
      }
    },
  },
};
</script>
