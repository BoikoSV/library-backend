<template>
  <nav class="navigation">
    <paginate
      :value="currentPage"
      :click-handler="changePage"
      :page-count="lastPage"
      :margin-pages="2"
      :page-range="3"
      :prev-text="'Prev'"
      :next-text="'Next'"
      :container-class="'pagination'"
      :page-class="'page-item'"
      page-link-class="page-link"
      prev-link-class="page-link"
      next-link-class="page-link"
    >
    </paginate>
  </nav>
</template>

<script>
export default {
  name: "AppPaginator", //eslint-disable-line
  props: ['current-page', 'last-page'],
  methods: {
    changePage (e) {
      this.$emit('changePage', e)
    }
  }
}
</script>

<style scoped>

</style>
