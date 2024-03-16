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

Route::get('/', "WebpagesController@HomePage")->Name('HomePage')->secure();
Route::get('/about', "WebpagesController@AboutPage")->Name('AboutPage')->secure();
Route::get('/account', "WebpagesController@AccountPage")->Name('AccountPage')->secure();
Route::get('/login', "WebpagesController@LoginPage")->Name('LoginPage')->secure();
Route::get('/register', "WebpagesController@RegisterPage")->Name('RegisterPage')->secure();
Route::get('/rule', "WebpagesController@RulePage")->Name('RulePage')->secure();

Route::prefix('admin')->group(function () {
    Route::get('/', "AdminController@IndexRedirect")->Name('IndexRedirect')->secure();

    Route::post('/fetch/account', "AdminController@FetchAccountData")->Name('FetchAccountData')->secure();
    Route::post('/account/edit', "AdminController@SubmitAccountEdit")->Name('SubmitAccountEdit')->secure();

    Route::get('/players', "AdminController@Players")->Name('Players')->secure();
    Route::post('/player/add', "AdminController@SubmitPlayerAdd")->Name('SubmitPlayerAdd')->secure();
    Route::post('/player/edit', "AdminController@SubmitPlayerEdit")->Name('SubmitPlayerEdit')->secure();
    Route::post('/player/delete', "AdminController@SubmitPlayerDelete")->Name('SubmitPlayerDelete')->secure();
    
    Route::get('/players/rule', "AdminController@PlayersRule")->Name('PlayersRule')->secure();
    Route::post('/player/rule/add', "AdminController@SubmitPlayerRuleAdd")->Name('SubmitPlayerRuleAdd')->secure();
    Route::post('/player/rule/edit', "AdminController@SubmitPlayerRuleEdit")->Name('SubmitPlayerRuleEdit')->secure();
    Route::post('/player/rule/delete', "AdminController@SubmitPlayerRuleDelete")->Name('SubmitPlayerRuleDelete')->secure();

    Route::get('/levels', "AdminController@Levels")->Name('Levels')->secure();
    Route::post('/level/add', "AdminController@SubmitLevelAdd")->Name('SubmitLevelAdd')->secure();
    Route::post('/level/edit', "AdminController@SubmitLevelEdit")->Name('SubmitLevelEdit')->secure();
    Route::post('/level/delete', "AdminController@SubmitLevelDelete")->Name('SubmitLevelDelete')->secure();

    Route::get('/nightmares', "AdminController@Nightmares")->Name('Nightmares')->secure();
    Route::post('/nightmare/add', "AdminController@SubmitNightmareAdd")->Name('SubmitNightmareAdd')->secure();
    Route::post('/nightmare/edit', "AdminController@SubmitNightmareEdit")->Name('SubmitNightmareEdit')->secure();
    Route::post('/nightmare/delete', "AdminController@SubmitNightmareDelete")->Name('SubmitNightmareDelete')->secure();

    Route::get('/links', "AdminController@Links")->Name('Links')->secure();
    Route::post('/link/add', "AdminController@SubmitLinkAdd")->Name('SubmitLinkAdd')->secure();
    Route::post('/link/edit', "AdminController@SubmitLinkEdit")->Name('SubmitLinkEdit')->secure();
    Route::post('/link/delete', "AdminController@SubmitLinkDelete")->Name('SubmitLinkDelete')->secure();

    Route::get('/cards', "AdminController@Cards")->Name('Cards')->secure();
    Route::post('/card/add', "AdminController@SubmitCardAdd")->Name('SubmitCardAdd')->secure();
    Route::post('/card/edit', "AdminController@SubmitCardEdit")->Name('SubmitCardEdit')->secure();
    Route::post('/card/delete', "AdminController@SubmitCardDelete")->Name('SubmitCardDelete')->secure();
});

Route::prefix('game')->group(function () {
    Route::get('/', "GameController@Home")->Name('Home')->secure();
    Route::post('/register/process', "GameController@RegisterProcess")->Name('RegisterProcess')->secure();
    Route::post('/login/process', "GameController@LoginProcess")->Name('LoginProcess')->secure();
    Route::get('/logout', "GameController@Logout")->Name('Logout')->secure();
    
    Route::prefix('room')->group(function () {
        Route::post('/create', "GameController@RoomCreate")->Name('RoomCreate')->secure();
        Route::post('/join', "GameController@RoomJoin")->Name('RoomJoin')->secure();
    
        Route::get('/waiting', "GameController@RoomWaiting")->Name('RoomWaiting')->middleware('redirectIfAuth')->secure();
        Route::post('/leave/wating', "GameController@LeaveRoomWating")->Name('LeaveRoomWating')->secure();
        Route::post('/player/remove', "GameController@PlayerRemove")->Name('PlayerRemove')->secure();
        Route::post('/delete', "GameController@RoomDelete")->Name('RoomDelete')->secure();
        Route::post('/poll/players', "GameController@pollPlayers")->Name('pollPlayers')->secure();
    
        Route::post('/change/status', "GameController@ChangeStatus")->Name('ChangeStatus')->secure();

        Route::post('/disconnect', "GameController@RoomDisconnect")->Name('RoomDisconnect')->secure();
    
        Route::post('/start', "GameController@StartGame")->Name('StartGame')->secure();
        Route::get('/start', "GameController@RoomPlay")->Name('RoomPlay')->middleware('redirectIfAuth')->secure();
    
        Route::post('/leave/playing', "GameController@LeaveRoom")->Name('LeaveRoom')->secure();
        Route::post('/start/timer', "GameController@StartTimer")->Name('StartTimer')->secure();
        Route::post('/end/timer', "GameController@EndTimer")->Name('EndTimer')->secure();
        Route::post('/poll/links', "GameController@PollLinks")->Name('PollLinks')->secure();
        Route::post('/fetch/timeout', "GameController@FetchTimeout")->Name('FetchTimeout')->secure();
        Route::post('/fetch/cards', "GameController@FetchCards")->Name('FetchCards')->secure();
        Route::post('/fetch/results', "GameController@FetchResults")->Name('FetchResults')->secure();
        Route::post('/round/card/add', "GameController@CardAdd")->Name('CardAdd')->secure();
        Route::post('/check/nightmare/link', "GameController@CheckNightmareLink")->Name('CheckNightmareLink')->secure();
        Route::post('/start/next/round', "GameController@StartNextRound")->Name('StartNextRound')->secure();
        Route::post('/start/next/circle', "GameController@StartNextCircle")->Name('StartNextCircle')->secure();
        Route::post('/end', "GameController@GameEnd")->Name('GameEnd')->secure();
        Route::post('/update/stats', "GameController@UpdateStats")->Name('UpdateStats')->secure();
    });
    
});