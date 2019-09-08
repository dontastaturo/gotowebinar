<?php

Route::get('account', function () {
    $from = Carbon\Carbon::now()->subYears(50)->startOfDay();
    $to = Carbon\Carbon::now()->addYears(50)->endOfDay();

    try {
        return Webinars::byAccountKey()
                       ->fromTime($from)
                       ->toTime($to)
                       ->page(0)
                       ->size(5)
                       ->get();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars', function () {
    $from = Carbon\Carbon::now()->subYear()->startOfDay();
    $to = Carbon\Carbon::tomorrow()->endOfDay();

    try {
        return Webinars::fromTime($from)
                       ->toTime($to)
                       ->page(0)
                       ->size(5)
                       ->get();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/{webinarKey}/show', function ($webinarKey) {
    try {
        return Webinars::webinarKey($webinarKey)
                       ->get();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/create', function () {
    try {
        return Webinars::subject('XXXXX CREATED BY OBJECT XXXXX*')
                       ->description('OBJECT Description*')
                       ->timeFromTo(Carbon\Carbon::now()->addDays(2), Carbon\Carbon::now()->addDays(2)->addHours(2))
                       ->timeZone('Europe/Amsterdam')
                       ->singleSession()
                       ->noEmailReminder()
                       ->noEmailAttendeeFollowUp()
                       ->noEmailAbsenteeFollowUp()
                       ->noEmailConfirmation()
                       ->create();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/createByArray', function () {

    //todo still work to do on creating by array ie DateTimes and test if the validation is working on create

    try {
        return Webinars::noEmailReminder()
                       ->timeFromTo(Carbon\Carbon::now()->addDays(2), Carbon\Carbon::now()->addDays(2)->addHours(2))
                       ->create([
                                    'subject' => 'XXXXX CREATED BY ARRAY XXXXX*',
                                    'description' => 'Test Description*',
                                    'timeZone' => 'Europe/Amsterdam',
                                    'type' => 'single_session', //single_session
                                    'isPasswordProtected' => false, //default is false
                                ]);
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/{webinarKey}/update', function ($webinarKey) {
    try {
        return Webinars::webinarKey($webinarKey)
                       ->subject('XXXXX UPDATED OBJECT XXXXX*')
                       ->description('UPDATED Description*')
                       ->timeFromTo(Carbon\Carbon::now()->addDays(2)->midDay(), Carbon\Carbon::now()->addDays(2)->midDay()->addHours(2))
                       ->update();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/{webinarKey}/updateByArray', function ($webinarKey) {

    //todo still work to do on creating by array ie DateTimes and test if the validation is working on update

    try {
        return Webinars::webinarKey($webinarKey)
                       ->timeFromTo(Carbon\Carbon::now()->addDays(2), Carbon\Carbon::now()->addDays(2)->addHours(2))
                       ->update([
                                    'subject' => 'XXXXX UPDATED BY ARRAY XXXXX*',
                                    'description' => 'UPDATED BY ARRAY Description*',
                                    'timeZone' => 'Europe/Amsterdam',
                                    'isPasswordProtected' => false, //default is false
                                ]);
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});

Route::get('webinars/{webinarKey}/delete', function ($webinarKey) {
    try {
        return Webinars::webinarKey($webinarKey)
                       ->sendCancellationEmails()
                       ->delete();
    } catch (Slakbal\Gotowebinar\Exception\GotoException $e) {
        return [$e->getMessage()];
    }
});
