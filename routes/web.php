<?php

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

Route::get('/', function() {
    return view('site');
});
//Auth::routes();

Route::group(['prefix' => 'admin'], function($r) {
#->DASHBOARD
$r->get('/login', 'LoginController@index')->name('login');
$r->post('/login/authenticate', 'LoginController@authenticate')->name('login_authenticate');
$r->get('/', 'HomeController@index')->name('home');

#->GERENCIAMENTO DE CONTATOS
$r->get('/contacts', 'ContactsController@index')->name('contacts');
$r->get('/contacts/create', 'ContactsController@viewStore')->name('contacts_create');
$r->post('/contacts/store', 'ContactsController@store')->name('contact_store');
$r->get('/contacts/view', 'ContactsController@view')->name('contact_view');
$r->get('/contacts/update/view', 'ContactsController@viewUpdate')->name('contact_view_update');
$r->post('/contacts/update', 'ContactsController@update')->name('contact_update');
$r->get('/contacts/delete', 'ContactsController@delete')->name('contact_delete');

#->GERENCIAR HISTÓRICO
$r->get('/contacts/history', 'ContactHistoryController@viewHistory')->name('history');

#->GERENCIAMENTO DE CORRETORES
$r->get('/brokers', 'BrokersController@index')->name('brokers');
$r->get('/brokers/create', 'BrokersController@viewStore')->name('brokers_create');
$r->post('/brokers/store', 'BrokersController@store')->name('broker_store');
$r->get('/brokers/update/view', 'BrokersController@viewUpdate')->name('broker_view_update');
$r->post('/brokers/update/password', 'BrokersController@passwordUpdate')->name('broker_password_update');
$r->post('/brokers/update', 'BrokersController@update')->name('broker_update');
$r->get('/brokers/delete', 'BrokersController@delete')->name('broker_delete');


#->GERENCIAMENTO DE IMÓVEIS
$r->get('/imoveis', 'PropertyController@index')->name('properties');
$r->get('/imoveis/create', 'PropertyController@viewStore')->name('properties_create');
$r->post('/imoveis/store', 'PropertyController@store')->name('properties_store');
$r->get('/imoveis/view', 'PropertyController@view')->name('properties_view');
$r->get('/imoveis/edit', 'PropertyController@viewUpdate')->name('properties_edit');
$r->post('/imoveis/update', 'PropertyController@update')->name('properties_update');
$r->get('/imoveis/status', 'PropertyController@status')->name('properties_status');

#->LOGOUT
$r->get('/logout', 'HomeController@userLogout')->name('logout');

#->GERENCIAMENTO DE USU�RIOS
$r->get('/user/create', 'UserController@viewRegister')->name('user_create');
$r->get('/user/store', 'UserController@register')->name('register_store');
$r->get('/user/update/view', 'UserController@viewUpdate')->name('user_view_update');
$r->post('/user/update/password', 'UserController@passwordUpdate')->name('user_password_update');
$r->post('/user/update', 'UserController@update')->name('user_update');

#->DELETAR IMAGEM
$r->get('image/delete', 'ImageController@delete')->name('delete_image');


#->RECUPERAR SENHA
$r->get('/recovery/view', 'EmailController@index')->name('recovery_view');
$r->post('/recovery/recover', 'EmailController@sendEmail')->name('recovery_password');

#->PLANOS
$r->get('/plans', 'PlanController@index')->name('plans');
$r->get('/plans/store', 'PlanController@store')->name('plan_store');

#->PayPal
$r->post('/buy','PayPalController@Payment')->name('buy');
$r->get('/buy/success','PayPalController@success')->name('buy_success');
$r->get('/buy/error','PayPalController@error')->name('buy_error');

#-> API
$r->get('/document', function(){ return view('api'); })->name('document');
});
