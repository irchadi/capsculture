-- 🔹 Créer la base
CREATE DATABASE IF NOT EXISTS capsculture CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE capsculture;

-- 🔹 Table : users (optionnelle pour évolution future)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 🔹 Table : categories (pour trier les faits)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- 🔹 Table principale : facts (capsules culturelles)
CREATE TABLE IF NOT EXISTS facts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    likes INT DEFAULT 0,
    category_id INT DEFAULT NULL,
    user_id INT DEFAULT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- 🔹 Table : likes (pour traçabilité individuelle - évolution)
CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fact_id INT NOT NULL,
    user_ip VARCHAR(45), -- pour suivi sans compte
    user_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_like (fact_id, user_ip),
    FOREIGN KEY (fact_id) REFERENCES facts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);