<template>
  <AppPage title="View loan" :sub-title="{name: 'Loans', path: '/loans'}">
    <div class="row">
      <div class="col">
        <nuxt-link :to="`/loans/${loan?.id}/edit`" :disabled="!loaded" tag="button" class="btn btn-primary">
          <i class="bi bi-pencil-fill"></i>
          Edit
        </nuxt-link>
        <button @click="deleteLoan" class="btn btn-primary" :disabled="!loaded">
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
          <div class="w-25 text-end">Book</div>
          <nuxt-link :to="`/books/${book.id}`" class="fw-bolder text-decoration-none">{{ `${book.title} - ${book.author} - ${book.isbn}` }}</nuxt-link>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Member</div>
          <nuxt-link :to="`/users/${user.id}`" class="fw-bolder text-decoration-none">{{ `${user.name} <${user.email}>` }}</nuxt-link>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Due date</div>
          <div class="fw-bolder">{{ formatDate(loan.due_date) }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Created at</div>
          <div class="fw-bolder">{{ formatDate(loan.created_at) }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Updated at</div>
          <div class="fw-bolder">{{ formatDate(loan.updated_at) }}</div>
        </div>
      </div>
    </div>
  </AppPage>
</template>

<script>
import moment from 'moment';
export default {
  name: "show", //eslint-disable-line
  mounted () {
    this.getLoans();
  },
  data () {
    return {
      loan: null,
      book: null,
      user: null,
      loaded: false
    }
  },
  methods: {
    async getLoans () {
      await this.$axios.get(`http://localhost:8000/api/loans/${this.$route.params.id}`)
        .then((res) => {
          this.loan = res.data.data
        })
      const book = this.$axios.get(`http://localhost:8000/api/books/${this.loan.book_id}`)
        .then((res) => {
          this.book = res.data.data
        })
      const user = this.$axios.get(`http://localhost:8000/api/users/${this.loan.user_id}`)
        .then((res) => {
          this.user = res.data.data
        })
      await Promise.all([book, user]).then(() => {
        this.loaded = true
      })
    },
    formatDate (date) {
      return moment(date).format('YYYY-MM-DD')
    },
    deleteLoan () {
      this.$store.dispatch('loans/deleteLoan', this.loan.id).then(() => {
        this.$router.push('/loans')
      })
    }
  }
}
</script>

<style scoped>

</style>
