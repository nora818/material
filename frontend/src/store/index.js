import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

// 全局 state 对象，用于保存所有组件的公共数据
const state = {
  user: null,
  searchQuery: ''
};


// 实时监听 state 值的最新状态，注意这里的 getters 可以理解为计算属性
const getters = {
  // 在组件中是通过 this.$store.getters.getUser 来获取
  getUser(state) {
    return state.user;
  },
  isLogged: state => !!state.user,
  getSearch(state) {
    return state.searchQuery;
  },
};

// 定义改变 state 初始值的方法，这里是唯一可以改变 state 的地方，缺点是只能同步执行
const mutations = {
  // 在组件中是通过 this.$store.commit('updateUser', user); 方法来调用 mutations
  updateUser(state, user) {
    state.user = user;
    localStorage.setItem('state', JSON.stringify(state))
  },
  clearUserData(state) {
    state.user = null
    localStorage.setItem('state', JSON.stringify(state))
    localStorage.removeItem('token')
    location.reload()
  },
  setSearchQuery(state, query) {
    state.searchQuery = query
  }
};

// 定义触发 mutations 里函数的方法，可以异步执行 mutations 里的函数
const actions = {
  // 在组件中是通过 this.$store.dispatch('asyncUpdateUser', user); 来调用 actions
  asyncUpdateUser(context, user) {
    context.commit('updateUser', user);
  },
  logout({ commit }) {
    commit('clearUserData')
  }
};

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions
});
