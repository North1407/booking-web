protected $routeMiddleware = [
// ...existing middleware...
'auth' => \App\Http\Middleware\Authenticate::class,
];