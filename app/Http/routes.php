<?php

/*
|--------------------------------------------------------------------------
|ApplicationRoutes
|--------------------------------------------------------------------------
|
|Hereiswhereyoucanregisteralloftheroutesforanapplication.
|It'sabreeze.SimplytellLaraveltheURIsitshouldrespondto
|andgiveitthecontrollertocallwhenthatURIisrequested.
|
*/

Route::get('/','HomeController@index');
Route::get('/ActivatedEmail','HomeController@ActivatedEmail');
Route::post('/Subscribe','HomeController@store');
Route::get('/about','AboutController@index');
Route::get('/service/{id}','AboutController@service');
Route::get('/offer','OfferController@index');
Route::get('/request_quotes','RequestQuotesController@index');
Route::get('/knowledge_hub','KnowledgeController@lists');
Route::get('/knowledge_hub/{id}','KnowledgeController@detail');
Route::get('/advertisements/{id}','HomeController@advertisements');
Route::get('/faq','FAQController@index');

Route::post('/CallbackFacebook','Auth\AuthController@CallbackFacebook');
Route::get('/FaceBookLogin','Auth\AuthController@FaceBookLogin');
Route::any('api/CallBackPayment','HomeController@CallBackPayment');
Route::any('api/PaymentSuccess/{id}','HomeController@PaymentSuccess');
Route::any('api/PaymentCancel/{id}','HomeController@PaymentCancel');





//FrontContactus
Route::get('/contact','ContactController@index');
Route::post('/contact','ContactController@create_contact');
Route::get('/ActivateRegister/{id}','Customer\AuthController@ActivateRegister');
Route::get('/email',function(){
    returnview('email.retailer_register');
});

//ForgotPassword
Route::get('Customer/ForgotPassword','Auth\AuthController@ForgotPassword');
Route::get('Retailer/ForgotPassword','Auth\AuthController@ForgotPassword');
Route::get('forgot_password','Auth\AuthController@ForgotPassword');
Route::get('Customer/ResetPassword/{token}','Auth\AuthController@CustomerResetPassword');
Route::get('Retailer/ResetPassword/{token}','Auth\AuthController@RetailerResetPassword');
Route::post('Customer/ChangeResetPassword','Auth\AuthController@ChangeResetPassword');
Route::post('Retailer/ChangeResetPassword','Auth\AuthController@RetailerChangeResetPassword');
Route::post('/CheckForgotPassword','Auth\AuthController@CheckForgotPassword');
Route::post('Retailer/CheckForgotPassword','Auth\AuthController@RetailerCheckForgotPassword');
Route::get('Customer/forgot_password','Auth\AuthController@CustomerForgotPassword');
Route::get('Retailer/forgot_password','Auth\AuthController@RetailerForgotPassword');

//Customer
Route::group(['prefix'=>'Customer'],function(){
    Route::get('/Register','Customer\AuthController@register');
    Route::post('/Register','Customer\AuthController@CheckRegister');
    Route::get('/Login','Customer\AuthController@login');
    Route::post('/Login','Customer\AuthController@CheckLogin');
    Route::get('/Logout','Customer\AuthController@Logout');

    Route::group(['middleware'=>'customer_auth'],function(){
        //ChangePassword
        Route::get('/ChangePassword','Customer\CustomerController@ChangePassword');
        Route::post('/ChangePassword','Customer\CustomerController@change_password');

        //Dashboard
        Route::get('/Dashboard','Customer\CustomerController@index');

        //Profile
        Route::post('/Profile','Customer\CustomerController@CheckSaveProfile');

        //ChoosePlan
        Route::post('/ChoosePlan','Customer\ChoosePlanController@ChoosePlan');

        //Request
        Route::get('/Request','Customer\RequestController@index');
        Route::get('/Request/{id}','Customer\RequestController@edit');
        Route::get('/NewRequest','Customer\RequestController@NewRequest');
        Route::post('/CreateBusiness','Customer\RequestController@CreateBusiness');
        Route::post('/CreateResidentail','Customer\RequestController@CreateResidentail');
        Route::post('/NewRequest/Business/{id}','Customer\RequestController@UpdateBusiness');
        Route::post('/NewRequest/Residentail/{id}','Customer\RequestController@UpdateResidentail');

        Route::get('/ViewSubmittedQuotes','Customer\QuotesController@index');
        Route::get('/ViewSubmittedQuotes/{id}','Customer\QuotesController@submittedQuote');
        Route::get('/ViewSubmittedQuotesDetail/{id}','Customer\QuotesController@submitQuoteDetail');
        Route::get('/ViewSubmittedSelectPlan/{id}','Customer\QuotesController@SelectChoosePlan');
        Route::post('/ViewSubmittedQuotes/SelectPlanBusiness/{id}','Customer\QuotesController@SelectPlanBusiness');
        Route::post('/ViewSubmittedQuotes/SelectPlanResidetail/{id}','Customer\QuotesController@SelectPlanResidetail');
        Route::get('/SubmitReviewRetailer','Customer\ReviewRetailerController@index');
        Route::post('/SubmitReviewRetailer','Customer\ReviewRetailerController@create');
        Route::get('/ViewConfirmRetailer','Customer\ConfirmedRetailerController@index');
        Route::get('/ViewConfirmRetailer/{id}','Customer\ConfirmedRetailerController@detail');
        Route::get('/Chat','Customer\ChatController@index');
        Route::post('/Chat/Send','Customer\ChatController@Send');
        Route::get('/SearchPrice','Customer\SearchPriceController@index');
        
        Route::get('/RejectRequest','Customer\QuotesController@RejectRequest');
    });
});

//Retailer
Route::group(['prefix'=>'Retailer'],function(){
    Route::get('/Register','Retailer\AuthController@register');
    Route::post('/Register','Retailer\AuthController@CheckRegister');
    Route::get('/Login','Retailer\AuthController@login');
    Route::get('/Logout','Retailer\AuthController@Logout');
    Route::post('/Login','Retailer\AuthController@CheckLogin');

    Route::group(['middleware'=>'retailer_auth'],function(){
        Route::get('/Dashboard','Retailer\RetailerController@index');
        Route::post('/Profile','Retailer\RetailerController@CheckSaveProfile');
        Route::get('/Chat','Retailer\ChatController@index');
        Route::post('/Chat/Send','Retailer\ChatController@Send');

        //ViewRequest
        Route::get('/ViewRequest','Retailer\RequestController@index');
        // Route::get('/ViewRequest/ListRequest','Retailer\RequestController@ListRequest');
        Route::get('/ViewRequest/{id}','Retailer\RequestController@ViewRequest');
        Route::post('/ViewRequestResidentail','Retailer\RequestController@submitquote');
        Route::post('/ViewRequestBusiness','Retailer\RequestController@submitquote_business');

        //ViewCustomer
        Route::get('/ViewCustomer','Retailer\CustomerController@index');
        Route::get('/ViewCustomer/{id}','Retailer\CustomerController@detail');

        //Offer
        Route::get('/Offer','Retailer\OfferController@index');
        Route::get('/PostOffer','Retailer\OfferController@PostOffer');
        Route::get('/PostOffer/{id}','Retailer\OfferController@edit');
        Route::post('/PostOffer/{id}','Retailer\OfferController@update');
        Route::post('/PostOffer','Retailer\OfferController@createOffer');

        //WeeklyPrice
        Route::get('/WeeklyPrice','Retailer\WeeklyPriceController@index');
        Route::get('/NewWeeklyPrice','Retailer\WeeklyPriceController@create');
        Route::get('/EditWeeklyPrice/{id}','Retailer\WeeklyPriceController@edit');
        Route::post('/NewWeeklyPrice','Retailer\WeeklyPriceController@CreatePrice');
        Route::post('/EditWeeklyPrice/{id}','Retailer\WeeklyPriceController@update');

        //Credit
        Route::get('/Credit','Retailer\CreditController@index');
        Route::get('/Credit/{id}','Retailer\CreditController@get_credit');
        Route::post('/Credit','Retailer\CreditController@purchase');
        Route::post('/BuyCreditWithSmoovPay','Retailer\CreditController@BuyCreditWithSmoovPay');

        //ChoosePlan
        Route::get('/ViewCustomerChoosePlan','Retailer\ChoosePlanController@index');
        Route::get('/ViewCustomerChoosePlan/{id}','Retailer\ChoosePlanController@detail');
        Route::post('/SubmitCustomerChoosePlan','Retailer\ChoosePlanController@submitquote');

        //Quotation
        Route::get('/Quotation','Retailer\QuotationController@index');
        Route::get('/NewQuotation','Retailer\QuotationController@create');
        Route::post('/NewQuotationLow','Retailer\QuotationController@CreateLow');
        Route::post('/NewQuotationHight','Retailer\QuotationController@CreateHight');
        Route::get('/EditQuotation/{id}','Retailer\QuotationController@edit');
        Route::post('/EditQuotationLow/{id}','Retailer\QuotationController@updateLow');
        Route::post('/EditQuotationHight/{id}','Retailer\QuotationController@updateHight');

        //ChangePasswordforRetailer
        Route::get('/ChangePassword','Retailer\RetailerController@ChangePassword');
        Route::post('/ChangePassword','Retailer\RetailerController@change_password');

        //Contract
        Route::get('/Contract','Retailer\ContractController@index');
        Route::get('/NewContract','Retailer\ContractController@create');
        Route::post('/Upload','Retailer\ContractController@fileUpload');
        Route::post('/Contract/Delete/{id}','Retailer\ContractController@destroy');

        // Promotions
        Route::get('/Promotion','Retailer\PromotionController@index');
        Route::get('/NewPromotion','Retailer\PromotionController@create');
        Route::post('/NewPromotion','Retailer\PromotionController@StorePromotion');
        Route::get('/PromotionDetail/{id}','Retailer\PromotionController@GetPromotion');
        Route::get('/EditPromotion/{id}','Retailer\PromotionController@GetPromotion');
        Route::post('/EditPromotion/{id}','Retailer\PromotionController@UpdatePromotion');

        // Buy Credit
        Route::get('/BuyCredit','Retailer\PromotionController@index');
        

    });
});



//Admin
Route::get('/admin/login','Admin\AuthController@login');
Route::get('/admin/logout','Admin\AuthController@logout');
//Route::get('/admin/change_password','Admin\AuthController@logout');
Route::post('/admin/CheckLogin','Admin\AuthController@CheckLogin');

Route::group(['middleware'=>'admin_auth','prefix'=>'admin'],function(){

    Route::get('/','Admin\HomeController@index');
    Route::get('/CustomerAndRetailer','Admin\HomeController@CustAndRetailer');
    Route::get('/dashboard','Admin\HomeController@index');

    Route::get('/Subscribe','Admin\SubscribeController@index');
    Route::get('/Subscribe/show','Admin\SubscribeController@show');
    //Admin
    //Route::get('/change_password','Admin\AdminController@change_password');
    //Route::get('/profile','Admin\UserController@profile');
    Route::get('/AdminUser/ListAdmin','Admin\AdminController@ListAdmin');
    Route::post('/AdminUser/Change_password','Admin\AdminController@change_password');
    Route::post('/AdminUser/{id}','Admin\AdminController@edit');
    Route::post('/AdminUser/Checkedit/{id}','Admin\AdminController@update');
    Route::resource('/AdminUser','Admin\AdminController');
    Route::post('/AdminUser','Admin\AdminController@store');
    Route::post('/GetPermission/{id}','Admin\AdminController@GetPermission');
    Route::post('/SetPermission','Admin\AdminController@SetPermission');
    Route::post('/AdminUser/Delete/{id}','Admin\AdminController@destroy');

    //User
    //Route::get('/change_password','Admin\UserController@change_password');
    Route::get('/profile','Admin\UserController@profile');
    Route::post('/update','Admin\UserController@UserUpdate');
    Route::get('/User/ListUser','Admin\UserController@ListUser');
    Route::post('/user/change_password','Admin\UserController@change_password');
    Route::post('/User/Checkedit/{id}','Admin\UserController@update');
    Route::resource('/User','Admin\UserController');
    Route::post('/User','Admin\UserController@store');
    Route::post('/User/{id}','Admin\UserController@edit');
    Route::post('/User/Delete/{id}','Admin\UserController@destroy');

    //ManageMenu
    Route::get('/ManageMenu','Admin\MenuController@index');
    Route::get('/menu/ListMenu','Admin\MenuController@ListMenu');
    Route::post('/menu','Admin\MenuController@store');
    Route::get('/menu/{id}','Admin\MenuController@edit');
    Route::post('/menu/checkedit/{id}','Admin\MenuController@update');
    Route::post('/menu/delete/{id}','Admin\MenuController@destroy');


    //FAQ
    Route::get('/Faq','Admin\FaqController@index');
    Route::get('/Faq/ListFaq','Admin\FaqController@ListFaq');
    Route::post('/Faq','Admin\FaqController@store');
    Route::get('/Faq/{id}','Admin\FaqController@edit');
    Route::post('/Faq/CheckEdit/{id}','Admin\FaqController@update');
    Route::post('/Faq/Delete/{id}','Admin\FaqController@destroy');

    //Customer
    Route::get('/Customers','Admin\CustomerController@index');
    Route::get('/Customers/ListCustomer','Admin\CustomerController@ListCustomer');
    Route::post('/Customers','Admin\CustomerController@store');
    Route::POST('/Customers/{id}','Admin\CustomerController@edit');
    Route::post('/Customers/CheckEdit/{id}','Admin\CustomerController@update');
    Route::post('/Customers/Delete/{id}','Admin\CustomerController@destroy');

    #CustomerWaiting
    Route::get('/CustomerWaiting','Admin\CustomerWaitingController@index');
    Route::get('/CustomerWaiting/ListCustomer','Admin\CustomerWaitingController@ListCustomer');
    Route::get('/CustomerWaiting/changeStatus/{id}','Admin\CustomerWaitingController@changeStatus');

    //Retailer
    Route::get('/Retailers','Admin\RetailerController@index');
    Route::get('/Retailers/ListRetailer','Admin\RetailerController@ListRetailer');
    Route::post('/Retailers','Admin\RetailerController@store');
    Route::get('/Retailers/{id}','Admin\RetailerController@edit');
    Route::get('/Retailers/changeStatus/{id}','Admin\RetailerController@changeStatus');
    Route::post('/Retailers/CheckEdit/{id}','Admin\RetailerController@update');
    Route::post('/Retailers/Delete/{id}','Admin\RetailerController@destroy');

    #RetailerWaiting
    Route::get('/RetailerWaiting','Admin\RetailerWaitingController@index');
    Route::get('/RetailerWaiting/ListRetailer','Admin\RetailerWaitingController@ListRetailer');
    Route::get('/RetailerWaiting/Edit/{id}','Admin\RetailerWaitingController@edit');
    Route::post('/RetailerWaiting/Update/{id}','Admin\RetailerWaitingController@update');
    Route::get('/RetailerWaiting/changeStatus/{id}','Admin\RetailerWaitingController@changeStatus');
    // Approve Request
    Route::get('/ApproveRequest','Admin\RequestController@index');
    Route::get('/ApproveRequest/ListApproveRequest','Admin\RequestController@ListApproveRequest');
    Route::get('/ApproveRequest/RequestDetail/{id}','Admin\RequestController@GetRequest');

    // Pending Request
    Route::get('/PendingRequest','Admin\PendingRequestController@index');
    Route::get('/PendingRequest/ListPendingRequest','Admin\PendingRequestController@ListPendingRequest');
    Route::get('/PendingRequest/{id}','Admin\PendingRequestController@GetRequest');
    Route::post('/PendingRequest/Update/{id}','Admin\PendingRequestController@update');
    Route::get('/PendingRequest/RequestDetail/{id}','Admin\PendingRequestController@GetRequestById');
    Route::post('/PendingRequest/Approve/{id}','Admin\PendingRequestController@approve');
    Route::post('/PendingRequest/CancelRequest/{id}','Admin\PendingRequestController@CancelRequest');

    //Knowledge
    Route::get('Knowledge','Admin\KnowledgeController@index');
    Route::get('/Knowledge/ListKnowledge','Admin\KnowledgeController@ListKnowledge');
    Route::post('/Knowledge','Admin\KnowledgeController@store');
    Route::get('/Knowledge/{id}','Admin\KnowledgeController@edit');
    Route::post('/Knowledge/CheckEdit/{id}','Admin\KnowledgeController@update');
    Route::post('/Knowledge/Delete/{id}','Admin\KnowledgeController@destroy');

    //Service
    Route::get('Service','Admin\ServiceController@index');
    Route::get('/Service/ListService','Admin\ServiceController@ListService');
    Route::post('/Service','Admin\ServiceController@store');
    Route::get('/Service/{id}','Admin\ServiceController@edit');
    Route::post('/Service/CheckEdit/{id}','Admin\ServiceController@update');
    Route::post('/Service/Delete/{id}','Admin\ServiceController@destroy');

    //Advertisement
    Route::get('Advertisement','Admin\AdvertisementController@index');
    Route::get('/Advertisement/ListAdvertisement','Admin\AdvertisementController@ListAdvertisement');
    Route::post('/Advertisement','Admin\AdvertisementController@store');
    Route::get('/Advertisement/{id}','Admin\AdvertisementController@edit');
    Route::post('/Advertisement/CheckEdit/{id}','Admin\AdvertisementController@update');
    Route::post('/Advertisement/Delete/{id}','Admin\AdvertisementController@destroy');

    //ContactDetail
    Route::get('ContactDetail','Admin\ContactDetailController@index');
    Route::get('/ContactDetail/ListContactDetail','Admin\ContactDetailController@ListContactDetail');
    Route::post('/ContactDetail','Admin\ContactDetailController@store');
    Route::get('/ContactDetail/{id}','Admin\ContactDetailController@edit');
    Route::post('/ContactDetail/CheckEdit/{id}','Admin\ContactDetailController@update');
    Route::post('/ContactDetail/Delete/{id}','Admin\ContactDetailController@destroy');

    //CustomerContact
    Route::get('CustomerContact','Admin\CustomerContactController@index');
    Route::get('/CustomerContact/ListCustomerContact','Admin\CustomerContactController@ListCustomerContact');
    Route::post('/CustomerContact','Admin\CustomerContactController@store');
    Route::get('/CustomerContact/{id}','Admin\CustomerContactController@edit');
    Route::post('/CustomerContact/CheckEdit/{id}','Admin\CustomerContactController@update');
    Route::post('/CustomerContact/Delete/{id}','Admin\CustomerContactController@destroy');


    //About
    Route::get('About','Admin\AboutController@index');
    Route::get('/About/ListAbout','Admin\AboutController@ListAbout');
    Route::post('/About','Admin\AboutController@store');
    Route::get('/About/{id}','Admin\AboutController@edit');
    Route::post('/About/CheckEdit/{id}','Admin\AboutController@update');
    Route::post('/About/Delete/{id}','Admin\AboutController@destroy');

    //Banner
    Route::get('Banner','Admin\BannerController@index');
    Route::get('/Banner/ListBanner','Admin\BannerController@ListBanner');
    Route::post('/Banner','Admin\BannerController@store');
    Route::get('/Banner/{id}','Admin\BannerController@edit');
    Route::post('/Banner/CheckEdit/{id}','Admin\BannerController@update');
    Route::post('/Banner/Delete/{id}','Admin\BannerController@destroy');

    //Credit
    Route::get('Credit','Admin\CreditController@index');
    Route::get('/Credit/ListCredit','Admin\CreditController@ListCredit');
    Route::post('/Credit','Admin\CreditController@store');
    Route::get('/Credit/{id}','Admin\CreditController@edit');
    Route::post('/Credit/CheckEdit/{id}','Admin\CreditController@update');
    Route::post('/Credit/Delete/{id}','Admin\CreditController@destroy');

    //AuthorityCredit
    Route::get('AuthorityCredit','Admin\AuthorityCreditController@index');
    Route::get('/AuthorityCredit/ListAuthorityCredit','Admin\AuthorityCreditController@ListAuthorityCredit');
    Route::post('/AuthorityCredit','Admin\AuthorityCreditController@store');
    Route::get('/AuthorityCredit/{id}','Admin\AuthorityCreditController@edit');
    Route::post('/AuthorityCredit/CheckEdit/{id}','Admin\AuthorityCreditController@update');
    Route::post('/AuthorityCredit/Delete/{id}','Admin\AuthorityCreditController@destroy');
    Route::get('/AuthorityCredit/StatusApproved/{id}','Admin\AuthorityCreditController@Approved');
    Route::post('/ApproveCredit/{id}','Admin\AuthorityCreditController@Approved');
    Route::get('/AuthorityCredit/StatusCancel/{id}','Admin\AuthorityCreditController@Cancel');


    //Offers
    Route::get('Offers','Admin\OfferController@index');
    Route::get('/Offers/ListOffers','Admin\OfferController@ListOffers');
    Route::post('/Offers','Admin\OfferController@store');
    Route::get('/Offers/{id}','Admin\OfferController@edit');
    Route::post('/Offers/CheckEdit/{id}','Admin\OfferController@update');
    Route::post('/Offers/Delete/{id}','Admin\OfferController@destroy');

    // Promotions
    Route::get('/Promotion','Admin\PromotionController@index');
    Route::get('/Promotion/ListPromotion','Admin\PromotionController@ListPromotion');
    Route::get('/Promotion/Edit/{id}','Admin\PromotionController@edit');
    Route::post('/Promotion/Update/{id}','Admin\PromotionController@update');
    Route::post('/Promotion/delete/{id}','Admin\PromotionController@delete');

    #Promotion Waiting
    Route::get('/PendingPromotion','Admin\PendingPromotionController@index');
    Route::get('/PendingPromotion/ListPending','Admin\PendingPromotionController@ListPending');
    Route::get('/PendingPromotion/ChangeStatus/{id}','Admin\PendingPromotionController@ChangeStatus');
    Route::get('/PendingPromotion/Cancel/{id}','Admin\PendingPromotionController@Cancel');



    //Chat
    Route::get('CustomerMessage','Admin\ChatController@CustomerMessage');
    Route::get('RetailerMessage','Admin\ChatController@RetailerMessage');
    // Route::get('Message/ListChat','Admin\ChatController@ListChat');
    Route::get('Message/CustomerListChat','Admin\ChatController@CustomerListChat');
    Route::get('Message/RetailerListChat','Admin\ChatController@RetailerListChat');
    Route::get('Message/{id}','Admin\ChatController@Message');
    Route::post('Message/Send','Admin\ChatController@Send');

    // SP Tariff
    Route::get('/SP_Tariff','Admin\SPTariffController@index');
    Route::get('/SP_Tariff/ListSPTariff','Admin\SPTariffController@ListSPTariff');
    Route::get('/SP_Tariff/{id}','Admin\SPTariffController@edit');
    Route::post('/SP_Tariff/CheckEdit/{id}','Admin\SPTariffController@update');
    Route::post('/SP_Tariff/Delete/{id}','Admin\SPTariffController@destroy');

    // Customer Condition
    Route::get('/CustomerCondition','Admin\ConditionController@index');
    Route::get('/CustomerCondition/ListCustCondition','Admin\ConditionController@ListCustCondition');
    Route::post('/CustomerCondition/Store','Admin\ConditionController@store');
    Route::get('/CustomerCondition/edit/{id}','Admin\ConditionController@edit');
    Route::post('/CustomerCondition/update/{id}','Admin\ConditionController@update');
    Route::post('/CustomerCondition/delete/{id}','Admin\ConditionController@destroy');

    // Retailer Condition
    Route::get('/RetailerCondition','Admin\RetailerConditionController@index');
    Route::get('/RetailerCondition/ListRetailerCondition','Admin\RetailerConditionController@ListRetailerCondition');
    Route::post('/RetailerCondition/Store','Admin\RetailerConditionController@store');
    Route::get('/RetailerCondition/edit/{id}','Admin\RetailerConditionController@edit');
    Route::post('/RetailerCondition/update/{id}','Admin\RetailerConditionController@update');
    Route::post('/RetailerCondition/delete/{id}','Admin\RetailerConditionController@destroy');

});

Route::any('/upload_file','OrakController@upload_file');
