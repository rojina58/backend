<?php
function sanitizeFormData($data) {
    // If $data is an array, sanitize each element recursively
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanitizeFormData($value);
        }
        return $data;
    }

    // If $data is a string, sanitize it
    if (is_string($data)) {
        // Remove HTML tags
        $data = strip_tags($data);

        // Remove leading and trailing whitespace
        $data = trim($data);

        // Convert special characters to HTML entities
        $data = htmlspecialchars($data);
    }

    return $data;
}
