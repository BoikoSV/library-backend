export default {
  setUsers (state, users) {
    state.users = users
  },
  setPaginatorData (state, paginatorData) {
    state.paginator = paginatorData;
  },
  setPage (state, page) {
    state.paginator.current_page = page;
  },
  setFilter (state, filter) {
    state.filter = filter;
  },
  setLoad (state, value) {
    state.load = value
  }
}
