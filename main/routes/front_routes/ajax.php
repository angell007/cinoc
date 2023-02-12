<?php

use Illuminate\Support\Facades\Route;

Route::post('filter-default-cities-dropdown', 'AjaxController@filterDefaultCities')->name('filter.default.cities.dropdown');
Route::post('filter-default-states-dropdown', 'AjaxController@filterDefaultStates')->name('filter.default.states.dropdown');
Route::post('filter-lang-cities-dropdown2', 'AjaxController@filterLangCities2')->name('filter.lang.cities.dropdown2');
Route::post('filter-lang-cities-dropdown', 'AjaxController@filterLangCities')->name('filter.lang.cities.dropdown');
Route::post('filter-lang-states-dropdown', 'AjaxController@filterLangStates')->name('filter.lang.states.dropdown');
Route::post('filter-lang-states-dropdown2', 'AjaxController@filterLangStates2')->name('filter.lang.states.dropdown2');
Route::post('filter-cities-dropdown', 'AjaxController@filterCities')->name('filter.cities.dropdown');
Route::post('filter-states-dropdown', 'AjaxController@filterStates')->name('filter.states.dropdown');
Route::post('filter-degree-types-dropdown', 'AjaxController@filterDegreeTypes')->name('filter.degree.types.dropdown');
