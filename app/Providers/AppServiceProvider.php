<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\pengajuan_cuti;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer('*', function ($view) {
        //     if (Auth::check()) {
        //         if (Auth::user()->hasRole('admin')) {
        //             // Untuk admin: ambil pengajuan cuti yang masih menunggu
        //             $cutiNotif = pengajuan_cuti::where('status', 'menunggu')->get();
        //         } else {
        //             // Untuk user: ambil pengajuan cuti milik dia yang sudah diproses
        //             $cutiNotif = pengajuan_cuti::where('id_user', Auth::id())
        //                 ->whereIn('status', ['menyetujui', 'tidak_menyetujui'])
        //                 ->get();
        //         }

        //         $view->with('cutiNotif', $cutiNotif);
        //     }
        // });

        // Kirim data notifikasi meeting ke semua view
        View::share('meetNotification', pengajuan_cuti::where('status', 'menunggu')->get());

    }
}
