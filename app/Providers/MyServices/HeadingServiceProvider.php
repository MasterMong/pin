<?php

namespace App\Providers\MyServices;

use Illuminate\Support\ServiceProvider;

use Orchid\Screen\Layout;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;

LayoutFactory::macro('heading', function (string $message, string $type) {
    return new class($message, $type) extends Layout
    {
        /**
         * @ string
         */
        public $message;
        public $type;

        /**
         * Heading constructor.
         *
         * @param string $message
         */
        public function __construct(string $message, string $type)
        {
            $this->message = $message;
            $this->type = $type;
        }

        /**
         * @param Repository $repository
         *
         * @return mixed
         */
        public function build(Repository $repository)
        {
            // return view('Services.heading')->with('message', $this->message, 'type', $this->type);
            return view('Services.heading')->with(['message' => $this->message, 'type' => $this->type]);
        }

    };
});

class HeadingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
