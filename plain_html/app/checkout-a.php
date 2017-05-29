<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
  <?php include 'head.php'; ?>
</head>

<body class="min-height-version">
  <?php include "header.php"; ?>

  <!--
     _____ ___ _____ _     _____
    |_   _|_ _|_   _| |   | ____|
      | |  | |  | | | |   |  _|
      | |  | |  | | | |___| |___
      |_| |___| |_| |_____|_____|

  -->


  <article id="page-checkout-title-section" class="visible-md visible-lg">
    <div class="container-fluid has-breakpoint">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-9">
          <div id="page-checkout-title">
            <h1>You have <strong>3</strong> items in your cart.</h1>
          </div>
        </div>
      </div>
    </div>
  </article> <!-- page-checkout-title-section -->

  <!--
      ____ ___  _   _ _____ _____ _   _ _____
     / ___/ _ \| \ | |_   _| ____| \ | |_   _|
    | |  | | | |  \| | | | |  _| |  \| | | |
    | |__| |_| | |\  | | | | |___| |\  | | |
     \____\___/|_| \_| |_| |_____|_| \_| |_|

  -->

  <form class="checkout-form">
    <article id="page-checkout-content-section" class="visible-md visible-lg">

      <div id="page-checkout-content-section-bg">
        <div class="sidebar-bg"></div>
        <div class="content-bg"></div>
      </div>

      <div class="container-fluid has-breakpoint">
        <div class="row">
          <div class="col-md-2 col-tablet-landscape-1">

            <!--
               ____ ___ ____  _____ ____    _    ____
              / ___|_ _|  _ \| ____| __ )  / \  |  _ \
              \___ \| || | | |  _| |  _ \ / _ \ | |_) |
               ___) | || |_| | |___| |_) / ___ \|  _ <
              |____/___|____/|_____|____/_/   \_\_| \_\

            -->

            <div id="page-checkout-sidebar-width"></div>
            <div id="page-checkout-sidebar">

              <nav>
                <ul>
                  <li class="selected">1. Your Cart</li>
                  <li>2. Shipping & Billing</li>
                  <li>3. Order Confirmation</li>
                </ul>
              </nav>

            </div> <!-- page-checkout-sidebar -->



          </div> <!-- col-md-2 -->
          <div class="col-md-10 col-tablet-landscape-11">


            <!--
                ____ ___  _   _ _____ _____ _   _ _____
               / ___/ _ \| \ | |_   _| ____| \ | |_   _|
              | |  | | | |  \| | | | |  _| |  \| | | |
              | |__| |_| | |\  | | | | |___| |\  | | |
               \____\___/|_| \_| |_| |_____|_| \_| |_|

            -->

            <div id="page-checkout-content-width"></div>
            <div id="page-checkout-content">



              <div id="page-checkout-cart-container">
                <div id="page-checkout-cart">

                  <!--
                     _____  _    ____  _     _____
                    |_   _|/ \  | __ )| |   | ____|
                      | | / _ \ |  _ \| |   |  _|
                      | |/ ___ \| |_) | |___| |___
                      |_/_/   \_\____/|_____|_____|

                  -->


                  <div id="page-checkout-cart-table">

                    <div id="page-checkout-cart-table-header">
                      <div class="row">
                        <div class="col-md-2">
                          <h4 class="left-aligned">Product</h4>
                        </div>
                        <div class="col-md-4">
                          <h4 class="center-aligned">Description</h4>
                        </div>
                        <div class="col-md-2">
                          <h4 class="center-aligned">Unit Price</h4>
                        </div>
                        <div class="col-md-2">
                          <h4 class="center-aligned">Quantity</h4>
                        </div>
                        <div class="col-md-2">
                          <h4 class="center-aligned">Subtotal</h4>
                        </div>
                      </div>
                    </div> <!-- page-checkout-cart-table-header -->

                    <div id="page-checkout-cart-table-content">

                      <!--
                          ___  _
                         / _ \/ |
                        | | | | |
                        | |_| | |
                         \___/|_|

                      -->

                      <div class="page-checkout-cart-table-item">
                        <div class="row">
                          <div class="col-md-2">

                            <a href="product-detail.php" title="Momotaro" class="cart-item-image">
                              <div class="manic-image-container" data-scale-mode="show_all" data-horizontal-align="left">
                                <img src="" 
                                  data-image-desktop="images_cms/cart/cart-image-01.png"
                                  data-image-tablet="images_cms/cart/cart-image-01.png"
                                  data-image-mobile="images_cms/cart/cart-image-01.png">
                              </div>
                            </a>

                          </div>
                          <div class="col-md-4">

                            <div class="cart-item-description">
                              <h2><a href="product-detail.php" title="Momotaro">Momotaro</a></h2>
                              <h3>ももたろう</h3>
                              <p>Japanese Sencha with White Peach</p>
                            </div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-value">$16.90</div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-quantity-container">

                              <div class="form-quantity">
                                <a href="javascript:void(0);" class="form-quantity-minus-btn"></a>
                                <input type="text" id="" name="" class="form-quantity-input-txt" value="2">
                                <a href="javascript:void(0);" class="form-quantity-plus-btn"></a>
                              </div>

                            </div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-value-and-button">
                              <div class="cart-item-value">$33.80</div>
                              <a href="javascript:void(0);" class="cart-item-close-btn close-btn"></a>
                            </div>

                          </div>
                          
                        </div>
                      </div>

                      <!--
                          ___ ____
                         / _ \___ \
                        | | | |__) |
                        | |_| / __/
                         \___/_____|

                      -->

                      <div class="page-checkout-cart-table-item">
                        <div class="row">
                          <div class="col-md-2">

                            <a href="product-detail.php" title="Momotaro" class="cart-item-image">
                              <div class="manic-image-container" data-scale-mode="show_all" data-horizontal-align="left">
                                <img src="" 
                                  data-image-desktop="images_cms/cart/cart-image-02.png"
                                  data-image-tablet="images_cms/cart/cart-image-02.png"
                                  data-image-mobile="images_cms/cart/cart-image-02.png">
                              </div>
                            </a>

                          </div>
                          <div class="col-md-4">

                            <div class="cart-item-description">
                              <h2><a href="product-detail.php" title="Momotaro">Koku Yuzu Kukicha</a></h2>
                              <h3>濃ゆず茎茶</h3>
                              <p>Japanese Twig Tea with Kochi Yuzu</p>
                            </div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-value">$16.90</div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-quantity-container">

                              <div class="form-quantity">
                                <a href="javascript:void(0);" class="form-quantity-minus-btn"></a>
                                <input type="text" id="" name="" class="form-quantity-input-txt" value="2">
                                <a href="javascript:void(0);" class="form-quantity-plus-btn"></a>
                              </div>

                            </div>

                          </div>
                          <div class="col-md-2">

                            <div class="cart-item-value-and-button">
                              <div class="cart-item-value">$33.80</div>
                              <a href="javascript:void(0);" class="cart-item-close-btn close-btn"></a>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div> <!-- page-checkout-cart-table-content -->

                  </div> <!-- page-checkout-cart-table -->

                  <div id="page-checkout-cart-middle">
                    <div class="row">
                      <div class="col-md-6">
                        <p>This shopping cart is worth S$4 in rebates.</p>
                      </div>
                      <div class="col-md-6">
                        <div class="cta-container">
                          <a href="" class="update-cta">Update Your Cart</a>
                        </div>
                      </div>
                    </div>
                  </div> <!-- page-checkout-cart-middle -->

                  <!--
                     ____  _   _ ____ _____ ___ _____  _    _
                    / ___|| | | | __ )_   _/ _ \_   _|/ \  | |
                    \___ \| | | |  _ \ | || | | || | / _ \ | |
                     ___) | |_| | |_) || || |_| || |/ ___ \| |___
                    |____/ \___/|____/ |_| \___/ |_/_/   \_\_____|

                  -->


                  <div id="page-checkout-cart-subtotal">
                    <div class="row">
                      <div class="col-md-8"></div>
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="column-01">
                              <p>Subtotal:</p>
                            </div>

                          </div>
                          <div class="col-md-6">

                            <div class="column-02">
                              <p>$50.70</p>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- page-checkout-cart-subtotal -->

                  <!--
                     ____ ___ ____   ____ ___  _   _ _   _ _____
                    |  _ \_ _/ ___| / ___/ _ \| | | | \ | |_   _|
                    | | | | |\___ \| |  | | | | | | |  \| | | |
                    | |_| | | ___) | |__| |_| | |_| | |\  | | |
                    |____/___|____/ \____\___/ \___/|_| \_| |_|

                  -->

                  <div id="page-checkout-cart-discount">
                    <div class="row">
                      <div class="col-md-5 col-tablet-landscape-6">

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                              <label>Discount code</label>
                            </div>
                            <div class="col-md-5">
                              <input type="text" name="" id="">
                            </div>
                            <div class="col-md-3">
                              <div class="cart-discount-cta-container">
                                <a href="javascript:void(0);" class="square-cta full-width-version">Apply</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                              <label>Gift Certificate</label>
                            </div>
                            <div class="col-md-5">
                              <input type="text" name="" id="">
                            </div>
                            <div class="col-md-3">
                              <div class="cart-discount-cta-container">
                                <a href="javascript:void(0);" class="square-cta full-width-version">Apply</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div> <!-- page-checkout-cart-discount -->




                </div> <!-- page-checkout-cart -->
              </div> <!-- page-checkout-cart-container -->
              
              <div id="page-checkout-content-footer">
                <div class="row">
                  <div class="col-md-6">
                    <div class="cta-container-01">
                      <a href="shop.php" class="arrow-cta reverse-version">Continue Shopping</a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="cta-container-02">
                      <a href="checkout-c.php" class="square-cta">Check-out</a>
                    </div>
                  </div>
                </div>
              </div>
              
            </div> <!-- page-checkout-content -->

          </div> <!-- col-md-10 -->
        </div> <!-- row -->
      </div> <!-- container-fluid -->
    </article> <!-- page-checkout-content-section -->

  </form>
  

  <?php include "footer.php"; ?>
  <?php include "script_checkout.php" ?>
</body>
</html>