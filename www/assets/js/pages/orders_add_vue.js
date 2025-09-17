// Vue app for orders/add page: lightweight interop with existing jQuery flows
// Assumptions: AdminLTE/jQuery already loaded, global BOOTSTRAP_DATA populated via renderBootstrapData

(function(){
    if(typeof window.Vue === 'undefined') return; // Guard if CDN not loaded

    const { createApp, reactive, computed } = window.Vue;

    const state = reactive({
        categories: [],
        productsByCategoryId: {},
        addonsByCategoryId: {},
        selectedCategoryId: null,
        selectedCategoryName: ''
    });

    function hydrateFromBootstrap(bootstrap){
        if(!bootstrap || !bootstrap.result) return;
        state.categories = bootstrap.categories || [];
        state.productsByCategoryId = bootstrap.productsByCategoryId || {};
        state.addonsByCategoryId = bootstrap.addonsByCategoryId || {};
    }

    // Initial hydrate if BOOTSTRAP_DATA was set synchronously by existing JS
    if(window.BOOTSTRAP_DATA) {
        hydrateFromBootstrap(window.BOOTSTRAP_DATA);
    }

    // Listen for custom event in case bootstrap arrives later
    window.addEventListener('orders:bootstrap', function(e){
        hydrateFromBootstrap(e.detail);
    });

    // Categories component
    const Categories = {
        name: 'Categories',
        setup(){
            const onSelectCategory = (category) => {
                // Keep interop with existing jQuery flow
                state.selectedCategoryId = category.id;
                state.selectedCategoryName = category.name;
                const evt = new CustomEvent('orders:categorySelected', { detail: { id: category.id, name: category.name } });
                window.dispatchEvent(evt);
            };
            return { state, onSelectCategory };
        },
        template: `
            <div class="row" style="position:relative;">
                <div class="col-sm-12"><h3>Select Category</h3></div>
                <div class="target d-flex flex-wrap">
                    <div v-for="c in state.categories" :key="c.id" class="col-md-4 btn pos-btn btn-default select-category"
                         @click="onSelectCategory(c)" style="margin-bottom:8px;">
                        <div class="image"><img :src="(c.photo ? (base_url + 'uploads/product_categories/' + c.photo) : (base_url + 'assets/images/image-placeholder-200px.png'))" alt=""></div>
                        <div class="label">{{ c.name }}</div>
                    </div>
                </div>
            </div>
        `
    };

    // Products component
    const Products = {
        name: 'Products',
        setup(){
            const products = computed(() => state.productsByCategoryId[state.selectedCategoryId] || []);
            const addons = computed(() => state.addonsByCategoryId[state.selectedCategoryId] || []);
            const back = () => {
                state.selectedCategoryId = null;
                state.selectedCategoryName = '';
                window.dispatchEvent(new Event('orders:backToCategories'));
            };
            const selectProduct = (p) => {
                // Mirror jQuery click by triggering a custom event consumed by existing JS
                const el = document.createElement('div');
                el.dataset.productId = p.id;
                el.dataset.productPrice = p.selling_price;
                el.dataset.productVat = p.vat;
                el.dataset.productName = p.name;
                el.dataset.category = p.categoryName;
                const evt = new CustomEvent('orders:productSelected', { detail: { el, product: p } });
                window.dispatchEvent(evt);
            };
            const selectAddon = (a) => {
                const el = document.createElement('div');
                el.dataset.productId = a.id;
                el.dataset.productPrice = a.selling_price;
                el.dataset.productVat = a.vat;
                el.dataset.productName = a.name;
                el.dataset.category = a.categoryName;
                const evt = new CustomEvent('orders:addonSelected', { detail: { el, product: a } });
                window.dispatchEvent(evt);
            };
            return { state, products, addons, back, selectProduct, selectAddon };
        },
        template: `
            <div class="row">
                <div class="col-sm-12">
                    <h3><span class='category-name'>{{ state.selectedCategoryName }}</span>
                        <div class='backToCategories cursor-pointer float-right' @click="back"><i class="fa fa-chevron-left"></i> Back</div>
                    </h3>
                </div>
                <div class="target d-flex flex-wrap">
                    <div v-for="p in products" :key="p.id" class="col-md-4 btn pos-btn btn-default select-product" @click="selectProduct(p)" style="margin-bottom:8px;">
                        <div class="image"><img :src="(p.photo ? (base_url + 'uploads/products/' + p.photo) : (base_url + 'assets/images/image-placeholder-200px.png'))" alt=""></div>
                        <div class="label">{{ p.name }}</div>
                        <div class="price">Rs {{ Number(p.selling_price).toLocaleString('en-US') }}</div>
                    </div>
                </div>
                <div id="addons-block" :class="{'d-none': addons.length===0}">
                    <div class="content d-flex flex-wrap">
                        <div v-for="a in addons" :key="a.id" class="col-md-4 btn addon-btn btn-default select-addon" @click="selectAddon(a)" style="margin-bottom:8px;">
                            <div class="image"><img :src="(a.photo ? (base_url + 'uploads/addons/' + a.photo) : (base_url + 'assets/images/image-placeholder-200px.png'))" alt=""></div>
                            <div class="label">{{ a.name }}</div>
                            <div class="price">Rs {{ Number(a.selling_price).toLocaleString('en-US') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        `
    };

    // Provide base_url to templates
    window.base_url = window.base_url || '';

    // Mount categories section
    const categoriesRoot = document.querySelector('#categories');
    if(categoriesRoot){
        const app = createApp(Categories);
        app.mount(categoriesRoot);
    }

    // Mount products section is disabled to avoid duplicate rendering and layout conflicts
    // const productsRoot = document.querySelector('#products');
    // if(productsRoot){
    //     const app2 = createApp(Products);
    //     app2.mount(productsRoot);
    // }

})();

