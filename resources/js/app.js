require('./bootstrap');
// require('./components/App')
const feather = require('feather-icons')
feather.replace({'stroke-width': 1.5})
global.feather = feather;
require('alpinejs');


for(let item of document.getElementsByTagName('img')) {
    item.addEventListener("error", function(e) {
        e.target.src = '/images/no-image.jpg';
    })
}
