document.addEventListener('DOMContentLoaded', (event) => {
    let app = new Vue({
        el: "#root",
        data: {
            menus: [],
            items:[],
            loading: false,
            cartLoading: false,
            failed: false,
            cartTotal: 0,
            rawTotal: 0,
            grandTotal: 0,
            delivery_fee: 0,
            message: '',
            vendorId: $("#vid").data('id'),
            disableCheckoutBtn: true,
            authenticated: false,
        },
        methods:{
            getMenu: (vendorId) =>{
                // this.loading = true;
                axios.get(`/menu/${vendorId}`).then((response)=>{
                    console.log(`/menu/${vendorId}`);
                    app.menus = response.data.vendor.food_categories;
                    app.loading = false;
                }).catch((e) =>{
                    console.log(e);
                });
            },
            addToCart: (id) =>{
                let token = $('.product-container').data('token');
                let postData = $.param({food_id: id, token: token});

                axios.post('/cart', postData).then((response) => {
                    app.updateCartView();
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
                        }else if(response.data.items !== undefined){
                            app.items = response.data.items;
                            app.cartTotal = response.data.cartTotal;
                            app.grandTotal = response.data.grandTotal;
                            app.rawTotal = response.data.rawTotal;
                            app.delivery_fee = response.data.delivery_fee;
                            app.cartLoading = false;
                            app.disableCheckoutBtn = false;
                        }else{

                            app.cartLoading = false;
                        }
                    })
                },2000);
            },
            updateCartView: () =>{
                app.cartLoading = true;
                setTimeout(function(){
                    axios.get('/items').then((response)=>{
                        if(response.data.error){
                            // It means cart is empty
                            app.cartLoading = false;
                            app.items = [];
                            app.disableCheckoutBtn = true;
                            app.message = response.data.error;
                        }else if(response.data.items !== undefined){
                            app.items = response.data.items;
                            app.cartTotal = response.data.cartTotal;
                            app.grandTotal = response.data.grandTotal;
                            app.delivery_fee = response.data.delivery_fee;
                            console.log(response.data.items);
                            app.cartLoading = false;
                            app.disableCheckoutBtn = false;
                        }else{
                            app.disableCheckoutBtn = true;
                            app.cartLoading = false;
                        }
                    })
                },200);
            },

            updateQuantity: (foodId, operator) =>{
                console.log(foodId, operator);
                let postData = $.param({food_id: foodId, operator: operator});
                axios.post('/cart/update', postData).then((response) => {

                    app.updateCartView();

                }).catch((e) => {
                    console.log(e);
                    $("#toast").removeClass('alert-success').addClass('alert-danger').css("display", "block").html(e);
                });
            },

            removeItem: (index) => {
                let postData = $.param({item_index: index});
                axios.post('/cart/remove', postData).then((response) => {
                    console.log(response.data);
                    $("#toast").css("display", "block").html(response.data.success);
                    app.updateCartView();
                })
            },

            checkout: () => {
                console.log(app.rawTotal);
                FlutterwaveCheckout({
                    public_key: $("#properties").data('public-key'),
                    tx_ref: "hooli-tx-1920bbtyt",
                    amount: app.rawTotal,
                    currency: "NGN",
                    payment_options: "card,mobilemoney,ussd",
                    redirect_url: 'http://localhost:4000/verifytransaction',
                    customer: {
                      email: $("#properties").data('customer-email'),
                      
                    },
                    callback: function (data) { // specified callback function
                      console.log(data);
                    },
                    customizations: {
                      title: "My store",
                      description: "Payment for items in cart",
                      logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTe--nxBU_W6hXIUKat2oX2hiAkvJffzIGoUg&usqp=CAU",
                    },
                  });
            },
        },
        beforeMount(){
            let v = $("#vid").data('id');
            this.loading = true;
            this.cartLoading = true;

            this.displayCartItems();
        }
    });
});