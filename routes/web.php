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

Route::get('/', "WebpagesController@HomePage")->Name('HomePage')->forceScheme('https');
Route::get('/about', "WebpagesController@AboutPage")->Name('AboutPage')->forceScheme('https');
Route::get('/account', "WebpagesController@AccountPage")->Name('AccountPage')->forceScheme('https');
Route::get('/login', "WebpagesController@LoginPage")->Name('LoginPage')->forceScheme('https');
Route::get('/register', "WebpagesController@RegisterPage")->Name('RegisterPage')->forceScheme('https');
Route::get('/rule', "WebpagesController@RulePage")->Name('RulePage')->forceScheme('https');

Route::prefix('admin')->group(function () {
    Route::get('/', "AdminController@IndexRedirect")->Name('IndexRedirect')->forceScheme('https');

    Route::post('/fetch/account', "AdminController@FetchAccountData")->Name('FetchAccountData')->forceScheme('https');
    Route::post('/account/edit', "AdminController@SubmitAccountEdit")->Name('SubmitAccountEdit')->forceScheme('https');

    Route::get('/players', "AdminController@Players")->Name('Players')->forceScheme('https');
    Route::post('/player/add', "AdminController@SubmitPlayerAdd")->Name('SubmitPlayerAdd')->forceScheme('https');
    Route::post('/player/edit', "AdminController@SubmitPlayerEdit")->Name('SubmitPlayerEdit')->forceScheme('https');
    Route::post('/player/delete', "AdminController@SubmitPlayerDelete")->Name('SubmitPlayerDelete')->forceScheme('https');
    
    Route::get('/players/rule', "AdminController@PlayersRule")->Name('PlayersRule')->forceScheme('https');
    Route::post('/player/rule/add', "AdminController@SubmitPlayerRuleAdd")->Name('SubmitPlayerRuleAdd')->forceScheme('https');
    Route::post('/player/rule/edit', "AdminController@SubmitPlayerRuleEdit")->Name('SubmitPlayerRuleEdit')->forceScheme('https');
    Route::post('/player/rule/delete', "AdminController@SubmitPlayerRuleDelete")->Name('SubmitPlayerRuleDelete')->forceScheme('https');

    Route::get('/levels', "AdminController@Levels")->Name('Levels')->forceScheme('https');
    Route::post('/level/add', "AdminController@SubmitLevelAdd")->Name('SubmitLevelAdd')->forceScheme('https');
    Route::post('/level/edit', "AdminController@SubmitLevelEdit")->Name('SubmitLevelEdit')->forceScheme('https');
    Route::post('/level/delete', "AdminController@SubmitLevelDelete")->Name('SubmitLevelDelete')->forceScheme('https');

    Route::get('/nightmares', "AdminController@Nightmares")->Name('Nightmares')->forceScheme('https');
    Route::post('/nightmare/add', "AdminController@SubmitNightmareAdd")->Name('SubmitNightmareAdd')->forceScheme('https');
    Route::post('/nightmare/edit', "AdminController@SubmitNightmareEdit")->Name('SubmitNightmareEdit')->forceScheme('https');
    Route::post('/nightmare/delete', "AdminController@SubmitNightmareDelete")->Name('SubmitNightmareDelete')->forceScheme('https');

    Route::get('/links', "AdminController@Links")->Name('Links')->forceScheme('https');
    Route::post('/link/add', "AdminController@SubmitLinkAdd")->Name('SubmitLinkAdd')->forceScheme('https');
    Route::post('/link/edit', "AdminController@SubmitLinkEdit")->Name('SubmitLinkEdit')->forceScheme('https');
    Route::post('/link/delete', "AdminController@SubmitLinkDelete")->Name('SubmitLinkDelete')->forceScheme('https');

    Route::get('/cards', "AdminController@Cards")->Name('Cards')->forceScheme('https');
    Route::post('/card/add', "AdminController@SubmitCardAdd")->Name('SubmitCardAdd')->forceScheme('https');
    Route::post('/card/edit', "AdminController@SubmitCardEdit")->Name('SubmitCardEdit')->forceScheme('https');
    Route::post('/card/delete', "AdminController@SubmitCardDelete")->Name('SubmitCardDelete')->forceScheme('https');
});

Route::prefix('game')->group(function () {
    Route::get('/', "GameController@Home")->Name('Home')->forceScheme('https');
    Route::post('/register/process', "GameController@RegisterProcess")->Name('RegisterProcess')->forceScheme('https');
    Route::post('/login/process', "GameController@LoginProcess")->Name('LoginProcess')->forceScheme('https');
    Route::get('/logout', "GameController@Logout")->Name('Logout')->forceScheme('https');
    
    Route::prefix('room')->group(function () {
        Route::post('/create', "GameController@RoomCreate")->Name('RoomCreate')->forceScheme('https');
        Route::post('/join', "GameController@RoomJoin")->Name('RoomJoin')->forceScheme('https');
    
        Route::get('/waiting', "GameController@RoomWaiting")->Name('RoomWaiting')->middleware('redirectIfAuth')->forceScheme('https');
        Route::post('/leave/wating', "GameController@LeaveRoomWating")->Name('LeaveRoomWating')->forceScheme('https');
        Route::post('/player/remove', "GameController@PlayerRemove")->Name('PlayerRemove')->forceScheme('https');
        Route::post('/delete', "GameController@RoomDelete")->Name('RoomDelete')->forceScheme('https');
        Route::post('/poll/players', "GameController@pollPlayers")->Name('pollPlayers')->forceScheme('https');
    
        Route::post('/change/status', "GameController@ChangeStatus")->Name('ChangeStatus')->forceScheme('https');

        Route::post('/disconnect', "GameController@RoomDisconnect")->Name('RoomDisconnect')->forceScheme('https');
    
        Route::post('/start', "GameController@StartGame")->Name('StartGame')->forceScheme('https');
        Route::get('/start', "GameController@RoomPlay")->Name('RoomPlay')->middleware('redirectIfAuth')->forceScheme('https');
    
        Route::post('/leave/playing', "GameController@LeaveRoom")->Name('LeaveRoom')->forceScheme('https');
        Route::post('/start/timer', "GameController@StartTimer")->Name('StartTimer')->forceScheme('https');
        Route::post('/end/timer', "GameController@EndTimer")->Name('EndTimer')->forceScheme('https');
        Route::post('/poll/links', "GameController@PollLinks")->Name('PollLinks')->forceScheme('https');
        Route::post('/fetch/timeout', "GameController@FetchTimeout")->Name('FetchTimeout')->forceScheme('https');
        Route::post('/fetch/cards', "GameController@FetchCards")->Name('FetchCards')->forceScheme('https');
        Route::post('/fetch/results', "GameController@FetchResults")->Name('FetchResults')->forceScheme('https');
        Route::post('/round/card/add', "GameController@CardAdd")->Name('CardAdd')->forceScheme('https');
        Route::post('/check/nightmare/link', "GameController@CheckNightmareLink")->Name('CheckNightmareLink')->forceScheme('https');
        Route::post('/start/next/round', "GameController@StartNextRound")->Name('StartNextRound')->forceScheme('https');
        Route::post('/start/next/circle', "GameController@StartNextCircle")->Name('StartNextCircle')->forceScheme('https');
        Route::post('/end', "GameController@GameEnd")->Name('GameEnd')->forceScheme('https');
        Route::post('/update/stats', "GameController@UpdateStats")->Name('UpdateStats')->forceScheme('https');
    });
    
});