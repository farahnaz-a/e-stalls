<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventCollectionController;
use App\Http\Controllers\VerzilverController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MollieWebhookController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\MovieHallController;
use App\Http\Controllers\StallHallController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ReturnCancelController;
use App\Models\PasswordResetToken;

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

// PUBLIC
Route::get('events', [EventCollectionController::class, 'index'])->name('public.events');
Route::get('vendor', [VendorController::class, 'index'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
// Route::get('/address-validation', [HomeController::class, 'addressValidation']);
Route::post('/address-verification', [HomeController::class, 'addressVerification'])->name('address.verification');
Route::get('contact', function() {
    return view('contact.index');
});
Route::get('/ondernemer', function() {
    return view('entrepreneur.index');
});
Route::post('/ondernemer/store', [HomeController::class, 'ondernemerStore'])->name('ondernemer.store');
Route::get('over-ons', function() {
    return view('about.index');
});
Route::get('samenwerken', function() {
    return view('samenwerken.index');
});

// -- Legal forms
Route::get('retour', [ReturnCancelController::class, 'retour'])->middleware('auth');
Route::post('/return/request', [ReturnCancelController::class, 'returnRequest'])->name('return.request')->middleware('auth');
Route::get('/admin/return/request', [ReturnCancelController::class, 'adminReturnList'])->name('admin.return.list')->middleware('auth');
Route::get('/user/return/request', [ReturnCancelController::class, 'userReturnList'])->name('user.return.list')->middleware('auth');
Route::get('/vendor/return/request', [ReturnCancelController::class, 'vendorReturnList'])->name('vendor.return.list')->middleware('auth');

Route::get('/admin/get-vendor/return/request', [ReturnCancelController::class, 'getVendorsOfThisEventForReturn'])->name('get.vendors.return')->middleware('auth');
Route::post('/admin/get-vendor/return/request', [ReturnCancelController::class, 'forwardVendorReturnReq'])->name('forward.vendor.return.request')->middleware('auth');
Route::get('annulering', [ReturnCancelController::class, 'annulering'])->middleware('auth');
Route::post('/cancel/request', [ReturnCancelController::class, 'cancelRequest'])->name('cancel.request')->middleware('auth');
Route::get('/admin/cancel/request', [ReturnCancelController::class, 'adminCancelRequest'])->name('admin.cancel.list')->middleware('auth');
Route::get('/user/cancel/request', [ReturnCancelController::class, 'userCancelRequest'])->name('user.cancel.list')->middleware('auth');
Route::get('/vendor/cancel/request', [ReturnCancelController::class, 'vendorCancelList'])->name('vendor.cancel.list')->middleware('auth');
Route::get('/admin/get-vendor/cancel/request', [ReturnCancelController::class, 'getVendorsOfThisEventForCancel'])->name('get.vendors.cancel')->middleware('auth');
Route::post('/admin/get-vendor/cancel/request', [ReturnCancelController::class, 'forwardVendorCancelReq'])->name('forward.vendor.cancel.request')->middleware('auth');
// END PUBLIC

// Authentication / account usage
Route::get('inloggen', [AuthController::class, 'login'])->name('login');
Route::get('uitloggen', [AuthController::class, 'logout']);
Route::post('auth', [AuthController::class, 'authenticate']);
Route::get('account-aanmaken', [AuthController::class, 'aanmaken']);
Route::get('vendor-aanmaken', [AuthController::class, 'vendor']);
Route::post('vendor-aanmaken', [AuthController::class, 'createVendor']);
Route::post('authcreate', [AuthController::class, 'create']);
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('user/chat-box', [AuthController::class, 'chatBox'])->middleware('auth')->name('chatBox');
Route::get('dashboard/bestellingen', [AuthController::class, 'orders'])->middleware('auth');
Route::get('vernietig-account', [AuthController::class, 'destroy'])->middleware('auth');
Route::post('vernietig-akkoord', [AuthController::class, 'destroyAccept'])->middleware('auth');
Route::post('authupdate', [AuthController::class, 'update'])->middleware('auth');

// Event Routes
Route::get('event/{id}', [EventController::class, 'index'])->middleware('auth');
Route::get('event/{id}/verlaten', [EventController::class, 'exit'])->middleware('auth');
Route::get('event/{id}/loterij', [LotteryController::class, 'main'])->middleware('auth');
Route::get('event/{id}/woordprijs', [LotteryController::class, 'wordprice'])->middleware('auth');
Route::post('event/{id}/woordprijscheck', [LotteryController::class, 'checkWord'])->middleware('auth');
Route::get('event/{id}/stallhall', [StallHallController::class, 'stallhall'])->middleware('auth');
Route::get('event/{eventid}/stallhall/{id}', [StallHallController::class, 'stall'])->middleware('auth');
Route::get('goodiebag/{id}', [StallHallController::class, 'goodiebag'])->middleware('auth');
Route::get('popup/{id}', [StallHallController::class, 'popup'])->middleware('auth');
// Route::get('popup/goodiebag/{id}', [StallHallController::class, 'goodiebagPopup'])->middleware('auth');
Route::get('event/{id}/moviehall', [MovieHallController::class, 'index'])->middleware('auth');
Route::get('event/{id}/movie/{movie}', [MovieHallController::class, 'movie'])->middleware('auth');
Route::get('event/{id}/auctionhall', [AuctionController::class, 'hall'])->middleware('auth');
Route::get('event/{id}/auction/{auctionid}', [AuctionController::class, 'auction'])->middleware('auth');
Route::post('event/{id}/auction/placebid', [AuctionController::class, 'bid'])->middleware('auth');


Route::get('event/{eventid}/product/{id}', [StallHallController::class, 'product'])->middleware('auth');
Route::get('event/{eventid}/coupon/{id}', [StallHallController::class, 'coupon'])->middleware('auth');
Route::post('event/{id}/atc', [CartController::class, 'atc'])->middleware('auth');
Route::get('event/{id}/winkelwagen', [CartController::class, 'cart'])->middleware('auth');
Route::get('event/{id}/winkelwagen/delete', [CartController::class, 'delete'])->middleware('auth');





// -- Verzilveren
Route::get('event/{id}/verzilveren', [VerzilverController::class, 'index'])->middleware('auth');
Route::post('authticket', [VerzilverController::class, 'authTicket'])->middleware('auth');

// Payments
Route::get('ticket-kopen/{id}', [PaymentController::class, 'buyTicket'])->middleware('auth');
Route::post('ticket-betalen', [PaymentController::class, 'processTicketPayment'])->middleware('auth');

Route::post('webhooks/mollie/aftercare', [MollieWebhookController::class, 'handleWebhookNotification'])->name('webhooks.mollie');
Route::get('bestelling-voltooid/{order_id}', [PaymentController::class, 'done'])->name('checkout.done')->middleware('auth');;



Route::get('debug', [LotteryController::class, 'tempor'])->middleware('auth');

Route::get('admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('admin/events', [AdminController::class, 'events'])->middleware('auth');
Route::get('admin/events/add', [AdminController::class, 'addEventForm'])->middleware('auth');
Route::post('admin/events/new', [AdminController::class, 'addEvent'])->middleware('auth');
Route::post('admin/events/update', [AdminController::class, 'updateEvent'])->middleware('auth');
Route::get('admin/events/{id}', [AdminController::class, 'updateEventForm'])->middleware('auth');
Route::get('admin/events/{id}/live', [AdminController::class, 'liveEvent'])->middleware('auth');
Route::get('admin/events/{id}/archive', [AdminController::class, 'archiveEvent'])->middleware('auth');
Route::get('admin/events/{id}/delete', [AdminController::class, 'deleteEvent'])->middleware('auth');
Route::get('admin/approvals', [AdminController::class, 'approvals'])->middleware('auth');
Route::get('admin/movies/{id}/accept', [AdminController::class, 'movieApprove'])->middleware('auth');
Route::get('admin/movies/{id}/decline', [AdminController::class, 'movieDecline'])->middleware('auth');
Route::get('admin/logos/{id}/accept', [AdminController::class, 'logoApprove'])->middleware('auth');
Route::get('admin/logos/{id}/decline', [AdminController::class, 'logoDecline'])->middleware('auth');
Route::get('admin/vendors/{id}/accept', [AdminController::class, 'vendorApprove'])->middleware('auth');
Route::get('admin/vendors/{id}/decline', [AdminController::class, 'vendorDecline'])->middleware('auth');
Route::get('admin/stalls/{id}/accept', [AdminController::class, 'stallApprove'])->middleware('auth');
Route::get('admin/stalls/{id}/decline', [AdminController::class, 'stallDecline'])->middleware('auth');
Route::get('admin/auctions/{id}/accept', [AdminController::class, 'auctionApprove'])->middleware('auth');
Route::post('admin/auctions/{id}/time-update', [AdminController::class, 'updateAuctionTime'])->middleware('auth');
Route::get('admin/auctions/{id}/archive', [AdminController::class, 'auctionArchive'])->middleware('auth');
Route::get('admin/auctions/{id}/settings', [AdminController::class, 'auctionSettings'])->middleware('auth');
Route::get('admin/auctions/{id}/decline', [AdminController::class, 'auctionDecline'])->middleware('auth');
Route::get('admin/preview/auction/{id}/{auctionid}', [AuctionController::class, 'auction'])->middleware('auth');
Route::get('admin/preview/stall/{id}/{stallid}', [AuctionController::class, 'viewStall'])->middleware('auth');
Route::get('admin/orders', [AdminController::class, 'orders'])->middleware('auth');
Route::get('admin/order/{id}/archive', [AdminController::class, 'archiveOrder'])->middleware('auth');
Route::get('admin/order/{id}/live', [AdminController::class, 'liveOrder'])->middleware('auth');

// bulk action routes
Route::post('admin/orders/bulk-archive', [AdminController::class, 'bulkArchiveOrders'])->middleware('auth');
Route::post('admin/orders/bulk-live', [AdminController::class, 'bulkLiveOrders'])->middleware('auth');

Route::get('admin/accounts', [AdminController::class, 'accounts'])->middleware('auth');
Route::get('admin/goodiebag', [AdminController::class, 'goodiebag'])->middleware('auth');
Route::post('admin/goodiebag/{id}/delete', [AdminController::class, 'deleteGoodiebag'])->middleware('auth');
Route::get('admin/goodiebag/{id}/edit', [AdminController::class, 'editGoodiebag'])->middleware('auth');
Route::get('admin/goodiebag/{id}/live', [AdminController::class, 'setLiveGoodiebag'])->middleware('auth');
Route::get('admin/goodiebag/{id}/archive', [AdminController::class, 'setArchiveGoodiebag'])->middleware('auth');
Route::post('admin/goodiebag/{id}/update', [AdminController::class, 'updateGoodiebag'])->middleware('auth');
Route::get('admin/accounts/{id}/delete', [AdminController::class, 'deleteUser'])->middleware('auth');
Route::get('admin/accounts/{id}/customer', [AdminController::class, 'customerUser'])->middleware('auth');
Route::get('admin/accounts/{id}/vendor', [AdminController::class, 'vendorUser'])->middleware('auth');
Route::get('admin/accounts/{id}/permissions', [AdminController::class, 'permissions'])->middleware('auth');
Route::post('admin/accounts/{id}/save', [AdminController::class, 'vendorSave'])->middleware('auth');
Route::get('admin/auctions', [AdminController::class, 'auctions'])->middleware('auth');
Route::get('admin/ondernemer', [AdminController::class, 'ondernemer'])->middleware('auth');
Route::get('admin/ondernemer/{id}/archive', [AdminController::class, 'archiveOndernemer'])->middleware('auth');
Route::post('admin/ondernemer/{id}/delete', [AdminController::class, 'deleteOndernemer'])->middleware('auth');
Route::get('admin/ondernemer/{id}/live', [AdminController::class, 'liveOndernemer'])->middleware('auth');
Route::get('admin/auction-log/{id}', [AdminController::class, 'showLog'])->middleware('auth');
Route::get('admin/prices', [AdminController::class, 'prices'])->middleware('auth');
Route::post('admin/prices/popup/update', [AdminController::class, 'updatePopUpPrice'])->middleware('auth');
Route::get('admin/prices/popup/{id}/delete', [AdminController::class, 'deletePopUpPrice'])->middleware('auth');
Route::get('admin/prices/popup/add', [AdminController::class, 'addPopUpForm'])->middleware('auth');
Route::post('admin/prices/popup/new', [AdminController::class, 'addPopUp'])->middleware('auth');
Route::get('admin/goodiebag/popup/prices/add', [AdminController::class, 'addGoodiebagForm'])->middleware('auth');
Route::post('admin/goodiebag/popup/prices/new', [AdminController::class, 'addGoodiebag'])->middleware('auth');
Route::get('admin/prices/popup/{id}', [AdminController::class, 'updatePopUpPriceForm'])->middleware('auth');
Route::post('admin-goodiebag-event-change', [AdminController::class, 'adminGoodiebagEventChange'])->name('admin.goodiebag.event-change')->middleware('auth');
Route::post('admin-event-change-vendor', [AdminController::class, 'eventChangeVendor'])->name('admin.event.change.vendor')->middleware('auth');


Route::get('vendor/account-instellingen', [VendorController::class, 'accountSettings'])->middleware('auth');
Route::get('vendor/saldo', [VendorController::class, 'saldo'])->middleware('auth');
Route::get('vendor/verkoopoverzicht', [VendorController::class, 'verkoopoverzicht'])->middleware('auth');
Route::get('vendor/retouren-en-annuleringen', [VendorController::class, 'retourenEnAnnuleringen'])->middleware('auth');
Route::get('vendor/place-logo-ad', [VendorController::class, 'logoAd'])->middleware('auth');
Route::post('vendor/place-logo-ad/add', [VendorController::class, 'AddlogoAd'])->middleware('auth');
Route::get('vendor/place-movie', [VendorController::class, 'movie'])->middleware('auth');
Route::post('vendor/place-movie/add', [VendorController::class, 'addMovie'])->middleware('auth');
Route::get('vendor/request-stall', [VendorController::class, 'stall'])->middleware('auth');
Route::get('vendor/stall/edit', [VendorController::class, 'stallEdit'])->middleware('auth');
Route::get('vendor/stall/re-send', [VendorController::class, 'stallResend'])->middleware('auth');
Route::post('vendor/stall/edit', [VendorController::class, 'stallUpdate'])->middleware('auth');
Route::post('/send/stall/request', [VendorController::class, 'sendStallRequest'])->middleware('auth');
Route::get('vendor/products/{id}/delete', [VendorController::class, 'deleteProduct'])->middleware('auth');
Route::get('vendor/product/{id}', [VendorController::class, 'product'])->middleware('auth');
Route::post('vendor/product/{id}', [VendorController::class, 'editProduct'])->middleware('auth');
Route::get('vendor/products/add', [VendorController::class, 'newProduct'])->middleware('auth');
Route::post('vendor/products/add', [VendorController::class, 'addProduct'])->middleware('auth');
Route::get('vendor/coupons/{id}/delete', [VendorController::class, 'deletecoupon'])->middleware('auth');
Route::get('vendor/coupon/{id}', [VendorController::class, 'coupon'])->middleware('auth');
Route::post('vendor/coupon/{id}', [VendorController::class, 'editCoupon'])->middleware('auth');
Route::get('vendor/coupons/add', [VendorController::class, 'newCoupon'])->middleware('auth');
Route::post('vendor/coupons/add', [VendorController::class, 'addCoupon'])->middleware('auth');
Route::post('vendor/request-stall', [VendorController::class, 'addStall'])->middleware('auth');
Route::get('vendor/request-goodiebag', [VendorController::class, 'goodiebag'])->middleware('auth');
Route::post('vendor/set-goodiebag', [VendorController::class, 'setGoodiebag'])->middleware('auth');
Route::post('vendor/set-stall-sample', [VendorController::class, 'setStallSampleInfo'])->middleware('auth');
Route::post('vendor-auction-item-update', [VendorController::class, 'VendorAuctionItemUpdate'])->name('admin.vendor.auction-item.update')->middleware('auth');

Route::get('vendor/request-auction-product', [VendorController::class, 'auction'])->name('request.auction.product')->middleware('auth');
Route::post('vendor/request-auction-product', [VendorController::class, 'addAuction'])->middleware('auth');
Route::post('vendor/auction_item_count', [VendorController::class, 'auction_item_count'])->name('auction_item_count')->middleware('auth');
Route::get('vendor/request-event', [VendorController::class, 'event'])->middleware('auth');
Route::post('stall-no-sample-change', [VendorController::class, 'stallNoSampleChange'])->name('stall.no-sample.change')->middleware('auth');

Route::get('/forgot-password', function () {
    return view('wachtwoord-vergeten');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPass'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    $exists = PasswordResetToken::where('token', $token)->exists();
    if($exists){
        return view('reset-expired');
    }else{
        return view('reset-wachtwoord', ['token' => $token]);
    }
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPass'])->name('password.update');

Route::get('admin/events/{id}/stalls', [AdminController::class, 'eventStalls'])->name('admin.events.stalls');
Route::post('admin/stall/visibility', [AdminController::class, 'stallVisibility'])->name('admin.stall.visibility')->middleware('auth');
Route::get('admin/events/{id}/movies', [AdminController::class, 'movieStalls'])->name('admin.movies.stalls');
Route::post('admin/movie/visibility', [AdminController::class, 'movieVisibility'])->name('admin.movie.visibility')->middleware('auth');
Route::get('admin/events/{id}/products', [AdminController::class, 'productStalls']);
Route::get('get/vendors', [AdminController::class, 'getVendor']);
Route::post('stall/assign/vendor', [AdminController::class, 'vendorStallAssign'])->name('assign.vendor.stalls');
Route::post('movie/assign/vendor', [AdminController::class, 'vendorMovieAssign'])->name('assign.vendor.movie');
Route::post('/return/cancelation', [AdminController::class, 'returnAndCancel'])->name('/return/cancelation');
