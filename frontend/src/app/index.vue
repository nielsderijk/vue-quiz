<template>
  <router-view></router-view>
</template>
<script>

  /* ============
   * Entry Point
   * ============
   *
   * The entry point of the application
   */

  import store from './store';
  import { router } from './../bootstrap';

  export default {
    /**
     * The Vuex store
     */
    store,

    /**
     * The router
     */
    router,

    /**
     * Fires when the app has been mounted
     */
    mounted() {

    },
  };
</script>
