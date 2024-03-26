<template>
    <div class="home-main">
        <div class="cart-list">
            <div class="cart">
                <div class="slide">
                    <h5 class="font-weight-bold spanborder"><span>Innovative Materials</span></h5>
                    <ol class="list-featured">
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Circulose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">NuCycl</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Mylo</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Reishi</a>
                                </h6>
                            </span>
                        </li>
                    </ol>
                    <img src="@/assets/images/11.png" alt="" style="width: 200px; height: 200px;">
                </div>
            </div>

            <div class="cart">
                <div class="slide">
                    <h5 class="font-weight-bold spanborder"><span>Recommended Materials</span></h5>
                    <ol class="list-featured">
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Organic Cotton</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Soy Protein Fiber&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Modal</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Recycled Polyester</a>
                                </h6>
                            </span>
                        </li>
                    </ol>
                    <img src="@/assets/images/22.png" alt="" style="width: 200px; height: 200px;">
                </div>
            </div>

            <div class="cart">
                <div class="slide">
                    <h5 class="font-weight-bold spanborder"><span>Traditional materials</span></h5>
                    <ol class="list-featured">
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Organic Wool&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Organic Bamboo </a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Organic Hemp</a>
                                </h6>
                            </span>
                        </li>
                        <li>
                            <span>
                                <h6 class="font-weight-bold">
                                    <a href="#" class="text-dark">Tencel Fiber</a>
                                </h6>
                            </span>
                        </li>
                    </ol>
                    <img src="@/assets/images/33.png" alt="" style="width: 200px; height: 200px;">
                </div>
            </div>
        </div>

        <div class="comment">
            <h3 class="comment-title">
                Add your comment
            </h3>
            <div class="comment-text">
                <textarea class="form-control" v-model="commentText" name="comment" rows="6"></textarea>
            </div>
            <div class="comment-submmit">
                <!-- Submit -->
                <button type="submit" class="btn btn-outline-primary" @click="sendComment">
                    Send a comment
                </button>
                <router-link to="/shequ">
                    <button type="reset" class="btn btn-link">
                        All comments
                    </button>
                </router-link>
            </div>
        </div>

        <div class="row img-list hp1">
            <div class="col-md-6 col-sm-12">
                <img src="@/assets/images/pingfen.png" class="hp1-img" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="hp1-text">
                    <div class="hp1-text-title">Grading system</div>
                    <div class="hp1-text-content">Start your environmental scoring of target clothes</div>
                    <button class="btn btn-success btn-lg"><router-link to="/score">Click to start</router-link></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import request from '../../utils/request';

export default {
    name: "Home",
    data() {
        return {
            commentText: '',
        }
    },
    methods: {
        sendComment() {
            request({
                method: "POST",
                url: "/api/comment",
                data: {
                    "content": this.commentText
                }
            }).then((resp) => {
                if (resp.data.code == 0) {
                    this.$message({
                        message: 'Success！',
                        type: 'success'
                    });
                    this.commentText=""
                } else {
                    this.$message({
                        message: 'Warning！',
                        type: 'warning'
                    });
                }
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.home-main {
    width: 100%;
    min-width: 1200px;
    padding-bottom: 20px;
    padding-top: 60px;

    .cart-list {
        display: flex;
    }

    .cart {
        padding: 50px 0 50px;
        display: inline-flexex;

        .slide {
            border-radius: 40px;
            background-color: rgba(0, 0, 0, 0.03);
            margin-left: 40px;
            margin-bottom: 20px;
            padding: 40px;
            position: relative;
            min-height: 500px;
            min-width: 300px;

            .spanborder {
                border-bottom: 1px solid #e8f3ec;
                margin-bottom: 2rem;

                span {
                    border-bottom: 1px solid rgba(0, 0, 0, 0.44);
                    display: inline-block;
                    padding-bottom: 20px;
                    margin-bottom: -1px;
                }
            }

            ol.list-featured {
                counter-reset: my-awesome-counter;
                list-style: none;
                padding-left: 0;
            }

            ol.list-featured li {
                counter-increment: my-awesome-counter;
                display: flex;
                font-size: 14px;
                align-items: center;
            }

            ol.list-featured li:before {
                content: "0" counter(my-awesome-counter);
                font-weight: bold;
                font-size: 3rem;
                margin-right: 0.5rem;
                font-family: 'Abril Fatface', serif;
                line-height: 1;
            }

            .font-weight-bold {
                font-weight: 700 !important;
            }

            img {
                width: 300px;
                height: 200px;
                position: absolute;
                bottom:4%;
                left: 10%;
            }
        }
    }

    .comment {
        display: flex;
        flex-direction: column;
        margin-left: 5%;

        .comment-title {
            font-size: 30px;
            color: #870100;
            margin-bottom: 10px;
        }

        .comment-text {
            margin-left: 10px;
            margin-bottom: 10px;
            width: 70%;
            height: auto;

            textarea {
                font-size: 24px;
            }
        }

        .comment-submmit {
            border: 1px solid #e8f3ec;
        }
    }

    .hp1 {
        height: 400px;
        margin: 40px 10%;

        .hp1-text {
            margin-top: 130px;

            .hp1-text-title {
                font-size: 40px;
                font-size: 3em;
                font-weight: bolder;
            }

            .hp1-text-content {
                font-size: 20px;
                margin: 20px 0;
            }
        }

        .hp1-img {
            width: 700px;
        }
    }
}
</style>