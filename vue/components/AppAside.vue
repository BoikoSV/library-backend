<template>
  <aside id="toggleMenu" class="aside col-2 min-vh-100 collapse-horizontal collapse bg-dark text-white">
<!--  User image  -->
    <div class="mt-3 d-flex justify-content-center">
      <div class="aside__user-image bg-light text-muted d-flex rounded-circle">
        <span class="m-auto d-flex text-nowrap">No image</span>
      </div>
    </div>

<!--  Menu  -->
    <ul class="nav nav-pills flex-column text-nowrap mt-4">
      <li v-for="link in links" :key="link.path" class="nav-item">
        <nuxt-link :to="{path: link.path}" active-class="active" class="nav-link link-light">
          <i :class="link.icon" />
          {{ link.text }}
        </nuxt-link>
      </li>
    </ul>
  </aside>
</template>

<script>
export default {
  name: 'AppAside',
  data () {
    return {
      links: [
        { text: 'Audit Logs', path: '/audit', icon: 'bi bi-clock-history' },
        { text: 'Settings', path: '/settings', icon: 'bi bi-sliders' },
        { text: 'Users', path: '/users', icon: 'bi bi-people' },
        { text: 'Loans', path: '/loans', icon: 'bi bi-journal-text' },
        { text: 'Books', path: '/books', icon: 'bi bi-book' }
      ]
    }
  }
}
</script>

<style>
.aside__user-image {
  width: 90px;
  height: 90px;
}
.nav-item{
  transition: background-color 0.2s
}
.aside .nav-item .active{
  border-radius: 0;
}
.nav-item:hover{
  background-color: #0d6efd7d;
}
</style>
