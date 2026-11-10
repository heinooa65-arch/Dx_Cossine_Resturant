<?php
declare(strict_types=1);
require_once __DIR__ . '/menu_images.php';

function curated_menu_catalog(): array
{
    return [
        [
            'name' => 'European Favourites', 'description' => 'Comforting classics from across Europe.', 'sort' => 1,
            'items' => [
                ['Spaghetti Bolognese',14500,'Slow-simmered beef and tomato ragù with parmesan.','pasta'],
                ['Spaghetti Carbonara',15500,'Pasta tossed with egg, smoked bacon, black pepper, and parmesan.','pasta2'],
                ['Lasagne al Forno',17500,'Layered pasta, beef ragù, béchamel, and golden cheese.','pasta'],
                ['Fettuccine Alfredo',14500,'Silky cream sauce, parmesan, and fresh parsley.','pasta2'],
                ['Penne Arrabbiata',12500,'Penne in a bright, gently spicy tomato and garlic sauce.','pasta'],
                ['Spinach & Ricotta Ravioli',16500,'Filled pasta with spinach, ricotta, and sage butter.','pasta2'],
                ['Gnocchi Pomodoro',14500,'Soft potato dumplings with tomato, basil, and parmesan.','pasta'],
                ['Basil Pesto Linguine',14500,'Linguine with basil pesto, toasted nuts, and parmesan.','pasta2'],
                ['Margherita Pizza',14500,'Tomato, mozzarella, basil, and olive oil on a crisp base.','pizza'],
                ['Mushroom & Herb Pizza',16500,'Roasted mushrooms, mozzarella, thyme, and garlic.','pizza'],
                ['Four Cheese Pizza',17500,'Mozzarella, blue cheese, parmesan, and creamy cheese.','pizza'],
                ['Chicken Parmigiana',19500,'Crumbed chicken, tomato sauce, melted mozzarella, and greens.','roast'],
                ['Chicken Schnitzel',16500,'Crisp golden chicken with lemon and potato salad.','roast'],
                ['Wiener-Style Schnitzel',21000,'Thin crumbed cutlet with lemon, herbs, and warm potatoes.','meat'],
                ['Fish & Chips',18500,'Crisp battered white fish, chips, and house tartar sauce.','fish'],
                ['Beef Bourguignon',24500,'Slow-braised beef with mushrooms, carrots, and red-wine-style gravy.','meat'],
                ['Coq au Vin',22000,'Tender chicken braised with mushrooms, onions, and herbs.','roast'],
                ['Shepherd’s Pie',18500,'Seasoned lamb and vegetables under browned mashed potato.','meat'],
                ['Cottage Pie',17500,'Slow-cooked beef and vegetables under creamy mashed potato.','meat'],
                ['Swedish Meatballs',18500,'Beef meatballs, creamy pan gravy, and buttery mash.','meat'],
                ['Beef Stroganoff',19500,'Tender beef and mushrooms in a creamy sauce over noodles.','meat'],
                ['Ratatouille',15500,'Slow-baked Provençal vegetables with tomato and herbs.','salad'],
                ['Greek Moussaka',18500,'Layered aubergine, spiced beef, and golden béchamel.','meat'],
                ['Chicken Souvlaki Plate',17500,'Grilled lemon-herb chicken, pita, salad, and yogurt sauce.','roast'],
                ['Spanish Chicken Paella',22000,'Saffron rice with chicken, peppers, peas, and lemon.','rice'],
                ['Vegetable Paella',17500,'Saffron rice with seasonal vegetables and green herbs.','rice'],
                ['Tortilla Española',12500,'Spanish potato and egg omelette with a green side salad.','salad'],
                ['Quiche Lorraine',15500,'Baked egg custard with smoked bacon and cheese.','pastry'],
                ['Croque Monsieur',14500,'Toasted ham and cheese sandwich with béchamel.','pastry'],
                ['French Onion Soup',10500,'Slow-cooked onion soup topped with toasted bread and cheese.','soup'],
                ['Chicken Caesar Salad',15500,'Grilled chicken, crisp leaves, parmesan, and house dressing.','salad'],
                ['Greek Village Salad',13500,'Tomato, cucumber, olives, feta, and oregano.','salad'],
                ['Steak Frites',26500,'Grilled beef steak, golden fries, and peppercorn butter.','meat'],
                ['Roast Chicken & Potatoes',19500,'Herb-roasted chicken with crisp potatoes and pan jus.','roast'],
                ['Salmon with Dill Cream',24500,'Pan-seared salmon with dill cream and seasonal vegetables.','fish'],
                ['Hungarian Beef Goulash',20500,'Paprika-braised beef with vegetables and soft bread.','soup'],
                ['Chicken Cordon Bleu',21500,'Chicken wrapped with ham and cheese, crumbed and baked.','roast'],
                ['Wild Mushroom Risotto',18500,'Creamy arborio rice, mushrooms, parmesan, and thyme.','pasta2'],
                ['Seafood Linguine',24500,'Pasta with prawns, mussels, tomato, garlic, and parsley.','pasta'],
                ['Baked Macaroni & Cheese',15500,'Oven-baked macaroni in a three-cheese sauce.','pasta2'],
                ['Beef Wellington Slice',28000,'Beef wrapped in mushroom duxelles and crisp pastry.','meat'],
                ['Bratwurst & Sauerkraut',18500,'Grilled sausage with tangy cabbage and mustard potatoes.','meat'],
                ['Chicken Pot Pie',17500,'Creamy chicken and vegetables beneath flaky pastry.','pastry'],
                ['Sicilian Caponata Toast',14500,'Sweet-sour aubergine, tomato, olives, and grilled bread.','salad'],
                ['Lemon Butter White Fish',20500,'Pan-fried fish with lemon butter, greens, and potatoes.','fish'],
                ['Pork Milanese',19500,'Crisp crumbed pork with lemon and rocket salad.','meat'],
                ['Spinach & Feta Crêpe',13500,'Thin savoury crêpe filled with spinach and feta.','pastry'],
                ['Potato Gratin',12500,'Thin-sliced potatoes baked with cream, garlic, and herbs.','roast'],
            ],
        ],
        [
            'name' => 'Myanmar Traditional', 'description' => 'Beloved noodles, curries, salads, rice, and street snacks.', 'sort' => 2,
            'items' => [
                ['Mohinga',6500,'Rice noodles in fragrant fish broth with lemongrass and banana stem.','noodles'],
                ['Ohn No Khao Swe',8500,'Wheat noodles in coconut chicken broth with crispy toppings.','noodles'],
                ['Shan Noodles with Tofu',7500,'Shan-style rice noodles with tomato, garlic, and chickpea tofu.','noodles'],
                ['Shan Noodles with Chicken',8500,'Rice noodles with chicken, tomato, garlic, and toasted peanuts.','noodles'],
                ['Nan Gyi Thoke',8000,'Thick rice noodles with chicken curry, onion, and crunchy toppings.','noodles'],
                ['Rakhine Mont Di',7500,'Fine rice noodles with a bright, spicy Rakhine fish broth.','noodles'],
                ['Mandalay Mee Shay',8500,'Rice noodles with savoury meat sauce, pickles, and crisp garnish.','noodles'],
                ['Kyay Oh Soup',9000,'Rice noodles, vegetables, and pork in clear seasoned broth.','soup'],
                ['Chicken Danbauk',14500,'Burmese spiced chicken biryani rice with fried onions and mint.','rice'],
                ['Lahpet Thoke',7500,'Fermented tea leaves tossed with crunchy beans, tomato, and lime.','salad'],
                ['Gyin Thoke',6500,'Fresh ginger salad with cabbage, toasted sesame, and lime.','salad'],
                ['Tofu Thoke',6500,'Chickpea tofu salad with garlic oil, chilli, and herbs.','salad'],
                ['Shan Tofu Noodle Salad',8000,'Rice noodles and chickpea tofu with Shan-style tomato dressing.','noodles'],
                ['Htamin Jin',8500,'Tangy Shan rice with tomato, potato, garlic, and crispy shallots.','rice'],
                ['Nga Htamin',9500,'Shan fish rice with turmeric, tomato, and fresh herbs.','rice'],
                ['Burmese Chicken Curry',12500,'Slow-cooked chicken with onion, turmeric, and warm spices.','curry'],
                ['Burmese Pork Curry',13500,'Tender pork simmered with garlic, ginger, and Burmese spices.','curry'],
                ['Burmese Beef Curry',15500,'Beef cooked low and slow with onion and aromatic spices.','curry'],
                ['Burmese Fish Curry',12500,'Fish simmered in a light tomato, turmeric, and onion gravy.','curry'],
                ['Tamarind Prawn Curry',16500,'Prawns in a gently tangy tamarind and tomato curry.','curry'],
                ['Burmese Egg Curry',8500,'Boiled eggs in a rich onion and tomato curry sauce.','curry'],
                ['Chicken & Potato Curry',12500,'Comforting chicken curry with soft potatoes and steamed rice.','curry'],
                ['Burmese Pumpkin Curry',9500,'Sweet pumpkin simmered with onion, garlic, and turmeric.','curry'],
                ['Sour Bamboo Shoot Curry',10500,'Bamboo shoots cooked with herbs and a lively sour note.','curry'],
                ['Chickpea & Potato Curry',9500,'Chickpeas and potatoes in a gently spiced tomato gravy.','curry'],
                ['Sour Fish Curry',13500,'Fish curry with tamarind, tomato, and fresh green chilli.','curry'],
                ['Chicken Fried Rice',9500,'Wok-fried rice with chicken, egg, spring onion, and garlic.','rice'],
                ['Vegetable Fried Rice',8000,'Wok-fried rice with seasonal vegetables and egg.','rice'],
                ['Coconut Noodle Soup',8500,'Soft noodles in coconut broth with onion and crisp garnish.','noodles'],
                ['Laphet Rice Bowl',9500,'Steamed rice topped with tea leaf salad and crunchy beans.','rice'],
                ['Burmese Vermicelli Salad',7500,'Rice vermicelli with herbs, cabbage, lime, and toasted peanuts.','salad'],
                ['Samosa Thoke',6500,'Warm samosas tossed with chickpeas, cabbage, and tangy sauce.','snack'],
                ['Rice & Curry Lunch Set',14500,'Steamed rice with chicken curry, vegetables, soup, and relish.','rice'],
                ['Shan Rice Plate',12000,'Turmeric rice served with fish, garlic oil, and crisp shallots.','rice'],
                ['Burmese Noodle Salad',7500,'Rice noodles with cabbage, herbs, toasted chickpea flour, and lime.','salad'],
                ['Shan Grilled Chicken',15500,'Char-grilled chicken marinated with garlic, ginger, and herbs.','roast'],
                ['Turmeric Grilled Fish',16500,'Whole fish with turmeric, lemongrass, and fresh herb relish.','fish'],
                ['Burmese Chicken Skewers',12500,'Grilled chicken skewers with tamarind and chilli dip.','roast'],
                ['Burmese Coconut Rice',8500,'Fragrant coconut rice with fried onions and toasted sesame.','rice'],
                ['Vegetable Curry Set',11500,'Seasonal Burmese vegetable curries with rice and soup.','curry'],
                ['A Kyaw Fritter Plate',7500,'Crisp Burmese fritters with cabbage salad and tamarind dip.','snack'],
                ['Pe Kyaw',5500,'Golden split-pea fritters served with fresh coriander dip.','snack'],
                ['Bayar Kyaw',5500,'Crisp Burmese gourd fritters with a light chilli sauce.','snack'],
                ['Buthi Kyaw',5500,'Crunchy battered gourd slices, fried until golden.','snack'],
                ['Palata with Pea Dip',6500,'Flaky Burmese flatbread with warm chickpea curry.','pastry'],
                ['Stuffed Burmese Paratha',7500,'Pan-fried flatbread filled with spiced potato and onion.','pastry'],
                ['Htamin Paung',9500,'Steamed rice with savoury toppings, herbs, and crispy shallots.','rice'],
                ['Burmese Tamarind Fish Curry',14500,'Fish curry with tamarind, tomato, turmeric, and onion.','curry'],
                ['Garlic Chilli Prawns',16500,'Prawns tossed with garlic, chilli, lime, and fresh coriander.','curry'],
                ['Spicy Burmese Chicken Stir-Fry',12500,'Chicken wok-fried with chilli, garlic, onion, and basil.','curry'],
                ['Mont Lin Ma Yar',6500,'Small Burmese griddle cakes with quail egg and spring onion.','snack'],
            ],
        ],
        [
            'name' => 'Sweets & Desserts', 'description' => 'European bakes and Myanmar sweets for a little treat.', 'sort' => 3,
            'items' => [
                ['Classic Tiramisu',8500,'Coffee-soaked sponge layered with mascarpone and cocoa.','dessert'],
                ['Vanilla Panna Cotta',7500,'Silky vanilla cream with seasonal fruit sauce.','dessert'],
                ['Crème Brûlée',8500,'Vanilla custard under a thin crackling caramel top.','dessert'],
                ['Apple Strudel',7500,'Warm spiced apple and raisin pastry with vanilla cream.','pastry'],
                ['Belgian Waffle',8500,'Warm crisp waffle with fruit and a little honey.','dessert'],
                ['New York Cheesecake',8500,'Baked cream cheese cake on a buttery biscuit base.','dessert'],
                ['Chocolate Lava Cake',9500,'Warm chocolate cake with a soft molten centre.','dessert'],
                ['French Apple Tart',8000,'Thin apple tart glazed with apricot and served warm.','pastry'],
                ['Cinnamon Roll',6500,'Soft spiral bun with cinnamon sugar and light icing.','pastry'],
                ['Lemon Tart',7500,'Buttery pastry with bright lemon curd.','pastry'],
                ['Berry Pavlova',8500,'Crisp meringue with cream and seasonal berries.','dessert'],
                ['Chocolate Profiteroles',8000,'Choux pastry puffs filled with cream and chocolate sauce.','dessert'],
                ['Vanilla Bean Gelato',6500,'Two scoops of smooth vanilla bean gelato.','dessert'],
                ['Mont Lone Yay Paw',6500,'Soft rice dumplings with palm sugar, coconut, and sesame.','dessert'],
                ['Shwe Yin Aye',7500,'Chilled coconut dessert with jelly, bread, and sweet cream.','dessert'],
                ['Mont Let Saung',6500,'Rice-flour pearls with coconut milk and palm sugar syrup.','drink'],
                ['Kyauk Kyaw Coconut Jelly',6000,'Layered coconut jelly with a delicate pandan fragrance.','dessert'],
                ['Bein Mont',6500,'Myanmar rice pancake with coconut, sesame, and palm sugar.','pastry'],
                ['Burmese Semolina Cake',6500,'Tender semolina cake with coconut and a golden crust.','pastry'],
                ['Coconut Jaggery Pancakes',6500,'Small pancakes filled with coconut and palm jaggery.','pastry'],
            ],
        ],
        [
            'name' => 'Drinks', 'description' => 'Myanmar tea, fresh fruit, and café favourites.', 'sort' => 4,
            'items' => [
                ['Burmese Milk Tea',4500,'Strong black tea with creamy milk, served over ice.','tea'],
                ['Laphet Yay (Myanmar Tea)',2500,'A comforting cup of traditional Myanmar black tea.','tea'],
                ['Fresh Lime Soda',4000,'Fresh lime juice, soda, and a little cane sugar.','drink'],
                ['Honey Lime Cooler',4500,'Fresh lime and local honey over ice.','drink'],
                ['Tamarind Cooler',4000,'Sweet-sour tamarind drink with a squeeze of lime.','drink'],
                ['Fresh Coconut Water',4500,'Chilled young coconut water, served fresh.','drink'],
                ['Fresh Sugarcane Juice',4000,'Pressed sugarcane juice with a hint of lime.','drink'],
                ['Roselle Iced Tea',4000,'Ruby-red roselle tea, lightly sweetened and chilled.','tea'],
                ['Mango Lassi',5500,'Ripe mango blended with yogurt and a touch of cardamom.','drink'],
                ['Avocado Smoothie',6000,'Creamy avocado blended fresh with milk.','drink'],
                ['Mango Smoothie',5500,'Ripe mango blended with yogurt and ice.','drink'],
                ['Papaya Lime Shake',5000,'Fresh papaya blended with lime and chilled milk.','drink'],
                ['Passion Fruit Soda',5000,'Passion fruit pulp, soda water, and a squeeze of lime.','drink'],
                ['Iced Lemon Tea',4000,'Black tea shaken with fresh lemon and ice.','tea'],
                ['Myanmar-Style Coffee',4000,'Strong brewed coffee with a little condensed milk.','coffee'],
                ['Iced Americano',4500,'Double espresso poured over cold water and ice.','coffee'],
                ['Cappuccino',5500,'Espresso with steamed milk and a soft cocoa finish.','coffee'],
                ['English Breakfast Tea',3500,'A warming pot of robust black tea.','tea'],
                ['Hot Chocolate',5500,'Rich cocoa with steamed milk.','coffee'],
                ['Sparkling Water',3000,'Chilled sparkling water with lemon on request.','drink'],
            ],
        ],
    ];
}

function seed_curated_menu(PDO $pdo): int
{
    $catalog = curated_menu_catalog();
    $categoryUpsert = $pdo->prepare('INSERT INTO categories (name,description,sort_order,is_active) VALUES (?,?,?,1) ON DUPLICATE KEY UPDATE description=VALUES(description),sort_order=VALUES(sort_order)');
    $categoryLookup = $pdo->prepare('SELECT id FROM categories WHERE name=?');
    $itemUpsert = $pdo->prepare('INSERT INTO menu_items (category_id,name,description,price,photo_url,is_available,mealdb_id) VALUES (?,?,?,?,?,1,?) ON DUPLICATE KEY UPDATE category_id=VALUES(category_id),name=VALUES(name),description=VALUES(description),price=VALUES(price),photo_url=VALUES(photo_url)');
    $count = 0;
    foreach ($catalog as $groupIndex => $group) {
        $categoryUpsert->execute([$group['name'],$group['description'],$group['sort']]);
        $categoryLookup->execute([$group['name']]);
        $categoryId = (int)$categoryLookup->fetchColumn();
        foreach ($group['items'] as $itemIndex => [$name,$price,$description]) {
            $catalogId = sprintf('local_%d_%03d', $groupIndex + 1, $itemIndex + 1);
            $itemUpsert->execute([$categoryId,$name,$description,$price,catalog_photo($name),$catalogId]);
            $count++;
        }
    }
    return $count;
}
