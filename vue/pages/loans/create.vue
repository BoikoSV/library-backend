<template>
  <AppPage title="New loan" :sub-title="{name: 'Loans', path: '/loans'}">
    <div class="row">
      <div class="col-6">
        <form @submit.prevent class="card border mb-4">
          <div class="card-body">
            <div class="row mb-3">
              <div class="mb-4">
                <label for="book" class="form-label">Book</label>
                <select
                  name="book"
                  id="book"
                  :class="{ 'is-invalid': $v.book.$error, 'is-valid': !$v.book.$invalid }"
                  v-model="book"
                  @change="$v.book.$touch"
                  class="form-control custom-select"
                >
                  <option value selected>Select a book</option>
                  <option v-for="book in books" :key="book.id" :value="book.id">{{ book.title }}</option>
                </select>
                <div class="invalid-feedback" v-if="$v.book.$error">{{ msgBook }}</div>
              </div>
              <div class="mb-4">
                <label for="member" class="form-label">Member</label>
                <select
                  name="member"
                  id="member"
                  :class="{ 'is-invalid': $v.member.$error, 'is-valid': !$v.member.$invalid }"
                  v-model="member"
                  @change="$v.member.$touch"
                  class="form-control custom-select"
                >
                  <option value selected>Select a member</option>
                  <option v-for="member in members" :key="member.id" :value="member.id">{{ member.name }}</option>
                </select>
                <div class="invalid-feedback" v-if="$v.member.$error">{{ msgMember }}</div>
              </div>
              <div class="mb-4">
                <div class="col">
                  <label for="created-from" class="form-label">Date to</label>
                  <input
                    v-model="date"
                    :class="{ 'is-invalid': $v.date.$error, 'is-valid': !$v.date.$invalid }"
                    @change="$v.date.$touch"
                    id="created-from"
                    type="date"
                    class="form-control"
                  >
                </div>
                <div class="invalid-feedback" v-if="$v.date.$error">{{ msgDate }}</div>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <button v-if="false" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span>Loading...</span>
              </button>
              <button @click="addLoan" v-else class="btn btn-primary">
                <i class="bi bi-plus-lg"/>
                Add loan
              </button>
              <button @click="reset" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise"/>
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
import { required } from 'vuelidate/lib/validators'
export default {
  name: "create", //eslint-disable-line
  async asyncData ({ $axios }) {
    const books = await $axios.$get('http://localhost:8000/api/books').then((res) => {
      return res.data
    })
    const members = await $axios.$get('http://localhost:8000/api/users').then((res) => {
      return res.data
    })
    return { books, members }
  },
  data () {
    return {
      book: '',
      member: '',
      date: ''
    }
  },
  validations: {
    book: { required },
    member: { required },
    date: { required }
  },
  methods: {
    addLoan () {
      this.$v.$touch();
      if (!this.$v.$error) {
        const loan = {
          book_id: this.book,
          user_id: this.member,
          due_date: this.date
        }
        this.$store.dispatch('loans/addLoan', loan)
      }
    },
    reset () {
      this.book = ''
      this.member = ''
      this.date = ''
      this.$v.$reset();
    }
  },
  computed: {
    msgBook () {
      let message = '';
      if (!this.$v.book.required) {
        message = 'You must select a book'
      }
      return message;
    },
    msgMember () {
      let message = '';
      if (!this.$v.member.required) {
        message = 'You must select a member'
      }
      return message;
    },
    msgDate () {
      let message = '';
      if (!this.$v.date.required) {
        message = 'You must select a date'
      }
      return message;
    }
  }
}
</script>

<style>
</style>
