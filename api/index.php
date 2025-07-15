<?php

require __DIR__ . "/../public/index.php";
if (file_exists(__DIR__ . '/../public' . $_SERVER['REQUEST_URI'])) {
    return false; // Biarkan Vercel menyajikan file statis
}
// Logika Laravel lainnya
