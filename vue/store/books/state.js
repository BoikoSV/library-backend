export default () => ({
  books: [],
  load: true,
  paginator: {
    current_page: null
  },
  path: 'http://localhost:8000/api/books',
  filter: {},
  currentBook: {
    id: null,
    isbn: null,
    title: null,
    author: null,
    status: null
  }
})
