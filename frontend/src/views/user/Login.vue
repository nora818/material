<template>
    <div class="login-main">
        <el-row class="form-main">
            <div class="title">
                <h3 class="login-title">Welcome to login</h3>
            </div>
            <el-form :model="form" :rules="rules" ref="form" label-width="80px">
                <el-form-item label="Username" prop="name">
                    <el-input v-model="form.name" placeholder="Please enter a username"></el-input>
                </el-form-item>

                <el-form-item label="Password" prop="password">
                    <el-input v-model="form.password" placeholder="Please enter a password"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit()">Login</el-button>
                </el-form-item>
            </el-form>
        </el-row>
    </div>
</template>

<script>
import request from '@/utils/request'

export default {
    name: "Login",
    data() {
        return {
            form: {
                name: '',
                password: '',
            },
            rules: {
                name: [
                    { required: true, message: 'Please enter a username', trigger: 'blur' },
                    { min: 3, max: 10, message: 'Lengths range from 3 to 10 characters', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: 'Please enter your password', trigger: 'blur' },
                    { min: 6, max: 20, message: 'The length is between 6 and 20 characters', trigger: 'blur' }
                ],
            }
        }
    },
    methods: {
        onSubmit() {
            this.$refs["form"].validate((valid) => {
                if (valid) {
                    request({
                        method: "POST",
                        url: "/api/login",
                        data: this.form
                    }).then(({ data }) => {
                        if (data.code == 0) {
                            const user = data.data
                            const { token } = user
                            localStorage.setItem('token', token)
                            this.$store.dispatch('asyncUpdateUser', user);
                            this.$message({
                                message: 'Login successful',
                                type: 'success'
                            });
                            this.$router.push('/')
                        } else {
                            this.$message({
                                message: resp.data.msg,
                                type: 'warning'
                            });
                        }
                    })
                } else {
                    this.$message({
                        message: 'Typing error!',
                        type: 'warning'
                    })
                }
                return false;
            })
        }
    }
}
</script>

<style scoped>
.login-main {
    width: 100%;
    min-width: 1200px;
    padding-bottom: 20px;
    padding-top: 60px;
    min-height: 80vh;

    .form-main {
        padding: 60px;
        margin-top: 80px;
        display: flex;
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255/var(--tw-bg-opacity));
        justify-content: center;
        width: 50%;
        flex-direction: column;
        margin-left: 25%;

        .title {
            margin-bottom: 20px;

            h3 {
                font-size: 24px;
            }
        }
    }
}

.login-title {
    text-align: center;
}
</style>