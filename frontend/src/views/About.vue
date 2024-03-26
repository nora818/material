<template>
    <div class="go-in">
        <div class="section">
            <div class="section-content">
                <div class="content-summary">
                    <iframe ref="myIframe" :srcdoc="htmlContent" width="100%" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    components: {

    },
    data() {
        return {
            htmlContent: `<p><br></p><h1><span style="font-size: 40px;">About Us：</span></h1><p>Welcome to our platform! We are a passionate and creative team dedicated to providing you with quality service and a unique experience. Whether you're looking for innovative solutions or want to explore amazing content, we have a wonderful space for you. </p><p>Through our efforts, we pursue not only the improvement of products and services, but also creating a pleasant online journey for you.</p><h1></h1><p><br></p>`
        };
    },
    mounted() {
        // 监听 iframe 内容加载完成后，调整高度
        this.$refs.myIframe.addEventListener('load', this.adjustIframeHeight);
        // 如果 iframe 内容发生变化，也可以通过 MutationObserver 进行监听
        const observer = new MutationObserver(this.adjustIframeHeight);
        observer.observe(this.$refs.myIframe, { attributes: true, childList: true, subtree: true });
    },
    methods: {
        adjustIframeHeight(event) {
            const iframe = this.$refs.myIframe;
            if (iframe) {
                const contentHeight = iframe.contentDocument.body.scrollHeight;
                iframe.style.height = `${contentHeight + 100}px`;
            }
        },
    },
};
</script>
  
<style lang="scss" scoped>
* {
    font-weight: normal;
    font-size: 14px;
    font-style: normal;
}

.editor * {
    font-weight: revert;
    font-size: revert;
    font-style: revert;
}

.go-in {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
    padding: 60px;

    .section {
        margin-top: 40px;
        width: 100%;

        &-content {
            width: 1240px;
            margin: 0 auto;
            background-color: #fff;

            .content-summary {
                padding: 100px;
            }
        }
    }
}
</style>