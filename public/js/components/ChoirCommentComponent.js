
// import Vue from 'vue';

export default Vue.component('choir-comment', {
  template: '<div><div>{{ currentChoir }}</div><textarea v-model="currentComment"></textarea><button @click="save()">Save Comment</button></div>',
  props: ['comment', 'choir'],
  data: function () {
    return {
      currentChoir: this.choir,
      currentComment: this.comment
    }
  },
  methods: {
    save: function () {
      console.log(this.currentComment)
    }
  }
})
