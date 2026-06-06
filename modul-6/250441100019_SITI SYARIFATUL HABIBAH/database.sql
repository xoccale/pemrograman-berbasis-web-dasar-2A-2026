USE task_manager;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('admin','user') NOT NULL
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul_task VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    deadline DATE,
    prioritas ENUM('Rendah','Sedang','Tinggi'),
    status_task ENUM('Belum Selesai','Selesai'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DESCRIBE tasks;
DESCRIBE users;

ALTER TABLE tasks
ADD user_id INT;