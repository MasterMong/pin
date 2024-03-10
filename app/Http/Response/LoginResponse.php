<?php
namespace App\Http\Response;

use App\Filament\Customer\Resources\MyOrdersResource;
use App\Filament\Resources\OrderResource;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // You can use the Filament facade to get the current panel and check the ID
//        if (Filament::getCurrentPanel()->getId() === 'admin') {
//            return redirect()->to(\App\Filament\Admin\Resources\AreaResource::getUrl('index'));
//        }
//
//        if (Filament::getCurrentPanel()->getId() === 'app') {
//            return redirect()->to(\App\Filament\Resources\ActivityResource::getUrl('index'));
//        }
        if (auth()->user()->role == 'admin') {
            return redirect()->route('filament.admin.pages.dashboard');
        }
        if (auth()->user()->role == 'area') {
            return redirect()->route('filament.app.pages.home');
        }

        return parent::toResponse($request);
    }
}
