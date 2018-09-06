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

/*Route::get('/editemployee', function () {
    return view('employees.editemployee');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/viewdashboard', 'DashboardController@view')->name('viewdashboard');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Branches
Route::get('/branches', 'LibraryController@branches')->name('branches');
Route::get('/createbranch', 'LibraryController@createbranch')->name('createbranch');
Route::post('/submitbranch', 'LibraryController@submitbranch')->name('submitbranch');
Route::get('/editbranch/{id}', 'LibraryController@editbranch')->name('editbranch');
Route::post('/updatebranch', 'LibraryController@updatebranch')->name('updatebranch');

Route::get('/positions', 'LibraryController@positions')->name('positions');
Route::get('/createposition', 'LibraryController@createposition')->name('createposition');
Route::post('/submitposition', 'LibraryController@submitposition')->name('submitposition');
Route::get('/editposition/{id}', 'LibraryController@editposition')->name('editposition');
Route::post('/updateposition', 'LibraryController@updateposition')->name('updateposition');

Route::get('/departments', 'LibraryController@departments')->name('departments');
Route::get('/createdept', 'LibraryController@createdept')->name('createdept');
Route::post('/submitdept', 'LibraryController@submitdept')->name('submitdept');
Route::get('/editdept/{id}', 'LibraryController@editdept')->name('editdept');
Route::post('/updatedept', 'LibraryController@updatedept')->name('updatedept');

Route::get('/positions', 'LibraryController@positions')->name('positions');
Route::get('/createposition', 'LibraryController@createposition')->name('createposition');
Route::post('/submitposition', 'LibraryController@submitposition')->name('submitposition');
Route::get('/editposition/{id}', 'LibraryController@editposition')->name('editposition');
Route::post('/updateposition', 'LibraryController@updateposition')->name('updateposition');

Route::get('/provinces', 'LibraryController@provinces')->name('provinces');
Route::get('/createprovince', 'LibraryController@createprovince')->name('createprovince');
Route::post('/submitprovince', 'LibraryController@submitprovince')->name('submitprovince');
Route::get('/editprovince/{id}', 'LibraryController@editprovince')->name('editprovince');
Route::post('/updateprovince', 'LibraryController@updateprovince')->name('updateprovince');

Route::get('/areas', 'LibraryController@areas')->name('areas');
Route::get('/createarea', 'LibraryController@createarea')->name('createarea');
Route::post('/submitarea', 'LibraryController@submitarea')->name('submitarea');
Route::get('/editarea/{id}', 'LibraryController@editarea')->name('editarea');
Route::post('/updatearea', 'LibraryController@updatearea')->name('updatearea');

Route::get('/allowancetypes', 'LibraryController@allowancetypes')->name('allowancetypes');
Route::get('/createallowancetype', 'LibraryController@createallowancetype')->name('createallowancetype');
Route::post('/submitallowancetype', 'LibraryController@submitallowancetype')->name('submitallowancetype');
Route::get('/editallowancetype/{id}', 'LibraryController@editallowancetype')->name('editallowancetype');
Route::post('/updateallowancetype', 'LibraryController@updateallowancetype')->name('updateallowancetype');

Route::get('/indicators', 'LibraryController@indicators')->name('indicators');
Route::get('/createindicator', 'LibraryController@createindicator')->name('createindicator');
Route::post('/submitindicator', 'LibraryController@submitindicator')->name('submitindicator');
Route::get('/editindicator/{id}', 'LibraryController@editindicator')->name('editindicator');
Route::post('/updateindicator', 'LibraryController@updateindicator')->name('updateindicator');

Route::get('/competencies', 'CompetencyController@competencies')->name('competencies');
Route::get('/createcoms', 'CompetencyController@createcoms')->name('createcoms');
Route::post('/submitcoms', 'CompetencyController@submitcoms')->name('submitcoms');
Route::get('/editcoms/{id}', 'CompetencyController@editcoms')->name('editcoms');
Route::post('/updatecoms', 'CompetencyController@updatecoms')->name('updatecoms');
Route::get('/setemployee', 'CompetencyController@setemployee')->name('setemployee');
Route::get('/getemployee', 'CompetencyController@getemployee')->name('getemployee');
Route::post('/submitempcom', 'CompetencyController@submitemployee')->name('submitempcom');
Route::get('/viewempcom', 'CompetencyController@viewemployee')->name('viewempcom');
Route::get('/getempcom', 'CompetencyController@viewemp')->name('getempcom');
Route::get('/getcom', 'CompetencyController@getemp')->name('getcom');

Route::get('/createemployee', 'EmployeesController@createemployee')->name('createemployee');
Route::get('/getpositions', 'EmployeesController@getpositions')->name('getpositions');
Route::get('/getzip', 'EmployeesController@getzip')->name('getzip');
Route::get('/employees', 'EmployeesController@employees')->name('employees');
Route::post('/submitemployee', 'EmployeesController@submitemployee')->name('submitemployee');
Route::get('/editemployee/{id}', 'EmployeesController@editemployee')->name('editemployee');
Route::post('/updateemployee', 'EmployeesController@updateemployee')->name('updateemployee');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('importExport', 'MaatwebsiteController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'MaatwebsiteController@downloadExcel');
// Route for import excel data to database.
Route::post('importExcel', 'MaatwebsiteController@importExcel')->name('importExcel');
Route::post('importarea', 'MaatwebsiteController@importarea')->name('importarea');
Route::post('importemployee', 'MaatwebsiteController@importemployee')->name('importemployee');
Route::post('importcon', 'MaatwebsiteController@importcon')->name('importcon');

Route::get('/createleave', 'LeavesController@createleave')->name('createleave');
Route::post('/submitleave', 'LeavesController@submitleave')->name('submitleave');
Route::get('/leaves', 'LeavesController@leaves')->name('leaves');
Route::post('/approveleave', 'LeavesController@approveleave')->name('approveleave');
Route::get('/editleave/{id}', 'LeavesController@editleave')->name('editleave');
Route::post('/updateleave', 'LeavesController@updateleave')->name('updateleave');
Route::get('/getleave', 'LeavesController@getleaves')->name('getleave');

Route::get('/createholiday', 'HolidaysController@createholiday')->name('createholiday');
Route::post('/submitholiday', 'HolidaysController@submitholiday')->name('submitholiday');
Route::get('/holidays', 'HolidaysController@holidays')->name('holidays');
Route::get('/getholiday', 'HolidaysController@getholiday')->name('getholiday');
Route::get('/get', 'HolidaysController@get')->name('get');
Route::get('/editholiday/{id}', 'HolidaysController@editholiday')->name('editholiday');
Route::post('/updateholiday', 'HolidaysController@updateholiday')->name('updateholiday');

Route::get('/setindicator', 'CompetencyController@setindicator')->name('setindicator');
Route::post('/submitset', 'CompetencyController@submitset')->name('submitset');
Route::get('/indicatorlist', 'CompetencyController@indicatorlist')->name('indicatorlist');
Route::get('/getlist', 'CompetencyController@getlist')->name('getlist');
Route::get('/editlist/{id}', 'CompetencyController@editlist')->name('editlist');

Route::get('/contributions', 'ContributionsController@contributions')->name('contributions');
Route::get('/editcontribution/{id}', 'ContributionsController@editcontribution')->name('editcontribution');

Route::get('/loantypes', 'LoansController@loantypes')->name('loantypes');
Route::get('/createloantype', 'LoansController@createloantype')->name('createloantype');
Route::post('/submitloantype', 'LoansController@submitloantype')->name('submitloantype');
Route::get('/editloantype/{id}', 'LoansController@editloantype')->name('editloantype');
Route::post('/updateloantype', 'LoansController@updateloantype')->name('updateloantype');

Route::get('/createloan', 'LoansController@createloan')->name('createloan');
Route::post('/submitloan', 'LoansController@submitloan')->name('submitloan');
Route::get('/loans', 'LoansController@loans')->name('loans');
Route::get('/editloan/{id}', 'LoansController@editloan')->name('editloan');

Route::get('/generatepayroll', 'PayrollController@generatepayroll')->name('generatepayroll');
Route::get('/employeelist', 'PayrollController@employeelist')->name('employeelist');
Route::get('/getpayrolldata', 'PayrollController@getpayrolldata')->name('getpayrolldata');
Route::get('/getpayrolldetails', 'PayrollController@getpayrolldetails')->name('getpayrolldetails');
Route::post('/submitpayroll','PayrollController@submitpayroll')->name('submitpayroll');


//routes ni kester for saving memos
Route::get('/creatememo','memorandumcontroller@creatememofunction')->name('creatememo');
Route::get('/getmemoid','memorandumcontroller@getidfunction')->name('getmemoid');
Route::get('/getarrayid','memorandumcontroller@getarrayfunction')->name('getarrayid');
Route::POST('/sendmemo','memorandumcontroller@sendmemofunction')->name('sendmemo');

//Routes for viewing

Route::get('/viewmemo/','memorandumcontroller@viewmemofunction')->name('viewmemo');
Route::get('/editmemo/{id}','memorandumcontroller@editmemofunction')->name('editmemo');
Route::get('/getemployeeseditmemo','memorandumcontroller@getemployeesforeditmemofunction')->name('getemployeeseditmemo');
Route::POST('/updatememo','memorandumcontroller@updatememofunction')->name('updatememo');











