<?php

// Script untuk mengganti semua translation calls ke namespace messages
$viewsDir = __DIR__ . '/resources/views';

function replaceInFile($filePath) {
    if (!file_exists($filePath)) {
        echo "File not found: $filePath\n";
        return;
    }
    
    $content = file_get_contents($filePath);
    if ($content === false) {
        echo "Failed to read: $filePath\n";
        return;
    }
    
    // Ganti semua __('key') menjadi __('messages.key') kecuali yang sudah ada messages.
    $pattern = "/\{\{\s*__\('([^']+)'\)\s*\}\}/";
    $replacement = function($matches) {
        $key = $matches[1];
        // Skip jika sudah menggunakan namespace messages
        if (strpos($key, 'messages.') === 0) {
            return $matches[0];
        }
        return "{{ __('messages." . $key . "') }}";
    };
    
    $newContent = preg_replace_callback($pattern, $replacement, $content);
    
    if ($newContent === null) {
        echo "Regex error for: $filePath\n";
        return;
    }
    
    if ($newContent !== $content) {
        file_put_contents($filePath, $newContent);
        echo "Updated: $filePath\n";
    } else {
        echo "No changes: $filePath\n";
    }
}

// Files to process
$files = [
    'resources/views/contents/pages/participant/index.blade.php',
    'resources/views/contents/pages/participant/create.blade.php',
    'resources/views/contents/pages/participant/edit.blade.php',
    'resources/views/contents/pages/participant/show.blade.php',
    'resources/views/contents/auth/login/index.blade.php'
];

foreach ($files as $file) {
    $fullPath = __DIR__ . '/' . $file;
    replaceInFile($fullPath);
}

echo "Translation updates completed!\n";
