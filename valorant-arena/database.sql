
CREATE DATABASE IF NOT EXISTS tectrader;
USE tectrader;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    discord_id VARCHAR(100),
    valorant_id VARCHAR(100),
    rank_tier VARCHAR(50),
    region VARCHAR(50),
    role INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    team_tag VARCHAR(20) NOT NULL,
    captain_id INT NOT NULL,
    team_logo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tournaments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tournament_name VARCHAR(255) NOT NULL,
    tournament_type VARCHAR(50) DEFAULT 'Open',
    status VARCHAR(50) DEFAULT 'Open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_one INT,
    team_two INT,
    score_one INT DEFAULT 0,
    score_two INT DEFAULT 0,
    match_status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS veto_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_id INT,
    team_id INT,
    action_type VARCHAR(50),
    map_name VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
