<template>
  <div>
    <nav aria-label="breadcrumb mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <nuxt-link class="link-dark" to="/">Dashboard</nuxt-link>
        </li>
        <li v-if="subTitle" class="breadcrumb-item">
          <nuxt-link class="link-dark" :to="subTitle.path">{{ subTitle.name }}</nuxt-link>
        </li>
        <li class="breadcrumb-item active">{{ title }}</li>
      </ol>
    </nav>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-5">{{ title }}</h4>
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppPage", //eslint-disable-line
  props: {
    title: {
      required: true,
      type: String
    },
    subTitle: {
      type: Object
    }
  }
}
</script>

<style scoped>
.breadcrumb-item a{
  text-decoration: none!important;
  font-weight: 500!important;
  transition: color 0.2s!important;
}
.breadcrumb-item a:hover{
  color: #2f54eb!important;
}
</style>
