export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/products', component: require('./components/product/Products.vue').default },
    { path: '/product/tag', component: require('./components/product/Tag.vue').default },
    { path: '/product/category', component: require('./components/product/Category.vue').default },
    // { path: '/subjects', component: require('./components/Subjects.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
    { path: '/testimonial', component: require('./components/testimonial/Testimonial.vue').default },
    { path: '/faq', component: require('./components/faq/Faq.vue').default },
    { path: '/orders', component: require('./components/order/Order.vue').default },
    { path: '/order/view', name: 'order/view', component: require('./components/order/OrderView.vue').default },




];
