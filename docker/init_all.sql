DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS materials;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'user',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES (
    'Administrator',
    'admin@gmail.com',
    '$2y$10$hZcIGRzvqByqlzQlZRS8qu5HrruM5B7FqAy1gCbd0mxM2XcOaZve6',
    'admin',
    NOW(),
    NOW()
)
ON CONFLICT (email) DO NOTHING;

CREATE TABLE IF NOT EXISTS materials (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(20) NOT NULL,
    file_path VARCHAR(255),
    thumbnail VARCHAR(255),
    is_approved SMALLINT DEFAULT 0,
    approved_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT fk_material_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    material_id INT NOT NULL,
    parent_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT fk_comment_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_material FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_parent FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE
);
