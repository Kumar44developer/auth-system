<?php
// Unit tests for authentication logic

function assert_true($condition, $message) {
    if ($condition) {
        echo "PASS: $message\n";
    } else {
        echo "FAIL: $message\n";
        exit(1);
    }
}

// 1. Password hashing test
$password = "Secret123!";
$hash = password_hash($password, PASSWORD_DEFAULT);
assert_true(password_verify($password, $hash), "Password verification succeeds for correct password");
assert_true(!password_verify("WrongPassword", $hash), "Password verification fails for incorrect password");

// 2. Email validation test
$validEmail = "user@example.com";
$invalidEmail = "not-an-email";
assert_true(filter_var($validEmail, FILTER_VALIDATE_EMAIL) !== false, "Valid email format recognized");
assert_true(filter_var($invalidEmail, FILTER_VALIDATE_EMAIL) === false, "Invalid email format detected");

// 3. String sanitation test
$dirty = "<script>alert('xss')</script>";
$escaped = htmlspecialchars($dirty);
assert_true(strpos($escaped, "<script>") === false, "HTML special characters safely escaped");

echo "\nAll authentication unit tests passed successfully!\n";
