/* Last Updated: 02/14/22 */

CREATE DATABASE tribunal;

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

    INSERT INTO `companies` 
    (`co_name`, `co_type`, `co_status`, `rep1`, `notes`) VALUES
    ('ACME Corp', 'OEM', 'Active', 'Yosemite Sam', 'This is a test company.'),
    ('Hunting Wabbits', 'End-User', 'Active', 'Elmer Fudd', 'This is another test company.');


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
  PRIMARY KEY (`id`)
);

    INSERT INTO `projects` 
    (`proj_name`, `companyID`, `co_name`, `project_status`, `rep1`, `notes`, `units_annual`, `stage`, `odds_win`, `chance_success`, `rev_high_annual`, `rev_low_annual`, `attn_priority`) VALUES
    ('Road Runner TNT', 1, 'ACME Corp', 'Active', 'Yosemite Sam', 'This is a test project.', 10000, 2, 75, 90, 5000000, 2500000, 506250);


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
  PRIMARY KEY (`id`)
);

    INSERT INTO `leads` 
    (`companyID`, `projectID`, `co_name`, `firstname`, `lastname`, `rep1`, `notes`, `process`) VALUES
    (1, 1, 'ACME Corp', 'Wile E.', 'Coyote', 'Yosemite Sam', 'This is a test lead.', 0),
    (1, 1, 'ACME Corp', 'Tasmanian', 'Devil', 'Yosemite Sam', 'This is a test lead.', 2);


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

    INSERT INTO `salesreps` 
    (`full_name`, `experience_level`, `email`, `phone`) VALUES
    ('Yosemite Sam', 5, 'ysamt@test.com', '555-555-5555'),
    ('Elmer Fudd', 2, 'efudd@test.com', '555-555-5555'),
    ('Bugs Bunny', 2, 'doc@test.com', '555-555-5555');


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
  `prefup_process` int(2) NOT NULL DEFAULT '0',
  `prefup_step_num` int(2),
  `prefup_step_name` varchar(30),
  `prefup_email_subject` text,
  `prefup_email_body` text,
  `prefup_days` int(3),
  PRIMARY KEY (`id`)
);
    /* Post-Contact and Tribunal To-Dos */
    INSERT INTO `todos` 
    (`projectID`, `leadID`, `rep1`, `priority`, `details`, `due_at`, `done`, `category`, `est_time`, `time_complete`) VALUES
    (0, 1, 'Yosemite Sam', '3: Medium', 'This is a medium-priority, post-contact task.', '2025-01-01', 0, 'Post-Contact Lead', 3, 2),
    (0, 1, 'Yosemite Sam', '1: Low', 'This is a low-priority, post-contact task.', '2025-01-02', 0, 'Post-Contact Lead', 5, 4),
    (1, 0,'Yosemite Sam', '5: High', 'Hold a tribunal for Road Runner TNT project', '2025-01-01', 0, 'Tribunal', 1, 0);

    /* Pre-Contact To-Dos */
    INSERT INTO `todos`
    (`projectID`, `leadID`, `rep1`, `priority`, `details`, `title`, `due_at`, `done`, `category`, `est_time`, `time_complete`, `prefup_process`, `prefup_step_num`, `prefup_step_name`, `prefup_email_subject`, `prefup_email_body`, `prefup_days`) VALUES

    (0, 2,'Yosemite Sam', '5: High', 'Pre-contact lead process. Step: Email 1B', 'Email 1B', '2025-01-01', 0, 'Pre-Contact Lead', 1, 0, 2, 1, 'Email 1B', 'Website registration follow-up', 'Hello, I am reaching out in regards to your recent registration on our website. We\'ve found it\'s often helpful to have a quick follow-up conversation since we have a large variety of product configurations, some of which aren\'t listed on the website. I\'ll try giving you a call tomorrow at 10:00AM ET but please feel free to suggest a more convenient time. I look forward to speaking with you then.', 0),

    (0, 2,'Yosemite Sam', '5: High', 'Pre-contact lead process. Step: Call - Leave VM', 'Call - Leave VM', '2025-01-02', 0, 'Pre-Contact Lead', 1, 0, 2, 2, 'Call - Leave VM', 'None', 'Hi, I am following up on my email yesterday in regards to your recent registration on our company website. It\'s often helpful to have a quick conversation about the application in case we have a better suited product configuration that\'s not on the website. We also have a couple new products nearing release that may be of interest. Feel free to call me back anytime. I do have a couple meetings so if I haven\'t heard back by tomorrow afternoon I\'ll give you one last ring. Thanks.', 1);


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

    INSERT INTO `prefup` 
    (`process`, `step_num`, `step_name`, `email_subject`, `email_body`, `days`) VALUES
    (1, 1, 'Email 1A', 'Website registration follow-up', 'Hello, I am reaching out in regards to your recent registration on our website. We\'ve found it\'s often helpful to have a quick follow-up conversation since we have a large variety of product configurations, some of which aren\'t listed on the website. I\'ll try giving you a call tomorrow at 10:00AM ET but please feel free to suggest a more convenient time. I look forward to speaking with you then.', 0),
    (1, 2, 'Call - Leave VM', 'None', 'Hi, I am following up on my email yesterday in regards to your recent registration on our company website. It\'s often helpful to have a quick conversation about the application in case we have a better suited product configuration that\'s not on the website. We also have a couple new products nearing release that may be of interest. Feel free to call me back anytime. I do have a couple meetings so if I haven\'t heard back by tomorrow afternoon I\'ll give you one last ring. Thanks.', 1),
    (1, 3, 'Call - No VM', 'None', 'None', 2),
    (1, 4, 'Email 2A', 'Re: Website registration follow-up', 'Hi, I wanted to send over one last email as an open invitation to send me over any application specs. I\'m happy to take a look. If we have something that looks like a good fit I\'ll send over a couple product recommendations. Otherwise hopefully I can help point you towards another vendor. Thank you.', 2),
    (2, 1, 'Email 1B', 'Website registration follow-up', 'Hello, I am reaching out in regards to your recent registration on our website. We\'ve found it\'s often helpful to have a quick follow-up conversation since we have a large variety of product configurations, some of which aren\'t listed on the website. I\'ll try giving you a call tomorrow at 10:00AM ET but please feel free to suggest a more convenient time. I look forward to speaking with you then.', 0),
    (2, 2, 'Call - Leave VM', 'None', 'Hi, I am following up on my email yesterday in regards to your recent registration on our company website. It\'s often helpful to have a quick conversation about the application in case we have a better suited product configuration that\'s not on the website. We also have a couple new products nearing release that may be of interest. Feel free to call me back anytime. I do have a couple meetings so if I haven\'t heard back by tomorrow afternoon I\'ll give you one last ring. Thanks.', 1);