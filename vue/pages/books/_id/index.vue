<template>
  <AppPage title="View book" :sub-title="{name: 'Books', path: '/books'}">
    <div class="row">
      <div class="col">
        <nuxt-link :to="`/books/${book?.id}/edit`" :disabled="!loaded" tag="button" class="btn btn-primary">
          <i class="bi bi-pencil-fill" />
          Edit
        </nuxt-link>
        <button class="btn btn-primary" :disabled="!loaded" @click="deleteBook">
          <i class="bi bi-trash-fill" />
          Delete
        </button>
      </div>
    </div>
    <div class="row mt-5">
      <div v-if="!loaded" class="col d-flex" style="height: 400px">
        <div class="spinner-border m-auto" style="width: 4rem; height: 4rem" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div v-else class="col">
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">ISBN</div>
          <div class="fw-bolder">{{ book.isbn }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Title</div>
          <div class="fw-bolder">{{ book.title }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Author</div>
          <div class="fw-bolder">{{ book.author }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Status</div>
          <div v-html="status(book.status)" />
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Created at</div>
          <div class="fw-bolder">{{ formatDate(book.created_at) }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Updated at</div>
          <div class="fw-bolder">{{ formatDate(book.updated_at) }}</div>
        </div>
      </div>
    </div>
  </AppPage>
</template>

<script>
import moment from 'moment';
export default {
  name: 'Show',
  data () {
    return {
      book: null,
      loaded: false
    }
  }, //eslint-disable-line
  mounted () {
    this.getBook();
  },
  methods: {
    status (statusId) {
      if (statusId === 0) {
        return '<span class="badge text-bg-danger">Unavailable</span>';
      }
      if (statusId === 1) {
        return '<span class="badge text-bg-success">Available</span>';
      }
    },
    getBook () {
      this.$axios.get(`http://localhost:8000/api/books/${this.$route.params.id}`)
        .then((res) => {
          this.book = res.data.data
          this.loaded = true
        })
    },
    formatDate (date) {
      return moment(date).format('YYYY-MM-DD')
    },
    deleteBook () {
      this.$store.dispatch('books/deleteBook', this.book.id).then(() => {
        this.$router.push('/books')
      })
    }
  }
}
</script>

<style scoped>

</style>
