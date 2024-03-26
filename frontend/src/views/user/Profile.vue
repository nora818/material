<template>
    <el-row class="comment-main">
        <el-col class="comment-cart">
            <el-timeline>
                <el-timeline-item v-for="(comment, i) in commentList" :key="i" :timestamp="comment.created_at"
                    placement="top" style="margin-left: 10%; width: 80%;">
                    <el-card>
                        <h4 style="font-size: 18px; color: #303133;">{{ comment.content }}</h4>
                        <p style="margin-top: 20px; font-size: 14px; color: #909399;">User {{ comment.user.name }} Submmit</p>
                        <el-button type="danger" style="float: right; position: relative;right: 2px; bottom: 5px;"
                            @click="deleteComment(i, comment.id)">Delete</el-button>
                    </el-card>
                </el-timeline-item>
            </el-timeline>
            <infinite-loading @distance="1" @infinite="handleLoadMore">
                <div slot="spinner">Loading...</div>
                <div slot="no-more">No more message</div>
                <div slot="no-results">No results message</div>
            </infinite-loading>
        </el-col>
    </el-row>
</template>
    
<script>
import request from '../../utils/request';

export default {
    name: "Coment",
    components: {
    },
    data() {
        return {
            commentList: [],
            page: 1,
        }
    },
    created() {

    },
    methods: {
        handleLoadMore($state) {
            request({
                method: "GET",
                url: "/api/user/comment/",
                params: {
                    page: this.page
                }
            }).then((resp) => {
                // console.log(resp)
                if (resp.data.code == 0) {
                    this.page = this.page + 1;

                    const { data } = resp.data.data
                    if (data.length) {
                        this.commentList.push(...data)
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                }
            });
        },
        deleteComment(index, $id) {
            request({
                method: "DELETE",
                url: "/api/comment/" + $id,
            }).then((resp) => {
                // console.log(resp)
                if (resp.data.code == 0) {
                    this.$message({
                        message: '删除成功!',
                        type: 'success'
                    })
                    this.commentList.splice(index, 1);
                }
            });
        }
    }
}
</script>
    
<style lang="scss" scoped>
.comment-main {
    width: 100%;
    min-width: 1200px;
    min-height: 80vh;
    padding-bottom: 20px;
    padding-top: 60px;
    display: flex;
    overflow: hidden;

    .comment-cart {
        margin-top: 40px;
        margin-left: 10%;
        width: 80%;
    }
}
</style>
    