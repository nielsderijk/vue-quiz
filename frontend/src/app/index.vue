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
  import HomeTransition from './transitions/home';

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

    methods: {
      getEnter(el, done) {
        window.scrollTo(0, 0);

        switch (this.$route.name) {
          case 'home.index': {
            HomeTransition.enter(el, done);
            break;
          }

          default: {
            HomeTransition.enter(el, done);
            break;
          }
        }
      },

      getLeave(el, done) {
        done();
        // HomeTransition.leave(el, done);
      },
    },



  };
</script>
