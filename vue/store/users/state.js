export default () => ({
  users: [],
  load: true,
  paginator: {
    current_page: null
  },
  path: 'http://localhost:8000/api/users',
  filter: {}
})
