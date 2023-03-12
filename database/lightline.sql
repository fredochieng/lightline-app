-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               PostgreSQL 14.5, compiled by Visual C++ build 1914, 64-bit
-- Server OS:                    
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table public.countries
CREATE TABLE IF NOT EXISTS "countries" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''countries_id_seq''::regclass)',
	"country_code" VARCHAR(255) NOT NULL,
	"country_name" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "countries_country_code_unique" ("country_code")
);

-- Dumping data for table public.countries: -1 rows
/*!40000 ALTER TABLE "countries" DISABLE KEYS */;
INSERT INTO "countries" ("id", "country_code", "country_name", "created_at", "updated_at") VALUES
	(1, 'ke', 'Kenya', NULL, NULL),
	(2, 'ug', 'Uganda', NULL, NULL),
	(3, 'tz', 'Tanzania', NULL, NULL);
/*!40000 ALTER TABLE "countries" ENABLE KEYS */;

-- Dumping structure for table public.education_level
CREATE TABLE IF NOT EXISTS "education_level" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''education_level_id_seq''::regclass)',
	"education_level" VARCHAR(255) NOT NULL,
	"el_status" BIGINT NOT NULL DEFAULT '1',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.education_level: -1 rows
/*!40000 ALTER TABLE "education_level" DISABLE KEYS */;
INSERT INTO "education_level" ("id", "education_level", "el_status", "created_at", "updated_at") VALUES
	(1, 'Primary', 1, NULL, NULL),
	(2, 'Secondary', 1, NULL, NULL),
	(3, 'University', 1, NULL, NULL);
/*!40000 ALTER TABLE "education_level" ENABLE KEYS */;

-- Dumping structure for table public.failed_jobs
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''failed_jobs_id_seq''::regclass)',
	"uuid" VARCHAR(255) NOT NULL,
	"connection" TEXT NOT NULL,
	"queue" TEXT NOT NULL,
	"payload" TEXT NOT NULL,
	"exception" TEXT NOT NULL,
	"failed_at" TIMESTAMP NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
	PRIMARY KEY ("id"),
	UNIQUE INDEX "failed_jobs_uuid_unique" ("uuid")
);

-- Dumping data for table public.failed_jobs: -1 rows
/*!40000 ALTER TABLE "failed_jobs" DISABLE KEYS */;
/*!40000 ALTER TABLE "failed_jobs" ENABLE KEYS */;

-- Dumping structure for table public.forex_rates
CREATE TABLE IF NOT EXISTS "forex_rates" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''forex_rates_id_seq''::regclass)',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.forex_rates: -1 rows
/*!40000 ALTER TABLE "forex_rates" DISABLE KEYS */;
/*!40000 ALTER TABLE "forex_rates" ENABLE KEYS */;

-- Dumping structure for table public.gender
CREATE TABLE IF NOT EXISTS "gender" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''gender_id_seq''::regclass)',
	"gender" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "gender_gender_unique" ("gender")
);

-- Dumping data for table public.gender: -1 rows
/*!40000 ALTER TABLE "gender" DISABLE KEYS */;
INSERT INTO "gender" ("id", "gender", "created_at", "updated_at") VALUES
	(1, 'Male', NULL, NULL),
	(2, 'Female', NULL, NULL),
	(3, 'Other', NULL, NULL);
/*!40000 ALTER TABLE "gender" ENABLE KEYS */;

-- Dumping structure for table public.marital_status
CREATE TABLE IF NOT EXISTS "marital_status" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''marital_status_id_seq''::regclass)',
	"marital_status" VARCHAR(255) NOT NULL,
	"ms_status" BIGINT NOT NULL DEFAULT '1',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.marital_status: -1 rows
/*!40000 ALTER TABLE "marital_status" DISABLE KEYS */;
INSERT INTO "marital_status" ("id", "marital_status", "ms_status", "created_at", "updated_at") VALUES
	(1, 'Single', 1, NULL, NULL),
	(2, 'Married', 1, NULL, NULL),
	(3, 'Divorced', 1, NULL, NULL);
/*!40000 ALTER TABLE "marital_status" ENABLE KEYS */;

-- Dumping structure for table public.migrations
CREATE TABLE IF NOT EXISTS "migrations" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''migrations_id_seq''::regclass)',
	"migration" VARCHAR(255) NOT NULL,
	"batch" INTEGER NOT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.migrations: -1 rows
/*!40000 ALTER TABLE "migrations" DISABLE KEYS */;
INSERT INTO "migrations" ("id", "migration", "batch") VALUES
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2022_09_21_133458_create_forex_rates_table', 1),
	(5, '2022_12_21_112302_create_permission_tables', 2),
	(7, '2014_10_12_000000_create_users_table', 3),
	(8, '2019_12_14_000001_create_personal_access_tokens_table', 4),
	(9, '2022_12_22_195500_create_sessions_table', 4),
	(11, '2022_12_26_133954_create_countries_table', 6),
	(12, '2022_12_26_165213_create_gender_table', 7),
	(13, '2022_12_23_163250_create_user_details_table', 8),
	(14, '2022_12_28_163846_create_user_points_table', 9),
	(15, '2022_12_29_132706_create_redemptions_table', 10),
	(19, '2022_12_31_200739_create_point_transactions_table', 11),
	(20, '2023_01_02_201210_add_columns_to_users_table', 12),
	(21, '2023_01_15_193316_create_marital_status_table', 13),
	(22, '2023_01_15_193614_create_education_level_table', 13),
	(24, '2023_01_16_195904_create_races_table', 15),
	(25, '2023_01_16_182834_add_columns_to_user_details_table', 16),
	(26, '2023_01_17_122332_create_user_referrals_mails_table', 17),
	(27, '2023_02_08_121613_add_tx_type-to_point_transactions_table', 18);
/*!40000 ALTER TABLE "migrations" ENABLE KEYS */;

-- Dumping structure for table public.model_has_permissions
CREATE TABLE IF NOT EXISTS "model_has_permissions" (
	"permission_id" BIGINT NOT NULL,
	"model_type" VARCHAR(255) NOT NULL,
	"model_id" BIGINT NOT NULL,
	INDEX "model_has_permissions_model_id_model_type_index" ("model_id", "model_type"),
	PRIMARY KEY ("permission_id", "model_id", "model_type"),
	CONSTRAINT "model_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON UPDATE NO ACTION ON DELETE CASCADE
);

-- Dumping data for table public.model_has_permissions: -1 rows
/*!40000 ALTER TABLE "model_has_permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "model_has_permissions" ENABLE KEYS */;

-- Dumping structure for table public.model_has_roles
CREATE TABLE IF NOT EXISTS "model_has_roles" (
	"role_id" BIGINT NOT NULL,
	"model_type" VARCHAR(255) NOT NULL,
	"model_id" BIGINT NOT NULL,
	INDEX "model_has_roles_model_id_model_type_index" ("model_id", "model_type"),
	PRIMARY KEY ("role_id", "model_id", "model_type"),
	CONSTRAINT "model_has_roles_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON UPDATE NO ACTION ON DELETE CASCADE
);

-- Dumping data for table public.model_has_roles: -1 rows
/*!40000 ALTER TABLE "model_has_roles" DISABLE KEYS */;
INSERT INTO "model_has_roles" ("role_id", "model_type", "model_id") VALUES
	(1, 'App\User', 47),
	(1, 'App\User', 48),
	(1, 'App\User', 56),
	(1, 'App\User', 58),
	(2, 'App\User', 49);
/*!40000 ALTER TABLE "model_has_roles" ENABLE KEYS */;

-- Dumping structure for table public.password_resets
CREATE TABLE IF NOT EXISTS "password_resets" (
	"email" VARCHAR(255) NOT NULL,
	"token" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	INDEX "password_resets_email_index" ("email")
);

-- Dumping data for table public.password_resets: -1 rows
/*!40000 ALTER TABLE "password_resets" DISABLE KEYS */;
/*!40000 ALTER TABLE "password_resets" ENABLE KEYS */;

-- Dumping structure for table public.permissions
CREATE TABLE IF NOT EXISTS "permissions" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''permissions_id_seq''::regclass)',
	"name" VARCHAR(255) NOT NULL,
	"guard_name" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "permissions_name_guard_name_unique" ("name", "guard_name")
);

-- Dumping data for table public.permissions: -1 rows
/*!40000 ALTER TABLE "permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "permissions" ENABLE KEYS */;

-- Dumping structure for table public.personal_access_tokens
CREATE TABLE IF NOT EXISTS "personal_access_tokens" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''personal_access_tokens_id_seq''::regclass)',
	"tokenable_type" VARCHAR(255) NOT NULL,
	"tokenable_id" BIGINT NOT NULL,
	"name" VARCHAR(255) NOT NULL,
	"token" VARCHAR(64) NOT NULL,
	"abilities" TEXT NULL DEFAULT NULL,
	"last_used_at" TIMESTAMP NULL DEFAULT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" ("tokenable_type", "tokenable_id"),
	UNIQUE INDEX "personal_access_tokens_token_unique" ("token")
);

-- Dumping data for table public.personal_access_tokens: -1 rows
/*!40000 ALTER TABLE "personal_access_tokens" DISABLE KEYS */;
/*!40000 ALTER TABLE "personal_access_tokens" ENABLE KEYS */;

-- Dumping structure for table public.point_transactions
CREATE TABLE IF NOT EXISTS "point_transactions" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''point_transactions_id_seq''::regclass)',
	"transaction_id" VARCHAR(255) NOT NULL,
	"user_id" BIGINT NOT NULL,
	"points" BIGINT NOT NULL,
	"activity" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NOT NULL,
	"updated_at" TIMESTAMP NOT NULL,
	"tx_type" VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "point_transactions_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON UPDATE CASCADE ON DELETE CASCADE
);

-- Dumping data for table public.point_transactions: -1 rows
/*!40000 ALTER TABLE "point_transactions" DISABLE KEYS */;
INSERT INTO "point_transactions" ("id", "transaction_id", "user_id", "points", "activity", "created_at", "updated_at", "tx_type") VALUES
	(3, '64879213', 47, 50, 'Sign Up', '2023-01-01 11:40:58', '2023-01-01 11:40:58', NULL),
	(4, '30781456', 56, 50, 'Sign Up', '2023-01-10 21:17:35', '2023-01-10 21:17:35', NULL),
	(5, '32091487', 47, 50, 'Redemption', '2023-02-08 16:15:19', '2023-02-08 16:15:19', 'Debit'),
	(6, '10295738', 47, 50, 'Redemption', '2023-02-13 21:59:42', '2023-02-13 21:59:42', 'Debit'),
	(7, '72968403', 47, 50, 'Redemption', '2023-02-14 08:29:28', '2023-02-14 08:29:28', 'Debit'),
	(8, '43710659', 47, 120, 'Redemption', '2023-02-14 08:30:23', '2023-02-14 08:30:23', 'Debit');
/*!40000 ALTER TABLE "point_transactions" ENABLE KEYS */;

-- Dumping structure for table public.races
CREATE TABLE IF NOT EXISTS "races" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''races_id_seq''::regclass)',
	"race" VARCHAR(255) NOT NULL,
	"race_status" BIGINT NOT NULL DEFAULT '1',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.races: -1 rows
/*!40000 ALTER TABLE "races" DISABLE KEYS */;
INSERT INTO "races" ("id", "race", "race_status", "created_at", "updated_at") VALUES
	(1, 'Black', 1, NULL, NULL),
	(2, 'White', 1, NULL, NULL);
/*!40000 ALTER TABLE "races" ENABLE KEYS */;

-- Dumping structure for table public.redemptions
CREATE TABLE IF NOT EXISTS "redemptions" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''redemptions_id_seq''::regclass)',
	"redemption_no" VARCHAR(255) NOT NULL,
	"user_id" BIGINT NOT NULL,
	"points_redeemed" BIGINT NOT NULL,
	"expected_date" VARCHAR(255) NOT NULL,
	"date_paid" VARCHAR(255) NULL DEFAULT NULL,
	"payment_mode" BIGINT NOT NULL,
	"status" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NOT NULL,
	"updated_at" TIMESTAMP NOT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "redemptions_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON UPDATE CASCADE ON DELETE CASCADE
);

-- Dumping data for table public.redemptions: -1 rows
/*!40000 ALTER TABLE "redemptions" DISABLE KEYS */;
INSERT INTO "redemptions" ("id", "redemption_no", "user_id", "points_redeemed", "expected_date", "date_paid", "payment_mode", "status", "created_at", "updated_at") VALUES
	(11, '8VLAY2MP', 47, 35, '2022-12-30 16:29:57', NULL, 1, '1', '2022-12-30 13:29:57', '2022-12-30 13:29:57'),
	(12, 'Y27TC5MR', 47, 40, '2022-12-30 23:34:00', NULL, 1, '1', '2022-12-30 20:34:00', '2022-12-30 20:34:00'),
	(13, '54T2KL7D', 47, 66, '2022-12-31 14:19:57', NULL, 1, '1', '2022-12-31 11:19:58', '2022-12-31 11:19:58'),
	(14, '9XFR4THE', 47, 70, '2022-12-31 14:37:10', NULL, 1, '1', '2022-12-31 11:37:10', '2022-12-31 11:37:10'),
	(16, 'W79BACKL', 47, 4, '2022-12-31 20:44:42', NULL, 1, '1', '2022-12-31 17:44:42', '2022-12-31 17:44:42'),
	(17, '53271809', 47, 60, '2022-12-31 22:41:24', NULL, 1, '1', '2022-12-31 19:41:24', '2022-12-31 19:41:24'),
	(18, '08691274', 47, 50, '2023-01-01 11:50:59', NULL, 1, '1', '2023-01-01 08:50:59', '2023-01-01 08:50:59'),
	(19, '53042817', 56, 50, '2023-01-10 21:20:53', NULL, 1, '1', '2023-01-10 18:20:53', '2023-01-10 18:20:53'),
	(20, '42817936', 47, 100, '2023-01-19 21:43:04', NULL, 1, '1', '2023-01-19 18:43:04', '2023-01-19 18:43:04'),
	(21, '58714360', 47, 370, '2023-01-19 21:43:43', NULL, 1, '1', '2023-01-19 18:43:43', '2023-01-19 18:43:43'),
	(22, '38671495', 47, 50, '2023-02-08 16:15:19', NULL, 1, '1', '2023-02-08 13:15:19', '2023-02-08 13:15:19'),
	(23, '18293460', 47, 50, '2023-02-13 21:59:42', NULL, 1, '1', '2023-02-13 18:59:42', '2023-02-13 18:59:42'),
	(24, '13609275', 47, 50, '2023-02-14 08:29:27', NULL, 1, '1', '2023-02-14 05:29:28', '2023-02-14 05:29:28'),
	(25, '97284156', 47, 120, '2023-02-14 08:30:23', NULL, 1, '1', '2023-02-14 05:30:23', '2023-02-14 05:30:23');
/*!40000 ALTER TABLE "redemptions" ENABLE KEYS */;

-- Dumping structure for table public.roles
CREATE TABLE IF NOT EXISTS "roles" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''roles_id_seq''::regclass)',
	"name" VARCHAR(255) NOT NULL,
	"guard_name" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "roles_name_guard_name_unique" ("name", "guard_name")
);

-- Dumping data for table public.roles: -1 rows
/*!40000 ALTER TABLE "roles" DISABLE KEYS */;
INSERT INTO "roles" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
	(1, 'Panel', 'web', NULL, NULL),
	(2, 'Admin', 'web', NULL, NULL);
/*!40000 ALTER TABLE "roles" ENABLE KEYS */;

-- Dumping structure for table public.role_has_permissions
CREATE TABLE IF NOT EXISTS "role_has_permissions" (
	"permission_id" BIGINT NOT NULL,
	"role_id" BIGINT NOT NULL,
	PRIMARY KEY ("permission_id", "role_id"),
	CONSTRAINT "role_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON UPDATE NO ACTION ON DELETE CASCADE,
	CONSTRAINT "role_has_permissions_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON UPDATE NO ACTION ON DELETE CASCADE
);

-- Dumping data for table public.role_has_permissions: -1 rows
/*!40000 ALTER TABLE "role_has_permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "role_has_permissions" ENABLE KEYS */;

-- Dumping structure for table public.sessions
CREATE TABLE IF NOT EXISTS "sessions" (
	"id" VARCHAR(255) NOT NULL,
	"user_id" BIGINT NULL DEFAULT NULL,
	"ip_address" VARCHAR(45) NULL DEFAULT NULL,
	"user_agent" TEXT NULL DEFAULT NULL,
	"payload" TEXT NOT NULL,
	"last_activity" INTEGER NOT NULL,
	PRIMARY KEY ("id"),
	INDEX "sessions_user_id_index" ("user_id"),
	INDEX "sessions_last_activity_index" ("last_activity")
);

-- Dumping data for table public.sessions: 1 rows
/*!40000 ALTER TABLE "sessions" DISABLE KEYS */;
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
	('KdRp2rVrGFu9KZAfwXVl0TA5OlSIXtiKp4c4ZHlO', 47, '192.168.0.10', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/110.0.5481.114 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicGNBbHdadFpLVG52U2ZYa25tbkFibkxucVVzTVV4bDNIcmlEVGxyaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cDovLzE5Mi4xNjguMC4yMDo4MDAwL3VzZXIvcHJvZmlsZS9kZXRhaWxzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xOTIuMTY4LjAuMjA6ODAwMC91c2VyL3Byb2ZpbGUvZGV0YWlscyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ3O30=', 1678214637),
	('Nn60PDpYApbyl6TTzzOsTFDuuA3Hhpm3BlY28Ho5', 49, '192.168.0.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovLzE5Mi4xNjguMC4yMDo4MDAwL2FkbWluL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiR1A3WGVVMXo5TVVqdGpoWm5HZDZMZzVOMVlOcWhERjdOWXZsM3ZIeSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDk7fQ==', 1678219512);
/*!40000 ALTER TABLE "sessions" ENABLE KEYS */;

-- Dumping structure for table public.users
CREATE TABLE IF NOT EXISTS "users" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''users_id_seq''::regclass)',
	"name" VARCHAR(255) NOT NULL,
	"email" VARCHAR(255) NOT NULL,
	"status" BIGINT NOT NULL DEFAULT '0',
	"ref_code" VARCHAR(255) NOT NULL,
	"verification_code" VARCHAR(255) NOT NULL,
	"email_verified_at" TIMESTAMP NULL DEFAULT NULL,
	"password" VARCHAR(255) NOT NULL,
	"remember_token" VARCHAR(100) NULL DEFAULT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	"referred_by" BIGINT NULL DEFAULT NULL,
	"registration_type" BIGINT NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "users_email_unique" ("email"),
	UNIQUE INDEX "users_ref_code_unique" ("ref_code")
);

-- Dumping data for table public.users: -1 rows
/*!40000 ALTER TABLE "users" DISABLE KEYS */;
INSERT INTO "users" ("id", "name", "email", "status", "ref_code", "verification_code", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "referred_by", "registration_type") VALUES
	(56, 'Dan Dan', 'dan@gmail.com', 1, 'Y6EBA13M', '753918', '2023-01-10 21:17:35', '$2y$10$a/Y0DHnj.ybIWNmxdVFUduQBOVd4apOOlOI7rOtXYl.fj1x0PjUZO', NULL, '2023-01-10 18:16:00', '2023-01-10 18:16:00', NULL, 1),
	(58, 'Sam Sam', 'sam@sam.com', 0, 'CQXJF78A', '406915', NULL, '$2y$10$/7UbYOQiA6eVlzhVGiP3VeUTdJ6vq9b8nLVHBjnivhfszVlf0zTr.', NULL, '2023-01-19 15:27:27', '2023-01-19 15:27:27', NULL, 1),
	(48, 'Hhhh', 'hhhh@hh.com', 0, 'ZKGVYNSR', '948270', NULL, '$2y$10$CrKl6DWjCEKUyPsVSPmT1OE2GA9pzrlVSPOtT.SxXS.FDz4H6B8m.', NULL, '2023-01-02 20:54:18', '2023-01-02 20:54:18', 47, NULL),
	(49, 'Lightline Admin', 'info@lightlineresearch.com', 1, 'GSPVM8B0', '806542', '2023-03-03 14:06:15', '$2y$10$RZd35fU4EpcL8Hp.GQRlJu6t6tNxZUEguxp55qY3F7YXgbw0jouHS', NULL, '2023-01-02 20:55:23', '2023-01-02 20:55:23', 47, NULL),
	(47, 'Fredrick Ochieng', 'fredrick.owuor2014@gmail.com', 1, 'A75QH4GF', '028731', '2023-01-01 11:40:58', '$2y$10$.smRsUKp1WixHd0Yj/W6uejG46R3TSoRvpgkTh8Ad4HjK4hU1xT5S', NULL, '2022-12-27 18:04:39', '2023-03-07 18:37:52', NULL, NULL);
/*!40000 ALTER TABLE "users" ENABLE KEYS */;

-- Dumping structure for table public.user_details
CREATE TABLE IF NOT EXISTS "user_details" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''user_details_id_seq''::regclass)',
	"user_id" BIGINT NOT NULL,
	"panel_no" VARCHAR(255) NOT NULL,
	"phone_number" VARCHAR(255) NOT NULL,
	"country_code" VARCHAR(255) NOT NULL,
	"dob" VARCHAR(255) NULL DEFAULT NULL,
	"age" BIGINT NULL DEFAULT NULL,
	"gender" VARCHAR(255) NULL DEFAULT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	"marital_status_id" BIGINT NULL DEFAULT NULL,
	"education_level_id" BIGINT NULL DEFAULT NULL,
	"race_id" BIGINT NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "user_details_country_code_foreign" FOREIGN KEY ("country_code") REFERENCES "countries" ("country_code") ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT "user_details_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON UPDATE CASCADE ON DELETE CASCADE
);

-- Dumping data for table public.user_details: 4 rows
/*!40000 ALTER TABLE "user_details" DISABLE KEYS */;
INSERT INTO "user_details" ("id", "user_id", "panel_no", "phone_number", "country_code", "dob", "age", "gender", "created_at", "updated_at", "marital_status_id", "education_level_id", "race_id") VALUES
	(2, 48, '1289', '+25465545455', 'ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 49, '3456', '+254452322344', 'ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 56, '6787', '+2547463546343', 'ke', NULL, 29, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 58, '5678', '+254756454656', 'ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1, 47, '4545', '+254708823158', 'ke', '1994-01-13', 29, 'Male', NULL, NULL, 1, 2, 1);
/*!40000 ALTER TABLE "user_details" ENABLE KEYS */;

-- Dumping structure for table public.user_points
CREATE TABLE IF NOT EXISTS "user_points" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''user_points_id_seq''::regclass)',
	"user_id" BIGINT NOT NULL,
	"points_earned" INTEGER NOT NULL DEFAULT '0',
	"points_redeemed" INTEGER NOT NULL DEFAULT '0',
	"points_balance" INTEGER NOT NULL DEFAULT '0',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "user_points_user_id_unique" ("user_id")
);

-- Dumping data for table public.user_points: -1 rows
/*!40000 ALTER TABLE "user_points" DISABLE KEYS */;
INSERT INTO "user_points" ("id", "user_id", "points_earned", "points_redeemed", "points_balance", "created_at", "updated_at") VALUES
	(12, 56, 50, 790, 30, NULL, NULL),
	(11, 47, 500, 790, 30, NULL, NULL);
/*!40000 ALTER TABLE "user_points" ENABLE KEYS */;

-- Dumping structure for table public.user_referrals_mails
CREATE TABLE IF NOT EXISTS "user_referrals_mails" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''user_referrals_mails_id_seq''::regclass)',
	"to_email" VARCHAR(255) NOT NULL,
	"referrer_link" VARCHAR(255) NOT NULL,
	"delivery_status" BIGINT NOT NULL DEFAULT '0',
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Dumping data for table public.user_referrals_mails: -1 rows
/*!40000 ALTER TABLE "user_referrals_mails" DISABLE KEYS */;
INSERT INTO "user_referrals_mails" ("id", "to_email", "referrer_link", "delivery_status", "created_at", "updated_at") VALUES
	(1, '1@1.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-01-17 12:42:00', '2023-01-17 12:42:00'),
	(2, '2@2.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-01-17 12:42:00', '2023-01-17 12:42:00'),
	(3, '1@1.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-01-17 12:47:08', '2023-01-17 12:47:08'),
	(4, '2@2.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-01-17 12:47:08', '2023-01-17 12:47:08'),
	(5, 'ddd@ffff.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-02-08 06:31:14', '2023-02-08 06:31:14'),
	(6, 'testing@1.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-02-08 06:36:02', '2023-02-08 06:36:02'),
	(7, 'test@test.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-02-08 06:36:02', '2023-02-08 06:36:02'),
	(8, '1@1.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-02-14 05:34:05', '2023-02-14 05:34:05'),
	(9, '2@2.com', 'http://localhost:8002/auth/user/register?ref=A75QH4GF', 0, '2023-02-14 05:34:05', '2023-02-14 05:34:05');
/*!40000 ALTER TABLE "user_referrals_mails" ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
