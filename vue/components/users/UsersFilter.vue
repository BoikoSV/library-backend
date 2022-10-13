<template>
  <form @submit.prevent class="card border mb-4">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <label for="created-from" class="form-label">Created at - from</label>
          <input v-model="filter.createdfrom" id="created-from" type="date" class="form-control">
        </div>
        <div class="col">
          <label for="created-to" class="form-label">Created at - to</label>
          <input v-model="filter.createdto" id="created-to" type="date" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label for="email" class="form-label">Email</label>
          <input v-model="filter.email" id="email" type="text" class="form-control">
        </div>
        <div class="col">
          <label for="name" class="form-label">Name</label>
          <input v-model="filter.name" id="name" type="text" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label for="status" class="form-label">Status</label>
          <select v-model="filter.status" id="status" class="form-select">
            <option value="">Select the status</option>
            <option value="1">Enabled</option>
            <option value="0">Disabled</option>
          </select>
        </div>
        <div class="col">
          <label for="role" class="form-label">Role</label>
          <select v-model="filter.role" id="role" class="form-select">
            <option value="">Select the role</option>
            <option value="1">Librarian</option>
            <option value="0">Member</option>
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-end gap-2">
        <button v-if="$store.state.users.load" class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          <span>Loading...</span>
        </button>
        <button v-else @click="filtered" class="btn btn-primary">
          <i class="bi bi-search" />
          Search
        </button>
        <button @click="reset" :disabled="$store.state.users.load" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-counterclockwise" />
          Reset
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "UsersFilter", //eslint-disable-line
  data () {
    return {
      filter: {
        email: '',
        name: '',
        status: '',
        role: '',
        createdfrom: '',
        createdto: ''
      }
    }
  },
  methods: {
    filtered () {
      this.$emit('filter', { ...this.filter })
    },
    reset () {
      this.filter.email = ''
      this.filter.name = ''
      this.filter.status = ''
      this.filter.role = ''
      this.filter.createdfrom = ''
      this.filter.createdto = ''
      this.$emit('reset')
    }
  }
}
</script>

<style scoped>

</style>
