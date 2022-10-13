export default {
  fetchUsers ({ commit, state }) {
    commit('setLoad', true)
    const params = {}
    params.page = state.paginator?.current_page
    if (state.filter?.email) { params.email = state.filter?.email }
    if (state.filter?.name) { params.name = state.filter?.name }
    if (state.filter?.status) { params.status = state.filter?.status }
    if (state.filter?.role) { params.role = state.filter?.role }
    if (state.filter?.createdfrom) { params.createdfrom = state.filter?.createdfrom }
    if (state.filter?.createdto) { params.createdto = state.filter?.createdto }
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
      commit('setUsers', data)
      commit('setPaginatorData', paginatorData)
      commit('setLoad', false)
    })
  },
  addUser({}, user) { //eslint-disable-line
    this.$axios.post('http://localhost:8000/api/users', user)
      .then((res) => {
        this.$router.push('/users')
      })
  },
  updateUser({}, user) { //eslint-disable-line
    this.$axios.patch(`http://localhost:8000/api/users/${user.id}`, user)
      .then((res) => {
        this.$router.push('/users')
      })
  },
  deleteUser({ commit }, userId) { //eslint-disable-line
    commit('setLoad', true)
    return this.$axios.delete(`http://localhost:8000/api/users/${userId}`)
  }
}
