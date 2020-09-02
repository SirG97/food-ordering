document.addEventListener('DOMContentLoaded', (event) => {
    let app = new Vue({
        el: "#root",
        components:{
            'Rave': VueRavePayment.default
          },
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
            txref: '',
            raveKey: $("#properties").data('public-key'),
            email: $("#properties").data('customer-email'),
            amount: 90000
        },
        computed: {
            reference(){
              let text = "";
              let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

              for( let i=0; i < 10; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

              return text;
            }
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

            generateTxRef:  (length) => {
                if (!length) {
                    length = 16
                }
                var str = ''
                for (var i = 1; i < length + 1; i = i + 8) {
                    str += Math.random().toString(36).substr(2, 10)
                }
                return (str).substr(0, length)
            },

            checkout: () => {
                console.log(app.rawTotal);

                app.txref = app.generateTxRef();
                console.log(app.txref);
                console.log($("#properties").data('customer-email'));
                console.log($("#properties").data('public-key'));
                FlutterwaveCheckout({
                    public_key: $("#properties").data('public-key'),
                    tx_ref: app.txref,
                    amount: app.rawTotal,
                    currency: "NGN",
                    // redirect_url: `http://localhost:4000/verifytransaction`,
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

            payWithRave: () => {
                const API_publicKey = $("#properties").data('public-key');
                app.txref = app.generateTxRef();
                var x = getpaidSetup({
                    PBFPubKey: API_publicKey,
                    customer_email: $("#properties").data('customer-email'),
                    amount: app.rawTotal,
                    customer_phone: "07033194937",
                    currency: "NGN",
                    txref: app.txref,
                    onclose: function() {},
                    callback: function(response) {
                        var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
                        console.log("This is the response returned after a charge", response);
                        if (
                            response.data.chargeResponseCode == "00" ||
                            response.data.chargeResponseCode == "0"
                        ) {
                            // redirect to a success page
                        } else {
                            // redirect to a failure page.
                        }
        
                        x.close(); // use this to close the modal immediately after payment.
                    }
                });
            },

            callback: function(response){
                console.log(response)
              },
            close: function(){
                console.log("Payment closed")
              }
        },
        beforeMount(){
            let v = $("#vid").data('id');
            this.loading = true;
            this.cartLoading = true;

            this.displayCartItems();
        }
    });
});