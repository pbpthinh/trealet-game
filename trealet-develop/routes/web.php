<?php

/**
 * Authentication
 */
Route::get('login', 'Auth\LoginController@show');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['registration', 'guest']], function () {
    Route::get('register', 'Auth\RegisterController@show');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::emailVerification();

Route::group(['middleware' => ['password-reset', 'guest']], function () {
    Route::resetPassword();
});

/**
 * Two-Factor Authentication
 */
Route::group(['middleware' => 'two-factor'], function () {
    Route::get('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@show')->name('auth.token');
    Route::post('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@update')->name('auth.token.validate');
});

/**
 * Social Login
 */
Route::get('auth/{provider}/login', 'Auth\SocialAuthController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

/**
 * Trealets
 */
Route::get('trealet-plays', 'TrealetPlaysController@index')->name('trealet-plays');
Route::get('trealet-play-details', 'TrealetPlayDetails@index')->name('trealet-play-details');
Route::post('trealet-play-details/score', 'TrealetPlayDetails@score')->name('trealet-play-details-score');
Route::get('my-trealets', 'MyTrealets@index')->name('my-trealets');
Route::get('trealets-search', 'TrealetsSearch@index')->name('trealets-search');
Route::get('/', 'TrealetsSearch@index')->name('trealets-search-index');
Route::get('streamline', 'StreamlineController@index')->name('streamline');
Route::get('streamline-edit', 'StreamlineEditController@index')->name('streamline-edit');
Route::delete('delete/{id}', 'MyTrealets@destroy_trealet')->name('destroy_trealet');
Route::get('duplicate/{id}', 'MyTrealets@duplicate_trealet')->name('duplicate_trealet');
Route::get('publish/{id}', 'MyTrealets@publish_trealet')->name('publish_trealet');
Route::get('play/{id}', 'TrealetPlaysController@play_a_trealet')->name('play_trealet');
Route::post('api/trealet/{id}', 'apiQrController@play_a_trealet')->name('getApi');
Route::get('qr/{id}', 'apiQrController@qr')->name('qr');
Route::get('show_edit_trealet/{id}', 'EditTrealetController@index')->name('edit_trealet');
Route::post('edit_old_trealet', 'EditTrealetController@edit_trealet')->name('edit_old_trealet');
Route::post('edit_trealet/{id}', 'EditTrealetController@update')->name('edit_trealet_to_controller');
Route::post('check_pass_tr/{id}', 'TrealetsSearch@check_key')->name('check_key_trealet_to_controller');

Route::get('input-audio',           'InputController@audio')->name('input-audio');
Route::post('input-audio/upload',   'InputController@audio_upload')->name('input-audio-upload');
Route::get('input-picture',         'InputController@picture')->name('input-picture');
Route::post('input-picture/upload', 'InputController@picture_upload')->name('input-picture-upload');
Route::get('input-form',             'InputController@form')->name('input-form');
Route::post('input-form/upload',     'InputController@form_upload')->name('input-form-upload');
Route::get('input-qr',                 'InputController@qr')->name('input-qr');
Route::post('input-qr/upload',        'InputController@qr_upload')->name('input-qr-upload');
Route::get('input-quiz',             'InputController@quiz')->name('input-quiz');
Route::post('input-quiz/upload',    'InputController@quiz_upload')->name('input-quiz-upload');


Route::post('upload_new_trealet', 'EditTrealetController@upload_new_trealet')->name('upload_new_trealet');
Route::post('upload_video', 'UploadController@video_upload')->name('video_upload');
Route::post('upload_image',    'UploadController@image_upload')->name('image-upload');
Route::post('upload_audio', 'UploadController@audio_upload')->name('audio-upload');
/**
 *StepQuest
 */
Route::get('stepquest/{path?}', [
    'uses' => 'StepQuestController@index',
    // 'as' => 'react',
    'where' => ['path' => '.*']
])->name('stepquest');

Route::get('stepquest-edit', 'StepquestEditController@index')->name('stepquest-edit');
Route::get('stepquest-edit/{id}/edit', 'StepquestEditController@edit')->name('stepquest-edit.edit');
Route::post('stepquest-edit/{id}/update', 'StepquestEditController@update')->name('stepquest-edit.update');
Route::get('stepquest-edit/tree-folder', 'StepquestEditController@treeFolder')->name('stepquest-edit.tree-folder');
Route::get('stepquest-edit/ungdung', 'StepquestEditController@ungdung')->name('stepquest-edit.ungdung');
Route::get('stepquest-edit/image', 'StepquestEditController@image')->name('stepquest-edit.image');
Route::post('stepquest-edit/upload', 'StepquestEditController@upload')->name('stepquest-edit.upload');
/**
 *qr question
 */
Route::get('qr-question-edit', 'qrQuestionEditController@index')->name('qr-question-edit');
Route::post('qr-question-edit/upload', 'qrQuestionEditController@upload')->name('qr-question-edit.upload');

/**
 *QR Media
 */
Route::get('qrMedia/{path?}', [
    'uses' => 'QRMediaEditController@index',
    // 'as' => 'react',
    'where' => ['path' => '.*']
])->name('qrMedia');
Route::get('qrMedia-edit', 'QRMediaEditController@index')->name('qrMedia-edit');
Route::get('qrMedia-edit/{id}/edit', 'QRMediaEditController@edit')->name('qrMedia-edit.edit');
Route::post('qrMedia-edit/{id}/update', 'QRMediaEditController@update')->name('qrMedia-edit.update');
Route::get('qrMedia-edit/tree-folder', 'QRMediaEditController@treeFolder')->name('qrMedia-edit.tree-folder');
Route::get('qrMedia-edit/ungdung', 'QRMediaEditController@ungdung')->name('qrMedia-edit.ungdung');
Route::get('qrMedia-edit/image', 'QRMediaEditController@image')->name('qrMedia-edit.image');
Route::post('qrMedia-edit/upload', 'QRMediaEditController@upload')->name('qrMedia-edit.upload');
/**
 * Maps
 */

Route::get('maps', 'MapsController@index')->name('maps');
Route::get('maps-trealet', 'MapsController@maps_trealet')->name('maps-trealet');
//map_crud
Route::get('map-edit', 'MapEditController@index')->name('get-map-edit');
Route::post('map-edit', 'MapEditController@storeMap')->name('store-map-edit');
Route::get('map-edit/{id}', 'MapEditController@getMap')->name('getMapEditById');

/**
 * Manage_member_group
 */
Route::get('manage_member/{id}', 'ManageMemberController@index')->name('manage_member');
Route::delete('delete_member/{member_id}/{trealet_id}', 'ManageMemberController@delete_member')->name('delete_member');
Route::post('update_role/{member_id}/{trealet_id}', 'ManageMemberController@update_role')->name('update_role');
Route::get('invite/{trealet_id}', 'InviteCreatorController@invite')->name('invite');
Route::post('invite_creator/{trealet_id}', 'InviteCreatorController@process')->name('process');
Route::get('accept/{token}', 'InviteCreatorController@accept')->name('accept');
/**
 * Search
 */

Route::get('/autocomplete-search', 'CommonController@autocompleteSearch');

/**
 * Impersonate Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::impersonate();
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    /**
     * Dashboard
     */
    //Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    /**
     * User Profile
     */

    Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile');
        Route::get('activity', 'ActivityController@show')->name('profile.activity');
        Route::put('details', 'DetailsController@update')->name('profile.update.details');

        Route::post('avatar', 'AvatarController@update')->name('profile.update.avatar');
        Route::post('avatar/external', 'AvatarController@updateExternal')
            ->name('profile.update.avatar-external');

        Route::put('login-details', 'LoginDetailsController@update')
            ->name('profile.update.login-details');

        Route::get('sessions', 'SessionsController@index')
            ->name('profile.sessions')
            ->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'SessionsController@destroy')
            ->name('profile.sessions.invalidate')
            ->middleware('session.database');
    });

    /**
     * Two-Factor Authentication Setup
     */

    Route::group(['middleware' => 'two-factor'], function () {
        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('two-factor.enable');

        Route::get('two-factor/verification', 'TwoFactorController@verification')
            ->name('two-factor.verification')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/resend', 'TwoFactorController@resend')
            ->name('two-factor.resend')
            ->middleware('throttle:1,1', 'verify-2fa-phone');

        Route::post('two-factor/verify', 'TwoFactorController@verify')
            ->name('two-factor.verify')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('two-factor.disable');
    });



    /**
     * User Management
     */
    Route::resource('users', 'Users\UsersController')
        ->except('update')->middleware('permission:users.manage');

    Route::group(['prefix' => 'users/{user}', 'middleware' => 'permission:users.manage'], function () {
        Route::put('update/details', 'Users\DetailsController@update')->name('users.update.details');
        Route::put('update/login-details', 'Users\LoginDetailsController@update')
            ->name('users.update.login-details');

        Route::post('update/avatar', 'Users\AvatarController@update')->name('user.update.avatar');
        Route::post('update/avatar/external', 'Users\AvatarController@updateExternal')
            ->name('user.update.avatar.external');

        Route::get('sessions', 'Users\SessionsController@index')
            ->name('user.sessions')->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'Users\SessionsController@destroy')
            ->name('user.sessions.invalidate')->middleware('session.database');

        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('user.two-factor.enable');
        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('user.two-factor.disable');
    });

    /**
     * Roles & Permissions
     */
    Route::group(['namespace' => 'Authorization'], function () {
        Route::resource('roles', 'RolesController')->except('show')->middleware('permission:roles.manage');

        Route::post('permissions/save', 'RolePermissionsController@update')
            ->name('permissions.save')
            ->middleware('permission:permissions.manage');

        Route::resource('permissions', 'PermissionsController')->middleware('permission:permissions.manage');
    });


    /**
     * Settings
     */

    Route::get('settings', 'SettingsController@general')->name('settings.general')
        ->middleware('permission:settings.general');

    Route::post('settings/general', 'SettingsController@update')->name('settings.general.update')
        ->middleware('permission:settings.general');

    Route::get('settings/auth', 'SettingsController@auth')->name('settings.auth')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth', 'SettingsController@update')->name('settings.auth.update')
        ->middleware('permission:settings.auth');

    if (config('services.authy.key')) {
        Route::post('settings/auth/2fa/enable', 'SettingsController@enableTwoFactor')
            ->name('settings.auth.2fa.enable')
            ->middleware('permission:settings.auth');

        Route::post('settings/auth/2fa/disable', 'SettingsController@disableTwoFactor')
            ->name('settings.auth.2fa.disable')
            ->middleware('permission:settings.auth');
    }

    Route::post('settings/auth/registration/captcha/enable', 'SettingsController@enableCaptcha')
        ->name('settings.registration.captcha.enable')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth/registration/captcha/disable', 'SettingsController@disableCaptcha')
        ->name('settings.registration.captcha.disable')
        ->middleware('permission:settings.auth');

    Route::get('settings/notifications', 'SettingsController@notifications')
        ->name('settings.notifications')
        ->middleware('permission:settings.notifications');

    Route::post('settings/notifications', 'SettingsController@update')
        ->name('settings.notifications.update')
        ->middleware('permission:settings.notifications');

    /**
     * Activity Log
     */

    Route::get('activity', 'ActivityController@index')->name('activity.index')
        ->middleware('permission:users.activity');

    Route::get('activity/user/{user}/log', 'Users\ActivityController@index')->name('activity.user')
        ->middleware('permission:users.activity');
});


/**
 * Installation
 */

Route::group(['prefix' => 'install'], function () {
    Route::get('/', 'InstallController@index')->name('install.start');
    Route::get('requirements', 'InstallController@requirements')->name('install.requirements');
    Route::get('permissions', 'InstallController@permissions')->name('install.permissions');
    Route::get('database', 'InstallController@databaseInfo')->name('install.database');
    Route::get('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('install-app', 'InstallController@install')->name('install.install');
    Route::get('complete', 'InstallController@complete')->name('install.complete');
    Route::get('error', 'InstallController@error')->name('install.error');
});




Route::prefix('/v2')->group(function () {
    Route::get('/streamline', 'StreamlineApiController@index')->name('indexStreamline');
    Route::get('/streamline/user', 'StreamlineApiController@getByUserId')->name('getStreamlineByUser');
    Route::get('/streamline/detail', 'StreamlineApiController@getByTrealetId')->name('getStreamlineById');

    Route::get('/stepquest', 'StepquestApiController@index')->name('indexStepquest');
    Route::get('/stepquest/user', 'StepquestApiController@getByUserId')->name('getStepquestByUser');
    Route::get('/stepquest/detail', 'StepquestApiController@getByTrealetId')->name('getStepquestById');

    Route::get('/qrmedia', 'QrMediaApiController@index')->name('indexQRMedia');
    Route::get('/qrmedia/user', 'QrMediaApiController@getByUserId')->name('getQRMediaByUser');
    Route::get('/qrmedia/detail', 'QrMediaApiController@getByTrealetId')->name('getQRMediaById');

    Route::get('/qrmedia/getMedia', 'QrMediaApiController@getMediaById')->name('getQRMediaById');


    Route::post('/input/play/data', 'InputDataApiController@uploadData')->name('postPlayData');
    Route::post('/registerUser', 'UserApiController@registerUser')->name('createUser');
    Route::post('/uploadImage', 'UploadController@image_upload_api')->name('uploadImg');
    Route::post('/uploadVideo', 'UploadController@video_upload_api')->name('uploadVid');
    Route::post('/uploadAudio', 'UploadController@audio_upload_api')->name('uploadAud');
});

Route::prefix('/map-player')->group(function () {
    Route::get('/maps', 'MapPlayerApiController@maps');
    Route::post('/login', 'MapPlayerApiController@login');
    Route::post('/map-detail', 'MapPlayerApiController@mapDetail');
    Route::post('/register', 'MapPlayerApiController@register');
    Route::post('/upload', 'MapPlayerApiController@upload');
    Route::post('/save-input', 'MapPlayerApiController@saveInput');
    Route::post('/get-input', 'MapPlayerApiController@getInput');
    Route::post('/social-login', 'MapPlayerApiController@socialLogin');
});
