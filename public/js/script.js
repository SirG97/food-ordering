    
document.addEventListener('DOMContentLoaded', (event) => {
    const hamburger = document.getElementById('hamburger');
    const main = document.getElementById('main');
    const sidebar = document.querySelector('.nav-sidebar');
    const profile = document.querySelector('.header-nav-item');
    const ndropdown = document.querySelector('.nav-dropdown');


    hamburger.addEventListener('click', () =>{
        sidebar.classList.toggle('nav-sidebar-open');
    });

    profile.addEventListener('click', () => {
        ndropdown.classList.toggle('active');
    });
    main.addEventListener('click', () =>{
        // if(sidebar.classList.contains('nav-sidebar-open')){
            sidebar.classList.remove('nav-sidebar-open');
        
    });

    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        console.log('hie');
        $(this).tab('show')
    })

    // Show search dropdown
    const search = $('#search_order');
    const search_result = $('.search-result');
    search.on('input', ()=>{
        search.addClass('no-bottom-borders');
        $('.search-result').css('display','block');
        let terms = search.val();
        const url = `/orders/${terms}/search`;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                search_result.html('loading...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let ul = '<ul class="list-group list-group-flush">';
                $.each(data, (key, value) => {
                    $.each(value, (index, item)=>{
                        console.log(item);
                        ul += `<li class="list-group list-group-item">
                                   <a href="/order/${item.order_no}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6>${item.parcel_name}  by ${item.fullname}</h6>
                                        <small>${item.order_no}</small>
                                    </div>
                                    <p class="mb-1">${item.email}</p> 
                                    </a>
                                </li>`;
                    });
                });
                ul += '</ul>';
                $('.search-result').html(ul);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                $('#search-result-list').html('No r');
            }
        });
    });
    // ul += '<li class="list-group list-group-item"><div class="d-flex w-100 justify-content-between"><h6>' + item.firstname + ' ' + item.surname + '</h6><small>'+ item.phone +'</small></div><p class="mb-1">'+ item.email +'</p></li>';
    search.on('blur', ()=>{
        $('#search').removeClass('no-bottom-borders');
        // $('.search-result').css('display','none');
    });

    const search_contribution = $('#search-contribution');
    const search_contribution_result = $('.search-contribution-result');
    search_contribution.on('input', ()=>{
        search_contribution.addClass('no-bottom-borders');
        $('.search-result').css('display','block');
        let terms = search_contribution.val();
        const url = `/contributions/${terms}/search`;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                search_result.html('<div class="d-flex justify-content-center pt-1 pb-1"><i class="fa fa-spinner fa-spin"></i> &nbsp; Searching...</div>');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let ul = '<ul class="list-group list-group-flush">';

                if(data !== undefined){
                    $.each(data, (key, value) => {
                        $.each(value, (index, item)=>{
                            ul += `<li class="list-group list-group-item">
                         
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6>${item.phone} </h6>
                                        <small>${item.updated_at}</small>
                                    </div>
                                    <p class="mb-1">${item.pin}</p> 
                                    
                                </li>`;
                        });
                    });
                    ul += '</ul>';
                }else{
                    ul += `<li class="list-group list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                                <p>No result found</p>
                        </div>
                    </li>`;
                    ul += '</ul>';
                }

                $('.search-result').html(ul);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                $('#search-result-list').html('No result for this query');
            }
        });
    });
    // ul += '<li class="list-group list-group-item"><div class="d-flex w-100 justify-content-between"><h6>' + item.firstname + ' ' + item.surname + '</h6><small>'+ item.phone +'</small></div><p class="mb-1">'+ item.email +'</p></li>';
    search_contribution.on('blur', ()=>{
        $('#search_contribution').removeClass('no-bottom-borders');
        $('.search-result').css('display','none');
    });


    // Show the edit modal and populate the fields for customer edit
    $('#editFood').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let food_id = button.data('food_id'); // Extract info from data-* attributes
        let category_id = button.data('category_id'); // Extract info from data-* attributes
        let name = button.data('name'); // Extract info from data-* attributes
        let unit_price = button.data('unit_price'); // Extract info from data-* attributes
        let description = button.data('description'); // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);

        modal.find('#food_id').val(food_id);

        modal.find(`#category_id option[value=${category_id}]`).prop('selected', true);
        modal.find('#name').val(name);
        modal.find('#unit_price').val(unit_price);
        modal.find('#description').val(description);

    });

    $('#editFoodBtn').on('click', (e)=>{
        e.preventDefault();
        let food_id = $('#food_id').val();
        const url = `/food/${food_id}/edit`;
        let d = new FormData();
        console.log($('#food_id').val());
        d.append('token', $('#token').val());
        d.append('food_category', $('#category_id').val());
        d.append('name', $('#name').val());
        d.append('unit_price', $('#unit_price').val());
        d.append('description', $('#description').val());
        d.append('food_img', $("#food_img").prop("files")[0]);

        $.ajax({
            url: url,
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: d,
            beforeSend: function(){
                $('#editFoodBtn').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response));
                let message = data.success;
                msg.innerHTML = alertMessage('success', message);
                $('#editFoodBtn').html('Save');
                //interval(5000);
                window.location.reload()
            },
            error: function(request, error){

                let errors = JSON.parse(request.responseText);
                console.log(errors);
                if(errors.error == undefined){
                    let ul = '';
                    $.each(errors, (key, value) => {
                        $.each(value, (index, item)=>{
                            console.log(item);
                            ul += `${item} <br>`;
                        });

                    });

                    msg.innerHTML = alertMessage('danger', ul);
                }else{
                    msg.innerHTML = alertMessage('danger', errors.error);
                }

                $('#editFoodBtn').html('Save');
                interval(5000);
            }
        });
    });

    // show the delete confirmation modal
    $('#deleteFoodModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let food_id = button.data('food_id'); // Extract info from data-* attributes
        let form_action = `/food/${food_id}/delete`;

        let modal = $(this);
        modal.find('#foodDeleteForm').attr("action", form_action);
    });

    $('#deleteFoodBtn').on('click', (e)=>{
        e.preventDefault();
        $("#foodDeleteForm").submit();
    });

    // show the delete confirmation modal
    $('#deleteVendorModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let vendor_id = button.data('vendor_id'); // Extract info from data-* attributes
        let form_action = `/vendor/${vendor_id}/delete`;

        let modal = $(this);

        modal.find('#vendorDeleteForm').attr("action", form_action);
    });

    $('#deleteVendorBtn').on('click', (e)=>{
        e.preventDefault();
        $("#vendorDeleteForm").submit();
    });

    // Upload banner
    $("#file-input").on("change", (e)=> {
       bannerUpload();
    });

    function bannerUpload(){
        let vendor_id = $('#banner_vendor_id').val();
        let d = new FormData();
        d.append('token', $('#banner_token').val());
        d.append('banner', $("#file-input").prop("files")[0]);
        const url = `/vendor/${vendor_id}/upload`;
        console.log(vendor_id);
        $.ajax({
            url: url,
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: d,
            beforeSend: function(){
                $('#file-icon').html('<i class="fa fa-spinner fa-spin"></i> ');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response));
                // let message = data.success;
                // msg.innerHTML = alertMessage('success', message);
                // $('#editFoodBtn').html('Save');
                // //interval(5000);
                window.location.reload()
            },
            error: function(request, error){

                let errors = JSON.parse(request.responseText);
                console.log(errors);
                if(errors.error == undefined){
                    let ul = '';
                    $.each(errors, (key, value) => {
                        $.each(value, (index, item)=>{
                            console.log(item);
                            ul += `${item} <br>`;
                        });

                    });


                    $('#file-icon').html(`<i class="alert alert-danger">${ul}</i>`);
                }else{

                    $('#file-icon').html(`<i class="alert alert-danger">${errors.error}</i>`);
                }

                $('#editFoodBtn').html('Save');
                interval(5000);
            }
        });
    }

    // Edit order modal
    $('#editOrderModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        modal.find('#order_no').val(button.data('order_no')); // Extract info from data-* attributes
        modal.find('#request_type').val( button.data('request_type')); // Extract info from data-* attributes
        modal.find('#district').val(button.data('district')); // Extract info from data-* attributes
        modal.find('#route').val(button.data('route')); // Extract info from data-* attributes
        modal.find('#fullname').val(button.data('fullname')); // Extract info from data-* attributes
        modal.find('#email').val(button.data('email')); // Extract info from data-* attributes
        modal.find('#service_type').val(button.data('service_type')); // Extract info from data-* attributes
        modal.find('#address').val(button.data('address')); // Extract info from data-* attributes
        modal.find('#phone').val(button.data('phone')); // Extract info from data-* attributes
        modal.find('#parcel_name').val(button.data('parcel_name')); // Extract info from data-* attributes
        modal.find('#parcel_size').val(button.data('parcel_size')); // Extract info from data-* attributes
        modal.find('#pick_up_address').val(button.data('pick_up_address')); // Extract info from data-* attributes
        modal.find('#pick_up_landmark').val(button.data('pick_up_landmark')); // Extract info from data-* attributes
        modal.find('#delivery_address').val(button.data('delivery_address')); // Extract info from data-* attributes
        modal.find('#delivery_landmark').val(button.data('delivery_address')); // Extract info from data-* attributes
        modal.find('#description').val(button.data('description')); // Extract info from data-* attributes

        let request = button.data('request_type');
        if(request === 'collection'){
            $("#delivery_address, #delivery_landmark").prop('readonly', true).val('').css('cursor', 'not-allowed');
            // $("").prop('readonly', true);
            $("#pick_up_address, #pick_up_landmark").prop('readonly', false).css('cursor', 'text');
            // $("").prop('readonly', false);
        }else if(request === 'delivery'){
            $("#pick_up_address, #pick_up_landmark").prop('readonly', true).val('').css('cursor', 'not-allowed');
            // $("").prop('readonly', true);
            $("#delivery_address, #delivery_landmark").prop('readonly', false).css('cursor', 'text');
            // $("").prop('disabled', false);
        }else if(request === 'combo' || request === 'swap'){
            $("#pick_up_address,#pick_up_landmark").prop('readonly', false).css('cursor', 'text');
            // $("").prop('disabled', false);
            $("#delivery_address, #delivery_landmark").prop('readonly', false).css('cursor', 'text');
            // $("").prop('disabled', false);
        }
    });

    $('#editOrderBtn').on('click', (e)=>{
        e.preventDefault();
        let order_no = $('#order_no').val();
        const url = `/order/${order_no}/edit`;
        const data = {
            token : $('#token').val(),
            request_type : $('#request_type').val(),
            service_type : $('#service_type').val(),
            email : $('#email').val(),
            district : $('#district').val(),
            route : $('#route').val(),
            fullname : $('#fullname').val(),
            address : $('#address').val(),
            phone : $('#phone').val(),
            parcel_name : $('#parcel_name').val(),
            parcel_size : $('#parcel_size').val(),
            pick_up_address : $('#pick_up_address').val(),
            pick_up_landmark : $('#pick_up_landmark').val(),
            delivery_address : $('#delivery_address').val(),
            delivery_landmark : $('#delivery_landmark').val(),
            description : $('#description').val(),
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function(){
                $('#editOrderBtn').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response));
                let message = data.success;
                msg.innerHTML = alertMessage('success', message);
                $('#editBtn').html('Save');
                //interval(5000);
                window.location.reload()
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                console.log(errors);
                let ul = '';
                $.each(errors, (key, value) => {
                    $.each(value, (index, item)=>{
                        console.log(item);
                        ul += `${item} <br>`;
                    });
                });

                msg.innerHTML = alertMessage('danger', ul);
                $('#editBtn').html('Save');
                interval(5000);
            }
        });
    });

    // show the delete confirmation modal for an order
    $('#deleteOrderModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let order_no = button.data('order_no'); // Extract info from data-* attributes
        let form_action = `/order/${order_no}/delete`;

        let modal = $(this);
        modal.find('#orderDeleteForm').attr("action", form_action);
    });

    $('#deleteOrderBtn').on('click', (e)=>{
        e.preventDefault();
        $("#orderDeleteForm").submit();
    });

    // Edit staff modal
    $('#editStaffModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        modal.find('#user_id').val( button.data('user_id')); // Extract info from data-* attributes
        modal.find('#username').val( button.data('username')); // Extract info from data-* attributes
        modal.find('#email').val(button.data('email')); // Extract info from data-* attributes
        modal.find('#password').val(button.data('password')); // Extract info from data-* attributes
        modal.find('#firstname').val(button.data('firstname')); // Extract info from data-* attributes
        modal.find('#lastname').val(button.data('lastname')); // Extract info from data-* attributes
        modal.find('#address').val(button.data('address')); // Extract info from data-* attributes
        modal.find('#phone').val(button.data('phone')); // Extract info from data-* attributes
        modal.find('#city').val(button.data('city')); // Extract info from data-* attributes
        modal.find('#state').val(button.data('state')); // Extract info from data-* attributes
        modal.find('#admin_right').val(button.data('admin_right')); // Extract info from data-* attributes
        modal.find('#job_title').val(button.data('job_title')); // Extract info from data-* attributes
        modal.find('#job_description').val(button.data('job_description')); // Extract info from data-* attributes
    });

    $('#editStaffBtn').on('click', (e)=>{
        e.preventDefault();
        let user_id = $('#user_id').val();
        const url = `/staff/${user_id}/edit`;

        let d = new FormData();
        d.append('token', $('#token').val());
        d.append('username', $('#username').val());
        d.append('firstname', $('#firstname').val());
        d.append('lastname', $('#lastname').val());
        d.append('email', $('#email').val());
        d.append('password', $('#password').val());
        d.append('phone', $('#phone').val());
        d.append('address', $('#address').val());
        d.append('city', $('#city').val());
        d.append('state', $('#state').val());
        d.append('admin_right', $('#admin_right').val());
        d.append('job_title', $('#job_title').val());
        d.append('job_description', $('#job_description').val());
        d.append('profile_pics', $("#profile_pics").prop("files")[0]);


        $.ajax({
            url: url,
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: d,
            beforeSend: function(){
                $('#editStaffBtn').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response));
                let message = data.success;
                msg.innerHTML = alertMessage('success', message);
                $('#editStaffBtn').html('Save');
                //interval(5000);
                window.location.reload()
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                console.log(errors);
                let ul = '';
                $.each(errors, (key, value) => {
                    $.each(value, (index, item)=>{
                        console.log(item);
                        ul += `${item} <br>`;
                    });
                });

                msg.innerHTML = alertMessage('danger', ul);
                $('#editStaffBtn').html('Save');
                interval(5000);
            }
        });
    });

    // show the delete confirmation modal for staff
    $('#deleteStaffModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let user_id = button.data('user_id'); // Extract info from data-* attributes
        let form_action = `/staff/${user_id}/delete`;

        let modal = $(this);
        modal.find('#staffDeleteForm').attr("action", form_action);
    });

    $('#deleteStaffBtn').on('click', (e)=>{
        e.preventDefault();
        $("#staffDeleteForm").submit();
    });

    $('#deleteAssignedRouteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let rider_id = button.data('rider_id'); // Extract info from data-* attributes
        let form_action = `/assigned_routes/${rider_id}/delete`;

        let modal = $(this);
        modal.find('#assignedRouteDeleteForm').attr("action", form_action);
    });

    $('#deleteAssignedRouteBtn').on('click', (e)=>{
        e.preventDefault();
        $("#assignedRouteDeleteForm").submit();
    });

    // // Croppie image upload
    // $image_crop = $('#upload-demo').croppie({
    //     // enableExif: true,
    //     viewport: {
    //         width: 280,
    //         height: 280,
    //         type: 'square'
    //     },
    //     boundary: {
    //         width: 300,
    //         height: 300
    //     }
    // });
    //
    // $('#food-img').on('change', function () {
    //     let reader = new FileReader();
    //     reader.onload = function (e) {
    //         $image_crop.croppie('bind', {
    //             url: e.target.result
    //         }).then(function(){
    //             console.log('jQuery bind complete');
    //         });
    //     }
    //     reader.readAsDataURL(this.files[0]);
    // });
    //
    // $('#save-food').on('click', function (ev) {
    //         ev.preventDefault();
    //     $image_crop.croppie('result', {
    //         type: 'canvas',
    //         size: 'viewport',
    //         format: 'png'
    //     }).then(function (img) {
    //         let data = {
    //             "food_category": $("#food_category"),
    //             "name": $("#name"),
    //             "unit_price": $("#unit_price"),
    //             "description": $("#description"),
    //             "food-img": img
    //         };
    //         $.ajax({
    //             url: "/food/create",
    //             type: "POST",
    //             data: data,
    //             beforeSend: function(){
    //                 $('#save-food').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
    //             },
    //             success: function (response) {
    //                 let data = JSON.parse(response);
    //                 console.log(JSON.parse(response));
    //                 let message = data.success;
    //
    //             },
    //         });
    //     });
    // });

    function alertMessage(status, message){
        return `<div class="alert alert-${status} m-t-20 alert-dismissible fade show" role="alert">
                    ${message}
                </div>`;
    }

    function interval(duration){
        setTimeout(()=>{
            $(".alert").alert('close');
        }, duration);
    }

});