import Vue from 'vue'
import App from './App'
import router from './router'
import store from "./store"

Vue.config.productionTip = false

// 使用 element ui
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading);

import ImageUrlPlugin from './plugins/ImageUrl'
Vue.use(ImageUrlPlugin);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})