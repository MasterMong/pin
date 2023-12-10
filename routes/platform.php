<?php

declare (strict_types = 1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\PostEditScreen;
use App\Orchid\Screens\PostListScreen;
use App\Orchid\Screens\Profile\ProfileAreaScreen;
use App\Orchid\Screens\Report\ReportStartegyYear;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Startegy\StartegyFormContexScreen;
use App\Orchid\Screens\Startegy\StartegyFormProjectScreen;
use App\Orchid\Screens\Startegy\StartegyMapScreen;
use App\Orchid\Screens\Startegy\StartegyProjectScreen;
use App\Orchid\Screens\Startegy\StartegyScreen;
use App\Orchid\Screens\StateScreen;
use App\Orchid\Screens\TaskScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
 */

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

Route::prefix('/profile')->name('profile.')->group(function () {
    // Profile
    Route::screen('/account', UserProfileScreen::class)
        ->name('account')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Profile'), route('profile.account')));

    Route::screen('/area', ProfileAreaScreen::class)
        ->name('area')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push("ปรับปรุงข้อมูล สพท", route('profile.area')));
});

Route::prefix('/users')->name('users.')->group(function () {
    // Users > User
    Route::screen('users/{user}/edit', UserEditScreen::class)
        ->name('edit')
        ->breadcrumbs(fn(Trail $trail, $user) => $trail
                ->parent('users.users')
                ->push($user->name, route('users.edit', $user)));

    // Users > Create
    Route::screen('users/create', UserEditScreen::class)
        ->name('create')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('users.users')
                ->push(__('Create'), route('users.create')));

    // Users
    Route::screen('users', UserListScreen::class)
        ->name('users')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Users'), route('users.users')));
});

Route::prefix('/startegy')->name('startegy.')->group(function () {
    Route::screen('/main', StartegyScreen::class)
        ->name('index')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push("แผนการดำเนินงาน", route('startegy.index')));
    Route::screen('/map', StartegyMapScreen::class)
        ->name('map')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('startegy.index')
                ->push("Startegy map", route('startegy.map')));
    Route::screen('/project', StartegyProjectScreen::class)
        ->name('project')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('startegy.index')
                ->push("โครงการ", route('startegy.project')));
    Route::screen('/contex/form', StartegyFormContexScreen::class)
        ->name('contex.form')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('startegy.index')
                ->push("สภาพบริบท/แนวทางพัฒนาเชิงกลยุทธ์", route('startegy.contex.form')));
    Route::screen('/project/form', StartegyFormProjectScreen::class)
        ->name('project.form')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('startegy.index')
                ->push("โครงการ", route('startegy.project.form')));
    Route::screen('/report', ReportStartegyYear::class)
        ->name('report')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push("รายงานผลการดำเนินงาน รอบ 12 เดือน", route('startegy.report')));
});

Route::prefix('/roles')->name('roles.')->group(function () {
    // Platform > System > Roles > Role
    Route::screen('roles/{role}/edit', RoleEditScreen::class)
        ->name('edit')
        ->breadcrumbs(fn(Trail $trail, $role) => $trail
                ->parent('roles.roles')
                ->push($role->name, route('roles.edit', $role)));

    // Platform > System > Roles > Create
    Route::screen('roles/create', RoleEditScreen::class)
        ->name('create')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('roles')
                ->push(__('Create'), route('roles.create')));

    // Platform > System > Roles
    Route::screen('roles', RoleListScreen::class)
        ->name('roles')
        ->breadcrumbs(fn(Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Roles'), route('roles.roles')));
});

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');

Route::screen('task', TaskScreen::class)
    ->name('platform.task')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Task');
    });

Route::screen('state', StateScreen::class)->name('state');
Route::screen('post/{post?}', PostEditScreen::class)
    ->name('platform.post.edit');

Route::screen('posts', PostListScreen::class)
    ->name('platform.post.list');
