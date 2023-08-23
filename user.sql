ALTER TABLE user
ADD COLUMN `provider` varchar(255) DEFAULT NULL,
ADD COLUMN `provider_id` varchar(255) DEFAULT NULL;