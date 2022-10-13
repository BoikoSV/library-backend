<template>
  <div class="row vh-100 gx-0">
    <AppAside />
    <div class="col bg-light">
      <nav class="navbar bg-body">
        <div class="container-fluid">
          <button data-bs-toggle="collapse" data-bs-target="#toggleMenu" class="border-0 bg-transparent fs-5">
<!--            eslint-disable-next-line -->
            <i class="bi bi-justify"></i>
          </button>
        </div>
      </nav>
      <main class="p-3">
        <nuxt />
      </main>
    </div>
  </div>
</template>

<script>
import AppAside from '@/components/AppAside';
export default {
  name: "default", //eslint-disable-line
  components: { AppAside },
  data () {
    return {
      bsCollapse: null
    }
  },
  mounted () {
    this.bsCollapse = new window.bootstrap.Collapse('#toggleMenu', {
      toggle: true
    })
  }
}
</script>

<style scoped></style>
