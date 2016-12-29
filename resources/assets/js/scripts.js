// Vue trans function to get Locales.
Vue.prototype.trans = (key) => {
    return _.get(window.transResource, key, key);
};

// Javascript trans function to get Locales.
window.trans = function(key){
    return _.get(window.transResource, key, key);
}