# login-page
Made while I was studying php. 

<p align="center">
    <img src="https://imgur.com/NTtYXFf.png">
    <img src="https://i.imgur.com/vbPZhX3.png">
    <img src="https://imgur.com/QDhAwhz.png">
    <img src="https://imgur.com/Ud35FrU.png">
</p>
The option "Filme Aleatório" return a random page of a movie you still haven't watched.

## Database tables (mysql)
Information about database connection in ``` utils/database.php ```
```
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `editedAt` varchar(255) NOT NULL,
  `deletedAt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `synopsis` text NOT NULL,
  `watched` varchar(2) DEFAULT NULL,
  `grade` float DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`userid`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;
```
