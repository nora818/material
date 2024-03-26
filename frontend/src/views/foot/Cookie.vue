<template>
    <div class="container" v-if="active">
        <div style="padding-left: 1.25rem;padding-right: 1.25rem;margin:auto;">
            <div class="header">Please set your cookie preferences</div>
            <div class="body">
                <div>Welcome to the materials rating website.</div>
                <div><span>We would like to use cookies on this website to ensure the security, efficient operation and service optimization of this website. For more information about our use of cookies, click</span><a href="#" target="_blank"
                        rel="noreferrer" style="color: rgb(255 209 0);"> Check </a><span>learn more</span>
                </div>
            </div>
            <div class="footer">
                <div class="button left" @click="setCookie(true)">Accept Cookies</div>
                <div class="button right" @click="setCookie(false)">Reject Cookies</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CookieMain",
    data() {
        return {
            active: true
        }
    },
    mounted() {
        if (localStorage.getItem('acceptCookie')) {
            this.active = true
        }
    },
    methods: {
        setCookie(value) {
            if (value) {
                localStorage.setItem('acceptCookie', 1);
                this.active = false
            } else {
                localStorage.setItem('acceptCookie', 2);
                this.active = false
            }
        }
    }
}
</script>

<style scoped>
* {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

.container {
    bottom: 0;
    color: rgb(255 255 255);
    left: 0;
    overflow: hidden;
    padding: 2rem 0;
    position: fixed;
    width: 100%;
    z-index: 10001;
    backdrop-filter: blur(3px);
    background: rgba(102, 117, 104, 0.85);
}

.header {
    font-size: 1.5rem;
    line-height: 1.25rem;
    margin-bottom: 2rem;
    font-weight: 500;
}

.body {
    font-size: 1rem;
    margin-bottom: 2rem;
    font-weight: 500;
}

.footer {
    display: flex;
}

.footer .button {
    height: 2.5rem;
    width: 7.63rem;
    align-items: center;
    border-color: rgb(255 255 255);
    border-radius: 0.375rem;
    border-width: 1px;
    cursor: pointer;
    display: flex;
    font-size: .875rem;
    font-weight: 500;
    justify-content: center;
}

.footer .left {
    background-color: rgb(255 255 255);
    color: rgb(17 25 37);
}

.footer .right {
    --tw-space-x-reverse: 0;
    --tw-space-y-reverse: 0;
    border: 1px solid rgb(255 255 255);
    margin: calc(0px*(1 - var(--tw-space-y-reverse))) calc(1.25rem*var(--tw-space-x-reverse)) calc(0px*var(--tw-space-y-reverse)) calc(1.25rem*(1 - var(--tw-space-x-reverse)));
    color: rgb(255 255 255);
}
</style>