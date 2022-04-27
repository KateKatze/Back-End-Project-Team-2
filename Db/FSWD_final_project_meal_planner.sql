-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2022 at 10:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd_final_project_meal_planner`
--
CREATE DATABASE IF NOT EXISTS `fswd_final_project_meal_planner` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd_final_project_meal_planner`;

-- --------------------------------------------------------

--
-- Table structure for table `meal_plan`
--

CREATE TABLE `meal_plan` (
  `meal_plan_id` int(11) NOT NULL,
  `fk_users_id` int(11) NOT NULL,
  `fk_recipe_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fk_recipe_manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `ingredients` varchar(650) NOT NULL,
  `description` varchar(650) NOT NULL,
  `prep_time` decimal(4,0) NOT NULL,
  `calories` int(4) NOT NULL,
  `diet` enum('regular','vegetarian','high-protein','low-carb') NOT NULL,
  `url` varchar(130) NOT NULL,
  `picture` varchar(260) DEFAULT NULL,
  `type` enum('breakfast','lunch','dinner','') DEFAULT NULL,
  `typeindex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `name`, `ingredients`, `description`, `prep_time`, `calories`, `diet`, `url`, `picture`, `type`, `typeindex`) VALUES
(4, 'Easy classic lasagne', '1 tbsp olive oil\r\n2 rashers smoked streaky bacon\r\n1 onion , finely chopped\r\n1 celery stick, finely chopped\r\n1 medium carrot , grated\r\n2 garlic cloves , finely chopped\r\n500g beef mince\r\n1 tbsp tomato puree\r\n2 x 400g cans chopped tomatoes\r\n1 tbsp clear honey\r\n500g pack fresh egg lasagne sheets\r\n400ml creme fraiche\r\n125g ball mozzarella , roughly torn\r\n50g freshly grated parmesan\r\nlarge handful basil leaves , torn (optional)', 'Kids will love to help assemble this easiest ever pasta bake with streaky bacon, beef mince, a crème fraîche sauce and gooey mozzarella', '75', 844, 'regular', 'https://www.bbcgoodfood.com/recipes/classic-lasagne', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/classic-lasange-4a66137.jpg?quality=90&webp=true&resize=300,272', 'dinner', 3),
(6, 'Butternut chilli', '600g medium vine tomatoes, or 400g can chopped or cherry tomatoes\r\n2 tbsp olive oil\r\n2 onions, finely chopped\r\n2 large garlic cloves, finely chopped\r\n1 red birds-eye chilli, deseeded and finely chopped\r\n1 tsp cayenne pepper\r\n1 tsp oregano\r\n1 bay leaf\r\n600g butternut squash, peeled and cut into cubes\r\n12 pitted green olives, roughly chopped\r\n150ml red wine\r\n½ vegetable stock cube\r\n200g jar piquillo pimiento peppers, or 2 roasted Romano peppers, roughly chopped', 'This Mexican stew is hearty enough to satisfy both vegetarians and meat eaters, with butternut squash, black beans and juicy tomatoes', '90', 370, 'regular', 'https://www.bbcgoodfood.com/recipes/butternut-chilli', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/butternut-chilli-14a4860.jpg?quality=90&webp=true&resize=300,272', 'dinner', 3),
(7, 'Next level paella', '3 tbsp olive oil\r\n10 large raw tiger prawns in their shells, heads removed and kept\r\nsmall bunch of parsley, leaves and stalks separated, leaves roughly chopped\r\n100ml dry sherry or white wine\r\n500g mussels\r\nlarge pinch of saffron strands\r\n150g cooking chorizo, cut into chunks\r\n1 onion, finely chopped\r\n3 garlic cloves, finely chopped\r\n1 medium squid (about 300g), cleaned and cut into rings with tentacles intact\r\n2 ripe tomatoes, roughly chopped\r\n250g paella rice\r\n100g frozen podded broad beans or peas (or a mixture of the two), defrosted\r\n1 lemon, finely zested then cut into wedges\r\nsmoked sea salt (optional)', 'Choose the freshest ingredients for a world-class paella with our ultimate recipe. Serve this classic Spanish seafood dish in the pan to impress your guests', '90', 600, 'vegetarian', 'https://www.bbcgoodfood.com/recipes/next-level-paella', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/paella-308c905.jpg?quality=90&webp=true&resize=300,272', 'lunch', 2),
(10, 'Pea & broad bean shakshuka', '1 bunch asparagus spears\r\n200g sprouting broccoli\r\n2 tbsp olive oil\r\n2 spring onions , finely sliced\r\n2 tsp cumin seeds\r\nlarge pinch cayenne pepper , plus extra to serve\r\n4 ripe tomatoes , chopped\r\n1 small pack parsley , finely chopped\r\n50g shelled peas\r\n50g podded broad beans\r\n4 large eggs\r\n50g pea shoots\r\nGreek yogurt and flatbreads, to serve', 'We’ve turned a classic brunch shakshuka dish into more of a sharing main course by adding seasonal spring vegetables like peas, broad beans and asparagus', '50', 199, 'vegetarian', 'https://www.bbcgoodfood.com/recipes/pea-broad-bean-shakshuka', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/pea-shakshuka-02f8597.jpg?quality=90&webp=true&resize=300,272', 'breakfast', 1),
(11, 'Burrito bowl with chipotle black beans', '125g basmati rice\r\n1 tbsp olive oil\r\n2 garlic cloves, chopped\r\n400g can black beans, drained and rinsed\r\n1 tbsp cider vinegar\r\n1 tsp honey\r\n1 tbsp chipotle paste\r\n100g chopped curly kale\r\n1 avocado, halved and sliced\r\n1 medium tomato, chopped\r\n1 small red onion, chopped', 'This healthy burrito bowl is chock full of veggies and greens, perfect for a filling lunch. This is one vegetarian meal that tastes just as good as it looks', '30', 573, 'vegetarian', 'https://www.bbcgoodfood.com/recipes/burrito-bowl-chipotle-black-beans', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/burrito-bowl-3629880.jpg?quality=90&webp=true&resize=300,272', 'breakfast', 1),
(12, 'Kefir breakfast smoothie', '1 large mango , stoned and chopped\r\n2cm piece ginger , finely grated\r\n½ tsp ground turmeric\r\n200ml fresh orange juice\r\n300ml kefir\r\n1-2 tbsp honey or agave, to taste', 'Kick-start your morning with this probiotic-rich kefir breakfast smoothie. With mango, orange juice, ginger and turmeric, you\'ll be ready for the day ahead', '5', 201, 'low-carb', 'https://www.bbcgoodfood.com/recipes/kefir-breakfast-smoothie', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/kefir-breakfast-smoothie-dd34b92.jpg?quality=90&webp=true&resize=300,272', 'breakfast', 1),
(13, 'Raspberry, almond & oat breakfast cookies', '2 ripe bananas , mashed\r\n150g porridge oats\r\n2 tbsp ground almonds\r\n1⁄2 tsp cinnamon\r\n100g raspberries (fresh or frozen)', 'Grab a few of these energy-boosting cookies for a quick breakfast, or offer as snacks to bridge the hunger gap before dinner. Enjoy with yogurt and fruit', '25', 86, 'low-carb', 'https://www.bbcgoodfood.com/recipes/raspberry-almond-oat-breakfast-cookies', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/raspberry-almond-oat-breakfast-cookies-c76041a.jpg?quality=90&webp=true&resize=300,272', 'breakfast', 1),
(44, 'Giant Yorkshire pudding', 'Yorkshire pudding: 2 large eggs (these should make 100ml in a jug)\r\n70g plain flour\r\n100ml whole milk\r\nrapeseed or sunflower oil, for the tin\r\nRoast:\r\n1 fat steak (rather than a long, thin one)\r\nrapeseed oil, for frying\r\n1 large potato\r\n2 carrots, peeled and cut into batons, or 8-10 baby carrots\r\n4 stems Tenderstem broccoli\r\n200-300ml gravy', 'Try this twist on a Sunday roast, with steak, potatoes, veg and gravy served in a giant Yorkshire pudding. Prep ahead and make Sunday lunch in no time.', '15', 746, 'high-protein', 'https://www.bbcgoodfood.com/recipes/giant-yorkshire-pudding-sunday-lunch', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/giant_yorkshire_roast_dinner-1d2d3b8.jpg?quality=90&webp=true&resize=300,272', 'lunch', 2),
(45, 'Avocado & black bean eggs', '2 tsp rapeseed oil\r\n1 red chilli, deseeded and thinly sliced\r\n1 large garlic clove, sliced\r\n2 large eggs\r\n400g can black beans\r\n½ x 400g can cherry tomatoes\r\n¼ tsp cumin seeds\r\n1 small avocado, halved and sliced\r\nhandful fresh, chopped coriander\r\n1 lime, cut into wedges', 'Set yourself up for the day with this healthy veggie breakfast with eggs, avocado and black beans. It takes just 10 minutes to throw together and makes a great lunch, too.', '5', 356, 'high-protein', 'https://www.bbcgoodfood.com/recipes/avocado-black-bean-eggs', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/avocado_blackbean_eggs-9b605bb.jpg?quality=90&webp=true&resize=300,272', 'lunch', 2),
(46, 'Honey & mustard chicken thighs', '1 tbsp honey\r\n1 tbsp wholegrain mustard\r\n2 garlic cloves, crushed\r\nzest and juice 1 lemon\r\n4 chicken thighs, skin on\r\n300g new potatoes, unpeeled, smaller left whole, bigger halved\r\n1 tbsp olive oil\r\n100g spinach\r\n100g frozen peas', 'This self-saucing one-pot is like a roast dinner without the fuss. Plus it\'s rich in iron, fibre and folate.', '50', 571, 'regular', 'https://www.bbcgoodfood.com/recipes/honey-mustard-chicken-thighs-spring-veg', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/honey-mustard-chicken-thighs-with-spring-veg-6cee676.jpg?quality=90&webp=true&resize=300,272', 'dinner', 3),
(47, 'Cashew curry', '1 small onion , chopped\r\n3-4 garlic cloves\r\nthumb-sized piece ginger , peeled and roughly chopped\r\n3 green chillies , deseeded\r\nsmall pack coriander , leaves picked and stalk roughly chopped\r\n100g unsalted cashews\r\n2 tbsp coconut oil\r\n1 ½ tbsp garam masala\r\n400g can chopped tomatoes\r\n450ml chicken stock\r\n3 large chicken breasts (about 475g), any visible fat removed, chopped into chunks\r\n155g fat-free Greek yogurt\r\n10ml single cream', 'This easy low-carb lunch is packed with iron rich veggies, crunchy cashews and chicken. Serve with your favorite steamed greens and a scattering of coriander.', '80', 508, 'low-carb', 'https://www.bbcgoodfood.com/recipes/cashew-curry', 'https://images.immediate.co.uk/production/volatile/sites/30/2020/08/cashew-curry_0-b7dfdfc.jpg?quality=90&webp=true&resize=300,272', 'dinner', 3);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_manager`
--

CREATE TABLE `recipe_manager` (
  `recipe_manager_id` int(11) NOT NULL,
  `fk_recipe_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(260) NOT NULL,
  `user_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `password`, `image`, `user_status`) VALUES
(9, 'Kate', 'Katze', 'kate@katze.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://i.weltbild.de/p/meine-katze-ist-ein-arschloch-deine-auch-257028754.jpg?v=10&wp=_max', 'adm'),
(12, 'Toto', 'Roooo', 'toto@roo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://c4-static.dodax.com/v2/360-360-98517498_DDbKa-png', 'user'),
(13, 'Road', 'Runner', 'road@runner.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://www.imago-images.de/bild/st/0153183811/w.jpg', 'user'),
(14, 'Longhorn', 'Foghorn', 'longhorn@foghorn.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://assets.dragoart.com/images/6934_501/how-to-draw-foghorn-leghorn_5e4c89efef3624.86706911_29188_3_4.jpg', 'user'),
(16, 'WillE', 'Coyote', 'wille@coyote.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://cdn.vox-cdn.com/thumbor/0RDGf9j-MBjhB9qy_shC6VpSdUg=/0x0:458x344/920x613/filters:focal(0x0:458x344):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/45826606/cliff.0.0.jpg', 'user'),
(17, 'Daffy', 'Duck', 'daffy@duck.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://i.discogs.com/AlSas4TEmmv89taR_koo0qJNOwVAXscHLhPdBW6H0cA/rs:fit/g:sm/q:90/h:452/w:324/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTEyOTMz/Ny0xMTQ0ODQ5ODk4/LmpwZWc.jpeg', 'user'),
(18, 'Bugs', 'Bunny', 'bugs@bunny.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'https://www.bravo.de/assets/styles/image_style_gallery_image/public/field/image/die-beliebtesten-comicfiguren-bugs-bunny.jpg?itok=xXetUHtZ', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meal_plan`
--
ALTER TABLE `meal_plan`
  ADD PRIMARY KEY (`meal_plan_id`),
  ADD KEY `fk_users_id` (`fk_users_id`),
  ADD KEY `fk_recipe_id` (`fk_recipe_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `recipe_manager`
--
ALTER TABLE `recipe_manager`
  ADD PRIMARY KEY (`recipe_manager_id`),
  ADD KEY `fk_recipe_id` (`fk_recipe_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meal_plan`
--
ALTER TABLE `meal_plan`
  MODIFY `meal_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `recipe_manager`
--
ALTER TABLE `recipe_manager`
  MODIFY `recipe_manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meal_plan`
--
ALTER TABLE `meal_plan`
  ADD CONSTRAINT `fk_recipe_id` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_manager`
--
ALTER TABLE `recipe_manager`
  ADD CONSTRAINT `recipe_manager_ibfk_1` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipe_manager_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
