<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Models\Product;
use App\Models\Category;

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
Route::get('/saad',function(){
    $categories = \DB::table('products')
    ->select('id','category')
    ->groupBy('category')
    ->get();
 return $categories;
    foreach($categories as $row)
    {
        
        //create category 1st step
        // Category::create([
        //     'title' => $row->category,
        //     'slug' => \Str::slug($row->category),
        //     'status' => 'active',
        // ]);
            
        //update category in product 2nd step
        $category = Category::find($row->category);
        Product::where('category',$row->category)->update(['cat_id'=>$category->id]);
    }
//   return   Product::get()->pluck('category');
});



Auth::routes(['register'=>true]);

Route::get('user/login',[FrontendController::class,'login'])->name('login.form');
Route::post('user/login',[FrontendController::class,'loginSubmit'])->name('login.submit');
Route::get('user/logout',[FrontendController::class,'logout'])->name('user.logout');

Route::get('user/register',[FrontendController::class,'register'])->name('register.form');
Route::post('user/register',[FrontendController::class,'registerSubmit'])->name('register.submit');
// Reset password
Route::get('password-reset', [FrontendController::class,'showResetForm'])->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', [\App\Http\Controllers\Auth\LoginController::class,'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback/', [\App\Http\Controllers\Auth\LoginController::class,'Callback'])->name('login.callback');

//Forget & Reset Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/',[FrontendController::class,'home'])->name('home');

// Frontend Routes
Route::get('/home', [FrontendController::class,'index']);
Route::get('/about-us',[FrontendController::class,'aboutUs'])->name('about-us');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/contact/message',[\App\Http\Controllers\MessageController::class,'store'])->name('contact.store');
Route::get('product-detail/{slug}',[FrontendController::class,'productDetail'])->name('product-detail');
Route::post('/product/search',[FrontendController::class,'productSearch'])->name('product.search');
Route::get('/product-cat/{slug}',[FrontendController::class,'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}',[FrontendController::class,'productSubCat'])->name('product-sub-cat');
Route::get('/product-child-cat/{slug}/{sub_slug}/{child_slug}',[FrontendController::class,'productChildCat'])->name('product-child-cat');
Route::get('/product-brand/{slug}',[FrontendController::class,'productBrand'])->name('product-brand');
// Cart section
Route::get('/add-to-cart/{slug}',[\App\Http\Controllers\CartController::class,'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart',[\App\Http\Controllers\CartController::class,'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}',[\App\Http\Controllers\CartController::class,'cartDelete'])->name('cart-delete');
Route::post('cart-update',[\App\Http\Controllers\CartController::class,'cartUpdate'])->name('cart.update');

Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout',[\App\Http\Controllers\CartController::class,'checkout'])->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}',[\App\Http\Controllers\WishlistController::class,'wishlist'])->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}',[\App\Http\Controllers\WishlistController::class,'wishlistDelete'])->name('wishlist-delete');
Route::post('cart/order',[\App\Http\Controllers\OrderController::class,'store'])->name('cart.order');
Route::get('order/pdf/{id}',[\App\Http\Controllers\OrderController::class,'pdf'])->name('order.pdf');
Route::get('/income',[\App\Http\Controllers\OrderController::class,'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[\App\Http\Controllers\AdminController::class,'userPieChart'])->name('user.piechart');
Route::get('/product-grids',[FrontendController::class,'productGrids'])->name('product-grids');
Route::get('/product-lists',[FrontendController::class,'productLists'])->name('product-lists');
Route::match(['get','post'],'/filter',[FrontendController::class,'productFilter'])->name('shop.filter');
// Order Track
Route::get('/product/track',[\App\Http\Controllers\OrderController::class,'orderTrack'])->name('order.track');
Route::post('product/track/order',[\App\Http\Controllers\OrderController::class,'productTrackOrder'])->name('product.track.order');
// Blog
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/blog-detail/{slug}',[FrontendController::class,'blogDetail'])->name('blog.detail');
Route::get('/blog/search',[FrontendController::class,'blogSearch'])->name('blog.search');
Route::post('/blog/filter',[FrontendController::class,'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}',[FrontendController::class,'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}',[FrontendController::class,'blogByTag'])->name('blog.tag');

// NewsLetter
Route::post('/subscribe',[FrontendController::class,'subscribe'])->name('subscribe');

// Product Review
Route::resource('/review',\App\Http\Controllers\ProductReviewController::class);
Route::post('product/{slug}/review',[\App\Http\Controllers\ProductReviewController::class,'store'])->name('review.store');

// Post Comment 
Route::post('post/{slug}/comment',[\App\Http\Controllers\PostCommentController::class,'store'])->name('post-comment.store');
Route::resource('/comment',\App\Http\Controllers\PostCommentController::class);
// Coupon
Route::post('/coupon-store',[\App\Http\Controllers\CouponController::class,'couponStore'])->name('coupon-store');
// Payment
Route::get('payment', [\App\Http\Controllers\PayPalController::class,'payment'])->name('payment');
Route::get('cancel', [\App\Http\Controllers\PayPalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [\App\Http\Controllers\PayPalController::class,'success'])->name('payment.success');



// Backend section start

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users',\App\Http\Controllers\UsersController::class);
    // Banner
    Route::resource('banner',App\Http\Controllers\BannerController::class);
    // Brand
    Route::resource('brand',\App\Http\Controllers\BrandController::class);
    // Profile
    Route::get('/profile',[\App\Http\Controllers\AdminController::class,'profile'])->name('admin-profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\AdminController::class,'profileUpdate'])->name('profile-update');
    // Category
    Route::resource('/category',\App\Http\Controllers\CategoryController::class);
    Route::resource('/sub_category',\App\Http\Controllers\SubCategoryController::class);
    Route::get('/sub_categries/{cat_id}',[\App\Http\Controllers\ChildCategoryController::class,'getsubcat']);
	Route::get('/fetch_brand/{cat_id}',[\App\Http\Controllers\ChildCategoryController::class,'getbrand']);
    Route::resource('/child_category',\App\Http\Controllers\ChildCategoryController::class);
    Route::get('/child_categries/{sub_cat_id}',[\App\Http\Controllers\ChildCategoryController::class,'getchildcat']);
    // Product
    Route::resource('/product',\App\Http\Controllers\ProductController::class);
    Route::post('import', [\App\Http\Controllers\ProductController::class, 'import'])->name('import');
    // Ajax for sub category
    Route::post('/category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParent']);
    // POST category
    Route::resource('/post-category',\App\Http\Controllers\PostCategoryController::class);
    // Post tag
    Route::resource('/post-tag',\App\Http\Controllers\PostTagController::class);
    // Post
    Route::resource('/post',\App\Http\Controllers\PostController::class);
    // Message
    Route::resource('/message',\App\Http\Controllers\MessageController::class);
    Route::get('/message/five',[\App\Http\Controllers\MessageController::class,'messageFive'])->name('messages.five');

    // Order
    Route::resource('/order',\App\Http\Controllers\OrderController::class);
    // Shipping
    Route::resource('/shipping',\App\Http\Controllers\ShippingController::class);
    // Coupon
    Route::resource('/coupon',\App\Http\Controllers\CouponController::class);
    // Settings
    Route::get('settings',[\App\Http\Controllers\AdminController::class,'settings'])->name('settings');
    Route::post('setting/update',[\App\Http\Controllers\AdminController::class,'settingsUpdate'])->name('settings.update');

    // Notification
    Route::get('/notification/{id}',[\App\Http\Controllers\NotificationController::class,'show'])->name('admin.notification');
    Route::get('/notifications',[\App\Http\Controllers\NotificationController::class,'index'])->name('all.notification');
    Route::delete('/notification/{id}',[\App\Http\Controllers\NotificationController::class,'delete'])->name('notification.delete');
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\AdminController::class,'changePassword'])->name('change.password.form');
    Route::post('change-password', [\App\Http\Controllers\AdminController::class,'changPasswordStore'])->name('change.password');
});










// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('user');
    
    // Profile
     Route::get('/profile',[\App\Http\Controllers\HomeController::class,'profile'])->name('user-profile');
     Route::post('/profile/{id}',[\App\Http\Controllers\HomeController::class,'profileUpdate'])->name('user-profile-update');
    
     //  Order
    Route::get('/order',[\App\Http\Controllers\HomeController::class,'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}',[\App\Http\Controllers\HomeController::class,"orderShow"])->name('user.order.show');
    Route::delete('/order/delete/{id}',[\App\Http\Controllers\HomeController::class,'userOrderDelete'])->name('user.order.delete');
    
    // Product Review
    Route::get('/user-review',[\App\Http\Controllers\HomeController::class,'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}',[\App\Http\Controllers\HomeController::class,'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}',[\App\Http\Controllers\HomeController::class,'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}',[\App\Http\Controllers\HomeController::class,'productReviewUpdate'])->name('user.productreview.update');
    
    // Post comment
    Route::get('user-post/comment',[\App\Http\Controllers\HomeController::class,'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}',[\App\Http\Controllers\HomeController::class,'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}',[\App\Http\Controllers\HomeController::class,'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}',[\App\Http\Controllers\HomeController::class,'userCommentUpdate'])->name('user.post-comment.update');
    
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\HomeController::class,'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [\App\Http\Controllers\HomeController::class,'changPasswordStore'])->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});