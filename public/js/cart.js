document.addEventListener('DOMContentLoaded', (event) => {
let app = new Vue({
        el: "#root",
        data: {
            menus: [],
            items:[],
            loading: false,
            cartLoading: false,
            failed: false,
            message: '',
            vendorId: $("#root").data('id')
        },
        methods:{
            getMenu: () =>{
                // this.loading = true;
                axios.get(`/menu/${this.vendorId}`).then((response)=>{
                    console.log(`/menu/${this.vendorId}`);
                    app.menus = response.data.vendor.food_categories;
                    this.loading = false;
                }).catch((e) =>{
                    console.log(e);
                });
            },
            addToCart: (id) =>{
                let token = $('.product-container').data('token');
                let postData = $.param({food_id: id, token: token});

                axios.post('/cart', postData).then((response) => {

                    console.log(postData);
                    $("#toast").css("display", "block").html(response.data.success);
                    setTimeout((e)=>{
                        $("#toast").css("display", "none")
                    }, 2500);
                    console.log(response.data.success);
                }).catch((e) => {
                    console.log(e);
                    $("#toast").removeClass('alert-success').addClass('alert-danger').css("display", "block").html(e);
                });
                // alert(`Food with id ${id} and ${token} has been added to cart`)
            },
            displayCartItems: () =>{
                this.cartLoading = true;
                setTimeout(function(){
                    axios.get('/items').then((response)=>{
                        if(response.data.error){
                            // It means cart is empty
                            app.cartLoading = false;
                            app.message = response.data.error;
                        }else{
                            app.items = response.data.items
                        }
                    })
                },2000);
            },
            updateQuantity: (foodId, operator) =>{

            }
        },
        created: () =>{
            this.loading = true;
            this.getMenu()
        }
    });
});