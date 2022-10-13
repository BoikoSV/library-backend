<template>
  <form @submit.prevent class="card border mb-4">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <label for="isbn" class="form-label">ISBN</label>
          <input v-model="filter.isbn" id="isbn" type="text" class="form-control">
        </div>
        <div class="col">
          <label for="title" class="form-label">Title</label>
          <input v-model="filter.title" id="title" type="text" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label for="author" class="form-label">Author</label>
          <input v-model="filter.author" id="author" type="text" class="form-control">
        </div>
        <div class="col">
          <label for="status" class="form-label">Status</label>
          <select v-model="filter.status" id="status" class="form-select">
            <option value="">Select the status</option>
            <option value="0">Unavailable</option>
            <option value="1">Available</option>
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-end gap-2">
        <button v-if="$store.state.books.load" class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          <span>Loading...</span>
        </button>
        <button v-else @click="filtered" class="btn btn-primary">
          <i class="bi bi-search" />
          Search
        </button>
        <button @click="reset" :disabled="$store.state.books.load" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-counterclockwise" />
          Reset
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "BooksFilter", //eslint-disable-line
  data () {
    return {
      filter: {
        isbn: '',
        title: '',
        author: '',
        status: ''
      }
    }
  },
  methods: {
    filtered () {
      this.$emit('filter', { ...this.filter })
    },
    reset () {
      this.filter.isbn = ''
      this.filter.title = ''
      this.filter.author = ''
      this.filter.status = ''
      this.$emit('reset')
    }
  }
}
</script>

<style scoped>

</style>
