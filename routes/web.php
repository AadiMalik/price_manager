<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    return redirect()->route('frontendHome');
});
Route::get('/term', function () {

    return view('Frontend/term');
});
Route::get('/chat', function () {
    return view('Backend/user/chat');
});
Route::get('/make', function () {
//    return view('welcome');
    Artisan::call('config:cache');
    return 'done';
    //Artisan::call('route:clear');
    // $exitCode = Artisan::call('storage:link');
    //return redirect()->route('frontendHome');
});
Route::get('/cache', function () {
//    return view('welcome');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    // $exitCode = Artisan::call('storage:link');
    return redirect()->route('frontendHome');
});

Auth::routes(['verify' => true]);
 
Route::get('user-product',[App\Http\Controllers\Backend\ProductController::class, 'user_product'])->name('user_product')->middleware('auth');
Route::group(['namespace' => 'Backend','middleware' => 'auth'], function () {
   Route::get('/home','HomeController@index')->name('home');
   Route::get('/user-profile','HomeController@userProfile')->name('userProfile');
   Route::post('/user-profile','HomeController@updateUserProfile')->name('updateUserProfile');
   Route::get('/update-password','HomeController@getViewUpdatePassword');
   Route::get('/chats','HomeController@chat')->name('chat');
   Route::post('/update-password','HomeController@UpdatePassword');
   Route::get('/userphone','UserPhoneController@index')->name('showuserphone');
   //Route::post('/user-profile','HomeController@updateUserProfile')->name('updateUserProfile');
 // slider gallery cms 
 Route::get('/slider-gallery','HomeController@sliderGallery');
 Route::post('/slider-gallery','HomeController@sliderGalleryUpload');
 Route::post('/slider-gallery-delete/{id}','HomeController@deleteGalleryImage');


                                                                                                                    // Products
   Route::group(['prefix' => 'product'], function() {
        Route::get('/','ProductController@index')->name('indexProduct');
        Route::get('/create','ProductController@create')->name('productCreate');
        Route::post('/store','ProductController@store')->name('productStore');

        Route::group(['prefix' => '{product}'], function (){
            Route::get('edit','ProductController@edit')->name('productEdit');
            Route::post('update','ProductController@update')->name('productUpdate');
            Route::get('delete','ProductController@destroy')->name('productDelete');
        });
   });

                                                                                                                    // FAQ
Route::group(['prefix' => 'faq'], function() {
        Route::get('/','FaqController@index')->name('indexfaq');
        Route::get('/create','FaqController@create')->name('faqCreate');
        Route::post('/store','FaqController@store')->name('faqStore');

        Route::group(['prefix' => '{faq}'], function (){
            Route::get('edit','FaqController@edit')->name('faqEdit');
            Route::post('update','FaqController@update')->name('faqUpdate');
            Route::get('delete','FaqController@destroy')->name('faqDelete');
        });
   });
                                                                                                                    //   Customer Route
    Route::group(['prefix' => 'customer'], function() {
        Route::get('/','CustomerController@index')->name('indexCustomer');
        Route::get('/create','CustomerController@create')->name('CustomerCreate');
        Route::post('/store','CustomerController@store')->name('CustomerStore');

        Route::group(['prefix' => '{customer}'], function (){
            Route::get('edit','CustomerController@edit')->name('CustomerEdit');
            Route::post('update','CustomerController@update')->name('CustomerUpdate');
            Route::get('delete','CustomerController@destroy')->name('CustomerDelete');
        });
   });
   Route::get('CustomerInvoice/{id}','CustomerController@invoice');
                                                                                                                   //   Location Route
    Route::group(['prefix' => 'location'], function() {
        Route::get('/','LocationController@index')->name('indexLocation');
        Route::get('/create','LocationController@create')->name('LocationCreate');
        Route::post('/store','LocationController@store')->name('LocationStore');

        Route::group(['prefix' => '{location}'], function (){
            Route::get('edit','LocationController@edit')->name('LocationEdit');
            Route::post('update','LocationController@update')->name('LocationUpdate');
            Route::get('delete','LocationController@destroy')->name('LocationDelete');
        });
   });
                                                                                                                 //   Sale Bricks Route
    // Route::group(['prefix' => '{package}/buyPackage'], function() {
    //     Route::get('/','UserPackageController@buyPackage')->name('buyPackage');
    //     Route::post('/','UserPackageController@storeBuyPackage')->name('storeBuyPackage');

    // });
    Route::group(['prefix' => 'saleBrick'], function() {
        Route::get('/','SaleBrickController@index')->name('indexSaleBricks');
        Route::get('/create','SaleBrickController@create')->name('SaleCreate');
        Route::post('/store','SaleBrickController@store')->name('SaleStore');
        
        Route::group(['prefix' => '{saleBrick}'], function (){
            Route::get('edit','SaleBrickController@edit')->name('SaleEdit');
            Route::post('update','SaleBrickController@update')->name('SaleUpdate');
            Route::get('delete','SaleBrickController@destroy')->name('SaleDelete');
        });
   });
    Route::get('generateinvoice/{saleBrick}','SaleBrickController@show');
    
                                                                                                                // Debit Credit
    Route::group(['prefix' => 'debit'], function() {
        Route::get('/','DebitController@index')->name('Saleindex');
        // Route::post('/','SaleBrickController@store')->name('SaleStore');
        
   });
                                                                                                                    // Notifications
Route::group(['prefix' => 'notification'], function() {
        Route::get('/','NotificationController@index')->name('indexnotification');
        Route::get('/create','NotificationController@create')->name('notificationCreate');
        Route::post('/store','NotificationController@store')->name('notificationStore');

        Route::group(['prefix' => '{notification}'], function (){
            Route::get('edit','NotificationController@edit')->name('notificationEdit');
            Route::post('update','NotificationController@update')->name('notificationUpdate');
            Route::get('delete','NotificationController@destroy')->name('notificationDelete');
        });
   });

                                                                                                                    // Term & Condition
Route::group(['prefix' => 'term'], function() {
        Route::get('/','TermController@index')->name('indexterm');
        Route::get('/create','TermController@create')->name('termCreate');
        Route::post('/store','TermController@store')->name('termStore');

        Route::group(['prefix' => '{term}'], function (){
            Route::get('edit','TermController@edit')->name('termEdit');
            Route::post('update','TermController@update')->name('termUpdate');
            Route::get('delete','TermController@destroy')->name('termDelete');
        });
   });

                                                                                                                    // User Type

    Route::group(['prefix' => 'user-type'], function() {
        Route::get('/','UserTypeController@index')->name('indexUserType');
        Route::get('/create','UserTypeController@create')->name('userTypeCreate');
        Route::post('/store','UserTypeController@store')->name('userTypeStore');

        Route::group(['prefix' => '{userType}'], function (){
            Route::get('edit','UserTypeController@edit')->name('userTypeEdit');
            Route::post('update','UserTypeController@update')->name('userTypeUpdate');
            Route::get('delete','UserTypeController@destroy')->name('userTypeDelete');
        });
    });
    
                                                                                                                    // User Rating
    Route::group(['prefix' => 'user-rating'], function() {
        Route::get('/','UserRatingController@index')->name('indexUserRating');
        Route::get('/create','UserRatingController@create')->name('userRatingCreate');
        Route::post('/store','UserRatingController@store')->name('userRatingStore');

        Route::group(['prefix' => '{userRating}'], function (){
            Route::get('edit','UserRatingController@edit')->name('userRatingEdit');
            Route::post('update','UserRatingController@update')->name('userRatingUpdate');
            Route::get('delete','UserRatingController@destroy')->name('userRatingDelete');
        });
    });

                                                                                                                    // Packages
    Route::group(['prefix' => 'package'], function() {
        Route::get('/','UserPackageController@index')->name('indexUserPackage');
        Route::get('/create','UserPackageController@create')->name('userPackageCreate');
        Route::post('/store','UserPackageController@store')->name('userPackageStore');

        Route::group(['prefix' => '{package}'], function (){
            Route::get('edit','UserPackageController@edit')->name('userPackageEdit');
            Route::post('update','UserPackageController@update')->name('userPackageUpdate');
            Route::get('delete','UserPackageController@destroy')->name('userPackageDelete');
        });
    });
                                                                                                                    // Package History
    Route::group(['prefix' => 'packagehistory'], function() {
        Route::get('/','PackageHistoryController@index')->name('indexPackageHistory');

        
    });
    Route::get('packagehistoryedit/{id}','PackageHistoryController@edit');
    Route::post('packagehistoryupdate/{id}','PackageHistoryController@update');

                                                                                                                    // Cities
    Route::group(['prefix' => 'city'], function() {
        Route::get('/','CityController@index')->name('indexCityPackage');
        Route::get('/create','CityController@create')->name('userCityCreate');
        Route::post('/store','CityController@store')->name('userCityStore');

        Route::group(['prefix' => '{city}'], function (){
            Route::get('edit','CityController@edit')->name('userCityEdit');
            Route::post('update','CityController@update')->name('userCityUpdate');
            Route::get('delete','CityController@destroy')->name('userCityDelete');
        });
    });

                                                                                                                    // User
    Route::group(['prefix' => 'user'], function() {
        Route::get('/','UserController@index')->name('indexUser');
        Route::get('/create','UserController@create')->name('userCreate');
        Route::post('/store','UserController@store')->name('userStore');

        Route::group(['prefix' => '{user}'], function (){
            Route::get('edit','UserController@edit')->name('userEdit');
            Route::post('update','UserController@update')->name('userUpdate');
            Route::get('delete','UserController@destroy')->name('userDelete');
            Route::get('verify','UserController@verify')->name('userVerify');
        });
    });
    
                                                                                                                    // User Package Update
    Route::group(['prefix' => 'userpackage'], function() {
        Route::get('/','UserController@userPackageindex')->name('indexUserPackage');
    });
    Route::get('packageedit/{id}','UserController@userPackageedit');
    Route::post('packageupdate/{id}','UserController@userPackageUpdate');
    
    
    
                                                                                                                    // Brands
    Route::group(['prefix' => 'brand'], function() {
        Route::get('/','BrandController@index')->name('indexBrand');
        Route::get('/create','BrandController@create')->name('brandCreate');
        Route::post('/store','BrandController@store')->name('brandStore');

        Route::group(['prefix' => '{brand}'], function (){
            Route::get('edit','BrandController@edit')->name('brandEdit');
            Route::post('update','BrandController@update')->name('brandUpdate');
            Route::get('delete','BrandController@destroy')->name('brandDelete');
        });
    });
                                                                                                                // Category
    Route::group(['prefix' => 'category'], function() {
        Route::get('/','CategoryController@index')->name('indexCategory');
        Route::get('/create','CategoryController@create')->name('categoryCreate');
        Route::post('/store','CategoryController@store')->name('categoryStore');

        Route::group(['prefix' => '{category}'], function (){
            Route::get('edit','CategoryController@edit')->name('categoryEdit');
            Route::post('update','CategoryController@update')->name('categoryUpdate');
            Route::get('delete','CategoryController@destroy')->name('categoryDelete');
        });
    });

    Route::group(['prefix' => 'product-category'], function() {
        Route::get('/','ProductCategoryController@index')->name('productCategory');
        Route::get('/create','ProductCategoryController@create')->name('productCategoryCreate');
        Route::post('/store','ProductCategoryController@store')->name('productCategoryStore');

        Route::group(['prefix' => '{category}'], function (){
            Route::get('edit','ProductCategoryController@edit')->name('productCategoryEdit');
            Route::post('update','ProductCategoryController@update')->name('productCategoryUpdate');
            Route::get('delete','ProductCategoryController@destroy')->name('productCategoryDelete');
        });
    });
    Route::group(['prefix' => 'product-brand'], function() {
        Route::get('/','ProductBrandController@index')->name('productBrand');
        Route::get('/create','ProductBrandController@create')->name('productBrandCreate');
        Route::post('/store','ProductBrandController@store')->name('productBrandStore');

        Route::group(['prefix' => '{brand}'], function (){
            Route::get('edit','ProductBrandController@edit')->name('productBrandEdit');
            Route::post('update','ProductBrandController@update')->name('productBrandUpdate');
            Route::get('delete','ProductBrandController@destroy')->name('productBrandDelete');
        });
    });
    Route::group(['prefix' => 'e-product'], function() {
        Route::get('/','EProductController@index')->name('e_product');
        Route::get('/create','EProductController@create')->name('e_productCreate');
        Route::post('/store','EProductController@store')->name('e_productStore');

        Route::group(['prefix' => '{product}'], function (){
            Route::get('edit','EProductController@edit')->name('e_productEdit');
            Route::post('update','EProductController@update')->name('e_productUpdate');
            Route::get('delete','EProductController@destroy')->name('e_productBrandDelete');
        });
    });
                                                                                                                    // Industries
    Route::group(['prefix' => 'industry'], function() {
        Route::get('/','IndustryController@index')->name('indexIndustry');
        Route::get('/create','IndustryController@create')->name('industryCreate');
        Route::post('/store','IndustryController@store')->name('industryStore');

        Route::group(['prefix' => '{industry}'], function (){
            Route::get('edit','IndustryController@edit')->name('industryEdit');
            Route::post('update','IndustryController@update')->name('industryUpdate');
//            Route::get('delete','IndustryController@destroy')->name('industryDelete');
        });
    });
    
        Route::get('checkphone/','TransactionTypeController@index');

    // Route::group(['prefix' => 'transaction-type'], function() {
    //     Route::get('/','TransactionTypeController@index')->name('indexTransactionType');
    //     Route::get('/create','TransactionTypeController@create')->name('transactionTypeCreate');
    //     Route::post('/store','TransactionTypeController@store')->name('transactionTypeStore');

    //     Route::group(['prefix' => '{transactionType}'], function (){
    //         Route::get('edit','TransactionTypeController@edit')->name('transactionTypeEdit');
    //         Route::post('update','TransactionTypeController@update')->name('transactionTypeUpdate');
    //         Route::get('delete','TransactionTypeController@destroy')->name('transactionTypeDelete');
    //     });
    // });

    Route::group(['prefix' => 'setting'], function() {
        Route::get('/','SettingController@index')->name('indexSetting');
        Route::get('/create','SettingController@create')->name('settingCreate');
        Route::post('/store','SettingController@store')->name('settingStore');

        Route::group(['prefix' => '{setting}'], function (){
            Route::get('edit','SettingController@edit')->name('settingEdit');
            Route::post('update','SettingController@update')->name('settingUpdate');
            Route::get('delete','SettingController@destroy')->name('settingDelete');
        });
    });

                                                                                                                    // Video Remarks
    Route::group(['prefix' => 'video-remarks'], function() {
        Route::get('/','RemarksVideoController@index')->name('indexVideoRemarks');
        Route::get('/create','RemarksVideoController@create')->name('videoRemarksCreate');
        Route::post('/store','RemarksVideoController@store')->name('videoRemarksStore');

        Route::group(['prefix' => '{videoRemarks}'], function (){
            Route::get('edit','RemarksVideoController@edit')->name('videoRemarksEdit');
            Route::post('update','RemarksVideoController@update')->name('videoRemarksUpdate');
            Route::get('delete','RemarksVideoController@destroy')->name('videoRemarksDelete');
        });
    });

                                                                                                                    // Images Remarks
    Route::group(['prefix' => 'image-remarks'], function() {
        Route::get('/','RemarksImageController@index')->name('indexImageRemarks');
        Route::get('/create','RemarksImageController@create')->name('imageRemarksCreate');
        Route::post('/store','RemarksImageController@store')->name('imageRemarksStore');

        Route::group(['prefix' => '{imageRemarks}'], function (){
            Route::get('edit','RemarksImageController@edit')->name('imageRemarksEdit');
            Route::post('update','RemarksImageController@update')->name('imageRemarksUpdate');
            Route::get('delete','RemarksImageController@destroy')->name('imageRemarksDelete');
        });
    });
                                                                                                                    // Social Media
    Route::group(['prefix' => 'social-media'], function() {
        Route::get('/','SocialMediaController@index')->name('indexSocialMedia');
        Route::get('/create','SocialMediaController@create')->name('socialMediaCreate');
        Route::post('/store','SocialMediaController@store')->name('socialMediaStore');

        Route::group(['prefix' => '{socialMedia}'], function (){
            Route::get('edit','SocialMediaController@edit')->name('socialMediaEdit');
            Route::post('update','SocialMediaController@update')->name('socialMediaUpdate');
            Route::get('delete','SocialMediaController@destroy')->name('socialMediaDelete');
        });
    });

                                                                                                                    // Discount Vouchers

    Route::group(['prefix' => 'discount'], function() {
        Route::get('/','DiscountController@index')->name('indexDiscount');
        Route::get('/create','DiscountController@create')->name('discountCreate');
        Route::post('/store','DiscountController@store')->name('discountStore');

        Route::group(['prefix' => '{discount}'], function (){
            Route::get('edit','DiscountController@edit')->name('discountEdit');
            Route::get('show-user','DiscountController@userName')->name('discountUserName');
            Route::post('update','DiscountController@update')->name('discountUpdate');
            Route::get('delete','DiscountController@destroy')->name('discountDelete');
        });
    });

                                                                                                                    // Client Review
    Route::group(['prefix' => 'client-review'], function() {
        Route::get('/','ClientReviewController@index')->name('indexReviews');
        Route::get('/create','ClientReviewController@create')->name('ReviewsCreate');
        Route::post('/store','ClientReviewController@store')->name('ReviewsStore');

        Route::group(['prefix' => '{review}'], function (){
            Route::get('edit','ClientReviewController@edit')->name('ReviewsEdit');
            Route::post('update','ClientReviewController@update')->name('ReviewsUpdate');
            Route::get('delete','ClientReviewController@destroy')->name('ReviewsDelete');
        });
    });

                                                                                                                    // Construction Videos
    Route::group(['prefix' => 'construction-video'], function() {
        Route::get('/','ConstructionVideoController@index')->name('indexConstructionVideo');
        Route::get('/create','ConstructionVideoController@create')->name('constructionVideoCreate');
        Route::post('/store','ConstructionVideoController@store')->name('constructionVideoStore');

        Route::group(['prefix' => '{constructionVideo}'], function (){
            Route::get('edit','ConstructionVideoController@edit')->name('constructionVideoEdit');
            Route::post('update','ConstructionVideoController@update')->name('constructionVideoUpdate');
            Route::get('delete','ConstructionVideoController@destroy')->name('constructionVideoDelete');
        });
    });

                                                                                                                    // Order Mail
    Route::group(['prefix' => 'order-mail'], function() {
        Route::get('/','OrderMailController@index')->name('indexOrderMail');
        Route::get('/create','OrderMailController@create')->name('orderMailCreate');
        Route::post('/store','OrderMailController@store')->name('orderMailStore');

        Route::group(['prefix' => '{orderMail}'], function (){
            Route::get('edit','OrderMailController@edit')->name('orderMailEdit');
            Route::post('update','OrderMailController@update')->name('orderMailUpdate');
            Route::get('delete','OrderMailController@destroy')->name('orderMailDelete');
        });
    });

                                                                                                                    // Feedback
    Route::group(['prefix' => 'feedback'], function() {
        Route::get('/','FeedBackController@index')->name('indexFeedback');

        Route::group(['prefix' => '{feedback}'], function (){
            Route::get('edit','FeedBackController@edit')->name('orderMailEdit');
            Route::post('update','FeedBackController@update')->name('orderMailUpdate');
            Route::get('delete','FeedBackController@destroy')->name('orderMailDelete');
        });
    });
    
                                                                                                                    // Admin Contact Us
    Route::group(['prefix' => 'admin-contact-us'], function() {
        Route::get('/','ContactUsController@index')->name('indexContactUsAdmin');
        Route::get('reply/{contact}','ContactUsController@replyContactUs')->name('replyContactUsAdmin');
        Route::post('replay/{contact}','ContactUsController@sendContactUs')->name('messageSendContactUsAdmin');
        

        Route::group(['prefix' => '{contact}'], function (){
        //     Route::get('edit','FeedBackController@edit')->name('orderMailEdit');
        //     Route::post('update','FeedBackController@update')->name('orderMailUpdate');
            Route::get('delete','ContactUsController@destroy');
        });
    });
    
                                                                                                                    // Site Content
    Route::group(['prefix' => 'site-content'], function() {
        Route::get('/','SiteContentController@index')->name('indexSiteContent');
        

        Route::group(['prefix' => '{siteContent}'], function (){
            Route::get('edit','SiteContentController@edit')->name('siteContentEdit');
            Route::post('update','SiteContentController@update')->name('siteContentUpdate');
//            Route::get('delete','FeedBackController@destroy')->name('orderMailDelete');
        });
    });

                                                                                                                    // Invoice
    Route::group(['prefix' => 'invoice'], function() {
        Route::get('/','InvoiceController@index')->name('indexInvoice');

        Route::group(['prefix' => '{invoice}'], function (){
            Route::get('/show','InvoiceController@show')->name('invoiceShow');
            Route::get('/statusChange','InvoiceController@statusChange')->name('statusChange');
            Route::get('/statusRejected','InvoiceController@statusRejected')->name('statusRejected');
            Route::get('/delete','InvoiceController@destroy');
        });
    });

                                                                                                                    // Invoice Images
    Route::group(['prefix' => 'invoice-image'], function() {
        Route::get('/','InvoiceImageController@index')->name('indexInvoiceImage');
        Route::get('/create','InvoiceImageController@create')->name('createInvoiceImage');
        Route::post('/store','InvoiceImageController@store')->name('storeInvoiceImage');

        Route::group(['prefix' => '{invoice}'], function (){
            Route::get('/edit','InvoiceImageController@edit')->name('invoiceImageEdit');
            Route::post('/update','InvoiceImageController@update')->name('invoiceImageUpdate');
            Route::get('/show','InvoiceImageController@show')->name('invoiceImageShow');
            Route::get('/delete','InvoiceImageController@destroy')->name('invoiceImageDelete');
        });
    });


        // Fetaure package
        Route::resource('f-package', 'FpackageController');
    /*Other User*/

    Route::group(['prefix' => 'website-image'], function() {
        Route::get('/','WebsiteController@index')->name('indexWebsite');
        Route::get('/create','WebsiteController@create')->name('websiteCreate');
        Route::post('/store','WebsiteController@store')->name('websiteStore');

        Route::group(['prefix' => '{website}'], function (){
            Route::get('edit','WebsiteController@edit')->name('websiteEdit');
            Route::post('update','WebsiteController@update')->name('websiteUpdate');
            Route::get('delete','WebsiteController@destroy')->name('websiteDelete');
        });
    });

    Route::group(['prefix' => 'office'], function() {
        Route::get('/','OfficeController@index')->name('indexOffice');
        Route::get('/create','OfficeController@create')->name('officeCreate');
        Route::post('/store','OfficeController@store')->name('officeStore');

        Route::group(['prefix' => '{office}'], function (){
            Route::get('edit','OfficeController@edit')->name('officeEdit');
            Route::post('update','OfficeController@update')->name('officeUpdate');
            Route::get('delete','OfficeController@destroy')->name('officeDelete');
        });
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/default','ProductController@defaultProductIndex')->name('defaultProductIndex');
        Route::get('/defaultAddProduct/{product}','ProductController@addAdminProduct')->name('addAdminProduct');

    });

    Route::group(['prefix' => '{package}/buyPackage'], function() {
        Route::get('/','UserPackageController@buyPackage')->name('buyPackage');
        Route::post('/','UserPackageController@storeBuyPackage')->name('storeBuyPackage');

    });
    Route::group(['prefix' => '{package}/f_buyPackage'], function() {
        Route::get('/','FbuypackageController@buyPackage')->name('f_buyPackage');
        Route::post('/','FbuypackageController@storeBuyPackage')->name('f_storeBuyPackage');

    });

    Route::group(['prefix' => 'customeDiscount'], function() {
        Route::get('/','DiscountController@userDiscount')->name('userInvoiceDetail');
    });
Route::get('subscribe','SubscribeController@index');
Route::post('emailsubscribe','SubscribeController@store');


    Route::get('/generate/invoice/{package}/{discount?}', 'InvoiceController@create')->name('generateInvoice');
    Route::get('/f-generate/invoice/{package}/{discount?}', 'InvoiceController@f_create')->name('f_generateInvoice');

});

Route::get('user/chat/{id}','Frontend\HomeController@userchatView')->name('user.chat')->middleware('auth');
Route::post('submit-chat','Frontend\HomeController@submitChat')->name('submit-chat');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/fhome','HomeController@index')->name('frontendHome');
    Route::get('/fuser','HomeController@allUser')->name('frontendUser');
    Route::get('/user-search','HomeController@userSearch')->name('frontendUserSearch');
    Route::get('/fbrand','BrandController@showBrand')->name('frontendBrand');
    Route::get('/fbrand/{id}','BrandController@getUserAlongWithBrand')->name('getUserAlongWithBrand');
    Route::get('/construction','ConstructionController@showConstruction')->name('frontendConstruction');
    Route::get('/remarks','RemarkController@showRemarks')->name('frontendRemarks');
    Route::get('/fpackage','PackageController@showPackage')->name('frontendPackage');
    Route::get('/package/{user}','PackageController@packageDetail')->name('frontendUserPackageDetail');
    Route::get('/package/{id}/{category}','PackageController@getProduct');
    Route::post('/package/{user}','PackageController@ClickPhone')->name('frontendUserphone');
    Route::post('/add-review/{user}','PackageController@packageReview')->name('frontendUserReview');
    Route::get('/contact-us','ContactUsController@showContact')->name('frontendContact');
    Route::post('/contact-us','ContactUsController@storeContact')->name('frontendStoreContact');
    Route::get('/about','AboutController@showAbout')->name('frontendAbout');
    Route::post('subcribe','HomeController@subscribe')->name('storeSubscribe');
    Route::get('/help','FaqController@index')->name('help');
    Route::get('/fterm','TermController@index')->name('fterm');
    Route::get('/f_package','FpackageController@index');
    Route::get('/product-detail/{id}','ProductController@show');
    Route::get('/products','ProductController@index');
    Route::get('/products/{id}','ProductController@category');
    Route::post('/add-to-cart','HomeController@cart')->name('cart.store')->middleware('auth');
    Route::post('detail-to-cart','HomeController@detailCart')->middleware('auth');
    Route::get('cart','CartController@index')->middleware('auth');
    Route::get('cart-remove/{id}','CartController@remove')->middleware('auth');
    Route::get('checkout','CartController@checkout')->middleware('auth');
    Route::post('checkout/store','CartController@store')->middleware('auth');

    
});

Route::get('order','Backend\OrderController@index')->middleware('auth');
Route::get('change-status','Backend\OrderController@Status_Change')->middleware('auth');
//Route::get('/home', 'HomeController@index')->name('home');
