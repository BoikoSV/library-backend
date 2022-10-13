export default {
  setBooks (state, books) {
    state.books = books
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
  },
  setBook (state, book) {
    state.currentBook.id = book.id;
    state.currentBook.title = book.title;
    state.currentBook.isbn = book.isbn;
    state.currentBook.status = book.status;
    state.currentBook.author = book.author;
  }
}
