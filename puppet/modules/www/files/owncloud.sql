CREATE DATABASE IF NOT EXISTS owncloud;
GRANT ALL PRIVILEGES ON owncloud.* TO 'owncloud'@'%' IDENTIFIED BY 'owncloud';
FLUSH PRIVILEGES;