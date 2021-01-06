<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<!-- Full bundle -->
<script src="./buefy/buefy.min.js"></script>
<script>
    var app = new Vue({
        el: '#app',
        data:{
            menudata:[{"name":"Dashboard","link":"#"},{"name":"Campaign","link":"#","submenu":[{"name":"Department","link":"departments.php"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]},{"name":"Events","link":"#","submenu":[{"name":"Sport","link":"#"},{"name":"NAAC","link":"#"},{"name":"IQAC","link":"#"},{"name":"Alumni","link":"#"}]},{"name":"Members","link":"#","submenu":[{"name":"University Department","link":"http:\/\/acoe.annauniv.edu"},{"name":"Affiliated Institution","link":"https:\/\/aucoe.annauniv.edu\/index.html"}]},{"name":"Me","link":"#","submenu":[{"name":"Department","link":"#"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]}],
            sidemenudata:[{"name":"Dashboard","link":"#"},{"name":"Campaign","link":"#","submenu":[{"name":"Department","link":"departments.php"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]},{"name":"Events","link":"#","submenu":[{"name":"Sport","link":"#"},{"name":"NAAC","link":"#"},{"name":"IQAC","link":"#"},{"name":"Alumni","link":"#"}]},{"name":"Members","link":"#","submenu":[{"name":"University Department","link":"http:\/\/acoe.annauniv.edu"},{"name":"Affiliated Institution","link":"https:\/\/aucoe.annauniv.edu\/index.html"}]},{"name":"Me","link":"#","submenu":[{"name":"Department","link":"#"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]}],
            menuvisible:false,

            expandOnHover: false,
            mobile: "reduce",
            fullheight:true,
            reduce: false,
        }
    });

</script>