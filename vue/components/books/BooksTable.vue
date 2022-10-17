<template>
  <div>
    <div v-if="books.length === 0" class="fs-3 text-center py-4">There are no records!</div>
    <table v-else class="table align-middle table-bordered table-hover position-relative">
      <div v-if="load" class="position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-center align-items-center" style="min-height: 100px;background-color: rgba(0, 0, 0, 0.3)">
        <div class="spinner-border text-light" style="height: 5rem; width: 5rem;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <thead>
      <tr class="text-nowrap text-center text-muted">
        <th>Cover</th>
        <th>ISBN</th>
        <th>
          Title
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>
          Author
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>
          Status
        </th>
        <th>--</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="book in books" :key="book.id">
        <td class="d-flex d-flex justify-content-center align-items-center">
          <div v-if="book.image" class="d-flex m-auto">
            <img style="width: 3rem;height: 3rem;object-fit: contain;" :src="`http://localhost:8000/storage/${book.image}`" alt="" class="m-auto">
          </div>
          <div v-else class="bg-light d-flex rounded-circle" style="width: 3rem;height: 3rem;">
            <i class="bi bi-book-fill m-auto fs-4 text-muted" />
          </div>
        </td>
        <td>{{ book.isbn }}</td>
        <td>{{ book.title }}</td>
        <td>{{ book.author }}</td>
        <td class="text-center" v-html="status(book.status)" />
        <td class="text-nowrap">
          <div class="d-flex justify-content-center align-items-center">
            <nuxt-link :to="`/books/${book.id}`" class="link-primary px-2"><i class="bi bi-eye-fill" /></nuxt-link>
            <nuxt-link :to="`/books/${book.id}/edit`" class="link-primary px-2"><i class="bi bi-pencil-fill" /></nuxt-link>
            <button
              type="button"
              class="link-danger bg-transparent border-0 px-2"
              @click="$emit('delete', book.id)"
            >
              <i class="bi bi-trash-fill" />
            </button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'BooksTable',
  props: {
    books: {
      required: true,
      type: Array
    },
    load: {
      required: true,
      type: Boolean
    }
  },
  methods: {
    status (statusId) {
      if (statusId === 0) {
        return '<span class="badge text-bg-danger">Unavailable</span>';
      }
      if (statusId === 1) {
        return '<span class="badge text-bg-success">Available</span>';
      }
    }
  }
}
</script>

<style scoped>

</style>
