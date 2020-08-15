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
                alert(`Food with id ${id} has been added to cart`)
            }
        },
        beforeMount(){
            this.loading = true;
            this.getMenu()
        }
    });
});