CREATE TABLE vdk_project (
        id INT AUTO_INCREMENT NOT NULL,
        project_id INT NOT NULL,
        created_at DATETIME NOT NULL,
        title VARCHAR(255) NOT NULL,
        donated_amount INT DEFAULT 0,
        goal_amount INT DEFAULT 0,
        num_donors INT DEFAULT 0,
        percentage_donated INT DEFAULT 0,
        num_days_left INT DEFAULT 0,
        url VARCHAR(255) NOT NULL,
        PRIMARY KEY(id),
        INDEX vdk_project_idx_1 (project_id, created_at DESC)
    );
