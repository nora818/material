<template>
    <div class="header-main">
        <div class="box">
            <div class="logo">
                <router-link to="/home" tag="a">
                    <img src="@/assets/images/ELOGO.png" alt="logo">
                </router-link>
            </div>
            <ul>
                <li>
                    <router-link to="/home" tag="a">Home page</router-link>
                </li>
                <li>
                    <router-link to="/material" tag="a">Material details</router-link>
                </li>
                <li>
                    <router-link to="/score" tag="a">Grading system</router-link>
                </li>
                <li>
                    <router-link to="/shequ" tag="a">Community</router-link>
                </li>
            </ul>

            <div class="search">
                <el-input v-model="searchText" placeholder="Search" prefix-icon="el-icon-search"
                    @keyup.enter.native="searchMaterial" @input="handleEmpty"></el-input>
            </div>

            <ul class="user" v-if="!isLogged">
                <li>
                    <router-link to="/login" tag="a" class="user-link">Login</router-link>
                </li>
                <li>
                    <router-link to="/register" tag="a"><el-button class="user-button" type="primary">Register
                            <i class="el-icon-right"></i></el-button></router-link>
                </li>
            </ul>
            <ul class="user" v-else>
                <li>
                    <router-link to="/profile" tag="a" class="user-link">{{ getUser.name }}</router-link>
                </li>
                <li>
                    <el-button class="user-button" type="primary" @click="logout()">Logout
                        <i class="el-icon-right"></i></el-button>
                </li>
            </ul>
        </div>
    </div>
</template>
  
<script>
import { mapGetters } from 'vuex'
import request from '../../utils/request'

export default {
    name: "HeaderMain",
    computed: {
        ...mapGetters([
            'isLogged',
            'getUser'
        ])
    },
    data() {
        return {
            profile: false,
            searchText: ""
        }
    },
    methods: {
        logout() {
            // 请求退出接口
            request({
                method: "GEt",
                url: "/api/logout",
            }).then((resp) => {
                if (resp.data.code == 0) {
                    this.$message({
                        message: 'Logout successfully',
                        type: 'success'
                    });
                    this.$store.dispatch('logout')
                }
            })
        },
        searchMaterial() {
            this.$store.commit('setSearchQuery', this.searchText)
            if (this.$route.path !== '/material') {
                this.$router.push('/material');
            }
        },
        handleEmpty() {
            if (this.$route.path == '/material') {
                if (this.searchText == "") {
                    this.$store.commit('setSearchQuery', this.searchText)
                }
            }
        }
    },
}
</script>
  
<style scoped lang="less">
.header-main {
    width: 100%;
    height: 65px;
    background-color: #fff;
    min-width: 1200px;
    box-shadow: 0 5px 40px rgba(2, 10, 18, 0.1);
    position: fixed;
    z-index: 100;

    .box {
        margin: 0 5%;
        height: 100%;
        display: flex;

        .logo {
            height: 100%;
            padding: 0 10px;
            display: flex;
            align-items: center;

            img {
                width: 110px;
            }
        }

        ul {
            // flex: 1;
            width: 800px;
            display: flex;
            padding-left: 10px;
            justify-content: space-around;

            li {
                padding: 10px 10px;
                height: 100%;
                display: flex;
                align-items: center;
                white-space: nowrap;

                .router-link-active {
                    color: #FA2800;
                }
            }
        }

        .search {
            display: flex;
            align-items: center;
            margin-left: 200px;
            width: 350px;

            i {
                padding: 3px 15px;
                font-size: 18px;
                cursor: pointer;
                border-right: 2px solid #e1e1e1;
            }
        }

        .user {
            display: flex;
            justify-content: end;
            margin-right: 2px;

            a {
                cursor: pointer;
                text-decoration: none;
                color: #00AAFF;
            }

            .user-link {
                font-size: 17px;
            }

            .user-button {
                line-height: 48px;
                height: 48px;
                padding: 0 30px;
                font-size: 17px;
                border-radius: 20px;
                background-color: #00AAFF;
                box-shadow: 0 10px 30px -10px #00AAFF;
                color: white;

                i {
                    margin-left: 3px;
                    height: 17px;
                    font-size: 17px;
                    font-weight: 800;
                }
            }
        }
    }
}
</style>
  