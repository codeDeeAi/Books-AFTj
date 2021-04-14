<template>
  <div>
      <ul class="list-group" v-for="(book, index) in data" :key="index">
        <li class="list-group-item"><h3>Title</h3> : {{book.title}}</li>
        <li class="list-group-item"><h3>Author</h3> : {{book.user.name}}</li>
        <li class="list-group-item"><h4>Description</h4> :{{book.description}}</li>
        </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      // Get Parameters from url
      id: this.$route.params.id,
      data: [],
    };
  },
  methods: {
    async getBook() {
      const res = await this.callApi("get", `api/book/${this.id}`);
      if (res.status == 200) {
        this.data = res.data;
      }
    },
  },
  created() {
      this.getBook()
  },
};
</script>
