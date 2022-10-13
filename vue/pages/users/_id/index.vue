<template>
  <AppPage title="View user" :sub-title="{name: 'Users', path: '/users'}">
    <div class="row">
      <div class="col">
        <nuxt-link :to="`/users/${user?.id}/edit`" :disabled="!loaded" tag="button" class="btn btn-primary">
          <i class="bi bi-pencil-fill"></i>
          Edit
        </nuxt-link>
        <button @click="deleteUser" class="btn btn-primary" :disabled="!loaded">
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
          <div class="w-25 text-end">Name</div>
          <div class="fw-bolder">{{ user.name }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Email</div>
          <div class="fw-bolder">{{ user.email }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Role</div>
          <div class="fw-bolder">{{ role(user.role) }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Status</div>
          <div><span class="badge" :class="status(user.status).class">{{ status(user.status).text }}</span></div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Created at</div>
          <div class="fw-bolder">{{ formatDate(user.created_at) }}</div>
        </div>
        <div class="d-flex gap-4 mb-5 fs-5">
          <div class="w-25 text-end">Updated at</div>
          <div class="fw-bolder">{{ formatDate(user.updated_at) }}</div>
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
    this.getUsers();
  },
  data () {
    return {
      user: null,
      loaded: false
    }
  },
  methods: {
    role (roleId) {
      if (roleId === 0) {
        return 'Member'
      } else {
        return 'Librarian'
      }
    },
    status (statusId) {
      if (statusId === 0) {
        return { class: 'text-bg-danger', text: 'Disabled' }
      } else {
        return { class: 'text-bg-success', text: 'Enabled' }
      }
    },
    getUsers () {
      this.$axios.get(`http://localhost:8000/api/users/${this.$route.params.id}`)
        .then((res) => {
          this.user = res.data.data
          this.loaded = true
        })
    },
    formatDate (date) {
      return moment(date).format('YYYY-MM-DD')
    },
    deleteUser () {
      this.$store.dispatch('users/deleteUser', this.user.id).then(() => {
        this.$router.push('/users')
      })
    }
  }
}
</script>

<style scoped>

</style>
