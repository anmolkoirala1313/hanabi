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

Auth::routes();

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::any('/register', function() {
    abort(404);
});

Route::get('/slider-list', function () {
    return redirect('/');
});


Route::get('/categories', function () {
    return redirect('/blog');
});

Route::get('/contact-us', 'App\Http\Controllers\FrontController@contact')->name('contact');
Route::post('/contact-us/store', 'App\Http\Controllers\FrontController@contactStore')->name('contact.store');
Route::get('/testimonial', 'App\Http\Controllers\FrontController@testimonial')->name('testimonial');
Route::get('/video-gallery', 'App\Http\Controllers\FrontController@videoGallery')->name('videoGallery');


Route::get('/', 'App\Http\Controllers\FrontController@index')->name('home');

Route::get('/career', 'App\Http\Controllers\FrontController@career')->name('career');

//blog
Route::get('blog/search/', 'App\Http\Controllers\FrontController@searchBlog')->name('searchBlog');

Route::get('blog/{slug}','App\Http\Controllers\FrontController@blogSingle')->name('blog.single');
Route::get('our-service/{slug}','App\Http\Controllers\FrontController@serviceSingle')->name('service.single');
Route::get('/our-service','App\Http\Controllers\FrontController@service')->name('service.frontend');
Route::get('/blog/categories/{slug}', 'App\Http\Controllers\FrontController@blogCategories')->name('blog.category');
Route::get('/blog', 'App\Http\Controllers\FrontController@blogs')->name('blog.frontend');
Route::get('/faq', 'App\Http\Controllers\FrontController@faq')->name('faq.frontend');
Route::get('/album', 'App\Http\Controllers\FrontController@album')->name('album');
Route::get('/album/{album}/', 'App\Http\Controllers\FrontController@albumgallery')->name('album.gallery');

Route::get('/privacy-policy', 'App\Http\Controllers\FrontController@privacy')->name('privacy.frontend');
Route::get('/terms-condition', 'App\Http\Controllers\FrontController@terms')->name('term.frontend');

//slider list single page
Route::get('slider-list/{slug}','App\Http\Controllers\FrontController@sliderSingle')->name('slider.single');

//end blog

Route::get('/clients', 'App\Http\Controllers\FrontController@clients')->name('client.frontend');

Route::get('/our-category', 'App\Http\Controllers\FrontController@category')->name('category.frontend');
Route::get('our-category/{slug}','App\Http\Controllers\FrontController@categorySingle')->name('category.single');
Route::get('/team', 'App\Http\Controllers\FrontController@team')->name('team');
//Route::get('/director', 'App\Http\Controllers\FrontController@director')->name('director');

//jobs
Route::get('jobs/search/', 'App\Http\Controllers\FrontController@searchJob')->name('searchJob');

Route::get('/jobs','App\Http\Controllers\FrontController@jobs')->name('job.list');
Route::get('/jobs/{slug}','App\Http\Controllers\FrontController@jobSingle')->name('job.single');

Route::get('/study-abroad','App\Http\Controllers\FrontController@studyAbroad')->name('study-abroad.list');
Route::get('/study-abroad/{slug}','App\Http\Controllers\FrontController@studyAbroadSingle')->name('study-abroad.single');

Route::get('/test-preparations','App\Http\Controllers\FrontController@testPreparation')->name('test-preparation.list');
Route::get('/test-preparations/{slug}','App\Http\Controllers\FrontController@testPreparationSingle')->name('test-preparation.single');

Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //signed-in user routes
    Route::get('/profile/{slug?}', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::get('/filemanager', 'App\Http\Controllers\HomeController@filemanager')->name('filemanager');
    Route::get('/profile/edit/{slug}', 'App\Http\Controllers\UserController@profileEdit')->name('profile.edit');
    Route::post('/profile/socials/', 'App\Http\Controllers\UserController@socialsUpdate')->name('profile.socials');
    Route::put('/profile/{id}/update', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::post('/user-image/update/', 'App\Http\Controllers\UserController@imageupdate')->name('user.imageupdate');
    Route::post('/profile/oldpassword', 'App\Http\Controllers\UserController@checkoldpassword')->name('user.oldpassword');
    Route::post('/profile/password', 'App\Http\Controllers\UserController@profilepassword')->name('user.password');
    Route::post('/user/removeaccount', 'App\Http\Controllers\UserController@removeAccount')->name('user.removeaccount');
    //end of signed-in user routes

    Route::get('/user-management', 'App\Http\Controllers\UserController@alluser')->name('alluser');
    Route::get('/user-management/create', 'App\Http\Controllers\UserController@create')->name('user.create');
    Route::post('/user-management/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::delete('/user-management/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    Route::patch('/status/update/{id}', 'App\Http\Controllers\UserController@statusupdate')->name('user-status.update');
    Route::patch('/role/update/{id}', 'App\Http\Controllers\UserController@roleupdate')->name('user-type.update');

    //homepage
    Route::get('/homepage-setting', 'App\Http\Controllers\HomePageController@index')->name('homepage.index');
    Route::post('/homepage-setting', 'App\Http\Controllers\HomePageController@store')->name('homepage.store');
    Route::put('/homepage-setting/{settings}', 'App\Http\Controllers\HomePageController@update')->name('homepage.update');
    Route::put('/homepage-setting/callaction/{settings}', 'App\Http\Controllers\HomePageController@callactionhome')->name('homepage.action');
    Route::put('/homepage-setting/core-values/{settings}', 'App\Http\Controllers\HomePageController@corevalues')->name('homepage.corevalues');
    Route::put('/homepage-setting/mission-values/{settings}', 'App\Http\Controllers\HomePageController@missionvalues')->name('homepage.mv');
    Route::put('/homepage-setting/makes-us-different/{settings}', 'App\Http\Controllers\HomePageController@makesdifferent')->name('homepage.different');
    Route::put('/homepage-setting/why-us/{settings}', 'App\Http\Controllers\HomePageController@whyus')->name('homepage.whyus');

    Route::put('/homepage-setting/grievance/{settings}', 'App\Http\Controllers\HomePageController@grievance')->name('homepage.grievance');


    Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
    Route::delete('/contact/{id}', 'App\Http\Controllers\ContactController@destroy')->name('contact.destroy');
    Route::get('/contact/edit/{slug}', 'App\Http\Controllers\ContactController@edit')->name('contact.edit');

    //Blog categories
    Route::get('/blog-category', 'App\Http\Controllers\BlogCategoryController@index')->name('blogcategory.index');
    Route::get('/blog-category/create', 'App\Http\Controllers\BlogCategoryController@create')->name('blogcategory.create');
    Route::post('/blog-category', 'App\Http\Controllers\BlogCategoryController@store')->name('blogcategory.store');
    Route::put('/blog-category/{category}', 'App\Http\Controllers\BlogCategoryController@update')->name('blogcategory.update');
    Route::delete('/blog-category/{category}', 'App\Http\Controllers\BlogCategoryController@destroy')->name('blogcategory.destroy');
    Route::get('/blog-category/{category}/edit', 'App\Http\Controllers\BlogCategoryController@edit')->name('blogcategory.edit');
    //End of Blog categories


    //Blog
    Route::get('/blogs', 'App\Http\Controllers\BlogController@index')->name('blog.index');
    Route::get('/blogs/create', 'App\Http\Controllers\BlogController@create')->name('blog.create');
    Route::post('/blogs', 'App\Http\Controllers\BlogController@store')->name('blog.store');
    Route::put('/blogs/{blogs}', 'App\Http\Controllers\BlogController@update')->name('blog.update');
    Route::delete('/blogs/{blogs}', 'App\Http\Controllers\BlogController@destroy')->name('blog.destroy');
    Route::get('/blogs/{blogs}/edit', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
    Route::patch('/blogs/{id}/update', 'App\Http\Controllers\BlogController@updateStatus')->name('blog-status.update');

    //End Blog

    Route::get('/dashboard-settings', 'App\Http\Controllers\SettingController@index')->name('settings.index');
    Route::get('/dashboard-settings/create', 'App\Http\Controllers\SettingController@create')->name('settings.create');
    Route::post('/dashboard-settings', 'App\Http\Controllers\SettingController@store')->name('settings.store');
    Route::put('/dashboard-settings/{settings}', 'App\Http\Controllers\SettingController@update')->name('settings.update');
    Route::delete('/dashboard-settings/{settings}', 'App\Http\Controllers\SettingController@destroy')->name('settings.destroy');
    Route::get('/dashboard-settings/{settings}/edit', 'App\Http\Controllers\SettingController@edit')->name('settings.edit');
    Route::post('/dashboard-settings/theme-mode', 'App\Http\Controllers\SettingController@themeMode')->name('settings.theme');
    Route::put('/dashboard-settings/privacy-policy/{settings}', 'App\Http\Controllers\SettingController@privacyPolicy')->name('settings.privacy');
    Route::put('/dashboard-settings/terms-conditions/{settings}', 'App\Http\Controllers\SettingController@termsConditions')->name('settings.terms');
    Route::put('/dashboard-settings/status/{settings}', 'App\Http\Controllers\SettingController@siteStatus')->name('settings.status');

    //for menu
    Route::get('/manage-menus/{slug?}', 'App\Http\Controllers\MenuController@index')->name('menu.index');
    Route::post('/create-menu', 'App\Http\Controllers\MenuController@store')->name('menu.store');
    Route::get('/add-page-to-menu','App\Http\Controllers\MenuController@addPage')->name('menu.page');
    Route::get('/add-service-to-menu','App\Http\Controllers\MenuController@addService')->name('menu.service');
    Route::get('add-post-to-menu','App\Http\Controllers\MenuController@addPost')->name('menu.post');
    Route::get('add-custom-link','App\Http\Controllers\MenuController@addCustomLink')->name('menu.custom');
    Route::get('/update-menu','App\Http\Controllers\MenuController@updateMenu')->name('menu.updateMenu');
    Route::post('/update-menuitem/{id}','App\Http\Controllers\MenuController@updateMenuItem')->name('menu.updatemenuitem');
    Route::get('/delete-menuitem/{id}/{key}/{in?}/{inside?}','App\Http\Controllers\MenuController@deleteMenuItem')->name('menu.deletemenuitem');
    Route::get('/delete-menu/{id}','App\Http\Controllers\MenuController@destroy')->name('menu.delete');

    //services
    Route::get('/services', 'App\Http\Controllers\ServiceController@index')->name('services.index');
    Route::get('/services/create', 'App\Http\Controllers\ServiceController@create')->name('services.create');
    Route::post('/services', 'App\Http\Controllers\ServiceController@store')->name('services.store');
    Route::put('/services/{service}', 'App\Http\Controllers\ServiceController@update')->name('services.update');
    Route::delete('/services/{service}', 'App\Http\Controllers\ServiceController@destroy')->name('services.destroy');
    Route::get('/services/{service}/edit', 'App\Http\Controllers\ServiceController@edit')->name('services.edit');

    //career

    Route::get('/career', 'App\Http\Controllers\CareerController@index')->name('career.index');
    Route::get('/career/create', 'App\Http\Controllers\CareerController@create')->name('career.create');
    Route::post('/career', 'App\Http\Controllers\CareerController@store')->name('career.store');
    Route::put('/career/{career}', 'App\Http\Controllers\CareerController@update')->name('career.update');
    Route::delete('/career/{career}', 'App\Http\Controllers\CareerController@destroy')->name('career.destroy');
    Route::get('/career/{career}/edit', 'App\Http\Controllers\CareerController@edit')->name('career.edit');

    //End of Career


    //pages

    Route::get('/pages', 'App\Http\Controllers\PageController@index')->name('pages.index');
    Route::get('/pages/create', 'App\Http\Controllers\PageController@create')->name('pages.create');
    Route::post('/pages', 'App\Http\Controllers\PageController@store')->name('pages.store');
    Route::put('/pages/{pages}', 'App\Http\Controllers\PageController@update')->name('pages.update');
    Route::delete('/pages/{pages}', 'App\Http\Controllers\PageController@destroy')->name('pages.destroy');
    Route::get('/pages/{pages}/edit', 'App\Http\Controllers\PageController@edit')->name('pages.edit');
    Route::patch('/pages/{id}/update', 'App\Http\Controllers\PageController@updateStatus')->name('pages-status.update');

    Route::get('/section-elements/', 'App\Http\Controllers\SectionElementController@index')->name('section-elements.index');
    Route::get('/section-elements/create/{id}', 'App\Http\Controllers\SectionElementController@create')->name('section-elements.create');
    Route::post('/section-elements', 'App\Http\Controllers\SectionElementController@store')->name('section-elements.store');
    Route::put('/section-elements/{elements}', 'App\Http\Controllers\SectionElementController@update')->name('section-elements.update');
    Route::delete('/section-elements/{elements}', 'App\Http\Controllers\SectionElementController@destroy')->name('section-elements.destroy');
    Route::get('/section-elements/{elements}/edit', 'App\Http\Controllers\SectionElementController@edit')->name('section-elements.edit');
    Route::put('/section-elements-upload-gallery/{id}', 'App\Http\Controllers\SectionElementController@uploadGallery')->name('section-elements-gallery.update');
    Route::post('/section-elements/image-delete', 'App\Http\Controllers\SectionElementController@deleteGallery')->name('section-elements-gallery.delete');
    Route::get('/section-elements/gallery/{id}', 'App\Http\Controllers\SectionElementController@getGallery')->name('section-elements-gallery.display');

    Route::put('/section-elements-upload-gallery2/{id}', 'App\Http\Controllers\SectionElementController@uploadGallery2')->name('section-elements-gallery2.update');
    Route::post('/section-elements/image2-delete', 'App\Http\Controllers\SectionElementController@deleteGallery2')->name('section-elements-gallery2.delete');
    Route::get('/section-elements/gallery2/{id}', 'App\Http\Controllers\SectionElementController@getGallery2')->name('section-elements-gallery2.display');
    Route::post('/section-elements/tablist/', 'App\Http\Controllers\SectionElementController@tablistUpdate')->name('section-elements.tablistUpdate');

    //End of pages

    //sliders
    Route::get('/sliders', 'App\Http\Controllers\SliderController@index')->name('sliders.index');
    Route::get('/sliders/create', 'App\Http\Controllers\SliderController@create')->name('sliders.create');
    Route::post('/sliders', 'App\Http\Controllers\SliderController@store')->name('sliders.store');
    Route::put('/sliders/{sliders}', 'App\Http\Controllers\SliderController@update')->name('sliders.update');
    Route::delete('/sliders/{sliders}', 'App\Http\Controllers\SliderController@destroy')->name('sliders.destroy');
    Route::get('/sliders/{sliders}/edit', 'App\Http\Controllers\SliderController@edit')->name('sliders.edit');
    Route::patch('/sliders/{id}/update', 'App\Http\Controllers\SliderController@updateStatus')->name('sliders-status.update');
    //End sliders

    Route::get('/clients', 'App\Http\Controllers\ClientController@index')->name('clients.index');
    Route::get('/clients/create', 'App\Http\Controllers\ClientController@create')->name('clients.create');
    Route::post('/clients', 'App\Http\Controllers\ClientController@store')->name('clients.store');
    Route::put('/clients/{clients}', 'App\Http\Controllers\ClientController@update')->name('clients.update');
    Route::delete('/clients/{clients}', 'App\Http\Controllers\ClientController@destroy')->name('clients.destroy');
    Route::get('/clients/{clients}/edit', 'App\Http\Controllers\ClientController@edit')->name('clients.edit');

    Route::get('/success-trail', 'App\Http\Controllers\SuccessTrailController@index')->name('success_trail.index');
    Route::get('/success-trail/create', 'App\Http\Controllers\SuccessTrailController@create')->name('success_trail.create');
    Route::post('/success-trail', 'App\Http\Controllers\SuccessTrailController@store')->name('success_trail.store');
    Route::put('/success-trail/{success}', 'App\Http\Controllers\SuccessTrailController@update')->name('success_trail.update');
    Route::delete('/success-trail/{success}', 'App\Http\Controllers\SuccessTrailController@destroy')->name('success_trail.destroy');
    Route::get('/success-trail/{success}/edit', 'App\Http\Controllers\SuccessTrailController@edit')->name('success_trail.edit');


    Route::get('/subsidiaries', 'App\Http\Controllers\SubsidiaryController@index')->name('subsidiary.index');
    Route::get('/subsidiaries/create', 'App\Http\Controllers\SubsidiaryController@create')->name('subsidiary.create');
    Route::post('/subsidiaries', 'App\Http\Controllers\SubsidiaryController@store')->name('subsidiary.store');
    Route::put('/subsidiaries/{subsidiary}', 'App\Http\Controllers\SubsidiaryController@update')->name('subsidiary.update');
    Route::delete('/subsidiaries/{subsidiary}', 'App\Http\Controllers\SubsidiaryController@destroy')->name('subsidiary.destroy');
    Route::get('/subsidiaries/{subsidiary}/edit', 'App\Http\Controllers\SubsidiaryController@edit')->name('subsidiary.edit');

    //job categories

    Route::get('/job-category', 'App\Http\Controllers\JobCategoryController@index')->name('jobcategory.index');
    Route::get('/job-category/create', 'App\Http\Controllers\JobCategoryController@create')->name('jobcategory.create');
    Route::post('/job-category', 'App\Http\Controllers\JobCategoryController@store')->name('jobcategory.store');
    Route::put('/job-category/{category}', 'App\Http\Controllers\JobCategoryController@update')->name('jobcategory.update');
    Route::delete('/job-category/{category}', 'App\Http\Controllers\JobCategoryController@destroy')->name('jobcategory.destroy');
    Route::get('/job-category/{category}/edit', 'App\Http\Controllers\JobCategoryController@edit')->name('jobcategory.edit');

    //End of job categories

    //course

    Route::get('/course', 'App\Http\Controllers\CourseController@index')->name('course.index');
    Route::get('/course/create', 'App\Http\Controllers\CourseController@create')->name('course.create');
    Route::post('/course', 'App\Http\Controllers\CourseController@store')->name('course.store');
    Route::put('/course/{course}', 'App\Http\Controllers\CourseController@update')->name('course.update');
    Route::delete('/course/{course}', 'App\Http\Controllers\CourseController@destroy')->name('course.destroy');
    Route::get('/course/{course}/edit', 'App\Http\Controllers\CourseController@edit')->name('course.edit');
    Route::patch('/course/{id}/update', 'App\Http\Controllers\CourseController@updateStatus')->name('course-status.update');

    //End course

    //test preparations

    Route::get('/test-preparation', 'App\Http\Controllers\TestPreparationController@index')->name('test-preparation.index');
    Route::get('/test-preparation/create', 'App\Http\Controllers\TestPreparationController@create')->name('test-preparation.create');
    Route::post('/test-preparation', 'App\Http\Controllers\TestPreparationController@store')->name('test-preparation.store');
    Route::put('/test-preparation/{id}', 'App\Http\Controllers\TestPreparationController@update')->name('test-preparation.update');
    Route::delete('/test-preparation/{test-preparation}', 'App\Http\Controllers\TestPreparationController@destroy')->name('test-preparation.destroy');
    Route::get('/test-preparation/{id}/edit', 'App\Http\Controllers\TestPreparationController@edit')->name('test-preparation.edit');
    Route::patch('/test-preparation/{id}/update', 'App\Http\Controllers\TestPreparationController@updateStatus')->name('test-preparation-status.update');

    //End course

    //jobs

    Route::get('/jobs', 'App\Http\Controllers\JobController@index')->name('job.index');
    Route::get('/jobs/create', 'App\Http\Controllers\JobController@create')->name('job.create');
    Route::post('/jobs', 'App\Http\Controllers\JobController@store')->name('job.store');
    Route::put('/jobs/{jobs}', 'App\Http\Controllers\JobController@update')->name('job.update');
    Route::delete('/jobs/{jobs}', 'App\Http\Controllers\JobController@destroy')->name('job.destroy');
    Route::get('/jobs/{jobs}/edit', 'App\Http\Controllers\JobController@edit')->name('job.edit');
    Route::patch('/jobs/{id}/update', 'App\Http\Controllers\JobController@updateStatus')->name('job-status.update');

    //End jobs

    //Testimonial
    Route::get('/testimonials', 'App\Http\Controllers\TestimonialController@index')->name('testimonials.index');
    Route::get('/testimonials/create', 'App\Http\Controllers\TestimonialController@create')->name('testimonials.create');
    Route::post('/testimonials', 'App\Http\Controllers\TestimonialController@store')->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', 'App\Http\Controllers\TestimonialController@update')->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', 'App\Http\Controllers\TestimonialController@destroy')->name('testimonials.destroy');
    Route::get('/testimonials/{testimonial}/edit', 'App\Http\Controllers\TestimonialController@edit')->name('testimonials.edit');

    //service category

    Route::get('/service-category', 'App\Http\Controllers\ServiceCategoryController@index')->name('service-category.index');
    Route::get('/service-category/create', 'App\Http\Controllers\ServiceCategoryController@create')->name('service-category.create');
    Route::post('/service-category', 'App\Http\Controllers\ServiceCategoryController@store')->name('service-category.store');
    Route::put('/service-category/{servicecat}', 'App\Http\Controllers\ServiceCategoryController@update')->name('service-category.update');
    Route::delete('/service-category/{servicecat}', 'App\Http\Controllers\ServiceCategoryController@destroy')->name('service-category.destroy');
    Route::get('/service-category/{servicecat}/edit', 'App\Http\Controllers\ServiceCategoryController@edit')->name('service-category.edit');

    //End of service category

    //recruitment process

    Route::get('/recruitment-process', 'App\Http\Controllers\RecruitmentProcessController@index')->name('recruitment.index');
    Route::get('/recruitment-process/create', 'App\Http\Controllers\RecruitmentProcessController@create')->name('recruitment.create');
    Route::post('/recruitment-process', 'App\Http\Controllers\RecruitmentProcessController@store')->name('recruitment.store');
    Route::put('/recruitment-process/{recruitment}', 'App\Http\Controllers\RecruitmentProcessController@update')->name('recruitment.update');
    Route::delete('/recruitment-process/{recruitment}', 'App\Http\Controllers\RecruitmentProcessController@destroy')->name('recruitment.destroy');
    Route::get('/recruitment-process/{recruitment}/edit', 'App\Http\Controllers\RecruitmentProcessController@edit')->name('recruitment.edit');
    Route::post('/recruitment-process/listUpdate/', 'App\Http\Controllers\RecruitmentProcessController@listUpdate')->name('recruitment.listUpdate');

    //end of process

    //teams

    Route::get('/teams', 'App\Http\Controllers\TeamController@index')->name('teams.index');
    Route::get('/teams/create', 'App\Http\Controllers\TeamController@create')->name('teams.create');
    Route::post('/teams', 'App\Http\Controllers\TeamController@store')->name('teams.store');
    Route::put('/teams/{teams}', 'App\Http\Controllers\TeamController@update')->name('teams.update');
    Route::delete('/teams/{teams}', 'App\Http\Controllers\TeamController@destroy')->name('teams.destroy');
    Route::get('/teams/{teams}/edit', 'App\Http\Controllers\TeamController@edit')->name('teams.edit');
    Route::post('/teams-sortable','App\Http\Controllers\TeamController@orderUpdate')->name('teams.order');

    //End of teams

    //Managing director

    Route::get('/managing-director', 'App\Http\Controllers\ManagingDirectorController@index')->name('managing-director.index');
    Route::get('/managing-director/create', 'App\Http\Controllers\ManagingDirectorController@create')->name('managing-director.create');
    Route::post('/managing-director', 'App\Http\Controllers\ManagingDirectorController@store')->name('managing-director.store');
    Route::put('/managing-director/{director}', 'App\Http\Controllers\ManagingDirectorController@update')->name('managing-director.update');
    Route::delete('/managing-director/{director}', 'App\Http\Controllers\ManagingDirectorController@destroy')->name('managing-director.destroy');
    Route::get('/managing-director/{director}/edit', 'App\Http\Controllers\ManagingDirectorController@edit')->name('managing-director.edit');
    Route::post('/director-sortable','App\Http\Controllers\ManagingDirectorController@orderUpdateDirector')->name('director.order');

    //End of managing director

    //Album
    Route::get('/album', 'App\Http\Controllers\AlbumController@index')->name('album.index');
    Route::get('/album/create', 'App\Http\Controllers\AlbumController@create')->name('album.create');
    Route::post('/album', 'App\Http\Controllers\AlbumController@store')->name('album.store');
    Route::put('/album/{album}', 'App\Http\Controllers\AlbumController@update')->name('album.update');
    Route::delete('/album/{album}', 'App\Http\Controllers\AlbumController@destroy')->name('album.destroy');
    Route::get('/album/{album}/edit', 'App\Http\Controllers\AlbumController@edit')->name('album.edit');
    Route::get('/album/show/{id}', 'App\Http\Controllers\AlbumController@show')->name('album.show');
    Route::put('/album-upload-gallery/{id}', 'App\Http\Controllers\AlbumController@uploadGallery')->name('album-gallery.update');
    Route::post('/album-gallery/image-delete', 'App\Http\Controllers\AlbumController@deleteGallery')->name('album-gallery.delete');
    Route::get('/album-gallery/{id}', 'App\Http\Controllers\AlbumController@getGallery')->name('album-gallery.display');
    //End of Album


    Route::get('/video-gallery', 'App\Http\Controllers\VideoGalleryController@index')->name('video.index');
    Route::get('/video-gallery/create', 'App\Http\Controllers\VideoGalleryController@create')->name('video.create');
    Route::post('/video-gallery', 'App\Http\Controllers\VideoGalleryController@store')->name('video.store');
    Route::put('/video-gallery/{video}', 'App\Http\Controllers\VideoGalleryController@update')->name('video.update');
    Route::delete('/video/{teams}', 'App\Http\Controllers\VideoGalleryController@destroy')->name('video.destroy');
    Route::get('/video-gallery/{video}/edit', 'App\Http\Controllers\VideoGalleryController@edit')->name('video.edit');
    Route::post('/video-gallery/update/gallery', 'App\Http\Controllers\VideoGalleryController@videoUpdate')->name('video.galleryUpdate');

});


Route::get('/{page}', 'App\Http\Controllers\FrontController@page')
    ->name('page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
