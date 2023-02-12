<?php

/* * ******  FAQ Field Start ********** */
Route::get('list-faqs', array_merge(['uses' => 'Admin\FaqController@indexFaqs'], $all_users))->name('list.faqs');
Route::get('create-faq', array_merge(['uses' => 'Admin\FaqController@createFaq'], $all_users))->name('create.faq');
Route::post('store-faq', array_merge(['uses' => 'Admin\FaqController@storeFaq'], $all_users))->name('store.faq');
Route::get('edit-faq/{id}/{industry_id?}', array_merge(['uses' => 'Admin\FaqController@editFaq'], $all_users))->name('edit.faq');
Route::put('update-faq/{id}', array_merge(['uses' => 'Admin\FaqController@updateFaq'], $all_users))->name('update.faq');
Route::delete('delete-faq', array_merge(['uses' => 'Admin\FaqController@deleteFaq'], $all_users))->name('delete.faq');
Route::get('fetch-faqs', array_merge(['uses' => 'Admin\FaqController@fetchFaqsData'], $all_users))->name('fetch.data.faqs');
Route::get('sort-faq', array_merge(['uses' => 'Admin\FaqController@sortFaqs'], $all_users))->name('sort.faqs');
Route::get('faq-sort-data', array_merge(['uses' => 'Admin\FaqController@faqSortData'], $all_users))->name('faq.sort.data');
Route::put('faq-sort-update', array_merge(['uses' => 'Admin\FaqController@faqSortUpdate'], $all_users))->name('faq.sort.update');
/* * ****** End FAQ Field ********** */


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

?>