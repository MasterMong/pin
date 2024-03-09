<?php

namespace App\Filament\Pages\Auth;

use App\Http\Controllers\SettingController;
use App\Models\Area;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;

class Register extends \Filament\Pages\Auth\Register
{
    public function form(Form $form): Form
    {
        $areas = Area::get()->pluck('name', 'id');
        return $form
            ->schema([
                $this->getNameFormComponent()->label('ชื่อ'),
                $this->getEmailFormComponent()->label('email'),
                TextInput::make('tel')->label('หมายเลขโทรศัพท์')->required(),
                Select::make('area_id')
                    ->options($areas)
                    ->searchable()
                    ->label('สำนักงานเขต')
                    ->required(),
                Group::make()->schema([
                    $this->getPasswordFormComponent()->label('รหัสผ่าน'),
                    $this->getPasswordConfirmationFormComponent()->label('ยืนยันรหัสผ่าน'),
                ])->columns(2),
                TextInput::make('secrect_code')
                    ->label('รหัสสำหรับสมัคร')
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $regis_token = SettingController::getSetting('regis_token');
        $data = $this->form->getState();

        if ($regis_token == $data['secrect_code']) {

            $user = $this->getUserModel()::create($data);

            event(new Registered($user));

            $this->sendEmailVerificationNotification($user);

            Filament::auth()->login($user);

            session()->regenerate();

            return app(RegistrationResponse::class);
        } else {
            Notification::make()
                ->title('ล้มเหลว')
                ->body('รหัสสำหรับสมัครไม่ถูกต้อง')
                ->danger()
                ->send();

            return null;
        }
    }
}
