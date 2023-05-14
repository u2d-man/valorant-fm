CREATE TABLE IF NOT EXISTS users (
    id int AUTO_INCREMENT primary key,
    login_id varchar(20) UNIQUE NOT NULL,
    password varchar(255) NOT NULL,
    name varchar(20) NOT NULL,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp on update current_timestamp
);
