<?php

/**
 * Generate the base URL for the application.
 *
 * @param string $path Optional path to append to the base URL.
 * @return string Full URL.
 */
function base_url($path = '') {
    $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" ? "https://" : "http://";
    $host = $_SERVER["HTTP_HOST"];
    $base_url = rtrim($protocol . $host . '/' . trim(PROJECT_DIR, '/'), '/') . '/';
    return $base_url . ltrim($path, '/');
}

/**
 * Generate the base file system path for the application.
 *
 * @param string $path Optional path to append to the base path.
 * @return string Full file system path.
 */
function base_path($path = '') {
    $rootpath = rtrim(dirname(__DIR__), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . trim(PROJECT_DIR, DIRECTORY_SEPARATOR);
    return $rootpath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

/**
 * Get the full file system path for uploads.
 *
 * @param string $filename Optional filename to append to the uploads path.
 * @return string Full uploads path.
 */
function uploads_path($filename = '') {
    return base_path('uploads') . DIRECTORY_SEPARATOR . ltrim($filename, DIRECTORY_SEPARATOR);
}

/**
 * Get the full URL for uploads.
 *
 * @param string $filename Optional filename to append to the uploads URL.
 * @return string Full uploads URL.
 */
function uploads_url($filename = '') {
    return base_url('uploads/' . ltrim($filename, '/'));
}

/**
 * Get the full URL for assets (e.g., CSS, JS).
 *
 * @param string $path Optional path to append to the assets URL.
 * @return string Full assets URL.
 */
function asset_url($path = '') {
    return base_url('assets/' . ltrim($path, '/'));
}

/**
 * Redirect to a specified URL.
 *
 * @param string $url The URL to redirect to.
 */
function redirect($url) {
    if (!headers_sent()) {
        header("Location: $url");
        exit; // Stop further script execution
    } else {
        echo "<p class='text-danger'>Unable to redirect. Headers already sent.</p>";
    }
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
 * @param string $field The name of the POST field to retrieve.
 * @param string $default Default value if the field is not set.
 * @return string Sanitized POST data or the default value.
 */
function getPostData($field, $default = "") {
    return isset($_POST[$field]) ? htmlspecialchars(trim($_POST[$field]), ENT_QUOTES, 'UTF-8') : $default;
}

/**
 * Check if a project exists in the database by its ID.
 *
 * @param int $projectId The ID of the project to check.
 * @return bool True if the project exists, false otherwise.
 */

/**
 * Handle file uploads and return the uploaded file name or false on failure.
 *
 * @param string $upload_category Directory category for the file.
 * @param string $input_name Name of the file input field.
 * @return string|false Uploaded file name on success, false on failure.
 */
function handleFileUpload($upload_category, $input_name) {
    $targetDir = uploads_path($upload_category . '/');

    // Ensure the upload directory exists
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            file_put_contents('debug_log.txt', "Failed to create upload directory: $targetDir\n", FILE_APPEND);
            return false;
        }
    }

    // Check if a file was uploaded
    if (!isset($_FILES[$input_name]) || $_FILES[$input_name]['error'] !== UPLOAD_ERR_OK) {
        file_put_contents('debug_log.txt', "File upload error: " . print_r($_FILES[$input_name], true), FILE_APPEND);
        return false;
    }

    $originalFileName = basename($_FILES[$input_name]['name']);
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Allow only specific file types
    $allowedTypes = ['dwg', 'pdf'];
    if (!in_array(strtolower($extension), $allowedTypes)) {
        file_put_contents('debug_log.txt', "Invalid file type: $extension\n", FILE_APPEND);
        return false;
    }

    $fileName = time() . '_' . $originalFileName; // Generate unique name
    $targetFilePath = $targetDir . $fileName;

    if (!move_uploaded_file($_FILES[$input_name]['tmp_name'], $targetFilePath)) {
        file_put_contents('debug_log.txt', "Failed to move uploaded file to $targetFilePath\n", FILE_APPEND);
        return false;
    }

    return $fileName;
}


?>
