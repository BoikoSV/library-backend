<template>
  <AppPage title="Books">
    <div class="mb-5">
      <nuxt-link :disabled="$store.state.books.load" to="/books/create" tag="button" class="btn btn-primary">
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
    <BooksFilter @filter="filter" @reset="reset" />

    <!--  Table  -->

    <BooksTable @delete="deleteBook" :books="books" :load="$store.state.books.load" />

    <div class="d-flex justify-content-end">
      <AppPaginator
        v-if="$store.state.books.paginator?.last_page > 1"
        :current-page="$store.state.books.paginator.current_page"
        :last-page="$store.state.books.paginator.last_page"
        @changePage="changePage"
      />
    </div>
</AppPage>
</template>

<script>
import BooksTable from '@/components/books/BooksTable';
import AppPaginator from '@/components/AppPaginator';
import BooksFilter from '@/components/books/BooksFilter';

export default {
  name: 'Index', //eslint-disable-line
  components: { AppPaginator, BooksTable, BooksFilter },
  mounted () {
    this.$store.commit('books/setPage', 1)
    this.$store.dispatch('books/fetchBooks')
  },
  beforeDestroy () {
    this.$store.commit('books/setPage', 1)
    this.$store.commit('books/setFilter', {})
  },
  computed: {
    books () {
      return this.$store.state.books.books;
    }
  },
  methods: {
    changePage (e) {
      this.$store.commit('books/setPage', e)
      this.$store.dispatch('books/fetchBooks')
    },
    filter (e) {
      this.$store.commit('books/setFilter', e)
      this.$store.commit('books/setPage', 1)
      this.$store.dispatch('books/fetchBooks')
    },
    reset () {
      this.$store.commit('books/setPage', 1)
      this.$store.commit('books/setFilter', {})
      this.$store.dispatch('books/fetchBooks')
    },
    deleteBook (bookId) {
      this.$store.dispatch('books/deleteBook', bookId).then(() => {
        this.$store.dispatch('books/fetchBooks')
      })
    }
  }
}
</script>

<style scoped>

</style>
