require('./bootstrap');

window.Vue = require('vue').default;


import Vue from "vue";
import VueToastr from "vue-toastr";
import { ToggleButton } from 'vue-js-toggle-button'
import {ColorPicker, ColorPanel} from 'one-colorpicker'

Vue.use(VueToastr);
Vue.use(ColorPanel);
Vue.use(ColorPicker);

Vue.component('ToggleButton', ToggleButton);


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-to-cart-button', require('./components/AddToCart.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('checkout', require('./components/Checkout.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);

Vue.component('user-row', require('./components/admin/user/UserRow.vue').default);
Vue.component('product-row', require('./components/admin/product/ProductRow.vue').default);
Vue.component('new-product', require('./components/admin/product/NewProduct.vue').default);
Vue.component('category-row', require('./components/admin/category/CategoryRow.vue').default);
Vue.component('new-category', require('./components/admin/category/NewCategory.vue').default);
Vue.component('order-row', require('./components/admin/order/OrderRow.vue').default);
Vue.component('orders-modal', require('./components/admin/order/OrdersModal.vue').default);
Vue.component('slider', require('./components/admin/slider/Slider.vue').default);
Vue.component('new-slider', require('./components/admin/slider/NewSlider.vue').default);
Vue.component('banner', require('./components/admin/banner/Banner.vue').default);
Vue.component('new-banner', require('./components/admin/banner/NewBanner.vue').default);
Vue.component('collection-row', require('./components/admin/collection/CollectionRow.vue').default);
Vue.component('new-collection', require('./components/admin/collection/NewCollection.vue').default);
Vue.component('general-settings-form', require('./components/admin/settings/Forms/general.vue').default);
Vue.component('social-media-form', require('./components/admin/settings/Forms/socialMedia.vue').default);
Vue.component('more-settings-form', require('./components/admin/settings/Forms/moreSettings.vue').default);
Vue.component('colors-form', require('./components/admin/settings/Forms/colors.vue').default);
Vue.component('logo-form', require('./components/admin/settings/Forms/logo.vue').default);
Vue.component('coupon-row', require('./components/admin/coupons/CouponRow.vue').default);
Vue.component('new-coupon', require('./components/admin/coupons/NewCoupon.vue').default);
Vue.component('my-chart', require('./components/admin/stats/Chart.vue').default);
Vue.component('latest-products-table', require('./components/admin/stats/LatestProduct.vue').default);
Vue.component('latest-sales-table', require('./components/admin/stats/LatestSales.vue').default);
Vue.component('edit-about', require('./components/admin/others/About.vue').default);
Vue.component('edit-security', require('./components/admin/others/Security.vue').default);








const app = new Vue({
    el: '#app'
});
