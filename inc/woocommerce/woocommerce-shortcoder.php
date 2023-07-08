<?php
function nsm_shortcoder_tabs(){
    ?>
    <li> Products </li>
    <?php
}
add_action( 'nsm/actions/shortcoder_tabs', 'nsm_shortcoder_tabs' );

function nsm_shortcoder_shortcodes(){
    ?>
    <div class="shortcoder-section">
        <h3>Products</h3>
        <div class="shortcode">
            <h4 class="shortcode-title">Product List</h4>
            <div class="shortcode-inner">
                <div>
                    <code class="shortcode-contents" data-shortcode="products">[products]</code>
                    <span>Prints a list of products</span>
                </div>
                <div class="copy">
                    <span class="dashicons dashicons-clipboard"></span>
                    Copy to Clipboard
                </div>
            </div>
            <form class="shortcode-form" method="POST">
                <div class="shortcode-options">

                    <div class="mt-10 mr-10">
                        <label for="shortcode-product_category">Category</label>
                        <select name="category" id="shortcode-product_category">
                            <option value="">Select a category</option>
                            <?php foreach( NSM_Helper::get_tax_terms( null, 'product_cat' ) as $key => $category ){ ?>
                                <option value="<?php echo $category->term_id ?>"><?php echo $category->name ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mt-10 mr-10">
                        <label for="shortcode-post_columns">Columns</label>
                        <select name="columns" id="shortcode-post_columns">
                            <option value="">Select columns</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4" selected>4</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="mt-10 mr-10">
                        <label for="shortcode-product_per_page">Count per page</label>
                        <input name="limit" type="number" placeholder="Enter number" value="5" id="shortcode-product_per_page">
                    </div>
                </div>
                <div class="mt-10">
                    <button class="generate-shortcode button" type="submit">Generate</button>
                </div>
            </form>
        </div>
    </div>
    <?php
}
add_action( 'nsm/actions/shortcoder_sections', 'nsm_shortcoder_shortcodes' );
