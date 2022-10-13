<template>
  <AppPage title="New book" :sub-title="{name: 'Books', path: '/books'}">
    <div class="row">
      <div class="col-6">
        <form class="card border mb-4" @submit.prevent>
          <div class="card-body">
            <div class="row mb-3">
              <div class="mb-4">
                <label for="isbn" class="form-label">ISBN</label>
                <input
                  id="isbn"
                  v-model="book.isbn"
                  :class="{ 'is-invalid': $v.book.isbn.$error, 'is-valid': !$v.book.isbn.$invalid }"
                  type="text"
                  class="form-control"
                  @blur="$v.book.isbn.$touch"
                >
                <div v-if="$v.book.isbn.$error" class="invalid-feedback">{{ msgIsbn }}</div>
              </div>
              <div class="mb-4">
                <label for="title" class="form-label">Title</label>
                <input
                  id="title"
                  v-model="book.title"
                  :class="{ 'is-invalid': $v.book.title.$error, 'is-valid': !$v.book.title.$invalid }"
                  type="text"
                  class="form-control"
                  @blur="$v.book.title.$touch"
                >
                <div v-if="$v.book.title.$error" class="invalid-feedback">{{ msgTitle }}</div>
              </div>
              <div class="mb-4">
                <label for="author" class="form-label">Author</label>
                <input
                  id="author"
                  v-model="book.author"
                  :class="{ 'is-invalid': $v.book.author.$error, 'is-valid': !$v.book.author.$invalid }"
                  type="text"
                  class="form-control"
                  @blur="$v.book.author.$touch"
                >
                <div v-if="$v.book.author.$error" class="invalid-feedback">{{ msgAuthor }}</div>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <button v-if="false" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" />
                <span>Loading...</span>
              </button>
              <button v-else class="btn btn-primary" @click="addBook">
                <i class="bi bi-plus-lg" />
                Add book
              </button>
              <button class="btn btn-outline-secondary" @click="reset">
                <i class="bi bi-arrow-counterclockwise" />
                Reset
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</AppPage>
</template>

<script>
import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators'
export default {
  name: "create", //eslint-disable-line
  data () {
    return {
      book: {
        isbn: '',
        title: '',
        author: ''
      }
    }
  },
  validations: {
    book: {
      isbn: { required, numeric, minLength: minLength(13), maxLength: maxLength(13) },
      title: { required, minLength: minLength(5), maxLength: maxLength(250) },
      author: { required, minLength: minLength(5), maxLength: maxLength(250) }
    }
  },
  computed: {
    msgIsbn () {
      let message = '';
      if (!this.$v.book.isbn.required) {
        message = 'The field ISBN is required'
      }
      if (!this.$v.book.isbn.minLength || !this.$v.book.isbn.maxLength) {
        message = 'The field must have 13 symbols'
      }
      if (!this.$v.book.isbn.numeric) {
        message = 'The field ISBN must be numeric'
      }
      return message;
    },
    msgTitle () {
      let message = '';
      if (!this.$v.book.title.required) {
        message = 'The field Title is required'
      }
      if (!this.$v.book.title.minLength) {
        message = 'The field must have min 5 symbols'
      }
      if (!this.$v.book.title.maxLength) {
        message = 'The field must be max 250 symbols'
      }
      return message;
    },
    msgAuthor () {
      let message = '';
      if (!this.$v.book.author.required) {
        message = 'The field Author is required'
      }
      if (!this.$v.book.author.minLength) {
        message = 'The field must have min 5 symbols'
      }
      if (!this.$v.book.author.maxLength) {
        message = 'The field must be max 200 symbols'
      }
      return message;
    }
  },
  methods: {
    addBook () {
      this.$v.$touch();
      if (!this.$v.$error) {
        this.$store.dispatch('books/addBook', this.book)
      }
    },
    reset () {
      this.book.isbn = ''
      this.book.title = ''
      this.book.author = ''
      this.$v.$reset();
    }
  }
}
</script>

<style>
</style>
