CREATE TABLE IF NOT EXISTS `people` (
    `id` int(100) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

Insert into `people` 
    (`id`, 
    `name`, 
    `email`, 
    `phone`, 
    `created`) 
values
    (1, 'John Doe', 'johndoe@example.com', '2026550143', '2022-05-08 17:32:00'),
    (2, 'David Deacon', 'daviddeacon@example.com', '2025550121', '2022-05-08 17:28:44'),
    (3, 'Sam White', 'samwhite@example.com', '2004550121', '2022-05-08 17:29:27'),
    (4, 'Colin Chaplin', 'colinchaplin@example.com', '2022550178', '2022-05-08 17:29:27'),
    (5, 'Ricky Waltz', 'rickywaltz@example.com', '7862342390', '2022-05-09 19:16:00'),
    (6, 'Arnold Hall', 'arnoldhall@example.com', '5089573579', '2022-05-09 19:17:00'),
    (7, 'Toni Adams', 'alvah1981@example.com', '2603668738', '2022-05-09 19:19:00'),
    (8, 'Donald Perry', 'donald1983@example.com', '7019007916', '2022-05-09 19:20:00'),
    (9, 'Joe McKinney', 'nadia.doole0@example.com', '6153353674', '2022-05-09 19:20:00'),
    (10, 'Angela Horst', 'angela1977@example.com', '3094234980', '2022-05-09 19:21:00'),
    (11, 'James Jameson', 'james1965@example.com', '4002349823', '2022-05-09 19:32:00'),
    (12, 'Daniel Deacon', 'danieldeacon@example.com', '5003423549', '2022-05-09 19:33:00'); 