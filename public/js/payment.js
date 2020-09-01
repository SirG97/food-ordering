document.addEventListener('DOMContentLoaded', (event) => {
    var rawTotal = 0;
    axios.get('/items').then((response)=>{
        if(response.data.error){
            app.message = response.data.error;
        }else if(response.data.items !== undefined){
             rawTotal = response.data.rawTotal;
        }else{

            
        }
    });

   const generateTxRef = (length) => {
        if (!length) {
            length = 16
        }
        var str = ''
        for (var i = 1; i < length + 1; i = i + 8) {
            str += Math.random().toString(36).substr(2, 10)
        }
        return (str).substr(0, length)
    }

   const checkout = () => {
        console.log(rawTotal);

        const txref = generateTxRef();
        
        FlutterwaveCheckout({
            public_key: $("#properties").data('public-key'),
            tx_ref: txref,
            amount: rawTotal,
            currency: "NGN",
            redirect_url: `http://localhost:4000/verifytransaction/${txref}`,
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

    }

    $("#checkout").on('click', (e) => {
        e.preventDefault();
        checkout();
    })
});