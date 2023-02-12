<?php

/* * ******  FAQ Field Start ********** */
Route::get('list-links', array_merge(['uses' => 'Admin\LinkController@indexLinks'], $all_users))->name('list.links');
Route::get('create-link', array_merge(['uses' => 'Admin\LinkController@createLink'], $all_users))->name('create.link');
Route::post('store-link', array_merge(['uses' => 'Admin\LinkController@storeLink'], $all_users))->name('store.link');
Route::get('edit-link/{id}/{industry_id?}', array_merge(['uses' => 'Admin\LinkController@editLink'], $all_users))->name('edit.link');
Route::put('update-link/{id}', array_merge(['uses' => 'Admin\LinkController@updateLink'], $all_users))->name('update.link');
Route::delete('delete-link', array_merge(['uses' => 'Admin\LinkController@deleteLink'], $all_users))->name('delete.link');
Route::get('fetch-links', array_merge(['uses' => 'Admin\LinkController@fetchLinksData'], $all_users))->name('fetch.data.links');
Route::get('sort-link', array_merge(['uses' => 'Admin\LinkController@sortLinks'], $all_users))->name('sort.links');
Route::get('link-sort-data', array_merge(['uses' => 'Admin\LinkController@linkSortData'], $all_users))->name('link.sort.data');
Route::put('link-sort-update', array_merge(['uses' => 'Admin\LinkController@linkSortUpdate'], $all_users))->name('link.sort.update');
/* * ****** End FAQ Field ********** */
?>