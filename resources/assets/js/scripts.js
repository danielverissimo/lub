// Vue trans function to get langs.
Vue.prototype.trans = (key) => {
    return _.get(window.transResource, key, key);
};

// Javascript trans function to get langs.
window.trans = function(key){
    return _.get(window.transResource, key, key);
}