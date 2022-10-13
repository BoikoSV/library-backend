<template>
  <div>
    <div v-if="loans.length === 0" class="fs-3 text-center py-4">There are no records!</div>
    <table v-else class="table align-middle table-bordered table-hover position-relative">
      <div v-if="load" class="position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-center align-items-center" style="min-height: 100px;background-color: rgba(0, 0, 0, 0.3)">
        <div class="spinner-border text-light" style="height: 5rem; width: 5rem;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <thead>
      <tr class="text-nowrap text-center text-muted">
        <th>Book</th>
        <th>Member</th>
        <th>
          Date
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>
          Due date
          <i class="bi bi-caret-down-fill" />
        </th>
        <th>--</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="loan in loans" :key="loan.id">
        <td><nuxt-link :to="`/books/${loan.book_id}`">{{ `${loan.title} - ${loan.author}` }}</nuxt-link></td>
        <td><nuxt-link :to="`/users/${loan.user_id}`">{{ `${loan.name} - ${loan.email}` }}</nuxt-link></td>
        <td class="text-nowrap">{{ $moment(loan.created_at).format("DD.MM.YY") }}</td>
        <td class="text-nowrap fs-6">{{ $moment(loan.due_date).format("DD.MM.YY") }}</td>
        <td class="text-nowrap d-flex justify-content-center">
          <nuxt-link :to="`/loans/${loan.id}`" class="link-primary px-2"><i class="bi bi-eye-fill"></i></nuxt-link>
          <nuxt-link :to="`/loans/${loan.id}/edit`" class="link-primary px-2"><i class="bi bi-pencil-fill"></i></nuxt-link>
          <button
            @click="$emit('delete', loan.id)"
            type="button"
            class="link-danger bg-transparent border-0 px-2"
          >
            <i class="bi bi-trash-fill"></i>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  name: 'LoansTable',
  props: {
    loans: {
      required: true,
      type: Array
    },
    load: {
      required: true,
      type: Boolean
    }
  }
}
</script>

<style scoped>

</style>
