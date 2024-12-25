<!-- START SECTION CLIENT LOGO -->
<div class="section small_pt">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row" id="clientLogoContainer">
                    <!-- Dynamic client logos will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('clientLogoContainer');

        // Fetch client logos
        axios.get('/Brand-list')
            .then(response => {
                if (response.data.msg === "success") {
                    const brands = response.data.data;
                    let html = '';

                    brands.forEach(brand => {
                        html += `
                            <div class="col-md-2 col-sm-3 col-4">
                                <div class="cl_logo">
                                    <img src="${brand.brandImg}" alt="${brand.brandName}" />
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
                console.error('Error fetching brands:', error);
            });
    });
</script>
