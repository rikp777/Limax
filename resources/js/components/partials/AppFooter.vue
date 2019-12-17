<template>
  <section class="app-footer">
    <footer class="footer">
      <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{ new Date().getFullYear() }} <a href="http://www.limax.nl" target="_blank" style="color: #eb5b65">Limax</a>. All rights reserved.</span>
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Made by <a href="https://www.linkedin.com/in/tomvvegchel/" target="_blank" style="color: #eb5b65">Tom van Vegchel</a> & <a href="http://www.linkedin.com/in/rikpeeters-nl" target="_blank" style="color: #eb5b65">Rik Peeters</a>.</span>
        <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <font-awesome-icon icon="heart" style="color: #eb5b65"></font-awesome-icon></span>
      </div>
    </footer>
  </section>

</template>

<script lang="js">
export default {
  name: 'app-footer'
}
</script>

<style scoped lang="scss">
.app-footer {

}
</style>
