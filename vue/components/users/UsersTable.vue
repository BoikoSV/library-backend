<template>
  <div>
    <div v-if="users.length === 0" class="fs-3 text-center py-4">There are no records!</div>
    <table v-else class="table align-middle table-bordered table-hover position-relative">
    <div v-if="load" class="position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-center align-items-center" style="min-height: 100px;background-color: rgba(0, 0, 0, 0.3)">
        <div class="spinner-border text-light" style="height: 5rem; width: 5rem;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <thead>
      <tr class="text-nowrap text-center text-muted">
        <th>Avatar</th>
        <th>
          Email
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>
          Name
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>
          Roles
        </th>
        <th>
          Status
        </th>
        <th>
          Created at
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>--</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>avatar img</td>
        <td>{{ user.email }}</td>
        <td class="text-nowrap">{{ user.name }}</td>
        <td>{{ role(user.role) }}</td>
        <td><span class="badge" :class="status(user.status).class">{{ status(user.status).text }}</span></td>
        <td class="text-nowrap">{{ $moment(user.created_at).format("DD.MM.YY") }}</td>
        <td class="text-nowrap d-flex justify-content-center">
          <nuxt-link :to="`/users/${user.id}`" class="link-primary px-2"><i class="bi bi-eye-fill"></i></nuxt-link>
          <nuxt-link :to="`/users/${user.id}/edit`" class="link-primary px-2"><i class="bi bi-pencil-fill"></i></nuxt-link>
          <button
            @click="$emit('delete', user.id)"
            type="button"
            class="link-danger bg-transparent border-0 px-2"
          >
            <i class="bi bi-trash-fill"></i>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'UsersTable',
  props: {
    users: {
      required: true,
      type: Array
    },
    load: {
      required: true,
      type: Boolean
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
    }
  }
}
</script>

<style scoped>

</style>
