<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Featured Products</h2>
                </div>
            </div>
        </div>
        <div class="row" id="productContainer">
            <!-- Products will load here dynamically -->
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('productContainer');

        // Fetch products
        axios.get('/Product-by-Remarks/popular')
            .then(response => {
                if (response.data.msg === "success") {
                    const products = response.data.data;
                    let html = '';

                    products.forEach(product => {
                        const discountHtml = product.discount > 0 ? `
                            <del>${product.price} BDT</del>
                            <div class="on_sale">
                                <span>${product.discount}% Off</span>
                            </div>
                        ` : '';

                        html += `
                            <div class="col-md-3 col-sm-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="/product/${product.id}">
                                            <img src="${product.image}" alt="${product.title}">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                <li><a href="#"><i class="icon-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product/${product.id}">${product.title}</a></h6>
                                        <div class="product_price">
                                            <span class="price">${product.discount_price > 0 ? product.discount_price : product.price} BDT</span>
                                            ${discountHtml}
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:${product.star}%"></div>
                                            </div>
                                            <span class="rating_num">(${Math.floor(product.star / 20)})</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${product.short_des}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    container.innerHTML = html;
                } else {
                    console.error('Error in response message:', response.data.msg);
                }
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    });
</script>
