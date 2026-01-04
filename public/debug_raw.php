<?php
echo "<h1>Azure Environment Debug</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<h2>Environment Variables</h2>";
echo "<pre>";
print_r($_ENV);
echo "</pre>";
echo "<h2>Server Variables</h2>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
