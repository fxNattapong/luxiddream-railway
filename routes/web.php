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

Route::get('/', "WebpagesController@HomePage")->Name('HomePage')->https();
Route::get('/about', "WebpagesController@AboutPage")->Name('AboutPage')->https();
Route::get('/account', "WebpagesController@AccountPage")->Name('AccountPage')->https();
Route::get('/login', "WebpagesController@LoginPage")->Name('LoginPage')->https();
Route::get('/register', "WebpagesController@RegisterPage")->Name('RegisterPage')->https();
Route::get('/rule', "WebpagesController@RulePage")->Name('RulePage')->https();

Route::prefix('admin')->group(function () {
    Route::get('/', "AdminController@IndexRedirect")->Name('IndexRedirect')->https();

    Route::post('/fetch/account', "AdminController@FetchAccountData")->Name('FetchAccountData')->https();
    Route::post('/account/edit', "AdminController@SubmitAccountEdit")->Name('SubmitAccountEdit')->https();

    Route::get('/players', "AdminController@Players")->Name('Players')->https();
    Route::post('/player/add', "AdminController@SubmitPlayerAdd")->Name('SubmitPlayerAdd')->https();
    Route::post('/player/edit', "AdminController@SubmitPlayerEdit")->Name('SubmitPlayerEdit')->https();
    Route::post('/player/delete', "AdminController@SubmitPlayerDelete")->Name('SubmitPlayerDelete')->https();
    
    Route::get('/players/rule', "AdminController@PlayersRule")->Name('PlayersRule')->https();
    Route::post('/player/rule/add', "AdminController@SubmitPlayerRuleAdd")->Name('SubmitPlayerRuleAdd')->https();
    Route::post('/player/rule/edit', "AdminController@SubmitPlayerRuleEdit")->Name('SubmitPlayerRuleEdit')->https();
    Route::post('/player/rule/delete', "AdminController@SubmitPlayerRuleDelete")->Name('SubmitPlayerRuleDelete')->https();

    Route::get('/levels', "AdminController@Levels")->Name('Levels')->https();
    Route::post('/level/add', "AdminController@SubmitLevelAdd")->Name('SubmitLevelAdd')->https();
    Route::post('/level/edit', "AdminController@SubmitLevelEdit")->Name('SubmitLevelEdit')->https();
    Route::post('/level/delete', "AdminController@SubmitLevelDelete")->Name('SubmitLevelDelete')->https();

    Route::get('/nightmares', "AdminController@Nightmares")->Name('Nightmares')->https();
    Route::post('/nightmare/add', "AdminController@SubmitNightmareAdd")->Name('SubmitNightmareAdd')->https();
    Route::post('/nightmare/edit', "AdminController@SubmitNightmareEdit")->Name('SubmitNightmareEdit')->https();
    Route::post('/nightmare/delete', "AdminController@SubmitNightmareDelete")->Name('SubmitNightmareDelete')->https();

    Route::get('/links', "AdminController@Links")->Name('Links')->https();
    Route::post('/link/add', "AdminController@SubmitLinkAdd")->Name('SubmitLinkAdd')->https();
    Route::post('/link/edit', "AdminController@SubmitLinkEdit")->Name('SubmitLinkEdit')->https();
    Route::post('/link/delete', "AdminController@SubmitLinkDelete")->Name('SubmitLinkDelete')->https();

    Route::get('/cards', "AdminController@Cards")->Name('Cards')->https();
    Route::post('/card/add', "AdminController@SubmitCardAdd")->Name('SubmitCardAdd')->https();
    Route::post('/card/edit', "AdminController@SubmitCardEdit")->Name('SubmitCardEdit')->https();
    Route::post('/card/delete', "AdminController@SubmitCardDelete")->Name('SubmitCardDelete')->https();
});

Route::prefix('game')->group(function () {
    Route::get('/', "GameController@Home")->Name('Home')->https();
    Route::post('/register/process', "GameController@RegisterProcess")->Name('RegisterProcess')->https();
    Route::post('/login/process', "GameController@LoginProcess")->Name('LoginProcess')->https();
    Route::get('/logout', "GameController@Logout")->Name('Logout')->https();
    
    Route::prefix('room')->group(function () {
        Route::post('/create', "GameController@RoomCreate")->Name('RoomCreate')->https();
        Route::post('/join', "GameController@RoomJoin")->Name('RoomJoin')->https();
    
        Route::get('/waiting', "GameController@RoomWaiting")->Name('RoomWaiting')->middleware('redirectIfAuth')->https();
        Route::post('/leave/wating', "GameController@LeaveRoomWating")->Name('LeaveRoomWating')->https();
        Route::post('/player/remove', "GameController@PlayerRemove")->Name('PlayerRemove')->https();
        Route::post('/delete', "GameController@RoomDelete")->Name('RoomDelete')->https();
        Route::post('/poll/players', "GameController@pollPlayers")->Name('pollPlayers')->https();
    
        Route::post('/change/status', "GameController@ChangeStatus")->Name('ChangeStatus')->https();

        Route::post('/disconnect', "GameController@RoomDisconnect")->Name('RoomDisconnect')->https();
    
        Route::post('/start', "GameController@StartGame")->Name('StartGame')->https();
        Route::get('/start', "GameController@RoomPlay")->Name('RoomPlay')->middleware('redirectIfAuth')->https();
    
        Route::post('/leave/playing', "GameController@LeaveRoom")->Name('LeaveRoom')->https();
        Route::post('/start/timer', "GameController@StartTimer")->Name('StartTimer')->https();
        Route::post('/end/timer', "GameController@EndTimer")->Name('EndTimer')->https();
        Route::post('/poll/links', "GameController@PollLinks")->Name('PollLinks')->https();
        Route::post('/fetch/timeout', "GameController@FetchTimeout")->Name('FetchTimeout')->https();
        Route::post('/fetch/cards', "GameController@FetchCards")->Name('FetchCards')->https();
        Route::post('/fetch/results', "GameController@FetchResults")->Name('FetchResults')->https();
        Route::post('/round/card/add', "GameController@CardAdd")->Name('CardAdd')->https();
        Route::post('/check/nightmare/link', "GameController@CheckNightmareLink")->Name('CheckNightmareLink')->https();
        Route::post('/start/next/round', "GameController@StartNextRound")->Name('StartNextRound')->https();
        Route::post('/start/next/circle', "GameController@StartNextCircle")->Name('StartNextCircle')->https();
        Route::post('/end', "GameController@GameEnd")->Name('GameEnd')->https();
        Route::post('/update/stats', "GameController@UpdateStats")->Name('UpdateStats')->https();
    });
    
});