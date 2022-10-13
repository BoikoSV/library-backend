export default {
  fetchLoans ({ commit, state }) {
    commit('setLoad', true)
    const params = {}
    params.page = state.paginator?.current_page
    if (state.filter?.book) { params.book = state.filter?.book }
    if (state.filter?.member) { params.member = state.filter?.member }
    if (state.filter?.date) { params.created_at = state.filter?.date }
    if (state.filter?.returnDate) { params.return_date = state.filter?.returnDate }
    if (state.filter?.dueDate) { params.due_date = state.filter?.dueDate }
    if (state.filter?.status) { params.status = state.filter?.status }

    this.$axios.$get(state.path, {
      params
    }).then(({ data, meta }) => {
      const paginatorData = {
        current_page: meta.current_page,
        from: meta.from,
        last_page: meta.last_page,
        per_page: meta.per_page,
        to: meta.to,
        total: meta.total
      }

      commit('setLoans', data)
      commit('setPaginatorData', paginatorData)
      commit('setLoad', false)
    })
  },
  addLoan({}, loan) { //eslint-disable-line
    this.$axios.post('http://localhost:8000/api/loans', loan)
      .then((res) => {
        this.$router.push('/loans')
      })
  },
  updateLoan({}, loan) { //eslint-disable-line
    this.$axios.patch(`http://localhost:8000/api/loans/${loan.id}`, loan)
      .then((res) => {
        this.$router.push('/loans')
      })
  },
  deleteLoan({ commit }, loanId) { //eslint-disable-line
    commit('setLoad', true)
    return this.$axios.delete(`http://localhost:8000/api/loans/${loanId}`)
  }
}
