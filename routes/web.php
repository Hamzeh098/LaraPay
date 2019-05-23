<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],
    function () {
        // admin controller
        Route::get('/', 'dashboardController@index')->name('dashboard.index');
        Route::get('/statistics', 'dashboardController@statistics')
             ->name('dashboard.statistics');
        
        /*User*/
        Route::group([
            'prefix' => 'user', 'namespace' => 'User', 'as' => 'user.',
        ], function () {
            Route::get('/', 'UsersController@index')->name('index');
            Route::get('/add', 'UsersController@create')->name('create');
            Route::post('/add/store', 'UsersController@store')->name('store');
            Route::get('/edit', 'UsersController@delete')->name('delete');
            Route::post('/update', 'UsersCotroller@update')->name('update');
            Route::get('/search', 'UsersController@search')->name('search');
        });
        
        /*UserAccount*/
        Route::group([
            'prefix' => 'accounts', 'namespace' => 'User', 'as' => 'user.',
        ], function () {
            Route::get('/', 'UserAccountController@index')
                 ->name('accounts.index');
            Route::get('/add', 'UserAccountController@create')
                 ->name('accounts.create');
            Route::post('/store', 'UserAccountController@store')
                 ->name('account.store');
            Route::get('/delete/{id}', 'UserAccountController@delete')
                 ->name('account.delete');
            Route::get('/edit/{id}', 'UserAccountController@edit')
                 ->name('account.edit');
            Route::post('/edit/{id}', 'UserAccountController@update')
                 ->name('account.update');
            Route::get('/search', 'UserAccountController@search')
                 ->name('account.search');
            
        });
        
        /*Gateways*/
        Route::group([
            'prefix' => 'gateways', 'namespace' => 'Gateway', 'as' => 'gateway.',
        ], function () {
            Route::get('/', 'GatewayController@index')->name('index');
            Route::get('/add', 'GatewayController@create')->name('create');
            Route::post('/add', 'GatewayController@store')->name('store');
            Route::get('/edit/{id}', 'GatewayController@edit')->name('edit');
            Route::post('/edit/{id}', 'GatewayController@update')
                 ->name('update');
            Route::get('/delete/{id}', 'GatewayController@delete')
                 ->name('delete');
            Route::get('/search', 'GatewayController@search')->name('search');
            Route::get('/report', 'GatewayReportController@index')
                 ->name('report.index');
            
            
            Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {
                Route::get('/', 'GatewayPlanController@index')->name('index');
                Route::get('/add', 'GatewayPlanController@create')
                     ->name('create');
                Route::post('/add', 'GatewayPlanController@store')
                     ->name('store');
                Route::get('/', 'GatewayPlanController@index')->name('index');
                
            });
        });
        
        /*Withdrawal*/
        Route::group([
            'prefix' => 'withdrawal', 'namespace' => 'Withdrawal',
            'as'     => 'withdrawal.',
        ], function () {
            Route::get('/', 'WithdrawalController@index')->name('index');
            Route::get('/add', 'WithdrawalController@create')->name('create');
            Route::post('/add', 'WithdrawalController@store')->name('store');
            Route::get('/approve/{id}', 'WithdrawalController@approve')
                 ->name('approve');
            Route::post('/approve/{id}', 'WithdrawalController@performApprove')
                 ->name('approve.save');
            Route::get('/reject/{id}', 'WithdrawalController@reject')
                 ->name('reject');
            
            
        });
        
        
    });

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('pay/start','PaymentsController@start')->name('payment.start');
    Route::post('pay/verify/{payment_code}','PaymentsController@verify')->name('payment.verify');
});