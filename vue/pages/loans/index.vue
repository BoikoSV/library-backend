<template>
  <AppPage title="Loans">
    <div class="mb-5">
      <nuxt-link :disabled="$store.state.loans.load" to="/loans/create" tag="button" class="btn btn-primary">
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
    <LoansFilter @filter="filter" @reset="reset" />

<!--  Table  -->

    <LoansTable :loans="loans" :load="$store.state.loans.load" @delete="deleteLoan" />

    <div class="d-flex justify-content-end">
      <AppPaginator
        v-if="$store.state.loans.paginator?.last_page > 1"
        :current-page="$store.state.loans.paginator.current_page"
        :last-page="$store.state.loans.paginator.last_page"
        @changePage="changePage"
      />
    </div>
</AppPage>
</template>

<script>
import AppPage from '@/components/AppPage';
import LoansTable from '@/components/loans/LoansTable';
import LoansFilter from '@/components/loans/LoansFilter'
export default {
  name: 'index', //eslint-disable-line
  components: { AppPage, LoansTable, LoansFilter },
  computed: {
    loans () {
      return this.$store.state.loans.loans;
    }
  },
  mounted () {
    this.$store.dispatch('loans/fetchLoans')
  },
  beforeDestroy () {
    this.$store.commit('loans/setPage', 1)
    this.$store.commit('loans/setFilter', {})
  },
  methods: {
    changePage (e) {
      this.$store.commit('loans/setPage', e)
      this.$store.dispatch('loans/fetchLoans')
    },
    filter (e) {
      this.$store.commit('loans/setFilter', e)
      this.$store.commit('loans/setPage', 1)
      this.$store.dispatch('loans/fetchLoans')
    },
    reset () {
      this.$store.commit('loans/setPage', 1)
      this.$store.commit('loans/setFilter', {})
      this.$store.dispatch('loans/fetchLoans')
    },
    deleteLoan (loanId) {
      this.$store.dispatch('loans/deleteLoan', loanId).then(() => {
        this.$store.dispatch('loans/fetchLoans')
      })
    }
  }
}
</script>

<style scoped>

</style>
