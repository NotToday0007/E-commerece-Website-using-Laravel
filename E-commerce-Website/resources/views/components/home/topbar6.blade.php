<!-- START SECTION CATEGORIES -->
<div class="section small_pb small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Categories</h2>
                </div>
                <p class="text-center leads">Explore our popular categories!</p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <div id="categoriesContainer" class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5"
                     data-loop="true" data-dots="false" data-nav="true" data-margin="30"
                     data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}, "991":{"items": "6"}, "1199":{"items": "7"}}'>
                    <!-- Categories will load here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CATEGORIES -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('categoriesContainer');

        // Fetch categories
        axios.get('/Category-list')
            .then(response => {
                if (response.data.msg === "success") {
                    const categories = response.data.data;
                    let html = '';

                    categories.forEach(category => {
                        html += `
                            <div class="item">
                                <div class="categories_box">
                                    <a href="/category/${category.id}">
                                        <img src="${category.categoryImg}" alt="${category.categoryName}" />
                                        <span>${category.categoryName}</span>
                                    </a>
                                </div>
                            </div>
                        `;
                    });

                    container.innerHTML = html;

                    // Reinitialize the carousel
                    $('.owl-carousel').owlCarousel('destroy'); // Destroy existing instance
                    $('.owl-carousel').owlCarousel({ // Reinitialize with options
                        loop: true,
                        margin: 30,
                        nav: true,
                        responsive: {
                            0: { items: 2 },
                            480: { items: 3 },
                            576: { items: 4 },
                            768: { items: 5 },
                            991: { items: 6 },
                            1199: { items: 7 },
                        }
                    });
                } else {
                    console.error('Error in response message:', response.data.msg);
                }
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    });
</script>
