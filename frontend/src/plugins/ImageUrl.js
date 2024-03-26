export default {
    install(Vue) {
        Vue.prototype.getImageUrl = function (relativePath) {
            const BASE_URL = "http://127.0.0.1:8000"
            return BASE_URL + '/storage/' + relativePath;
        };
    }
};