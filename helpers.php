<?php

/**
 * Generate the base URL for the application.
 *
 * @param string $path Optional path to append to the base URL.
 * @return string Full URL.
 */
function base_url($path = '') {
    $protocol = $_SERVER['REQUEST_SCHEME'] ?? 'http';
    $host = $_SERVER['HTTP_HOST'];
    $base_url = rtrim($protocol . '://' . $host . '/' . trim(PROJECT_DIR, '/'), '/') . '/';
    return $base_url . ltrim($path, '/');
}

/**
 * Generate the base file system path for the application.
 *
 * @param string $path Optional path to append.
 * @return string Full file system path.
 */
function base_path($path = '') {
    return rtrim(dirname(__DIR__) . DIRECTORY_SEPARATOR . trim(PROJECT_DIR, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

/**
 * Get the full file system path for uploads.
 *
 * @param string $filename Optional filename.
 * @return string Full uploads path.
 */
function uploads_path($filename = '') {
    return base_path('uploads') . DIRECTORY_SEPARATOR . ltrim($filename, DIRECTORY_SEPARATOR);
}

/**
 * Get the full URL for uploads.
 *
 * @param string $filename Optional filename.
 * @return string Full uploads URL.
 */
function uploads_url($filename = '') {
    return base_url('uploads/' . ltrim($filename, '/'));
}

/**
 * Get the full URL for assets (e.g., CSS, JS).
 *
 * @param string $path Optional path.
 * @return string Full assets URL.
 */
function asset_url($path = '') {
    return base_url('assets/' . ltrim($path, '/'));
}

/**
 * Redirect to a specified URL and exit.
 *
 * @param string $url The URL to redirect to.
 */
function redirect($url) {
    if (!headers_sent()) {
        header("Location: $url", true, 302);
        exit;
    }
    echo "<p class='text-danger'>Unable to redirect. Headers already sent.</p>";
}

/**
 * Check if the current request is a POST request.
 *
 * @return bool True if POST request, false otherwise.
 */
function isPostRequest() {
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

/**
 * Retrieve sanitized POST data.
 *
 * @param string $field The POST field name.
 * @param string $default Default value if field is missing.
 * @return string Sanitized POST data or the default value.
 */
function getPostData($field, $default = "") {
    return isset($_POST[$field]) ? filter_var(trim($_POST[$field]), FILTER_SANITIZE_STRING) : $default;
}

/**
 * Log errors to a debug file.
 *
 * @param string $message The error message.
 */
function logError($message) {
    file_put_contents(base_path('debug_log.txt'), "[" . date('Y-m-d H:i:s') . "] $message\n", FILE_APPEND);
}

/**
 * Handle file uploads dynamically and return the uploaded file name or false on failure.
 *
 * @param string $upload_category Directory category for the file.
 * @param string $input_name Name of the file input field.
 * @param array $allowedTypes Allowed file types (default: common types).
 * @param int $maxSize Maximum file size in bytes (default: 5MB).
 * @return string|false Uploaded file name on success, false on failure.
 */
function handleFileUpload($upload_category, $input_name, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'dwg', 'docx', 'xlsx', 'mp3', 'wav'], $maxSize = 5 * 1024 * 1024) {
    if (!isset($_FILES[$input_name]) || $_FILES[$input_name]['error'] !== UPLOAD_ERR_OK) {
        return false; // Return false if file is not uploaded
    }

    $targetDir = uploads_path($upload_category . DIRECTORY_SEPARATOR);

    // Ensure the upload directory exists
    if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
        return false;
    }

    $originalFileName = basename($_FILES[$input_name]['name']);
    $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    $fileSize = $_FILES[$input_name]['size'];

    // Validate file extension
    if (!in_array($extension, $allowedTypes, true)) {
        return false;
    }

    // Validate file size
    if ($fileSize > $maxSize) {
        return false;
    }

    // Generate unique file name
    $fileName = time() . '_' . uniqid() . '.' . $extension;
    $targetFilePath = $targetDir . $fileName;

    // Move uploaded file
    if (!move_uploaded_file($_FILES[$input_name]['tmp_name'], $targetFilePath)) {
        return false;
    }

    return $upload_category . '/' . $fileName; // Return relative path
}


?>
