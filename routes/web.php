<?php


use App\Http\Middleware\Admin;
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
Route::get('/currency-update','DataController@c_update');
Route::get("/get_test",'ProductController@get_test')->middleware("admin");
// SEO Controller
Route::get('/metatags','DataController@metatags')->middleware('secondadmin');
Route::get('/metatag/{id}','DataController@metatag')->middleware('secondadmin');
Route::get('/metadescriptions','DataController@metadescriptions')->middleware('secondadmin');
Route::get('/metadesc/{id}','DataController@metadesc')->middleware('secondadmin');
Route::get('/metatag-creation','DataController@metatagcreation')->middleware('secondadmin');
Route::get('/metadesc-creation','DataController@metadesccreation')->middleware('secondadmin');
Route::post('/addnewtag','DataController@addnewtag')->middleware('secondadmin');
Route::post('/addnewdescription','DataController@addnewdesc')->middleware('secondadmin');
Route::get('/deletetag/{id}', 'DataController@deletetag')->middleware('secondadmin');
Route::get('/deletedesc/{id}', 'DataController@deletedesc')->middleware('secondadmin');
Route::post('/editmetadesc/{id}','DataController@editmetadesc')->middleware('secondadmin');
// end of SEO Controller

Route::get('/list-of-most-viewed-products','AdminController@getmostviewedproducts')->middleware('admin');

Route::get('/add-product-tab','ProductController@prodtabs')->middleware('admin');
Route::get('/product-tabs-list','ProductController@prodtablist')->middleware('admin');
Route::post('/addproducttab','ProductController@addproducttab')->middleware('admin');
Route::get('/deleteprodtab/{id}','ProductController@deleteproducttab')->middleware('admin');
Route::post('/prodtabedit/{id}','ProductDetails@editprod_tab')->middleware('admin');

Route::get('/home', function(){return redirect('/');})->middleware('admin');
Route::get('/', 'AdminController@Displaydataforadmin')->name('admin')->middleware('admin');
Route::post('sendproblem', 'UserController@sendproblem');
Route::post('addproblem','AdminController@addproblem')->middleware('admin');
Route::get('/problem/list','AdminController@problemlists')->middleware('admin');
Route::get('/unverified', 'AdminController@unverified')->middleware('admin');
Route::get('/cnt-list', 'AdminController@cntlist')->middleware('admin');
// Route::get('/delete_contact/{id}', 'AdminController@delete_contact')->middleware('admin');
Route::get('/helpdeskcontrol', 'AdminController@helpdeskcontrol')->middleware('admin');
Route::get('/helpdeskcontrol-deleted', 'AdminController@helpdeskcontrol_deleted')->middleware('admin');
Route::get('/helpdeskcontrol-sent', 'AdminController@helpdeskcontrol_sent')->middleware('admin');
Route::post('/read-contact','AdminController@readcontact')->middleware('admin');
Route::get('/get-contact-details','AdminController@getcontdets')->middleware('admin');
// Route::post('/unreadcont/{id}','AdminController@unreadcont')->middleware('admin');
Route::post('/delete-contact','AdminController@del_contact')->middleware('admin');
// Route::post('/deleteallcont/{id}','AdminController@deleteallcont')->middleware('admin');
// Route::post('/undeletecont/{id}','AdminController@undeletecont')->middleware('admin');

Route::get('/delete-unused-images','UserController@deleteUnusedImages')->middleware('mainadmin');

Route::get('/verified', 'AdminController@verified')->middleware('admin');
Route::get('/rejectnewscomment/{id}','AdminController@rejectnewscomment')->middleware('admin');
Route::post('/verifynewscomment/{id}','AdminController@verifynewscomment')->middleware('admin');
Route::get('/productlist', 'ProductController@showproducts')->middleware('admin');
Route::get('/sellproduct', 'UserController@getData')->middleware('admin');
Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct')->middleware('admin');
Route::get('/catlists', 'AdminController@getDataforcatlists')->name('catss')->middleware('admin');
Route::get('/deletecategory/{id}', 'ProductController@deletecategory')->middleware('admin');
Route::post('/categoryedit/{id}', 'ProductController@categoryedit')->middleware('admin');
Route::post('/subcatedit/{id}', 'ProductController@subcatedit')->middleware('admin');
Route::get('/deletesubcat/{id}', 'ProductController@deletesubcat')->middleware('admin');
Route::get('/vipcomments','AdminController@vipcomments')->middleware('admin');
Route::post('/addvipcomment','AdminController@addvipcomment')->middleware('admin');
Route::get('/deletevipcomment/{id}', 'AdminController@deletevipcomment')->middleware('admin');
Route::get('/userlist','AdminController@getuserlist')->middleware('mainadmin');
Route::post('/verify/{user}/number','AdminController@verify_number')->middleware('admin');
Route::get('/userdelete/{id}', 'AdminController@deleteuser')->middleware('mainadmin');
Route::post('/assignadmin/{id}/edit','AdminController@assignadmin')->middleware('mainadmin');
Route::post('/addnewproduct', 'UserController@addproduct')->middleware('admin');
Route::get('/productedit/{id}', 'UserController@productedit')->middleware('admin');
Route::post('/edit/productslug/{id}','ProductController@editproductslug')->middleware('admin');
Route::get('/news-list','AdminController@newslist')->middleware('admin');
Route::post('/editproduct/{id}','UserController@editproduct')->middleware('admin');
Route::get('/catcreation', 'AdminController@addnewcategory')->name('catcr')->middleware('admin');
Route::post('/addnewcat', 'AdminController@catcreation')->middleware('admin');
Route::post('/addnewsubcat', 'AdminController@addnewsubcat')->middleware('admin');
Route::get('/addnews','AdminController@addnews')->middleware('admin');
Route::post('/addnews','AdminController@toaddnews')->middleware('admin');
Route::post('/edit/news/slug/{id}','UserController@changenewsslug')->middleware('admin');
Route::get('/boostedlist', 'AdminController@getactivity')->name('boost')->middleware('admin');
Route::post('/addposter','AdminController@addposter')->middleware('admin');
Route::get('/deleteposter/{id}', 'AdminController@deleteposter')->middleware('admin');
Route::get('/usercreation', 'AdminController@usercreation')->middleware('mainadmin');
Route::post('/adduser', 'AdminController@adduser')->middleware('mainadmin');
Route::get('/newsdelete/{id}', 'AdminController@newsdelete')->middleware('admin');
Route::get('/profile','AdminController@profiledata')->middleware('admin');
Route::get('/admin', function(){ return redirect('/'); });
Route::post('/editnews/{id}','AdminController@editnews')->middleware('admin');

Route::post('/changepassword/{id}','UserController@changepassword')->middleware('admin');
Route::post('/changeprofilesettings/{id}','UserController@changeuserdata')->middleware('admin');
Route::post('/update/profilephoto/{id}','UserController@update_avatar')->middleware('admin');

Route::get('/pages','UserController@getpages')->middleware('secondadmin');
Route::get('/createpages','UserController@createpage')->middleware('secondadmin');
Route::post('/create/new/page','UserController@tocreatepage')->middleware('secondadmin');
Route::get('/deletepage/{token}','UserController@deletepage')->middleware('secondadmin');
Route::post('/editpage/{id}','UserController@editpageslug')->middleware('secondadmin');
Route::get('/page-detail/{slug}','UserController@pageedit')->middleware('secondadmin');
Route::post('/update/page/{id}','UserController@updatepages')->middleware('secondadmin');
// new version routes are here

Route::post('/addnewscomment','UserController@addnewscomment');
Route::get('notfound',['as'=>'notfound', 'uses' => 'AdminController@notfound']);

Route::get('/tabscontrol','UserController@tabslist')->middleware('admin');
Route::post('/addtab','UserController@createtab')->middleware('admin');
Route::get('/deletetab/{id}','UserController@deletetab')->middleware('admin');
Route::post('/edit/tab/{id}','UserController@edittab')->middleware('admin');
Route::get('/tabedit/{id}','UserController@tabedit')->middleware('admin');

Route::get('/product/ajax-sub', 'UserController@getbyajax')->name('ajax-sub');
Route::get('/product/getdatabyaj', 'UserController@getdatabyajax')->name('getdatabyaj');
Route::get('/product/getdatabyajax', 'ProductController@getdatabyajax')->name('getdatabyajax');
Route::get('/product/getcitybyajax', 'AdminController@getcitybyajax')->name('getcitybyajax');
Route::get('/product/getphonecodebyajax','AdminController@getphonecodebyajax')->name('getphonecodebyajax');

// Register routes
Route::post('/login/custom',['uses' => 'Auth\LoginController@login','as' => 'login.custom']);
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
