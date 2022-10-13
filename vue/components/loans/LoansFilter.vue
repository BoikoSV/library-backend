<template>
  <form @submit.prevent class="card border mb-4">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <label for="book" class="form-label">Book</label>
          <input v-model.trim="filter.book" id="book" type="text" class="form-control">
        </div>
        <div class="col">
          <label for="member" class="form-label">Member</label>
          <input v-model.trim="filter.member" id="member" type="text" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label for="date" class="form-label">From date</label>
          <input v-model.trim="filter.date" id="date" type="date" class="form-control">
        </div>
        <div class="col">
          <label for="due-date" class="form-label">To due date</label>
          <input v-model.trim="filter.dueDate" id="due-date" type="date" class="form-control">
        </div>
      </div>
      <div class="d-flex justify-content-end gap-2">
        <button v-if="$store.state.loans.load" class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          <span>Loading...</span>
        </button>
        <button v-else @click="filtered" class="btn btn-primary">
          <i class="bi bi-search" />
          Search
        </button>
        <button @click="reset" class="btn btn-outline-secondary">
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
        book: '',
        member: '',
        date: '',
        returnDate: '',
        dueDate: ''
      }
    }
  },
  methods: {
    filtered () {
      this.$emit('filter', { ...this.filter })
    },
    reset () {
      this.filter.book = ''
      this.filter.member = ''
      this.filter.date = ''
      this.filter.returnDate = ''
      this.filter.status = ''
      this.filter.dueDate = ''
      this.$emit('reset')
    }
  }
}
</script>

<style scoped>

</style>
