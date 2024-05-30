<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            
            'auth' => [
                'user' => $request->user(),
                'permissions' => $request->user() ? $request->user()->getPermissionArray() : [],
                'isSuperAdmin' => $request->user() ? $request->user()->hasRole('superadmin') : false,
                'role' => $request->user() ? $request->user()->getRoleNames()->first() : '-',
            ],
             'flashMessage' => [
                'success' => $request->session()->get('success'),
                  'error' => $request->session()->get('error'),
            ],
            'app' => [
                'name' => config('app.name'),
                'perpage' => [
                    ['label' => '5', 'value' => 5],
                    ['label' => '10', 'value' => 10],
                    ['label' => '20', 'value' => 20],
                    ['label' => '50', 'value' => 50],
                    ['label' => '100', 'value' => 100],
                ],
            ],
            'locale' => function () {                
                if(session()->has('locale')) {
                    app()->setLocale(session('locale'));
                }
                return app()->getLocale();
            },
            'language' => function () {
                $lang = __('app');
                return response()->json($lang);
            },
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
