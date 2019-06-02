<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/2
 * Time: 10:49 AM
 */
Route::middleware(['api'])->group(function () {
    Route::post('/sms', 'Myth\Controllers\SmsController@send');
});
