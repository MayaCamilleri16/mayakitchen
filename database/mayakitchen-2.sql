-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 25, 2024 at 06:27 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mayakitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `appOrders`
--

CREATE TABLE `appOrders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','completed','canceled') DEFAULT NULL,
  `delivery_type` enum('delivery','pickup') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appOrders`
--

INSERT INTO `appOrders` (`order_id`, `user_id`, `order_date`, `total_price`, `status`, `delivery_type`) VALUES
(2, 2, '2025-06-04 00:00:00', '40.00', 'confirmed', 'pickup');

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `party_size` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `preferences_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`id`, `user_id`, `date`, `time`, `party_size`, `discount_id`, `preferences_id`) VALUES
(2, 2, '2024-04-16', '25:09:00', 2, 1, 1),
(3, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(4, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(5, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(6, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(7, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(8, 1, '2024-04-04', '18:01:15', 5, 1, 2),
(9, 1, '2024-04-04', '18:01:15', 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `DailySpecials`
--

CREATE TABLE `DailySpecials` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `food_special` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DailySpecials`
--

INSERT INTO `DailySpecials` (`id`, `date`, `food_special`, `price`, `description`, `created_at`, `updated_at`) VALUES
(2, '2024-04-03', 'Nuggets', '10.00', 'With bbq sauce', '2024-04-20 14:32:18', '2024-04-20 18:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `percentage`, `expiry_date`) VALUES
(1, 'Mayakitchen', '20.00', '2024-04-12'),
(2, 'Mayakitchen', '10.00', '2024-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drink_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`drink_id`, `name`, `price`) VALUES
(1, 'gin', '8'),
(3, 'Kinnie', '2'),
(4, 'Sprite', '2'),
(5, 'Dr Pepper', '2'),
(6, 'Schweppes', '2'),
(7, 'est Lager', '3'),
(8, 'Fonteinen Intens Rood', '3'),
(9, 'cisk', '3'),
(10, 'Paddles Home Sweet Home', '3'),
(11, 'still water', '1'),
(12, 'sparkling water', '1'),
(13, 'Martini', '6');

-- --------------------------------------------------------

--
-- Table structure for table `event_feedback`
--

CREATE TABLE `event_feedback` (
  `feedback_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_feedback`
--

INSERT INTO `event_feedback` (`feedback_id`, `event_id`, `user_id`, `rating`, `comment`, `time`) VALUES
(1, 2, 4, '5.00', 'beautiful event ', '2024-04-19 08:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `event_management`
--

CREATE TABLE `event_management` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `party_size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_management`
--

INSERT INTO `event_management` (`event_id`, `user_id`, `event_name`, `event_date`, `event_time`, `party_size`) VALUES
(2, 3, 'Forget Me Not', '2024-04-25', '21:45:06', '2'),
(3, 4, 'Rock', '2024-04-12', '19:02:12', '6'),
(4, 4, 'Rock', '2024-04-12', '19:02:12', '6'),
(5, 4, 'Rock', '2024-04-12', '19:02:12', '6');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`name`, `price`, `extra`, `food_id`) VALUES
('Salt and pepper calamari with confit garlic aioli', '9.00', 'cheese', 2),
('mushroom and chicken pie', '5.00', 'cheese', 3),
('Parmesan-crumbed chicken schnitzel, fried egg and apple and cabbage slaw', '15.00', 'cabbage slaw', 4),
('Shannon Bennett\'s rib-eye with anchovy butter and roasted cauliflower', '15.00', 'butter', 5),
('Loaded quattro formaggi (four cheese) burgers', '13.99', 'burger', 6),
('Slow-cooked eggplant parmigiana', '6.00', 'eggs', 7),
('Matt Preston\'s Mexican black bean and corn nachos', '11.00', 'corn', 8),
('Barbecued butterflied lamb with olive oil chips', '19.00', 'sauce', 9),
('Parmesan and sage pork cutlets with spiced tomato relish', '15.00', 'tomatoes', 10),
('Beef brisket with horseradish mash', '20.00', 'beef', 11),
('Baked bangers with caramelised sriracha onions', '19.00', 'caramelised sriracha onions', 12),
('Fish burgers', '10.00', 'sauce', 13),
('Panko and pea-crumbed snapper', '8.00', 'none', 14),
('Lamb burgers with buffalo mozzarella and cucumber salad', '10.00', 'buffalo mozzarella', 15),
('Asian-style fish and sesame-salt chips', '6.00', 'chips', 16),
('Roasted sweet potatoes with chilli and seeds', '3.50', 'sauce ', 17),
('Vegetarian haloumi hash burgers with kale aioli', '12.00', 'haloumi ', 18),
('Sticky date puddings with butterscotch sauce', '4.00', 'butterscotch sauce', 19),
('Layered berry crumble', '5.00', 'berries', 20),
('Banana, strawberry and choc ice-cream sundae', '3.00', 'smarties', 21),
('Chocolate lava cakes', '3.00', 'chocolate ', 22),
('Affogato', '6.00', 'liquor', 23),
('Marmalade bread & butter pudding', '4.00', 'marmalade ', 24),
('Choc-caramel brownie pudding and hot fudge sauce', '3.50', 'fudge sauce', 25),
('Sticky golden syrup dumplings', '2.50', 'syrup', 26),
('Double chocolate creme brulee', '5.00', 'creme', 27);

-- --------------------------------------------------------

--
-- Table structure for table `food_preferences`
--

CREATE TABLE `food_preferences` (
  `preferences_id` int(11) NOT NULL,
  `preference_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_preferences`
--

INSERT INTO `food_preferences` (`preferences_id`, `preference_name`) VALUES
(1, 'Lactose'),
(2, 'Vegetarian'),
(3, 'Gluten-free'),
(5, 'Lactose'),
(6, 'Lactose'),
(7, 'Vegan');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_program`
--

CREATE TABLE `loyalty_program` (
  `user_id` int(11) NOT NULL,
  `points` decimal(10,2) NOT NULL,
  `discount_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loyalty_program`
--

INSERT INTO `loyalty_program` (`user_id`, `points`, `discount_id`) VALUES
(1, '100.00', 2),
(4, '5.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `drink_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `booking_id`, `food_id`, `drink_id`, `discount_id`, `table_id`, `offer_id`, `status`) VALUES
(2, 9, 5, 5, 1, 6, 3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `prep_time_minutes` varchar(100) NOT NULL,
  `cook_time_minutes` int(11) NOT NULL,
  `total_time_minutes` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `meal_type` enum('Breakfast','Lunch','Dinner','Snack','Dessert') NOT NULL,
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `recipe_name`, `prep_time_minutes`, `cook_time_minutes`, `total_time_minutes`, `servings`, `meal_type`, `instructions`) VALUES
(1, 'Spaghetti Carbonara', '10', 15, 30, 4, 'Dinner', '1. Bring a large pot of salted water to a boil and cook the spaghetti according to package directions until al dente.\n2. While the pasta cooks, heat a large skillet over medium heat. Add the diced pancetta or bacon and cook until crispy.\n3. In a bowl, whisk together the eggs, Parmesan cheese, and black pepper.\n4. When the pasta is ready, reserve 1/2 cup of the pasta water and drain the rest.\n5. Add the cooked pasta to the skillet with the pancetta or bacon and toss to combine.\n6. Remove the skillet from heat and quickly pour in the egg and cheese mixture. Toss until the eggs coat the pasta and begin to cook from the residual heat.\n7. Add the reserved pasta water a little at a time if needed to create a creamy sauce.\n8. Serve the Spaghetti Carbonara immediately, garnished with extra grated Parmesan cheese and black pepper if desired.'),
(3, 'Affogato', '15', 0, 15, 20, 'Snack', 'Espresso – This is a small concentrated shot of hot coffee. The standard size for a shot of espresso is 30 ml (1 ounce).\r\n\r\nIt goes without saying that the better your coffee, the better your affogato!\r\n\r\nVanilla gelato or ice cream – Traditionally gelato though ice cream is just as good, in my opinion! More important is the flavour. Vanilla is the classic choice because it pairs so well with coffee. Feel free to experiment!\r\n\r\nHow much ice cream – Use one large(ish) or two small(ish) scoops for one shot of coffee, for a good balance of the two. Though if using liquor, I lean towards two medium scoops, as pictured.\r\n\r\nLiquor (optional) – To roll your after dinner drink into this all-in-one dessert, add half a shot of liquor! Amaretto (almond flavour) and frangelico (hazelnut) are probably the most common. Rum, sambuca and Kahlua are also standard offerings at Italian restaurants, and multiple readers suggested orange liqueurs (such as Grand Marnier and Cointreau). Though really, you can add anything you think/know goes well with coffee!\r\n\r\nPS A shot of liquor is 30 ml / 1 ounce so half a shot is 15 ml / 0.5 ounce which is 1 tablespoon. Though nobody will hold you back from dialling the quantity up. '),
(4, 'Chocolate banoffee pie', '30', 10, 40, 20, 'Dessert', 'Buttery baking spread*, melted\r\n85g\r\nReduced fat dark chocolate digestive biscuits, crushed\r\n250g\r\nDark chocolate, melted (we like 70% cocoa solids chocolate)\r\n150g\r\nCarnation Caramel\r\n397g\r\nBananas\r\n2\r\nCarton whipping cream, whipped to soft peaks\r\n200ml\r\nCocoa powder, to dust\r\n* Recipe is based on 70% fat buttery baking spread\r\nYou will also need…\r\n20cm loose-bottomed cake tin'),
(5, 'Banana, strawberry and choc ice-cream sundae', '20', 0, 20, 10, 'Dessert', '1/2 cup dark chocolate melts\r\n2 tbsp pure cream\r\n2 bananas, peeled, sliced\r\n12 strawberries, hulled, quartered\r\n8 scoops vanilla ice-cream\r\n35g packet mini M&Ms'),
(6, 'Spaghetti Bolognese', '15', 45, 60, 4, 'Dessert', 'Cook the spaghetti as per package instructions. In a separate pan, cook the ground beef until browned. Add tomato sauce and simmer for 20 minutes. Combine with cooked spaghetti and serve.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rating`, `comment`, `time`) VALUES
(1, 1, '2.00', 'poor service', '2024-04-13 10:11:23'),
(7, 1, '5.00', 'Good service, polite waiters', '2024-04-11 06:58:16'),
(8, 1, '5.00', 'Good service, polite waiters', '2024-04-13 10:07:02'),
(9, 1, '5.00', 'Good service, polite waiters', '2024-04-13 10:09:06'),
(10, 1, '5.00', 'Good service, polite waiters', '2024-04-25 15:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `serve_feedback`
--

CREATE TABLE `serve_feedback` (
  `serve_feedback_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serve_feedback`
--

INSERT INTO `serve_feedback` (`serve_feedback_id`, `order_id`, `rating`, `comment`) VALUES
(2, 2, '4.50', 'Great service!');

-- --------------------------------------------------------

--
-- Table structure for table `special_offers`
--

CREATE TABLE `special_offers` (
  `offer_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `valid_until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `special_offers`
--

INSERT INTO `special_offers` (`offer_id`, `name`, `discount_percentage`, `valid_until`) VALUES
(1, 'Beers', '10.00', '2024-04-25'),
(3, 'SoftDrinks', '5.00', '2024-05-31'),
(5, 'pasta', '20.00', '2024-05-31'),
(6, 'Burgers', '50.00', '2024-05-31'),
(7, 'Burgers', '50.00', '2024-05-31'),
(8, 'Burgers', '50.00', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `table_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `current_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_shifts`
--

CREATE TABLE `staff_shifts` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_shifts`
--

INSERT INTO `staff_shifts` (`id`, `staff_id`, `start_time`, `end_time`, `date`) VALUES
(1, 2, '10:28:18', '15:28:18', '2024-04-22'),
(3, 3, '09:00:00', '16:00:00', '2024-04-19'),
(4, 19, '09:00:00', '16:00:00', '2024-04-19'),
(5, 19, '09:00:00', '16:00:00', '2024-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `staff_work`
--

CREATE TABLE `staff_work` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_work`
--

INSERT INTO `staff_work` (`staff_id`, `username`, `password`, `email`, `role`) VALUES
(17, 'deborah9', '123', 'deborah@gmail.com', 'manager'),
(18, 'Jack Nelson', '345', 'JackNelsonh@gmail.com', 'Chef'),
(19, 'Leon', '657', 'LeonSpiteri@gmail.com', 'waiter'),
(20, 'Leon', '657', 'LeonSpiteri@gmail.com', 'waiter'),
(21, 'Leon', '657', 'LeonSpiteri@gmail.com', 'waiter'),
(22, 'Leon', '657', 'LeonSpiteri@gmail.com', 'waiter'),
(23, 'Leon', '657', 'LeonSpiteri@gmail.com', 'waiter');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `number` decimal(10,0) NOT NULL,
  `available` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `number`, `available`) VALUES
(2, '1', '0'),
(3, '4', '0'),
(4, '3', '0'),
(5, '2', '0'),
(6, '8', '0'),
(7, '6', '0'),
(8, '7', '0'),
(9, '10', '0'),
(10, '9', '0'),
(11, '5', '0'),
(12, '13', 'yes'),
(13, '5', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `UserOrdersApp`
--

CREATE TABLE `UserOrdersApp` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity_food` int(11) NOT NULL,
  `drink_id` int(11) NOT NULL,
  `quantity_drink` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserOrdersApp`
--

INSERT INTO `UserOrdersApp` (`order_id`, `food_id`, `quantity_food`, `drink_id`, `quantity_drink`, `discount_id`, `user_id`) VALUES
(1, 23, 2, 9, 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`) VALUES
(1, 'kylie', 'kylie2003@gmail.com', '$2y$10$6LgfkAidn90vlb/jMTxQIO5ySa7IhqzHyu/t2w8yeVlz1NxTxPK1a'),
(2, 'mayadebono2', 'mayadeb@gmail.com', 'msms'),
(3, '', '', ''),
(4, 'Kyle', 'kyle2003@gmail.com', 'kyle'),
(5, 'Kyle', 'kyle2003@gmail.com', 'kyle'),
(6, 'Kyle', 'kyle2003@gmail.com', 'kyle'),
(7, 'Kyle', 'kyle2003@gmail.com', 'kyle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appOrders`
--
ALTER TABLE `appOrders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_ibfk_1` (`user_id`),
  ADD KEY `bookings_ibfk_2` (`discount_id`),
  ADD KEY `preferences_id` (`preferences_id`);

--
-- Indexes for table `DailySpecials`
--
ALTER TABLE `DailySpecials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indexes for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_management`
--
ALTER TABLE `event_management`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_preferences`
--
ALTER TABLE `food_preferences`
  ADD PRIMARY KEY (`preferences_id`);

--
-- Indexes for table `loyalty_program`
--
ALTER TABLE `loyalty_program`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `drink_id` (`drink_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `serve_feedback`
--
ALTER TABLE `serve_feedback`
  ADD PRIMARY KEY (`serve_feedback_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `special_offers`
--
ALTER TABLE `special_offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`table_id`),
  ADD KEY `staff_ibfk_1` (`current_order_id`);

--
-- Indexes for table `staff_shifts`
--
ALTER TABLE `staff_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_work`
--
ALTER TABLE `staff_work`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `UserOrdersApp`
--
ALTER TABLE `UserOrdersApp`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `drink_id` (`drink_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appOrders`
--
ALTER TABLE `appOrders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `DailySpecials`
--
ALTER TABLE `DailySpecials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event_feedback`
--
ALTER TABLE `event_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_management`
--
ALTER TABLE `event_management`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `food_preferences`
--
ALTER TABLE `food_preferences`
  MODIFY `preferences_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loyalty_program`
--
ALTER TABLE `loyalty_program`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `serve_feedback`
--
ALTER TABLE `serve_feedback`
  MODIFY `serve_feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `special_offers`
--
ALTER TABLE `special_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_shifts`
--
ALTER TABLE `staff_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_work`
--
ALTER TABLE `staff_work`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appOrders`
--
ALTER TABLE `appOrders`
  ADD CONSTRAINT `apporders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`preferences_id`) REFERENCES `food_preferences` (`preferences_id`) ON UPDATE CASCADE;

--
-- Constraints for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD CONSTRAINT `event_feedback_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_management` (`event_id`),
  ADD CONSTRAINT `event_feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `loyalty_program`
--
ALTER TABLE `loyalty_program`
  ADD CONSTRAINT `loyalty_program_ibfk_1` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `Bookings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`drink_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_5` FOREIGN KEY (`offer_id`) REFERENCES `special_offers` (`offer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_6` FOREIGN KEY (`table_id`) REFERENCES `tables` (`table_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `serve_feedback`
--
ALTER TABLE `serve_feedback`
  ADD CONSTRAINT `serve_feedback_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`current_order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `UserOrdersApp`
--
ALTER TABLE `UserOrdersApp`
  ADD CONSTRAINT `userordersapp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userordersapp_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userordersapp_ibfk_3` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userordersapp_ibfk_4` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`drink_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
