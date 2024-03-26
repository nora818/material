<template>
    <div class="footer-main">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" viewBox="0 0 1440 126" style="enable-background:new 0 0 1440 126;" xml:space="preserve">
            <path class="bg-black" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z">
            </path>
        </svg>
        <div class="bg-black pb-5">
            <div class="container">
                <div class="footer-link">
                    <div class="col-6 col-md">
                        <router-link to="/about">
                            <h5 class="mb-4 text-white">About Us</h5>
                        </router-link>
                    </div>
                    <div class="col-6 col-md">
                        <router-link to="/contact">
                            <h5 class="mb-4 text-white">Contact information</h5>
                        </router-link>
                    </div>
                    <div class="col-6 col-md">
                        <router-link to="/help">
                            <h5 class="mb-4 text-white">Help</h5>
                        </router-link>
                    </div>
                    <div class="col-6 col-md">
                        <!-- <a href="http://www.google.com" target="_blank"> -->
                        <router-link to="/link">
                            <h5 class="mb-4 text-white">Social media links</h5>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <cookie-main class="cookie"></cookie-main>
    </div>
</template>

<script>
import CookieMain from '@/views/foot/Cookie';
export default {
    name: "FooterMain",
    components: {
        CookieMain
    }
}
</script>

<style lang="less" scoped>
.footer-main {
    .cookie {
        position: fixed;
        bottom: 0;
    }

    .bg-black {
        background-color: #030303;
    }

    svg {
        margin-bottom: -7px;
    }

    .pb-5,
    .py-5 {
        padding-bottom: 3rem !important;
    }

    .footer-link {
        display: flex;
        justify-content: space-around;
    }

    .text-white {
        color: #fff !important;
        font-size: 24px;
    }
}
</style>