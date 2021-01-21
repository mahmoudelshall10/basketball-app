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

// if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
//     error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// }
// use App\Http\Controllers\Admin\NotificationController;

use Maatwebsite\Excel\Excel;
use App\Exports\MiniBasketReportsExport;

Route::get('/', function () {
    return view('welcome');
});



//Auth::routes();
Auth::routes(['register' => false , 'confirm' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/page', 'HomeController@page')->name('page');

Route::group(['namespace' => 'Admin'], function () {

Route::resource('referee','AdminRefereeController');
Route::resource('instructions','InstructionsController')->only(['index','create','store']);
Route::resource('hall','AdminHallsController')->except(['show']);
Route::resource('team','AdminTeamController');
Route::resource('news','AdminNewsController')->except(['show']);
Route::resource('question','AdminQuestionController')->except(['show']);
Route::resource('question_option','AdminQuestionOptionController')->except(['show','delete']);
Route::resource('matchesreferees', 'MatchRefereeController')->only(['show','index','edit','update']);
//////////////////////////allowancesvalues/////////////////////
// Route::resource('allowancesvalues', 'AdminAllowancesValueController');
Route::get('allowancesvalues', 'AdminAllowancesValueController@index')->name('allowancesvalues.index');
Route::get('allowancesvalues/create', 'AdminAllowancesValueController@create')->name('allowancesvalues.create');
Route::post('allowancesvalues', 'AdminAllowancesValueController@store')->name('allowancesvalues.store');
Route::get('allowancesvalues/{id}', 'AdminAllowancesValueController@show')->name('allowancesvalues.show');
Route::get('allowancesvalues/{id}/edit', 'AdminAllowancesValueController@edit')->name('allowancesvalues.edit');
Route::PATCH('allowancesvalues/{id}', 'AdminAllowancesValueController@update')->name('allowancesvalues.update');
Route::Delete('allowancesvalues/{id}', 'AdminAllowancesValueController@delete')->name('allowancesvalues.destroy');
Route::get('allowance/association', 'AdminAllowancesValueController@associationIndex')->name('allowancesvalues.association');
Route::get('view-copy', 'AdminAllowancesValueController@viewCopy')->name('allowancesvalues.viewCopy');
Route::post('store-copy', 'AdminAllowancesValueController@storeCopy')->name('allowancesvalues.copy');

// Route::get('allowance/print', 'AdminAllowancesValueController@print')->name('page-print');
Route::get('allowance/cairo-area', 'AdminAllowancesValueController@cairoAreaIndex')->name('allowancesvalues.cairoarea');
Route::get('allowance/mini-basket', 'AdminAllowancesValueController@miniBasketIndex')->name('allowancesvalues.minibasket');
//////////////////////////allowancesvalues/////////////////////
Route::resource('allowances', 'AdminAllowancesController')->only('index');
Route::resource('reports', 'ReportController')->only(['index']);

////////mini basket//////////
Route::get('reports/mini-basket-report','ReportController@MiniBasketIndex')->name('reports.MiniBasketIndex');
Route::get('reports/mini-basket-report/action','ReportController@MiniBasketReport')->name('reports.MiniBasketReport');
Route::get('reports/mini-basket-report/exportexcel', 'ReportController@MiniBasketReportExportExcel')->name('miniBasketReportExportExcel');
Route::get('reports/mini-basket-report/exportpdf', 'ReportController@miniBasketReportExportPdf')->name('miniBasketReportExportPdf');

////////mini basket//////////


////////cairo area//////////
Route::get('reports/cairo-area-report','ReportController@cairoAreaIndex')->name('reports.cairoAreaIndex');
Route::get('reports/cairo-area-report/action','ReportController@CairoAreaReport')->name('reports.CairoAreaReport');
Route::get('reports/cairo-area-report/exportexcel', 'ReportController@cairoAreaReportExportExcel')->name('cairoAreaReportExportExcel');
Route::get('reports/cairo-area-report/exportpdf', 'ReportController@cairoAreaReportExportPdf')->name('cairoAreaReportExportPdf');
////////cairo area//////////

////////association//////////

Route::get('reports/association-report','ReportController@AssociationReport')->name('reports.AssociationIndex');
Route::get('reports/association-report/exportexcel', 'ReportController@associationReportExportExcel')->name('associationReportExportExcel');
Route::get('reports/association-report/exportpdf', 'ReportController@associationReportExportPdf')->name('associationReportExportPdf');
////////association//////////

//////////////Search/////////////////
Route::get('live-search', 'SearchController@reportSearch')->name('reports.Search');
Route::get('live-search/action', 'SearchController@search')->name('Search');

Route::get('decline-search', 'SearchController@declineView')->name('search.decline');
Route::get('decline-search/action', 'SearchController@decline')->name('Decline');
//////////////Search/////////////////



Route::get('notifications','NotificationController@index')->name('notifications.index');
// Route::resource('league','AdminLeagueController')->except(['show']);
Route::resource('league','AdminLeagueController')->except(['show']);
Route::get('association-leagues','AdminLeagueController@associationIndex')->name('associationIndex');
Route::get('cairo-area-leagues','AdminLeagueController@cairoAreaIndex')->name('cairoAreaIndex');
Route::get('mini-basket-leagues','AdminLeagueController@miniBasketIndex')->name('miniBasketIndex');
Route::prefix('league')->group(function(){
	Route::get('{id}/teams','AdminLeagueController@teamIndex')->where('id', '[0-9]+')->name('leaguesTeams.index');
	Route::get('{id}/teams/assign','AdminLeagueController@teamCreate')->where('id', '[0-9]+')->name('leaguesTeams.create');
	Route::POST('{id}/teams/assign','AdminLeagueController@teamStore')->where('id', '[0-9]+')->name('leaguesTeams.store');
	Route::Delete('{league_id}/teams/{leagues_teams_id}','AdminLeagueController@teamDestroy')->name('leaguesTeams.destroy');
	Route::get('{id}/matches','AdminLeagueController@matchIndex')->where('id', '[0-9]+')->name('leaguesMatches.index');
	Route::get('{id}/matches/create','AdminLeagueController@matchCreate')->where('id', '[0-9]+')->name('leaguesMatches.create');
	Route::POST('{id}/matches/store','AdminLeagueController@matchStore')->where('id', '[0-9]+')->name('leaguesMatches.store');
	Route::get('{league_id}/matches/{leage_matches_id}','AdminLeagueController@matchShow')->where('id', '[0-9]+')->name('leaguesMatches.show');
	Route::Delete('{league_id}/matches/{leage_matches_id}','AdminLeagueController@matchDestroy')->name('leaguesMatches.destroy');
	Route::get('send/{leage_matches_id}','AdminLeagueController@sendNotification')->name('sendNotification');
	Route::get('send_all','AdminLeagueController@sendNotificationsForAll')->name('sendNotificationsForAll');
	Route::post('matches/{leage_matches_id}','AdminLeagueController@storePeriods')->name('storePeriods');
});
Route::resource('exam','AdminExamController')->except(['show','delete']);
Route::prefix('exam')->group(function(){
	Route::get('{id}/questions','AdminExamController@questionsIndex')->where('id', '[0-9]+')->name('examQuestion.index');
	Route::POST('{id}/questions','AdminExamController@questionsStore')->where('id', '[0-9]+')->name('examQuestion.store');
	Route::Delete('{exam_id}/questions/{exam_question_id}','AdminExamController@questionDestroy')->name('examQuestion.destroy');
	Route::get('{id}/referees','AdminExamController@refereesIndex')->where('id', '[0-9]+')->name('examReferee.index');
	Route::POST('{id}/referees','AdminExamController@refereeStore')->where('id', '[0-9]+')->name('examReferee.store');
	Route::Delete('{exam_id}/referees/{exam_referee_id}','AdminExamController@refereeDestroy')->name('examReferee.destroy');
	// Route::get('{id}/teams/assign','AdminLeagueController@teamCreate')->where('id', '[0-9]+')->name('leaguesTeams.create');
	// Route::POST('{id}/teams/assign','AdminLeagueController@teamStore')->where('id', '[0-9]+')->name('leaguesTeams.store');
	
});
Route::get('verify/{id}','MatchRefereeController@verify')->name('verifyMatch');
Route::get('single_type','GlobalController@single_type')->name('getView');
Route::get('getcities/{id}','AdminCityController@getCities')->name('getCities');
Route::get('getcitybygov/{id}','AdminCityController@getCityByGov')->name('getCityByGov');
Route::get('getcairoareas','AdminCityController@getCairoAreas')->name('getCairoAreas');
Route::get('getcitiesexid/{id}','AdminCityController@getCitiesExId')->name('getCitiesExId');
Route::get('getmatchreferees/{id}','AdminAllowancesController@getMatchReferees')->name('getMatchReferees');
Route::get('getleaguematches/{id}','AdminAllowancesController@getLeagueMatches')->name('getLeagueMatches');
Route::get('getallnotifications','NotificationController@getAllNotifications')->name('getAllNotifications');
Route::post('updatenotificationstoread/{id}','NotificationController@updateNotificationsToRead')->name('updateNotificationsToRead');
Route::get('getrefereesmatch/{id}', 'MatchRefereeController@getRefereesMatch')->name('refereesMatch');
Route::get('getleague/{id}','AdminAllowancesValueController@leagueId')->name('leagueId');
});