<template>
  <div class="body">
    <div class="container grid grid-cols-1 justify-center">
      <div
        class="card shadow-md rounded-3xl py-4 px-3 m-auto w-1/2"
      >
        <div class="flex justify-center py-4">
          <h5
            class="card-title font-bold text-xl font-medium text-gray-500 text-4xl"
          >
            Signup
          </h5>
        </div>
        <form>
          <div class="form-group">
            <label>Name</label>
            <input
              type="text"
              class="form-control border border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
              v-model="post.name"
            />
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input
              type="email"
              class="form-control border border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
              v-model="post.email"
            />
            <small class="form-text text-muted"
              >We'll never share your email with anyone else.</small
            >
          </div>
          <div class="form-group">
            <label>Password</label>
            <input
              type="password"
              class="form-control border border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
              v-model="post.password"
            />
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input
              type="password"
              class="form-control border border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
              v-model="post.password2"
            />
          </div>
          <div class="flex justify-center">
            <a
              href="#!"
              class="btn btn-outline-success"
              @click="createAccount"
              :loading="isLoading"
              :disabled="isLoading"
              >{{ isLoading ? "Creating ..." : "Sign up" }}</a
            >
          </div>
          <div class="flex justify-center">
            <p class="font-serif text-sm py-2">
              Already a user? <router-link to="/login">Login</router-link>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "",
  components: {},
  data() {
    return {
      spin: false,
      isLoading: false,
      post: {
        name: "",
        password: "",
        password2: "",
      },
    };
  },
  methods: {
    async createAccount() {
      this.isLoading = true;
      if (this.post.name.trim() == "") {
        this.toast("Name is required!", 'error');
        this.isLoading = false;
      } else if (this.post.email.trim() == "") {
        this.toast("Email is required!", 'error');
        this.isLoading = false;
      } else if (this.post.password.trim() == "") {
        this.toast("Password is required!", 'error');
        this.isLoading = false;
      } else if (this.post.password != this.post.password2) {
        this.toast("Passwords must be identical!", 'error');
        this.isLoading = false;
      } else {
        const res = await this.callApi("post", "api/signup", this.post);
        if (res.status == 200) {
          //  Account Created
          this.toast("Account created successfully!", "success");
          this.post.name = "";
          this.post.email = "";
          this.post.password = "";
          this.post.password2 = "";
          this.isLoading = false;
          this.toastError("Error creating Account, try again !");
        } else if (res.status == 422) {
          var errs = res.data.errors;
          for (let i in errs) {
            var err = errs[i][0];
            this.toast(err, "error");
          }
          this.isLoading = false;
        } else {
          var err = "Network Error, Refresh !";
          this.toast(err, "error");
          this.isLoading = false;
        }
      }
    },
  },
  created() {},
  mounted() {},
};
</script>
<style scoped></style>
