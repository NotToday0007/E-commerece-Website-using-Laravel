<div class="main_content">
    <!-- START SECTION BANNER -->
    <div class="section pb_20 small_pt">
        <div id="carouselSection" class="container">
            <div class="row" id="carouselRow"> <!-- Added row container -->
            </div>
        </div>
    </div>

    <script>
        Topbar(); // Corrected function call

        async function Topbar() {
            try {
                let res = await axios.get("/Topbar-Category");
                $("#carouselRow").empty(); // Clear the row container

                res.data['data'].forEach((item, i) => {


                    let SliderItem = `
                    <div class="col-md-4"> <!-- Bootstrap column class -->
                        <div class="sale-banner mb-3 mb-md-4">
                            <a class="hover_effect1" href="#">
                                <img src="${item['image']}" alt="shop_banner_img${i}" class="img-fluid">
                            </a>
                        </div>
                    </div>`;
                    $("#carouselRow").append(SliderItem);
                });
            } catch (error) {
                console.error("Error fetching Topbar categories:", error);
            }
        }
    </script>
</div>
