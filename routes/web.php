<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\UserUpdateInforProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\Account\AdminGroupPermissionController;
use App\Http\Controllers\Backend\Account\AdminPermissionController;
use App\Http\Controllers\Backend\Account\AdminRoleController;
use App\Http\Controllers\Backend\Account\AdminUserController;
use App\Http\Controllers\Backend\AdminAuthorController;
use App\Http\Controllers\Backend\AdminBookController;
use App\Http\Controllers\Backend\AdminBorrowController;
use App\Http\Controllers\Backend\AdminCategoryController;
use App\Http\Controllers\Backend\AdminClassController;
use App\Http\Controllers\Backend\AdminDepartmentController;
use App\Http\Controllers\Backend\AdminImportBookController;
use App\Http\Controllers\Backend\AdminPublishingCompanyController;
use App\Http\Controllers\Backend\AdminReaderController;

Route::namespace('Auth')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/', [LoginController::class, 'postLogin']);
    Route::get('logout', [LoginController::class, 'logoutUser'])->name('logout');

    Route::get('/update-info-profile', [UserUpdateInforProfileController::class, 'userUpdateInfo'])->name('update.info.profile');
    Route::post('/update-info-profile', [UserUpdateInforProfileController::class, 'updateInfoUser']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'postForgotPassword']);

    Route::get('change-forgot-password/{token}', [ForgotPasswordController::class, 'changePassword'])->name('change.forgot.password');
    Route::post('change-forgot-password/{token}', [ForgotPasswordController::class, 'postChangePassword']);
});
Route::prefix('library-manager')->namespace('Backend')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/check-book', [AdminDashboardController::class, 'checkBook'])->name('admin.check.book');

    Route::prefix('system-management')->namespace('Account')->group(function () {
        // Quản lý nhóm quyền
        Route::prefix('group-permission')->group(function () {
            Route::get('/', [AdminGroupPermissionController::class, 'index'])->name('get.list.group-permission');
            Route::get('/create', [AdminGroupPermissionController::class, 'create'])->name('get.create.group-permission');
            Route::post('/create', [AdminGroupPermissionController::class, 'store']);

            Route::get('/update/{id}', [AdminGroupPermissionController::class, 'edit'])->name('get.update.group-permission');
            Route::post('/update/{id}', [AdminGroupPermissionController::class, 'update']);

            Route::get('/delete/{id}', [AdminGroupPermissionController::class, 'delete'])->name('get.delete.group-permission');
        });

        // Quản lý quyền
        Route::prefix('permission')->group(function () {
            Route::get('/', [AdminPermissionController::class, 'index'])->name('get.list.permission');
            Route::get('/create', [AdminPermissionController::class, 'create'])->name('get.create.permission');
            Route::post('/create', [AdminPermissionController::class, 'store']);

            Route::get('/update/{id}', [AdminPermissionController::class, 'edit'])->name('get.update.permission');
            Route::post('/update/{id}', [AdminPermissionController::class, 'update']);

            Route::get('/delete/{id}', [AdminPermissionController::class, 'delete'])->name('get.delete.permission');
        });
        Route::prefix('role')->middleware('permission:toan-quyen-quan-ly|danh-sach-vai-tro')->group(function () {
            Route::get('/', [AdminRoleController::class, 'index'])->name('get.list.role');
            Route::get('/create', [AdminRoleController::class, 'create'])->name('get.create.role');
            Route::post('/create', [AdminRoleController::class, 'store']);

            Route::get('/update/{id}', [AdminRoleController::class, 'edit'])->name('get.update.role');
            Route::post('/update/{id}', [AdminRoleController::class, 'update']);

            Route::get('/delete/{id}', [AdminRoleController::class, 'delete'])->name('get.delete.role');
        });

        Route::prefix('user')->middleware('permission:toan-quyen-quan-ly|danh-sach-nguoi-dung')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('get.list.user');
            Route::get('/create', [AdminUserController::class, 'create'])->name('get.create.user');
            Route::post('/create', [AdminUserController::class, 'store']);

            Route::get('/update/{id}', [AdminUserController::class, 'edit'])->name('get.update.user');
            Route::post('/update/{id}', [AdminUserController::class, 'update']);

            Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('get.delete.user');

            Route::get('/account', [AdminUserController::class, 'account'])->name('get.account.info');
            Route::post('/account/update/{id}', [AdminUserController::class, 'updateAccount'])->name('update.account');

            Route::get('/change/password', [AdminUserController::class, 'changePassword'])->name('change.password');
            Route::post('/password/change', [AdminUserController::class, 'postChangePassword'])->name('post.change.password');
        });

    });
    Route::prefix('department')->middleware('permission:toan-quyen-quan-ly|danh-sach-khoi-lop')->group(function () {
        Route::get('/', [AdminDepartmentController::class, 'index'])->name('get.list.department');
        Route::get('/create', [AdminDepartmentController::class, 'create'])->name('get.create.department');
        Route::post('/create', [AdminDepartmentController::class, 'store']);

        Route::get('/update/{id}', [AdminDepartmentController::class, 'edit'])->name('get.update.department');
        Route::post('/update/{id}', [AdminDepartmentController::class, 'update']);

        Route::get('/delete/{id}', [AdminDepartmentController::class, 'delete'])->name('get.delete.department');
    });

    Route::prefix('class')->middleware('permission:toan-quyen-quan-ly|danh-sach-lop')->group(function () {
        Route::get('/', [AdminClassController::class, 'index'])->name('get.list.class');
        Route::get('/create', [AdminClassController::class, 'create'])->name('get.create.class');
        Route::post('/create', [AdminClassController::class, 'store']);

        Route::get('/update/{id}', [AdminClassController::class, 'edit'])->name('get.update.class');
        Route::post('/update/{id}', [AdminClassController::class, 'update']);

        Route::get('/delete/{id}', [AdminClassController::class, 'delete'])->name('get.delete.class');
    });
    Route::prefix('reader')->middleware('permission:toan-quyen-quan-ly|danh-sach-nguoi-doc')->group(function () {
        Route::get('/', [AdminReaderController::class, 'index'])->name('get.list.reader');
        Route::get('/create', [AdminReaderController::class, 'create'])->name('get.create.reader');
        Route::post('/create', [AdminReaderController::class, 'store']);

        Route::get('/update/{id}', [AdminReaderController::class, 'edit'])->name('get.update.reader');
        Route::post('/update/{id}', [AdminReaderController::class, 'update']);
        Route::get('/delete/{id}', [AdminReaderController::class, 'delete'])->name('get.delete.reader');
        Route::post('/preview_card/{id}', [AdminReaderController::class, 'previewCard'])->name('get.preview.card');
        Route::get('list/reader/book/{id}', [AdminReaderController::class, 'readerBook'])->name('get.list.reader.book')->middleware('permission:toan-quyen-quan-ly|quan-ly-danh-sach-muon-sach');
    });

    Route::prefix('author')->middleware('permission:toan-quyen-quan-ly|danh-sach-tac-gia')->group(function () {
        Route::get('/', [AdminAuthorController::class, 'index'])->name('get.list.author');
        Route::get('/create', [AdminAuthorController::class, 'create'])->name('get.create.author');
        Route::post('/create', [AdminAuthorController::class, 'store']);

        Route::get('/update/{id}', [AdminAuthorController::class, 'edit'])->name('get.update.author');
        Route::post('/update/{id}', [AdminAuthorController::class, 'update']);
        Route::get('/delete/{id}', [AdminAuthorController::class, 'delete'])->name('get.delete.author');
    });

    Route::prefix('category')->middleware('permission:toan-quyen-quan-ly|danh-sach-danh-muc')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('get.list.category');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('get.create.category');
        Route::post('/create', [AdminCategoryController::class, 'store']);

        Route::get('/update/{id}', [AdminCategoryController::class, 'edit'])->name('get.update.category');
        Route::post('/update/{id}', [AdminCategoryController::class, 'update']);
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('get.delete.category');
    });
    Route::prefix('publishing_company')->middleware('permission:toan-quyen-quan-ly|danh-sach-nha-xuat-ban')->group(function () {
        Route::get('/', [AdminPublishingCompanyController::class, 'index'])->name('get.list.publishing_company');
        Route::get('/create', [AdminPublishingCompanyController::class, 'create'])->name('get.create.publishing_company');
        Route::post('/create', [AdminPublishingCompanyController::class, 'store']);

        Route::get('/update/{id}', [AdminPublishingCompanyController::class, 'edit'])->name('get.update.publishing_company');
        Route::post('/update/{id}', [AdminPublishingCompanyController::class, 'update']);
        Route::get('/delete/{id}', [AdminPublishingCompanyController::class, 'delete'])->name('get.delete.publishing_company');
    });

    Route::prefix('book')->middleware('permission:toan-quyen-quan-ly|danh-sach-sach')->group(function () {
        Route::get('/', [AdminBookController::class, 'index'])->name('get.list.book');
        Route::get('/create', [AdminBookController::class, 'create'])->name('get.create.book');
        Route::post('/create', [AdminBookController::class, 'store']);

        Route::get('/update/{id}', [AdminBookController::class, 'edit'])->name('get.update.book');
        Route::post('/update/{id}', [AdminBookController::class, 'update']);
        Route::get('/delete/{id}', [AdminBookController::class, 'delete'])->name('get.delete.book');
    });

    Route::prefix('import_books')->middleware('permission:toan-quyen-quan-ly|nhap-sach')->group(function () {
        Route::get('/{id}', [AdminImportBookController::class, 'index'])->name('get.list.import_books');
        Route::post('/post/create/{id}', [AdminImportBookController::class, 'store'])->name('post.create.import_books');
        Route::get('/delete/{id}', [AdminImportBookController::class, 'delete'])->name('get.delete.import_books');
    });

    Route::prefix('borrow')->middleware('permission:toan-quyen-quan-ly|danh-sach-muon-sach')->group(function () {
        Route::get('/', [AdminBorrowController::class, 'index'])->name('get.list.borrow');
        Route::get('/create', [AdminBorrowController::class, 'create'])->name('get.create.borrow');
        Route::post('/create', [AdminBorrowController::class, 'store']);

        Route::get('/update/{id}', [AdminBorrowController::class, 'edit'])->name('get.update.borrow');
        Route::post('/update/{id}', [AdminBorrowController::class, 'update']);
        Route::get('/delete/{id}', [AdminBorrowController::class, 'delete'])->name('get.delete.borrow');
        Route::get('/add/row/table', [AdminBorrowController::class, 'ajaxAddRow'])->name('add.row.book');
        Route::get('/ajax/view/{id}', [AdminBorrowController::class, 'ajaxViewBorrow'])->name('get.ajax.view');
        Route::get('/delete/orders/{id}', [AdminBorrowController::class, 'deleteOrders'])->name('get.delete.orders')->middleware('permission:toan-quyen-quan-ly|xoa-lich-su-muon-sach');
    });
    Route::prefix('list/borrow/book')->middleware('permission:toan-quyen-quan-ly|danh-sach-thong-tin-muon-sach')->group(function () {
        Route::get('/', [AdminBorrowController::class, 'listBorrowBook'])->name('get.list.borrow.book');
    });
});
