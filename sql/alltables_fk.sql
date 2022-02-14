/* Last Updated: 10/25/21 at 4:45pm */
/* THIS FILE VERSION USES FOREIGN KEYS */

CREATE TABLE `companies` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `co_name` varchar(255) NOT NULL,
  `co_type` varchar(20),
  `co_status` varchar(15),
  `linkedleads` int(11),
  `rep1` varchar(30),
  `rep2` varchar(30),
  `address_st` varchar(100),
  `address_city` varchar(25),
  `address_state` varchar(25),
  `address_country` varchar(25),
  `address_zip` varchar(15),
  `website1` varchar(50),
  `website2` varchar(50),
  `notes` text,
  `lastcontact_date` date,
  `lastcontact_type` varchar(20),
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(50),
  `modified_at` datetime on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50),
  PRIMARY KEY (`companyID`)
);

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_name` varchar(25) NOT NULL,
  `companyID` int(11),
  `co_name` varchar(255),
  `co_type` varchar(20),
  `project_status` varchar(15),
  `linkedleads` int(11),
  `rep1` varchar(30),
  `rep2` varchar(30),
  `website1` varchar(50),
  `website2` varchar(50),
  `notes` text,
  `units_annual` int(11) DEFAULT 0,
  `stage` int(5) DEFAULT 0,
  `odds_win` int(5) DEFAULT 0,
  `chance_success` int(5) DEFAULT 0,
  `rev_high_annual` int(20) DEFAULT 0,
  `rev_low_annual` int(20) DEFAULT 0,
  `attn_priority` int(50),
  `meeting_held` boolean,
  `meeting_held_date` date,
  `lastcontact_date` date,
  `lastcontact_type` varchar(20),
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(50),
  `modified_at` datetime on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50),
  PRIMARY KEY (`id`),
  CONSTRAINT fk_projco FOREIGN KEY (companyID)
    REFERENCES companies(companyID)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11),
  `projectID` int(11),
  `co_name` varchar(255),
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25),
  `phone1` varchar(25),
  `phone2` varchar(25),
  `rep1` varchar(30),
  `rep2` varchar(30),
  `email` varchar(30),
  `address_st` varchar(100),
  `address_city` varchar(25),
  `address_state` varchar(25),
  `address_country` varchar(25),
  `address_zip` varchar(15),
  `website1` varchar(50),
  `website2` varchar(50),
  `notes` text,
  `lastcontact_date` date,
  `lastcontact_type` varchar(20),
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(50),
  `modified_at` datetime on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50),
  `source` varchar(25),
  `process` int(3),
  `contact_made` boolean,
  `contact_date` date,
  `opt_out` boolean,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_leadco FOREIGN KEY (companyID)
    REFERENCES companies(companyID)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT fk_leadproj FOREIGN KEY (projectID)
    REFERENCES projects(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

CREATE TABLE `threshold` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `type` varchar(25),
  `calc_adjust` int(20),
  `thresh_value` int(30),
  `thresh_value_2` int(30),
  PRIMARY KEY (`id`)
);

  INSERT INTO `threshold` 
  (`type`, `calc_adjust`, `thresh_value`, `thresh_value_2`) VALUES
  ('projects', 1000000000, 100, 1000);

CREATE TABLE `salesreps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(25) NOT NULL,
  `experience_level` int(2) NOT NULL,
  `email` varchar(40),
  `phone` varchar(20),
  PRIMARY KEY (`id`)
);

CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11),
  `projectID` int(11),
  `leadID` int(11),
  `rep1` varchar(30),
  `rep2` varchar(30),
  `presider_1` varchar(30),
  `presider_2` varchar(30),
  `priority` varchar(12),
  `details` text,
  `title` varchar(50),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50),
  `modified_at` datetime on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50),
  `due_at` date,
  `done` boolean,
  `done_at` date,
  `category` varchar(30),
  `est_time` int(10),
  `time_complete` int(10),
  `prefup_process` int(2),
  `prefup_step_num` int(2),
  `prefup_step_name` varchar(30),
  `prefup_email_subject` text,
  `prefup_email_body` text,
  `prefup_days` int(3),
  PRIMARY KEY (`id`)
);

CREATE TABLE `prefup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process` int(2),
  `step_num` int(2),
  `step_name` varchar(30),
  `email_subject` text,
  `email_body` text,
  `days` int(3),
  PRIMARY KEY (`id`)
);