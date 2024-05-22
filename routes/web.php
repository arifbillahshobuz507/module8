<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

Route::get('/', [DemoController::class, 'homePage']);

//Routes
//======================Request======================//
Route::get('/simple-request', [DemoController::class, 'simpleRequest']);

// Request with Parameter
// rquiar pamrameter
Route::get('/user/{name}/{age}/{city}', [DemoController::class, 'requiredPeramiter']);
// optional parameter
Route::get('/user-data/{name?}/{age?}/{city?}', [DemoController::class, 'optionalPeramiter']);

//Request Body
//request Body by single data catch
Route::get('/request-body', [DemoController::class, 'requestBody']);
//request Body by all data catch
Route::get('/request-body-data', [DemoController::class, 'requestBodyData']);

//Request Header
Route::get('header-single-data', [DemoController::class,'headerSingleData']);
Route::get('header-multiple-data', [DemoController::class,'headerMultipleData']);

//Request All type data
Route::get('all-type-single-data/{age?}', [DemoController::class,'allSingleData']);
Route::get('all-type-multiple-data/{age}', [DemoController::class,'allMultipleData']);


// from data
//from data by single data catch
Route::post('/from-data', [DemoController::class, 'fromDataSingle']);
//from data by all data catch
Route::post('/from-data-multiple', [DemoController::class, 'fromDataMultiple']);


// Multipart From Data/ file
//Multipar From data/ single image work
Route::get('/multipart-from-data', [DemoController::class, 'singleImage']);
//multipart from all data
Route::get('/multipart-multiple-from-data-multiple', [DemoController::class, 'MultipleImage']);

//file upload
//single file upload
Route::get('/single-file-upload', [DemoController::class, 'singleFile']);
//multipart from all data
Route::get('/multiple-file-upload', [DemoController::class, 'MultipleFile']);

//Ip address
Route::get('/ip-address', [DemoController::class, 'ipAddress']);

//Content Negotiation
Route::post('/accept-content-type', [DemoController::class, 'acceptableContentType']);
//Content Negotiation condition
Route::post('/accept-content-type-condition', [DemoController::class, 'acceptableContentTypeCondition']);

//Cookie
Route::post('/cookie', [DemoController::class, 'cookie']);
//======================/Request======================//
//||||||||||||||||||||||||||||||||||||||||||||||||||||//
//======================/Request======================//
Route::get('/simple-response', [DemoController::class, 'simpleResponse']);
Route::post('/simple-response', [DemoController::class, 'simpleResponsePost']);

//redairect response
Route::get('/redirect1', [DemoController::class, 'redirect1']);
Route::get('/redirect2', [DemoController::class, 'redirect2']);

//file binary and file download response
Route::get('/file-binary', [DemoController::class, 'fileBinary']);
Route::get('/file-download', [DemoController::class, 'fileDownload']);

//cookie create
Route::get('/cookie-crate', [DemoController::class, 'cookies']);

//Header set
Route::get('/header-set', [DemoController::class, 'header']);
//======================/Response======================//
//||||||||||||||||||||||||||||||||||||||||||||||||||||//
//=================Hasin Sir Live class==============//
Route::get('/peramiter-accept-name-only/{name?}', [DemoController::class, 'peramiterNameAccept'])->whereAlpha('name');
Route::get('/peramiter-accept-number-only/{id?}', [DemoController::class, 'peramiterNumberAccept'])->whereNumber('id');
// qurey string peramiter pass
Route::get('/peramiter-qurey-string-specific-peramiter/{name?}', [DemoController::class, 'peramiterQureyStringSpacificPeramiter']);
Route::get('/peramiter-qurey-string-all-peramiter/{name?}', [DemoController::class, 'peramiterQureyStringAllPeramiter']);

//person
Route::get('/person', [DemoController::class, 'personPage']);
Route::post('/person', [DemoController::class, 'personStore'])->name('person');
//======================hasin vai Live class======================//
//||||||||||||||||||||||||||||||||||||||||||||||||||||//
//=================Rabbil Sir Live class==============//
Route::get('/string-int-null-boolen-response', [DemoController::class, 'strngIntNullBoolenResponse']);
Route::get('/array-associative-array-response', [DemoController::class, 'arrayAssociativeArrayResponse']);
Route::get('/json-respons', [DemoController::class, 'jsonRespons']);
Route::get('/response-with-data-msg-code', [DemoController::class, 'responseWithDataMsgCode']);
Route::get('/response-redirect', [DemoController::class, 'responseRedirect']);
Route::get('/binary-file-response', [DemoController::class, 'binaryFileResponse']);
Route::get('/file-download', [DemoController::class, 'fileDownloadManage']);
Route::get('/respnse-cookies', [DemoController::class, 'respnseCookies']);
Route::get('/response-with-header-properties', [DemoController::class, 'responseWithHeaderProperties']);
Route::get('/response-blade-view', [DemoController::class, 'responseBladeView']);

