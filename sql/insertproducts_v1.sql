-- Voeg de 6 categorieën toe
INSERT INTO `categories` (`name`, `description`) VALUES
('Breakfast', 'Start your day right with these healthy options.'),
('Lunch & Dinner', 'Nourishing and filling bowls.'),
('Handhelds (Wraps & Sandwiches)', 'Delicious handheld meals.'),
('Sides & Small Plates', 'Perfect for sharing or as an extra.'),
('Signature Dips', 'Enhance your meal with our signature dips.'),
('Drinks', 'Refreshing and healthy beverages.');

-- Voeg de 25 producten toe, gekoppeld aan de juiste category_id
INSERT INTO `products` (`category_id`, `image_id`, `name`, `description`, `price`, `kcal`, `available`) VALUES
-- 1. Breakfast (category_id = 1)
(1, NULL, 'Morning Boost Açaí Bowl (VG)', 'A chilled blend of açaí and banana topped with crunchy granola, chia seeds, and coconut.', 7.50, 320, 1),
(1, NULL, 'The Garden Breakfast Wrap (V)', 'Whole-grain wrap with fluffy scrambled eggs, baby spinach, and a light yogurt-herb sauce.', 6.50, 280, 1),
(1, NULL, 'Peanut Butter & Cacao Toast (VG)', 'Sourdough toast with 100% natural peanut butter, banana, and a sprinkle of cacao nibs.', 5.00, 240, 1),
(1, NULL, 'Overnight Oats: Apple Pie Style (VG)', 'Oats soaked in almond milk with grated apple, cinnamon, and crushed walnuts.', 5.50, 290, 1),

-- 2. Lunch & Dinner (category_id = 2)
(2, NULL, 'Tofu Power Tahini Bowl (VG)', 'Tri-color quinoa, maple-glazed tofu, roasted sweet potatoes, and kale with tahini dressing.', 10.50, 480, 1),
(2, NULL, 'The Supergreen Harvest (VG)', 'Massaged kale, edamame, avocado, cucumber, and toasted pumpkin seeds with lemon-olive oil.', 9.50, 310, 1),
(2, NULL, 'Mediterranean Falafel Bowl (VG)', 'Baked falafel, hummus, pickled red onions, cherry tomatoes, and cucumber on a bed of greens.', 10.00, 440, 1),
(2, NULL, 'Warm Teriyaki Tempeh Bowl (VG)', 'Steamed brown rice, seared tempeh, broccoli, and shredded carrots with a ginger-soy glaze.', 11.00, 500, 1),

-- 3. Handhelds (Wraps & Sandwiches) (category_id = 3)
(3, NULL, 'Zesty Chickpea Hummus Wrap (VG)', 'Spiced chickpeas, shredded carrots, crisp lettuce, and signature hummus in a whole-wheat wrap.', 8.50, 410, 1),
(3, NULL, 'Avocado & Halloumi Toastie (V)', 'Grilled halloumi cheese, smashed avocado, and chili flakes on thick-cut multi-grain bread.', 9.00, 460, 1),
(3, NULL, 'Smoky BBQ Jackfruit Slider (VG)', 'Pulled jackfruit in BBQ sauce with a crunchy purple slaw on a vegan brioche bun.', 7.50, 350, 1),

-- 4. Sides & Small Plates (category_id = 4)
(4, NULL, 'Oven-Baked Sweet Potato Wedges (VG)', 'Seasoned with smoked paprika. (Best with Avocado Lime Dip).', 4.50, 260, 1),
(4, NULL, 'Zucchini Fries (V)', 'Crispy breaded zucchini sticks. (Best with Greek Yogurt Ranch).', 4.50, 190, 1),
(4, NULL, 'Baked Falafel Bites - 5pcs (VG)', '', 5.00, 230, 1),
(4, NULL, 'Mini Veggie Platter & Hummus (VG)', 'Fresh crunch: Celery, carrots, and cucumber.', 4.00, 160, 1),

-- 5. Signature Dips (category_id = 5)
(5, NULL, 'Classic Hummus (VG)', '', 1.00, 120, 1),
(5, NULL, 'Avocado Lime Crema (VG)', '', 1.00, 110, 1),
(5, NULL, 'Greek Yogurt Ranch (V)', '', 1.00, 90, 1),
(5, NULL, 'Spicy Sriracha Mayo (VG)', '', 1.00, 180, 1),
(5, NULL, 'Peanut Satay Sauce (VG)', '', 1.00, 200, 1),

-- 6. Drinks (category_id = 6)
(6, NULL, 'Green Glow Smoothie (VG)', 'Spinach, pineapple, cucumber, and coconut water.', 3.50, 120, 1),
(6, NULL, 'Iced Matcha Latte (VG)', 'Lightly sweetened matcha green tea with almond milk.', 3.00, 90, 1),
(6, NULL, 'Fruit-Infused Water (VG)', 'Freshly infused water with a choice of lemon-mint, strawberry-basil, or cucumber-lime.', 1.50, 0, 1),
(6, NULL, 'Berry Blast Smoothie (VG)', 'A creamy blend of strawberries, blueberries, and raspberries with almond milk.', 3.80, 140, 1),
(6, NULL, 'Citrus Cooler (VG)', 'A refreshing mix of orange juice, sparkling water, and a hint of lime.', 3.00, 90, 1);