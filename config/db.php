<?php

try {
    $pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT 'user',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

//  Perfect. Let’s lock everything in one clean, professional paragraph.

// In our role-based authentication system, we are using **PDO
//  (PHP Data Objects)** to securely connect PHP with a 
// SQLite database and run database queries safely using
//  prepared statements, which protect against SQL injection.
//  During registration, when a user enters a password, we do not
//  store it in plain text; instead, we use `password_hash()` which applies a 
// secure hashing algorithm (like bcrypt) along with a randomly generated salt.
//  This salt ensures that even if two users choose the same password, their stored hashes will be completely different. The hash string stored in the database already contains the salt and algorithm information. During login, we use `password_verify()`, which takes the entered password, extracts the salt from the stored hash, re-hashes the entered password using the same algorithm and salt, and then compares the result with the stored hash. This process does not decrypt anything (because hashing is one-way); it simply checks whether the entered password produces the same hash. Hashing protects user passwords in case of a database leak, while prepared statements protect the database from SQL injection attacks. Together, these mechanisms form the security foundation of a real-world authentication system.

// Now we move forward. 🔥
