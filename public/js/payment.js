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

    // document.getElementById('checkout').addEventListener("click", (e) => {
    //         e.preventDefault();
    //         console.log('dude!');
    //         const PBFKey = $("#properties").data('public-key'); // paste in the public key from your dashboard here
    //         const txRef = ''+Math.floor((Math.random() * 1000000000) + 1); //Generate a random id for the transaction reference
    //         const email = $("#properties").data('customer-email');
    //         const phone = '07033194937';
    //         const amount = rawTotal;
        
           

    //     // getpaidSetup is Rave's inline script function. it holds the payment data to pass to Rave.
    //     getpaidSetup({
    //         PBFPubKey: PBFKey,
    //         customer_email: email,
    //         amount: amount,
    //         customer_phone: phone,
    //         currency: "NGN",  // Select the currency. leavig it empty defaults to NGN
    //         txref: txRef, // Pass your UNIQUE TRANSACTION REFERENCE HERE.
        
    //         onclose: function() {},
    //         callback: function(response) {
    //             // collect flwRef returned and pass to a server page to complete status check.
    //             txref = response.data.txRef
                
    //             if(response.tx.chargeResponseCode =='00' || response.tx.chargeResponseCode == '0') {
    //                 // redirect to a success page
    //                 //window.location = "https://fltwvapp.herokuapp.com/status.php?txref="+txref; //Add your success page here
    //               window.location = "https://fltwvapp.herokuapp.com/success.php";
    //               console.log("success", response);
    //             } else {
    //                 // redirect to a failure page.
    //                 //window.location = "https://fltwvapp.herokuapp.com/status.php?txref="+txref;
    //                window.location = "https://fltwvapp.herokuapp.com/error.php";
    //                console.log("error", response);
    //             }
    //         }
    //       });
    // });
});