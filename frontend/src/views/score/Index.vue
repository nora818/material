<template>
    <div class="score-main">
        <el-row class="form-main">
            <div class="score-title">
                <h3>Scoring System</h3>
            </div>
            <el-form ref="form" :model="form" :rules="rules" label-width="80px" style="margin-left: 30px;">
                <el-form-item label="Main material" prop="main_name">
                    <el-select v-model="form.main_name" filterable placeholder="Please select" style="width:500px;">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Secondary material">
                    <el-select v-model="form.second_name" filterable placeholder="Please select" style="width:500px;">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Other materials">
                    <el-select v-model="form.other_name" filterable placeholder="Please select" style="width:500px;">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit" :disabled="!canSubmit">Rate now</el-button>
                </el-form-item>
            </el-form>

            <div class="score-result" v-if="isshow">
                <!-- <div class="score-result"> -->
                <el-descriptions title="Result" :column="1" border>
                    <el-descriptions-item label="Material" :labelStyle='labelStyle'>
                        <span style="color: #303133;">
                            Main material:<span style="color: #F56C6C;">{{ oldform.main_name }}</span>
                            <br>Secondary material:<span style="color: #F56C6C;">{{ oldform.second_name }}</span>
                            <br>Other materials:<span style="color: #F56C6C;">{{ oldform.other_name }}</span>
                        </span>
                    </el-descriptions-item>
                    <el-descriptions-item label="Score" :labelStyle='labelStyle'>
                        <span style="color: #67C23A;">{{ score }}</span>
                    </el-descriptions-item>
                    
                </el-descriptions>
            </div>
        </el-row>

    </div>
</template>
<script>
import request from '../../utils/request';

export default {
    data() {
        return {
            options: [],
            rules: {
                main_name: [
                    { required: true, message: 'Please enter Main material', trigger: 'blur' },
                ],
            },
            form: {
                main_name: "",
                second_name: "",
                other_name: ""
            },
            oldform: {},
            isshow: false,
            score: 0,
            image_url: null,
            labelStyle: { 'width': '100px', 'text-align': 'center' }
        }
    },
    computed: {
        canSubmit() {
            const {
                main_name,
            } = this.form
            return Boolean(main_name)
        }
    },
    created() {
        request({
            method: "GET",
            url: "/api/product_list",
            data: this.form
        }).then((resp) => {
            if (resp.data.code == 0) {
                const data = resp.data.data
                this.options = data
            }
        });
    },
    methods: {
        onSubmit() {
            this.$refs["form"].validate((valid) => {
                if (valid) {
                    request({
                        method: "POST",
                        url: "/api/score",
                        data: this.form
                    }).then((resp) => {
                        if (resp.data.code == 0) {
                            this.isshow = true
                            this.score = resp.data.data.score
                            this.image_url = resp.data.data.image_url

                            this.oldform = resp.data.data.name
                            this.form = {
                                main_name: "",
                                second_name: "",
                                other_name: ""
                            }
                            this.$message({
                                message: 'Success!',
                                type: 'success'
                            })
                        }
                    });
                } else {
                    this.$message({
                        message: 'Warning!',
                        type: 'warning'
                    })
                }
                return false;
            })
        }
    }
}
</script>
<style scoped lang="scss">
.score-main {
    width: 100%;
    min-width: 1200px;
    padding-bottom: 20px;
    padding-top: 60px;
    min-height: 80vh;

    .form-main {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255/var(--tw-bg-opacity));
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        padding: 2rem;

        .score-title {
            margin-bottom: 15px;

            h3 {
                font-size: 30px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.44);
                display: inline-block;
                padding-bottom: 20px;
                margin-bottom: -1px;
            }
        }

        .score-result {
            margin-left: 2rem;
            min-height: 280px;
            width: 30%;
            padding: 10px;
        }
    }
}
</style>