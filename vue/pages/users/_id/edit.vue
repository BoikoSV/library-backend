<template>
  <AppPage title="Edit user" :sub-title="{name: 'Users', path: '/users'}">
    <div class="row">
      <div class="col-6">
        <form @submit.prevent class="card border mb-4">
          <div class="card-body">
            <div class="row mb-3">
              <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input
                  :class="{ 'is-invalid': $v.user.email.$error, 'is-valid': !$v.user.email.$invalid }"
                  v-model="user.email"
                  @blur="$v.user.email.$touch"
                  id="email"
                  type="email"
                  class="form-control"
                >
                <div class="invalid-feedback" v-if="$v.user.email.$error">{{ msgEmail }}</div>
              </div>
              <div class="mb-4">
                <label for="name" class="form-label">Name</label>
                <input
                  :class="{ 'is-invalid': $v.user.name.$error, 'is-valid': !$v.user.name.$invalid }"
                  v-model="user.name"
                  @blur="$v.user.name.$touch"
                  id="name"
                  type="text"
                  class="form-control"
                >
                <div class="invalid-feedback" v-if="$v.user.name.$error">{{ msgName }}</div>
              </div>
              <div class="mb-4">
                <label for="role" class="form-label">Role</label>
                <select
                  name="role"
                  id="role"
                  class="form-control"
                  :class="{ 'is-invalid': $v.user.role.$error, 'is-valid': !$v.user.role.$invalid }"
                  v-model="user.role"
                  @change="$v.user.role.$touch"
                >
                  <option value="0">Member</option>
                  <option value="1">Librarian</option>
                </select>
                <div class="invalid-feedback" v-if="$v.user.role.$error">{{ msgRole }}</div>
              </div>
              <div class="mb-4">
                <label for="role" class="form-label">Status</label>
                <select
                  name="status"
                  id="status"
                  class="form-control"
                  :class="{ 'is-invalid': $v.user.status.$error, 'is-valid': !$v.user.status.$invalid }"
                  v-model.number="user.status"
                  @change="$v.user.status.$touch"
                >
                  <option value="0">Disabled</option>
                  <option value="1">Enabled</option>
                </select>
                <div class="invalid-feedback" v-if="$v.user.status.$error">{{ msgStatus }}</div>
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button v-if="false" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span>Loading...</span>
              </button>
              <button @click="updateUser" v-else class="btn btn-primary">
                <i class="bi bi-check-circle"></i>
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </AppPage>
</template>

<script>
import { required, email, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
  name: "edit", //eslint-disable-line
  async asyncData ({ $axios, route }) {
    const user = await $axios.$get(`http://localhost:8000/api/users/${route.params.id}`)
      .then((res) => {
        return res.data
      })
    return { user }
  },
  data () {
    return {
      user: {
        email: '',
        name: '',
        role: 0,
        status: 0
      }
    }
  },
  validations: {
    user: {
      email: { required, email },
      name: { required, minLength: minLength(5), maxLength: maxLength(250) },
      role: { required },
      status: { required }
    }
  },
  methods: {
    updateUser () {
      this.$v.$touch();
      if (!this.$v.$error) {
        this.$store.dispatch('users/updateUser', this.user)
      }
    }
  },
  computed: {
    msgEmail () {
      let message = '';
      if (!this.$v.user.email.required) {
        message = 'The field Email is required'
      }
      if (!this.$v.user.email.email) {
        message = 'The input must be valid email'
      }
      return message;
    },
    msgName () {
      let message = '';
      if (!this.$v.user.name.required) {
        message = 'The field name is required'
      }
      if (!this.$v.user.name.minLength) {
        message = 'The field must have min 5 symbols'
      }
      if (!this.$v.user.name.maxLength) {
        message = 'The field must be max 250 symbols'
      }
      return message;
    },
    msgRole () {
      let message = '';
      if (!this.$v.user.role.required) {
        message = 'The field Role is required'
      }
      return message;
    },
    msgStatus () {
      let message = '';
      if (!this.$v.user.status.required) {
        message = 'The field Status is required'
      }
      return message;
    }
  }
}
</script>

<style>
</style>
