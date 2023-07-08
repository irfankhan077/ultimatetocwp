<?php 

function nsm_shortcoder_button(){
    global $post;

    if( !$post )
    return false;

    $supported_types = [ 'page', 'post', 'product', 'service', 'job' ];
    
    if( in_array( $post->post_type, $supported_types ) ){
    ?>
    <button class="button button-primary shortcoder-trigger shortcoder-button" type="button">Generate Shortcodes</button>
    <?php
    }

}
add_action( 'media_buttons', 'nsm_shortcoder_button', 10 );

function nsm_shortcoder_popup(){

    ?>
    <div class="shortcoder-popup">

        <div class="shortcoder-shortcodes-list">

            <ul class="shortcoder-tabs">
                <li class="active"> General </li>
                <li> Post Types </li>
                <?php do_action( 'nsm/actions/shortcoder_tabs' ) ?>
            </ul>

            <div class="shortcoder-section active">
                <h3>General</h3>
                <div class="shortcode">
                    <h4 class="shortcode-title">Current Year</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="current_year">[current_year]</code>
                            <span>Prints out the current year. E.g. 2022</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                </div>
                <div class="shortcode">
                    <h4 class="shortcode-title">Current Month & Year</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="current_month_year">[current_month_year]</code>
                            <span>Prints out the current month and year. E.g. January 2022</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                </div>
                <div class="shortcode">
                    <h4 class="shortcode-title">Simple contact form</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="nsm_contact">[nsm_contact]</code>
                            <span>Prints out a contact form</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                </div>
                <div class="shortcode">
                    <h4 class="shortcode-title">Button</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="nsm_button">[nsm_button] </code>
                            <span>Prints a nicely designed button.</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                    <form class="shortcode-form" method="POST">
                        <div class="shortcode-options">
                            <div class="mt-10 mr-10">
                                <label for="align">Alignment</label>
                                <select name="align" id="align">
                                    <option value="text-center">Center Aligned</option>
                                    <option value="text-left">Left Aligned</option>
                                    <option value="text-right">Right Aligned</option>
                                </select>
                            </div>
                            <div class="mt-10 mr-10">
                                <label for="text">Text</label>
                                <input type="text" name="text" placeholder="Enter button text">
                            </div>
                            <div class="mt-10 mr-10">
                                <label for="link">Link</label>
                                <input type="text" name="link" placeholder="Enter button link">
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="generate-shortcode button" type="submit">Generate</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="shortcoder-section">
                <h3>Posts</h3>
                <div class="shortcode">
                    <h4 class="shortcode-title">Post List</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="post_list">[post_list]</code>
                            <span>Prints a list of posts</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                    <form class="shortcode-form" method="POST">
                        <div class="shortcode-options">

                            <div class="mt-10 mr-10">
                                <label for="shortcode-post_category">Category</label>
                                <select name="category" id="shortcode-post_category">
                                    <option value="">Select a category</option>
                                    <?php foreach( get_categories() as $key => $category ){ ?>
                                        <option value="<?php echo $category->term_id ?>"><?php echo $category->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mt-10 mr-10">
                                <label for="shortcode-post_columns">Columns</label>
                                <select name="columns" id="shortcode-post_columns">
                                    <option value="">Select columns</option>
                                    <option value="6">2</option>
                                    <option value="4">3</option>
                                    <option value="3">4</option>
                                    <option value="2">6</option>
                                </select>
                            </div>
                            <div class="mt-10 mr-10">
                                <label for="shortcode-post_per_page">Count per page</label>
                                <input name="count" type="number" placeholder="Enter number" value="5" id="shortcode-post_per_page">
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="generate-shortcode button" type="submit">Generate</button>
                        </div>
                    </form>
                </div>
                <?php if( $guides = NSM_Helper::populate_posts_dropdown('guide') ){ ?>
                <div class="shortcode">
                    <h4 class="shortcode-title">Single Guide</h4>
                    <div class="shortcode-inner">
                        <div>
                            <code class="shortcode-contents" data-shortcode="howto">[howto] </code>
                            <span>Prints the howTo content + schema on a given page.</span>
                        </div>
                        <div class="copy">
                            <span class="dashicons dashicons-clipboard"></span>
                            Copy to Clipboard
                        </div>
                    </div>
                    <form class="shortcode-form" method="POST">
                        <div class="shortcode-options">
                            <div class="mt-10 mr-10">
                                <label for="id">Guide</label>
                                <select name="id" id="id">
                                    <option value="">Select a guide</option>
                                    <?php foreach( $guides as $key => $guide ){ ?>
                                        <option value="<?php echo $key?>"><?php echo $guide ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="generate-shortcode button" type="submit">Generate</button>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </div>

            <?php do_action( 'nsm/actions/shortcoder_sections' ) ?>

        </div>

    </div>
    <div class="shortcoder-popup-overlay shortcoder-trigger"></div>
    <?php
}
add_action( 'admin_footer', 'nsm_shortcoder_popup', 10 );

function nsm_shortcoder_scripts(){
	wp_enqueue_style( 'shortcoder', NSM_URI . '/assets/css/shortcoder.css', [], NSM_VERSION );
	wp_enqueue_script( 'shortcoder', NSM_URI . '/assets/js/shortcoder.js', [ 'jquery' ], NSM_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'nsm_shortcoder_scripts' );