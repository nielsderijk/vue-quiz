export default {
  /*
   * Data
   */
  data() {
    return {
      isInView: false,
      isOnTop: false,
      isFixed: false,
    };
  },

  /*
   * Mounted
   * Add scroll listener
   */
  mounted() {
    window.addEventListener('scroll', this.handleScroll, false);
    this.handleScroll();
  },

  /*
   * Methods
   */
  methods: {
    handleScroll() {
      // Overwrite this in your component.
    },

    inView(element) {
      const rect = element.getBoundingClientRect();

      return (
        rect.bottom > -5 &&
        rect.top < (window.innerHeight || document.documentElement.clientHeight)
      );
    },

    onTop(element) {
      const rect = element.getBoundingClientRect();

      return (
        rect.top <= 5
      );
    },

    fixed(element) {
      const rect = element.getBoundingClientRect();

      return (
        rect.top + element.clientHeight <= 0
      );
    },
  },

  /*
   * beforeDestroy
   */
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll, false);
  },
};
