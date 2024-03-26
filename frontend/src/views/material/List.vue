<template>
  <div class="material-main">
    <el-row class="cd" v-for="(product, i) in productList" :key="i">
      <div class="ce">
        <div class="cf">
          <div class="ck ci cg">
            <div>
              <div class="ch cm">
                <div>{{ product.name }}</div>
              </div>
              <div class="cn co">
                {{ product.content }}
              </div>
              <div class="cq">
                <div class="cr">
                  <span>
                    <el-image style="width: 350px; height: 180px;position: relative; top: 2em;left: 1em;"
                      :src="getImageUrl(product.grade_url)" fit="cover"></el-image>
                  </span>
                </div>
              </div>
            </div>
            <div class="cj">
              <span><img alt="" :src="getImageUrl(product.product_url)"></span>
            </div>
          </div>
        </div>
      </div>
    </el-row>
    <div v-if="isshow">
      <infinite-loading @distance="1" @infinite="handleLoadMore" style="margin-top: 20px;">
        <div slot="spinner">Loading...</div>
        <div slot="no-more">No more message</div>
        <div slot="no-results">No results message</div>
      </infinite-loading>
    </div>
  </div>
</template>
  
<script>
import request from '../../utils/request';

export default {
  computed: {
    searchQuery() {
      return this.$store.state.searchQuery
    },
  },
  watch: {
    // 监听 searchQuery 的变化
    searchQuery: {
      handler: 'getList', // 当 searchQuery 变化时调用 getList 方法
    },
  },
  components: {
  },
  data() {
    return {
      productList: [],
      page: 1,
      isshow: true
    }
  },
  methods: {
    handleLoadMore($state) {
      request({
        method: "GET",
        url: "/api/product",
        params: {
          page: this.page
        }
      }).then((resp) => {
        // console.log(resp)
        if (resp.data.code == 0) {
          this.page = this.page + 1;

          const { data } = resp.data.data
          if (data.length) {
            this.productList.push(...data)
            $state.loaded()
          } else {
            $state.complete()
          }
        }
      });
    },
    getList() {
      if (this.searchQuery) {
        this.productList = []
        this.isshow = false
        request({
          method: "GET",
          url: "/api/product/search",
          params: {
            name: this.searchQuery
          }
        }).then((resp) => {
          // console.log(resp)
          if (resp.data.code == 0) {
            const data = resp.data.data
            if (data.length) {
              this.productList.push(...data)
            }
          }
        });
      } else {
        this.page = 1
        this.productList = []
        this.isshow = true
      }
    }
  }
}
</script>
  
<style lang="scss" scoped>
.material-main {
  width: 100%;
  min-width: 1200px;
  padding-bottom: 20px;
  padding-top: 60px;
  min-height: 80vh;

  .cd .ce {
    --tw-bg-opacity: 1;
    background-color: rgb(255 255 255/var(--tw-bg-opacity));
    display: flex;
    flex-direction: column;
    margin-top: 40px;
    border-radius: 20px;
    padding: 20px .25rem;
    width: 80%;
    margin-left: 10%;
    position: relative;
  }

  .cf {
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    justify-content: center;
    overflow: hidden;
    padding: 1.25rem;
    width: 100%;
  }

  .cd .ck {
    margin: auto;
    max-width: 1280px;
  }

  .cd .ci {
    display: block;
    padding-bottom: 3.75rem;
  }

  .cd .ck .ch {
    display: inline-block;
    font-size: 2.5rem;
    line-height: 3.5rem;
    margin-top: 0;
  }

  .cd .ck .cn {
    font-size: 1rem;
    line-height: 1.5rem;
    margin-bottom: 40px;
    color: rgba(0, 0, 0, .6);
    width: 520px;
  }

  .cd .ck .cr {
    color: rgba(0, 0, 0, .9);
    font-size: 20px;
    font-weight: 500;
    line-height: 28px;
    margin-right: 4px;
  }

  .cd .cj {
    height: auto;
    position: absolute;
    right: 10%;
    top: 5%;
    width: 30%;

    span {
      display: block;
      padding-top: 52.518756698821015%;
    }

    img {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
    }
  }
}
</style>
  