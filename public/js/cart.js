document.addEventListener('DOMContentLoaded', (event) => {
let app = new Vue({
        el: "#root",
        data: {
            menus: [],
            loading: false,
            vendorId: $("#root").data('id')
        },
        methods:{
            getMenu: function(){
                this.loading = true;
                axios.get(`/menu/${this.vendorId}`).then((response)=>{
                    console.log(`/menu/${this.vendorId}`);
                    app.menus = response.data.vendor.food_categories;
                    this.loading = false;
                }).catch((e) =>{
                    console.log(e);
                });
            },
            addToCart: function(id){
                let token = $('.product-container').data('token');
                let postData = $.param({food_id: id, token: token});
                axios.post('/cart', postData).then((response) => {
                    $("#toast").css("display", "block").html(response.data.success);
                    setTimeout((e)=>{
                        $("#toast").css("display", "none")
                    }, 2500);
                    console.log(response.data.success);
                }).catch((e) => {
                    $("#toast").removeClass('alert-success').addClass('alert-danger').css("display", "block").html(e);
                });
                // alert(`Food with id ${id} and ${token} has been added to cart`)
            }
        },
        beforeMount(){
            this.loading = true;
            this.getMenu()
        }
    });
});