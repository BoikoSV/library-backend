<template>
  <AppPage title="Users">
    <div class="mb-5">
      <nuxt-link :disabled="$store.state.users.load" to="/users/create" tag="button" class="btn btn-primary">
        <i class="bi bi-plus-lg" />
        New
      </nuxt-link>
      <button class="btn btn-primary">
        <i class="bi bi-upload" />
        Import
      </button>
      <button class="btn btn-outline-secondary">
        <i class="bi bi-clock-history" />
        Audit Logs
      </button>
      <button class="btn btn-outline-secondary">
        <i class="bi bi-file-earmark-excel" />
        Export to Excel
      </button>
    </div>

    <!--  Forms  -->
    <UsersFilter @filter="filter" @reset="reset" />

    <!--  Table  -->
    <UsersTable :users="users" :load="$store.state.users.load" @delete="deleteUser" />

    <div class="d-flex justify-content-end">
      <AppPaginator
        v-if="$store.state.users.paginator?.last_page > 1"
        :current-page="$store.state.users.paginator.current_page"
        :last-page="$store.state.users.paginator.last_page"
        @changePage="changePage"
      />
    </div>
</AppPage>
</template>

<script>
import UsersTable from '@/components/users/UsersTable';
import UsersFilter from '@/components/users/UsersFilter';
export default {
  name: "index", //eslint-disable-line
  components: { UsersFilter, UsersTable },
  computed: {
    users () {
      return this.$store.state.users.users;
    }
  }, //eslint-disable-line
  mounted () {
    this.$store.commit('users/setPage', 1)
    this.$store.dispatch('users/fetchUsers')
  },
  beforeDestroy () {
    this.$store.commit('users/setPage', 1)
  },
  methods: {
    changePage (e) {
      console.log(e)
      this.$store.commit('users/setPage', e)
      this.$store.dispatch('users/fetchUsers')
    },
    filter (e) {
      this.$store.commit('users/setFilter', e)
      this.$store.commit('users/setPage', 1)
      this.$store.dispatch('users/fetchUsers')
    },
    reset () {
      this.$store.commit('users/setPage', 1)
      this.$store.commit('users/setFilter', {})
      this.$store.dispatch('users/fetchUsers')
    },
    deleteUser (userId) {
      this.$store.dispatch('users/deleteUser', userId).then(() => {
        this.$store.dispatch('users/fetchUsers')
      })
    }
  }
}
</script>

<style scoped>

</style>
