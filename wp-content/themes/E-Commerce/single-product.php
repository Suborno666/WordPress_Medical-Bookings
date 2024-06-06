<?php
get_header();
// echo isset($GLOBALS['term_names']) ? $GLOBALS['term_names'] : 'Uncategorized';
?>

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->
        <?php 
            // Fetch top-level comments for the current post
            echo '<p>'.$GLOBALS['avg'].'</p>';
        ?>


        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <?php
                                if (have_posts()) {
                                    while (have_posts()) {
                                        the_post();
                                        // echo '<p>single-product.php is being used</p>';
                            ?>
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3">
                                <?php 
                                    the_title(); 
                                ?>
                                </h4>
                                <p class="mb-3">Category: 
                                    <?php 
                                       echo isset($GLOBALS['term_names']) ? $GLOBALS['term_names'] : 'Uncategorized';
                                    ?>
                                </p>
                                <h5 class="fw-bold mb-3"><?php echo 'Rs '.get_post_meta(get_the_ID(),'unique_mb_price_id',true).'/ kg'?></h5>
                                <div class="d-flex mb-4">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $avg) {
                                            echo '<i class="fa fa-star text-secondary"></i>';
                                        }else if($avg == 0){
                                            echo '<i class="fa fa-star"></i>';
                                        } 
                                        else{
                                            echo '<i class="fa fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>

                                <p class="mb-4">       
                                    <?php 
                                    the_excerpt(); 
                                    ?>
                                </p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>

                                <!-- Button trigger modal -->
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" style="border: 1px solid transparent !important;">
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-solid fa-file-export"></i> Submit Enquiry</a>
                                </button>
                                
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <?php 
                                    the_content(); 
                                    ?>
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_weight_id',true);?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Country of Origin</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_origin_id',true);?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Quality</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_quality_id',true)?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Сheck</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_check_id',true)?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Min Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_minWeight_id',true)?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php comments_template(); ?>
                            <?php
                                }
                            } else {
                                echo '<h2>Post not found</h2>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                            <div class="col-lg-12">
                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                                <div class="mb-4">
                                    <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <li>
                                                <?php 
                                                    // Initialize counters
                                                    $fruit_post_count = 0;
                                                    $vegetable_post_count = 0;
                                                    $bread_post_count = 0;
                                                    $meat_post_count = 0;

                                                    $args = array(  
                                                        'post_type' => ['product'],
                                                        'post_status' => 'publish',
                                                        'posts_per_page' => -1, 
                                                        'orderby'   => [
                                                            'date' =>'DESC',
                                                            'menu_order'=>'ASC',
                                                        ],
                                                        'order' => 'ASC', 
                                                    );

                                                    $query = new WP_Query($args);

                                                    foreach ($query->posts as $post) {
                                                        $terms = get_the_terms($post->ID, 'product category');
                                                        if ($terms && !is_wp_error($terms)) {
                                                            foreach ($terms as $term) {
                                                                switch ($term->slug) {
                                                                    case 'fruit':
                                                                        $fruit_post_count++;
                                                                        break;
                                                                    case 'vegetable':
                                                                        $vegetable_post_count++;
                                                                        break;
                                                                    case 'bread':
                                                                        $bread_post_count++;
                                                                        break;
                                                                    case 'meat':
                                                                        $meat_post_count++;
                                                                        break;
                                                                    default:
                                                                        // Handle unexpected terms if necessary
                                                                        break;
                                                                }
                                                            }
                                                        } else {
                                                            // Debugging output to ensure terms are fetched correctly
                                                            echo 'No terms found for post ID: ' . $post->ID . '<br>';
                                                        }
                                                    }

                                                ?>

                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Fruits</a>
                                                        <span>
                                                            <?php 
                                                            echo "(".$fruit_post_count.")";
                                                            ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Vegetables</a>
                                                        <span>
                                                            <?php 
                                                            echo "(".$vegetable_post_count.")";
                                                            ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Bread</a>
                                                        <span>
                                                            <?php 
                                                            echo "(".$bread_post_count.")";
                                                            ?>
                                                        </span>
                                                    </div>
                                                </li>
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Meat</a>
                                                    <span>
                                                        <?php 
                                                        echo "(".$meat_post_count.")";
                                                        ?>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-4">Featured products</h4>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="img/featur-1.jpg" class="img-fluid rounded" alt="Image">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="img/vegetable-item-4.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="img/vegetable-item-5.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="img/vegetable-item-6.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-4">
                                    <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <?php
                        $term = isset($GLOBALS['term_names']) ? $GLOBALS['term_names'] : 'Uncategorized';
                        $args = [
                            'post_type' => ['product'],
                            'post_status' => 'publish',
                            'posts_per_page' => -1, 
                            'orderby'   => [
                                'date' =>'DESC',
                                'menu_order'=>'ASC',
                            ],
                            'order' => 'ASC',
                            'tax_query' =>[ 
                                [
                                    'taxonomy' => 'product category',
                                    'field'    => 'slug',
                                    'terms'    => $term,
                                ],
                            ], 
                        ];
                        $loop = new WP_Query($args);
                        while($loop->have_posts()):$loop->the_post();
                    ?>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="<?php the_post_thumbnail_url('thumbnail')?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                        <?php 
                            $terms = get_the_terms(get_the_ID(), 'product category');
                            if ($terms && !is_wp_error($terms)) {
                                $term_names = array();
                                foreach ($terms as $term) {
                                    $term_names[] = $term->name;
                                }
                                echo implode(', ', $term_names);
                            } else {
                                echo 'Uncategorized';
                            }
                        ?>
                        </div>
                        <div class="p-4 rounded-bottom">
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_content(); ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0"><?php echo get_post_meta(get_the_ID(),'unique_mb_price_id',true).'/kg'?></p>
                                <a class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->



        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <?php
                if(!is_user_logged_in()){
                    $current_user = wp_get_current_user();
                }
                if(have_posts()){
                    the_post();
                    ?>
                    <form id="form" method="post" class="mx-auto p-2 grid gap-3 row gy-1" style="width: 450px;margin-top: 54px;">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Name" value="<?php echo $current_user->display_name;?>">
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput1">Email</label>
                            <input type="email" name="email" class="form-control" id="formGroupExampleInput1" placeholder="Email" value="<?php echo $current_user->user_email;?>">
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput1">Your Product</label>
                            <input type="text" name="product" class="form-control" id="formGroupExampleInput1" placeholder="Product" value="<?php the_title();?>">
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2">Quantity</label>
                            <input type="text" name="quantity" class="form-control" id="formGroupExampleInput2" placeholder="Quantity" value="1">
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput3">Price</label>
                            <input type="text" name="price" class="form-control" id="formGroupExampleInput3" placeholder="Price" value="<?php echo get_post_meta(get_the_ID(),'unique_mb_price_id',true); ?>">
                        </div>
                        
                        <p id="response"></p>
                        
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                <?php 
                } 
                ?>


            </div>
        </div>

        <script>
            let quantity; 
            let originalPrice;  

            $(document).ready((e) => {
                originalPrice = $('#formGroupExampleInput3').val();

                function updateValue() {
                    quantity = parseFloat($(this).find('input[type="text"]').val());
                    $('#formGroupExampleInput2').val(quantity);

                    let totalQuantity = quantity * originalPrice;
                    console.log(totalQuantity);

                    $('#formGroupExampleInput3').val(totalQuantity);
                }

                $('.input-group.quantity.mb-5').on('click', updateValue);

                $('.increase-button').on('click', updateValue);
                $('.decrease-button').on('click', updateValue);


                $("#form").on('submit',(e)=>{
                    e.preventDefault();
                    var formData = new FormData($('#form')[0]);
                    formData.append("action", "send_email");
                    for( var [key,value] of formData.entries()){
                        console.log(key,"=>",value)
                    }
                    $.ajax({
                        type:"POST",
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success:(res)=>{
                            $("#response").html(res.data);
                            $("#response").css('color','green');
                            $("#response").html(res.alert);
                            $("#response").css('color','red');
                        }
                    })
                })
            })

        </script>

        <?php

get_footer();
?>