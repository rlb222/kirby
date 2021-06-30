export default {
  inheritAttrs: false,
  props: {
    blueprint: String,
    column: String,
    parent: String,
    name: String,
    timestamp: Number,
    data: Array,
    options: Object,
    pagination: Object
  },
  data() {
    return {
      isProcessing: false,
    };
  },
  computed: {
    headline() {
      return this.options.headline || " ";
    },
    help() {
      return this.options.help;
    },
    isInvalid() {
      if (this.options.min && this.data.length < this.options.min) {
        return true;
      }

      if (this.options.max && this.data.length > this.options.max) {
        return true;
      }

      return false;
    }
  },
  methods: {
    items(data) {
      return data;
    },
    paginate(pagination) {
      this.$reload({
        query: {
          [`${this.name}[page]`]: pagination.page
        }
      });
    }
  }
};
