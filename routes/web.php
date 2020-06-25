<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * -----------------------------------------------------------------------------------------------------------
 * Customer Routes
 * -----------------------------------------------------------------------------------------------------------
 */

/*===============================
 * Customer Login register Routes
================================*/
Auth::routes();

//Social login Routes
Route::get('/login/{provider}', 'Auth\SocialController@redirect')->name('customer.social.login');
Route::get('/login/callback/{provider}', 'Auth\SocialController@callback');

//Customer Password Change Routes
Route::get('/change/password', 'Auth\PasswordController@index')->name('change.password');
Route::post('/password/update', 'Auth\PasswordController@Update')->name('change.password.update');

/*============================
 * Customer Dashboard Routes
=============================*/
Route::prefix('customer')->group(function () {
    Route::get('/dashboard', 'Customer\CustomerController@dashboard')->name('home');
    Route::get('/my-account', 'Customer\CustomerController@account')->name('customer.account');
    Route::get('/billing-address', 'Customer\CustomerController@billing')->name('customer.billing.address');

    //Orders Routes
    Route::get('/orders/all', 'Customer\OrderController@NewOrder')->name('customer.new.order');
    Route::get('/orders/complete', 'Customer\OrderController@CompleteOrder')->name('customer.complete.order');

    //Profile Routes
    Route::get('/profile', 'Customer\CustomerController@show')->name('customer.profile');
    Route::post('/profile/update/{id}', 'Customer\CustomerController@update')->name('customer.profile.update');

    //wishlist Routes
    Route::get('/wishlist', 'Customer\WishlistController@Show')->name('customer.wishlist');
    Route::get('/wishlist/delete/{id}/{ran}', 'Customer\WishlistController@Delete')->name('delete.wishlist');

    //Feedback Routes
    Route::get('/feedback/pending', 'Customer\FeedbackController@Pending')->name('customer.pending.feedback');
    Route::get('/product/feedback/{slug}/{ord_id}/{ran}', 'Customer\FeedbackController@SingleProduct')->name('customer.Product.feedback');
});

/*
 * -----------------------------------------------------------------------------------------------------------
 * Front-end Routes
 * -----------------------------------------------------------------------------------------------------------
 */

//Homepage Routes
Route::get('/', 'Frontend\HomeController@index')->name('site_url');

//Search Routes
Route::get('/search', 'Frontend\HomeController@Search')->name('product.search');

//Shop Page Routes
Route::get('/shop', 'Frontend\ShopPageController@index')->name('shop.page');

//wishlist route
Route::get('/product/wishlist/{id}', 'Frontend\WishlistController@Store')->name('add.wishlist');

//Blog page Routes
Route::get('/blog', 'Frontend\BlogPageController@index')->name('blog.page');

//Blog Taxonomy page Routes
Route::get('/blog/category/{name}/{id}', 'Frontend\BlogPageController@taxonomy')->name('blog.category.page');

//Blog Single View Routes
Route::get('/blog/{slug}/{rand}', 'Frontend\BlogPageController@view')->name('single.blog.page');

//Contact Page Routes
Route::get('/contact', 'Frontend\ContactPageController@index')->name('contact.page');
Route::post('/contact', 'Frontend\ContactPageController@mail')->name('contact.mail');

//About Page Routes
Route::get('/about', 'Frontend\AboutPageController@index')->name('about.page');

//Order Tracking Page Routes
Route::post('/order/tracking/{id}', 'Frontend\TrackingController@tracking')->name('order.tracking');

//Single Product View Routes
Route::get('/product/{slug}/{ran}', 'Frontend\SingleProductPageController@view')->name('single.product.view');

//Product Review Routes
Route::post('/product/review/store/{id}/{ord_id}', 'Frontend\ReviewsController@store')->name('product.review');

//Quick Product View Ajax
Route::get('/product/single/quick/view/{id}', 'Frontend\SingleProductPageController@QuickView')->name('single.product.quick.view');
Route::get('/product/quick-view/', 'Frontend\HomeController@QuickShow')->name('quick.view');

//Newsletters Routes
Route::post('/newsletter/store', 'Frontend\NewsletterController@store')->name('newsletter.store');

//================
//Cart Page Routes
//================
Route::get('/cart', 'Frontend\CartPageController@index')->name('cart.page');
//Single cart Routes
Route::get('/product/single/add-to-cart/{id}', 'Frontend\CartPageController@SingleCart')->name('single.cart');
//multi cart routes
Route::post('/product/single/model/cart', 'Frontend\CartPageController@ModelCart')->name('single.model.cart');
Route::post('/products/add/cart/{id}', 'Frontend\CartPageController@Cart')->name('products.add.cart');
Route::get('/cart/remove/{id}', 'Frontend\CartPageController@Delete')->name('cart.remove');
//all cart remove
Route::get('/cart/remove/all', 'Frontend\CartPageController@AllDelete')->name('all.cart.remove');
Route::post('/cart/update/{id}', 'Frontend\CartPageController@Update')->name('cart.update');
//Ajax Cart Remove
Route::get('/topbar/cart/remove/{id}', 'Frontend\CartPageController@CartRemove')->name('cart.remove.ajax');

//====================
//Checkout Page Routes
//====================
Route::get('/checkout', 'Frontend\CheckoutController@show')->name('checkout.page');
Route::post('/checkout/order/payment', 'Frontend\CheckoutController@Order')->name('order.page');
Route::get('/checkout/payment', 'Frontend\CheckoutController@PaymentShow')->name('order.payment.page');
Route::post('/checkout/payment', 'Frontend\CheckoutController@Payment')->name('order.payment');
//Coupon Routes
Route::post('/apply/coupon', 'Frontend\CouponController@Coupon')->name('apply.coupon');
Route::get('/remove/coupon', 'Frontend\CouponController@Remove')->name('remove.coupon');

//Location Ajax Routes
Route::get('/api/get_state/{id}', 'Frontend\CheckoutController@State')->name('state.ajax');

//OrderConfirm Page Route
Route::get('/order/confirm/'.md5('confirm-your-order'), 'Frontend\CheckoutController@Confirm')->name('order.confirm.page');

//====================
//Taxonomy Page Routes
//====================
Route::get('/shop/category/{name}/{id}', 'Frontend\TaxonomyController@Category')->name('category.taxonomy');
Route::get('/shop/category/subcategory/{name}/{id}', 'Frontend\TaxonomyController@SubCategory')->name('subcategory.taxonomy');
Route::get('/shop/brand/{name}/{id}', 'Frontend\TaxonomyController@Brand')->name('brand.taxonomy');


/*
 * ----------------------------------------------------------------------------------------------------------
 * admin Routes
 * ----------------------------------------------------------------------------------------------------------
 */

Route::prefix('admin')->group(function (){
    Route::get('/', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');

    //Admin Logout
    Route::get('/logout', 'Admin\AdminController@logout')->name('admin.logout');

    //Password Reset Route
    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');


    Route::get('/password/confirm', 'Admin\Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
    Route::post('/password/confirm', 'Admin\Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm.post');

    //Change Password Route
    Route::get('/change/password', 'Admin\Auth\PasswordController@index')->name('admin.change.password');
    Route::post('/password/update', 'Admin\Auth\PasswordController@Update')->name('admin.change.password.update');

    /*====================================================================================
     * Admin Dashboard Page Routes
     =====================================================================================*/
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

    /*===============================
     * E-commerce Page Routes start
     ===============================*/
    //e-commerce dashboard Routes
    Route::get('/ecommerce/dashboard', 'Admin\Ecommerce\DashboardController@show')->name('admin.ecommerce.dashboard');

    /*===============================
     * E-commerce Orders Routes start
     ===============================*/
    Route::get('/ecommerce/orders', 'Admin\Order\OrderController@AllOrders')->name('admin.all.orders');

    Route::get('/orders/new', 'Admin\Order\OrderController@NewOrders')->name('admin.new.orders');
    Route::get('/orders/pending', 'Admin\Order\OrderController@PendingOrders')->name('admin.pending.orders');

    Route::get('/orders/confirm', 'Admin\Order\OrderController@ConfirmOrders')->name('admin.confirm.orders');
    Route::get('/orders/confirm/{id}', 'Admin\Order\OrderController@ConfirmOrder')->name('admin.confirm.order');

    Route::get('/orders/processing', 'Admin\Order\OrderController@ProcessingOrders')->name('admin.processing.orders');
    Route::get('/orders/processing/{id}', 'Admin\Order\OrderController@ProcessingOrder')->name('admin.processing.order');

    Route::get('/orders/complete', 'Admin\Order\OrderController@CompleteOrders')->name('admin.complete.orders');
    Route::get('/orders/complete/{id}', 'Admin\Order\OrderController@CompleteOrder')->name('admin.complete.order');

    Route::get('/orders/on-hold', 'Admin\Order\OrderController@HoldOrders')->name('admin.hold.orders');
    Route::get('/orders/on-hold/{id}', 'Admin\Order\OrderController@HoldOrder')->name('admin.hold.order');

    Route::get('/orders/edit/{id}', 'Admin\Order\OrderController@EditOrder')->name('admin.edit.orders');
    Route::get('/orders/delete/{id}', 'Admin\Order\OrderController@DeleteOrder')->name('admin.delete.order');


    /*=============================
     * Shipping Method Routes start
     =============================*/
    Route::get('/ecommerce/shipping/method', 'Admin\Ecommerce\ShippingController@show')->name('admin.shipping');
    Route::post('/ecommerce/shipping/store', 'Admin\Ecommerce\ShippingController@store')->name('admin.shipping.store');
    Route::get('/ecommerce/shipping/edit/{id}', 'Admin\Ecommerce\ShippingController@edit')->name('admin.shipping.edit');
    Route::post('/ecommerce/shipping/update/{id}', 'Admin\Ecommerce\ShippingController@update')->name('admin.shipping.update');
    Route::get('/ecommerce/shipping/delete/{id}', 'Admin\Ecommerce\ShippingController@delete')->name('admin.shipping.delete');

    //Shipping Method Active-Inactive Routes
    Route::get('/ecommerce/shipping/active/{id}', 'Admin\Ecommerce\ShippingController@Active')->name('admin.shipping.active');
    Route::get('/ecommerce/shipping/inactive/{id}', 'Admin\Ecommerce\ShippingController@Inactive')->name('admin.shipping.inactive');

    /*============================
     * Admin Product Routes start
     ============================*/

    //Product Category Routes
    Route::get('/product/category', 'Admin\Product\CategoryController@index')->name('admin.category');
    Route::post('/product/category/store', 'Admin\Product\CategoryController@store')->name('admin.category.store');
    Route::get('/product/category/edit/{id}', 'Admin\Product\CategoryController@edit')->name('admin.category.edit');
    Route::post('/product/category/update/{id}', 'Admin\Product\CategoryController@update')->name('admin.category.update');
    Route::get('/product/category/delete/{id}', 'Admin\Product\CategoryController@delete')->name('admin.category.delete');

    //Product Brand Routes
    Route::get('/product/brand', 'Admin\Product\BrandController@index')->name('admin.brand');
    Route::post('/product/brand/store', 'Admin\Product\BrandController@store')->name('admin.brand.store');
    Route::get('/product/brand/edit/{id}', 'Admin\Product\BrandController@edit')->name('admin.brand.edit');
    Route::post('/product/brand/update/{id}', 'Admin\Product\BrandController@update')->name('admin.brand.update');
    Route::get('/product/brand/delete/{id}', 'Admin\Product\BrandController@delete')->name('admin.brand.delete');

    //Product Sub-Category Routes
    Route::get('/product/sub-category', 'Admin\Product\SubcategoryController@index')->name('admin.subcategory');
    Route::post('/product/sub-category/store', 'Admin\Product\SubcategoryController@store')->name('admin.subcategory.store');
    Route::get('/product/sub-category/edit/{id}', 'Admin\Product\SubcategoryController@edit')->name('admin.subcategory.edit');
    Route::post('/product/sub-category/update/{id}', 'Admin\Product\SubcategoryController@update')->name('admin.subcategory.update');
    Route::get('/product/sub-category/delete/{id}', 'Admin\Product\SubcategoryController@delete')->name('admin.subcategory.delete');
    //Get Product Subcategory Via Ajax
    Route::get('/get/subcategory/{id}', 'Admin\Product\ProductController@ajaxSubcategory')->name('admin.ajax.subcategory');

    //Product Coupon Routes
    Route::get('/coupon', 'Admin\Coupon\CouponController@index')->name('admin.coupon');
    Route::post('/coupon/store', 'Admin\Coupon\CouponController@store')->name('admin.coupon.store');
    Route::get('/coupon/edit/{id}', 'Admin\Coupon\CouponController@edit')->name('admin.coupon.edit');
    Route::post('/coupon/update/{id}', 'Admin\Coupon\CouponController@update')->name('admin.coupon.update');
    Route::get('/coupon/delete/{id}', 'Admin\Coupon\CouponController@delete')->name('admin.coupon.delete');

    //Product Routes
    Route::get('/product', 'Admin\Product\ProductController@index')->name('admin.product');
    Route::get('/product/add-new', 'Admin\Product\ProductController@showProductForm')->name('admin.product.add.new');
    Route::post('/product/store', 'Admin\Product\ProductController@store')->name('admin.product.store');
    Route::get('/product/edit/{id}', 'Admin\Product\ProductController@edit')->name('admin.product.edit');
    Route::post('/product/update/{id}', 'Admin\Product\ProductController@update')->name('admin.product.update');
    Route::get('/product/delete/{id}', 'Admin\Product\ProductController@delete')->name('admin.product.delete');

    //Product Active-Inactive Routes
    Route::get('/product/active/{id}', 'Admin\Product\ProductController@Active')->name('admin.product.active');
    Route::get('/product/inactive/{id}', 'Admin\Product\ProductController@Inactive')->name('admin.product.inactive');

    /*===================
     * Review Route
     ====================*/
    Route::get('/reviews', 'Admin\Ecommerce\ReviewsController@index')->name('admin.review');
    Route::get('/reviews/delete/{id}', 'Admin\Ecommerce\ReviewsController@delete')->name('admin.review.delete');

    /*===================================
     * Stock Management Page Routes start
     ====================================*/
    Route::get('/stock/all', 'Admin\Product\StockManageController@ShowAll')->name('admin.stock');
    Route::get('/stock/out-of-stock', 'Admin\Product\StockManageController@ShowOutStock')->name('admin.stock.out');
    Route::get('/stock/low-stock', 'Admin\Product\StockManageController@ShowLowStock')->name('admin.stock.low');

    /*=============================
     * Admin Blog post Routes start
     =============================*/

    //Post Category Routes
    Route::get('/blog/category', 'Admin\Post\PostCategoryController@index')->name('admin.post.category');
    Route::post('/blog/category/store', 'Admin\Post\PostCategoryController@store')->name('admin.post.category.store');
    Route::get('/blog/category/edit/{id}', 'Admin\Post\PostCategoryController@edit')->name('admin.post.category.edit');
    Route::post('/blog/category/update/{id}', 'Admin\Post\PostCategoryController@update')->name('admin.post.category.update');
    Route::get('/blog/category/delete/{id}', 'Admin\Post\PostCategoryController@delete')->name('admin.post.category.delete');


    //Post Tags Routes
    Route::get('/blog/tags', 'Admin\Post\PostTagController@index')->name('admin.post.tag');
    Route::post('/blog/tags/store', 'Admin\Post\PostTagController@store')->name('admin.post.tag.store');
    Route::get('/blog/tags/edit/{id}', 'Admin\Post\PostTagController@edit')->name('admin.post.tag.edit');
    Route::post('/blog/tags/update/{id}', 'Admin\Post\PostTagController@update')->name('admin.post.tag.update');
    Route::get('/blog/tags/delete/{id}', 'Admin\Post\PostTagController@delete')->name('admin.post.tag.delete');

    //Blog Post Routes
    Route::get('/blog', 'Admin\Post\PostController@index')->name('admin.post');
    Route::get('/blog/add-new', 'Admin\Post\PostController@showProductForm')->name('admin.post.add.new');
    Route::post('/blog/store', 'Admin\Post\PostController@store')->name('admin.post.store');
    Route::get('/blog/edit/{id}', 'Admin\Post\PostController@edit')->name('admin.post.edit');
    Route::post('/blog/update/{id}', 'Admin\Post\PostController@update')->name('admin.post.update');
    Route::get('/blog/delete/{id}', 'Admin\Post\PostController@delete')->name('admin.post.delete');

    //Get Blog Post Subcategory Via Ajax
    Route::get('/post/get/subcategory/{id}', 'Admin\Post\PostController@ajaxSubcategory')->name('admin.post.ajax.subcategory');

    //Blog Post Active-Inactive Routes
    Route::get('/blog/active/{id}', 'Admin\Post\PostController@Active')->name('admin.post.active');
    Route::get('/blog/inactive/{id}', 'Admin\Post\PostController@Inactive')->name('admin.post.inactive');


    /*==============================
     * Theme Panel Page Routes start
     ===============================*/
    //header footer panel route
    Route::get('/theme/panel/header-footer', 'Admin\Settings\ThemePanelController@HeaderShow')->name('admin.theme.header');
    Route::post('/theme/panel/header/update/{id}', 'Admin\Settings\ThemePanelController@HeaderUpdate')->name('admin.theme.header.update');
    Route::post('/theme/panel/footer/update/{id}', 'Admin\Settings\ThemePanelController@FooterUpdate')->name('admin.theme.footer.update');
    //slider panel routes
    Route::get('/theme/panel/slider', 'Admin\Settings\ThemePanelController@SliderShow')->name('admin.theme.slider');
    Route::post('/theme/panel/slider/store', 'Admin\Settings\ThemePanelController@SliderStore')->name('admin.theme.slider.store');
    Route::get('/theme/panel/slider/delete/{id}', 'Admin\Settings\ThemePanelController@SliderDelete')->name('admin.theme.slider.delete');
    Route::get('/theme/panel/slider/edit/{id}', 'Admin\Settings\ThemePanelController@SliderEdit')->name('admin.theme.slider.edit');
    Route::post('/theme/panel/slider/update/{id}', 'Admin\Settings\ThemePanelController@SliderUpdate')->name('admin.theme.slider.update');


    /*==============================
     * All Page Routes start
     ===============================*/
    //Homepage panel routes
    Route::get('/pages/panel/home', 'Admin\Pages\PagesController@Homepage')->name('admin.page.home');
    Route::post('/pages/panel/banner/update/{id}', 'Admin\Pages\PagesController@HomeUpdate')->name('admin.page.banner.update');
    Route::post('/pages/panel/info/update/{id}', 'Admin\Pages\PagesController@InfoUpdate')->name('admin.page.info.update');
    //Contact panel routes
    Route::get('/pages/panel/contact', 'Admin\Pages\PagesController@Contactpage')->name('admin.page.contact');
    //About panel routes
    Route::get('/pages/panel/about', 'Admin\Pages\PagesController@Aboutpage')->name('admin.page.about');

    /*====================================
     * Admin Add and Show Page Routes start
     =====================================*/
    Route::get('/user/all', 'Admin\Auth\AdminManageController@show')->name('admin.user');
    Route::get('/user/add-new', 'Admin\Auth\AdminManageController@showAdminForm')->name('admin.user.add.new');
    Route::post('/user/store', 'Admin\Auth\AdminManageController@store')->name('admin.user.store');
    Route::get('/user/edit/{id}', 'Admin\Auth\AdminManageController@edit')->name('admin.user.edit');
    Route::post('/user/update/{id}/{r_id}', 'Admin\Auth\AdminManageController@update')->name('admin.user.update');
    Route::get('/user/delete/{id}/{r_id}', 'Admin\Auth\AdminManageController@delete')->name('admin.user.delete');


    /*=============================
     * Tools Routes start
     =============================*/
    //SEO Meta Data Routes
    Route::get('/tools/seo', 'Admin\Tools\SeoController@show')->name('admin.tools.seo');
    Route::post('/tools/seo/update/{id}', 'Admin\Tools\SeoController@update')->name('admin.tools.seo.update');

    //Newsletters Routes
    Route::get('/tools/newsletters', 'Admin\Newsletter\NewslettersController@index')->name('admin.newsletters');
    Route::get('/tools/newsletters/delete/{id}', 'Admin\Newsletter\NewslettersController@delete')->name('admin.newsletter.delete');


    /*=============================
     * Settings Routes start
     =============================*/
    //Website Backup Routes
    //Route::get('/database/backup', 'Admin\Settings\SettingsController@show')->name('admin.database.show');

    Route::get('/settings/backup', 'Admin\Settings\BackupController@index')->name('admin.database.show');
    Route::get('/settings/backup/store', 'Admin\Settings\BackupController@store')->name('app.backups.store');
    Route::get('/settings/backup/create', 'Admin\Settings\BackupController@create')->name('app.backups.create');
    Route::get('/settings/backup/download/{file_name}', 'Admin\Settings\BackupController@download')->name('app.backups.download');
    Route::get('/settings/backup/delete/{file_name}', 'Admin\Settings\BackupController@delete')->name('app.backups.destroy');


    /*
     * -----------------------------
     * File manager Routes
     * -----------------------------
     */

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
