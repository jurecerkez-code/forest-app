@"
<!DOCTYPE html>
<html>
<body>
    <h1>Blade Test</h1>
    <p>2 + 2 = {{ 2 + 2 }}</p>
    <p>Current time: {{ now() }}</p>
</body>
</html>
"@ | Out-File -FilePath "resources/views/blade-test.blade.php" -Encoding utf8
