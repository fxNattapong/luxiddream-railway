<?php

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

Route::get('/', "WebpagesController@HomePage")->Name('HomePage');
Route::get('/about', "WebpagesController@AboutPage")->Name('AboutPage');
Route::get('/account', "WebpagesController@AccountPage")->Name('AccountPage');
Route::get('/login', "WebpagesController@LoginPage")->Name('LoginPage');
Route::get('/register', "WebpagesController@RegisterPage")->Name('RegisterPage');
Route::get('/rule', "WebpagesController@RulePage")->Name('RulePage');

Route::prefix('admin')->group(function () {
    Route::get('/', "AdminController@IndexRedirect")->Name('IndexRedirect');

    Route::post('/fetch/account', "AdminController@FetchAccountData")->Name('FetchAccountData');
    Route::post('/account/edit', "AdminController@SubmitAccountEdit")->Name('SubmitAccountEdit');

    Route::get('/players', "AdminController@Players")->Name('Players');
    Route::post('/player/add', "AdminController@SubmitPlayerAdd")->Name('SubmitPlayerAdd');
    Route::post('/player/edit', "AdminController@SubmitPlayerEdit")->Name('SubmitPlayerEdit');
    Route::post('/player/delete', "AdminController@SubmitPlayerDelete")->Name('SubmitPlayerDelete');
    
    Route::get('/players/rule', "AdminController@PlayersRule")->Name('PlayersRule');
    Route::post('/player/rule/add', "AdminController@SubmitPlayerRuleAdd")->Name('SubmitPlayerRuleAdd');
    Route::post('/player/rule/edit', "AdminController@SubmitPlayerRuleEdit")->Name('SubmitPlayerRuleEdit');
    Route::post('/player/rule/delete', "AdminController@SubmitPlayerRuleDelete")->Name('SubmitPlayerRuleDelete');

    Route::get('/levels', "AdminController@Levels")->Name('Levels');
    Route::post('/level/add', "AdminController@SubmitLevelAdd")->Name('SubmitLevelAdd');
    Route::post('/level/edit', "AdminController@SubmitLevelEdit")->Name('SubmitLevelEdit');
    Route::post('/level/delete', "AdminController@SubmitLevelDelete")->Name('SubmitLevelDelete');

    Route::get('/nightmares', "AdminController@Nightmares")->Name('Nightmares');
    Route::post('/nightmare/add', "AdminController@SubmitNightmareAdd")->Name('SubmitNightmareAdd');
    Route::post('/nightmare/edit', "AdminController@SubmitNightmareEdit")->Name('SubmitNightmareEdit');
    Route::post('/nightmare/delete', "AdminController@SubmitNightmareDelete")->Name('SubmitNightmareDelete');

    Route::get('/links', "AdminController@Links")->Name('Links');
    Route::post('/link/add', "AdminController@SubmitLinkAdd")->Name('SubmitLinkAdd');
    Route::post('/link/edit', "AdminController@SubmitLinkEdit")->Name('SubmitLinkEdit');
    Route::post('/link/delete', "AdminController@SubmitLinkDelete")->Name('SubmitLinkDelete');

    Route::get('/cards', "AdminController@Cards")->Name('Cards');
    Route::post('/card/add', "AdminController@SubmitCardAdd")->Name('SubmitCardAdd');
    Route::post('/card/edit', "AdminController@SubmitCardEdit")->Name('SubmitCardEdit');
    Route::post('/card/delete', "AdminController@SubmitCardDelete")->Name('SubmitCardDelete');
});

Route::prefix('game')->group(function () {
    Route::get('/', "GameController@Home")->Name('Home');
    Route::post('/register/process', "GameController@RegisterProcess")->Name('RegisterProcess');
    Route::post('/login/process', "GameController@LoginProcess")->Name('LoginProcess');
    Route::get('/logout', "GameController@Logout")->Name('Logout');
    
    Route::prefix('room')->group(function () {
        Route::post('/create', "GameController@RoomCreate")->Name('RoomCreate');
        Route::post('/join', "GameController@RoomJoin")->Name('RoomJoin');
    
        Route::get('/waiting', "GameController@RoomWaiting")->Name('RoomWaiting')->middleware('redirectIfAuth');
        Route::post('/leave/wating', "GameController@LeaveRoomWating")->Name('LeaveRoomWating');
        Route::post('/player/remove', "GameController@PlayerRemove")->Name('PlayerRemove');
        Route::post('/delete', "GameController@RoomDelete")->Name('RoomDelete');
        Route::post('/poll/players', "GameController@pollPlayers")->Name('pollPlayers');
    
        Route::post('/change/status', "GameController@ChangeStatus")->Name('ChangeStatus');

        Route::post('/disconnect', "GameController@RoomDisconnect")->Name('RoomDisconnect');
    
        Route::post('/start', "GameController@StartGame")->Name('StartGame');
        Route::get('/start', "GameController@RoomPlay")->Name('RoomPlay')->middleware('redirectIfAuth');
    
        Route::post('/leave/playing', "GameController@LeaveRoom")->Name('LeaveRoom');
        Route::post('/start/timer', "GameController@StartTimer")->Name('StartTimer');
        Route::post('/end/timer', "GameController@EndTimer")->Name('EndTimer');
        Route::post('/poll/links', "GameController@PollLinks")->Name('PollLinks');
        Route::post('/fetch/timeout', "GameController@FetchTimeout")->Name('FetchTimeout');
        Route::post('/fetch/cards', "GameController@FetchCards")->Name('FetchCards');
        Route::post('/fetch/results', "GameController@FetchResults")->Name('FetchResults');
        Route::post('/round/card/add', "GameController@CardAdd")->Name('CardAdd');
        Route::post('/check/nightmare/link', "GameController@CheckNightmareLink")->Name('CheckNightmareLink');
        Route::post('/start/next/round', "GameController@StartNextRound")->Name('StartNextRound');
        Route::post('/start/next/circle', "GameController@StartNextCircle")->Name('StartNextCircle');
        Route::post('/end', "GameController@GameEnd")->Name('GameEnd');
        Route::post('/update/stats', "GameController@UpdateStats")->Name('UpdateStats');
    });
    
});