<?php
/**
 * Route Testing Script
 * Upload this file to your public folder and access it via browser
 * URL: https://chapakhana.notesofshahriar.com/test-routes.php
 */

// Load Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "<!DOCTYPE html>";
echo "<html><head><title>Route Test - Chapakhana</title>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
    .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    h1 { color: #2563eb; }
    .success { color: #059669; background: #d1fae5; padding: 10px; border-radius: 4px; margin: 10px 0; }
    .error { color: #dc2626; background: #fee2e2; padding: 10px; border-radius: 4px; margin: 10px 0; }
    .info { color: #0284c7; background: #e0f2fe; padding: 10px; border-radius: 4px; margin: 10px 0; }
    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
    th { background: #f3f4f6; font-weight: 600; }
    .route-name { font-family: monospace; color: #7c3aed; }
    .route-uri { font-family: monospace; color: #059669; }
    .route-method { font-family: monospace; color: #dc2626; font-weight: bold; }
</style>";
echo "</head><body>";
echo "<div class='container'>";
echo "<h1>🔍 Route Testing - Chapakhana</h1>";

try {
    // Get all routes
    $routes = Route::getRoutes();
    
    echo "<div class='success'>✓ Laravel loaded successfully!</div>";
    
    // Check for orders routes
    $ordersRoutes = [];
    foreach ($routes as $route) {
        $uri = $route->uri();
        if (strpos($uri, 'orders') !== false) {
            $ordersRoutes[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $uri,
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        }
    }
    
    if (count($ordersRoutes) > 0) {
        echo "<div class='success'>✓ Found " . count($ordersRoutes) . " orders route(s)!</div>";
        
        echo "<h2>Orders Routes:</h2>";
        echo "<table>";
        echo "<tr><th>Method</th><th>URI</th><th>Name</th><th>Controller</th></tr>";
        
        foreach ($ordersRoutes as $route) {
            echo "<tr>";
            echo "<td class='route-method'>" . htmlspecialchars($route['method']) . "</td>";
            echo "<td class='route-uri'>/" . htmlspecialchars($route['uri']) . "</td>";
            echo "<td class='route-name'>" . htmlspecialchars($route['name'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($route['action']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<div class='error'>✗ No orders routes found!</div>";
        echo "<div class='info'>This means the routes are not registered. Run: php artisan route:cache</div>";
    }
    
    // Check if UserOrderController exists
    echo "<h2>Controller Check:</h2>";
    if (class_exists('App\Http\Controllers\UserOrderController')) {
        echo "<div class='success'>✓ UserOrderController exists</div>";
    } else {
        echo "<div class='error'>✗ UserOrderController not found</div>";
    }
    
    // Check if Order model exists
    if (class_exists('App\Models\Order')) {
        echo "<div class='success'>✓ Order model exists</div>";
    } else {
        echo "<div class='error'>✗ Order model not found</div>";
    }
    
    // Check if OrderItem model exists
    if (class_exists('App\Models\OrderItem')) {
        echo "<div class='success'>✓ OrderItem model exists</div>";
    } else {
        echo "<div class='error'>✗ OrderItem model not found</div>";
    }
    
    // Check views
    echo "<h2>View Check:</h2>";
    $viewPath1 = resource_path('views/orders/index.blade.php');
    $viewPath2 = resource_path('views/orders/show.blade.php');
    
    if (file_exists($viewPath1)) {
        echo "<div class='success'>✓ orders/index.blade.php exists</div>";
    } else {
        echo "<div class='error'>✗ orders/index.blade.php not found</div>";
    }
    
    if (file_exists($viewPath2)) {
        echo "<div class='success'>✓ orders/show.blade.php exists</div>";
    } else {
        echo "<div class='error'>✗ orders/show.blade.php not found</div>";
    }
    
    // Environment info
    echo "<h2>Environment Info:</h2>";
    echo "<div class='info'>";
    echo "Laravel Version: " . app()->version() . "<br>";
    echo "PHP Version: " . PHP_VERSION . "<br>";
    echo "Environment: " . app()->environment() . "<br>";
    echo "Debug Mode: " . (config('app.debug') ? 'Enabled' : 'Disabled') . "<br>";
    echo "</div>";
    
    // Recommendations
    echo "<h2>Recommendations:</h2>";
    echo "<div class='info'>";
    echo "<strong>If routes are not showing:</strong><br>";
    echo "1. Run: <code>php artisan route:clear</code><br>";
    echo "2. Run: <code>php artisan route:cache</code><br>";
    echo "3. Run: <code>php artisan config:cache</code><br>";
    echo "4. Check that routes/auth.php is included in routes/web.php<br>";
    echo "<br>";
    echo "<strong>If controllers/models are missing:</strong><br>";
    echo "1. Run: <code>composer dump-autoload</code><br>";
    echo "2. Make sure all files are uploaded to server<br>";
    echo "<br>";
    echo "<strong>If views are missing:</strong><br>";
    echo "1. Upload resources/views/orders/ folder to server<br>";
    echo "2. Run: <code>php artisan view:clear</code><br>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>";
    echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<strong>File:</strong> " . htmlspecialchars($e->getFile()) . "<br>";
    echo "<strong>Line:</strong> " . $e->getLine();
    echo "</div>";
}

echo "<hr>";
echo "<p style='color: #6b7280; font-size: 14px;'>Test completed at " . date('Y-m-d H:i:s') . "</p>";
echo "<p style='color: #6b7280; font-size: 14px;'><strong>Important:</strong> Delete this file after testing for security!</p>";
echo "</div>";
echo "</body></html>";
