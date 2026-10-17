// The four shoes from resources/views/home.blade.php, in the shape of the
// MongoDB `products` collection (app/Models/Product.php). Used in demo mode.
export const seedProducts = [
  {
    _id: '1',
    ProductID: 'P001',
    Name: 'Air Max 270',
    Description: 'Comfortable and stylish running shoes.',
    Price: 19000,
    Discount_Price: 15000,
    StockQuantity: 20,
    Brand: 'Nike',
    Category: 'Running',
    img_url: 'https://static.nike.com/a/images/t_default/cb1951e7-0600-4f7a-9b26-12be8cd2bd01/W+AIR+MAX+270.png',
  },
  {
    _id: '2',
    ProductID: 'P002',
    Name: 'Nike Air Force 1 Flyknit 2.0',
    Description: 'Responsive running shoe with great energy return.',
    Price: 19000,
    Discount_Price: 18000,
    StockQuantity: 15,
    Brand: 'Nike',
    Category: 'Casual',
    img_url: 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/jyfsnrfrqnvo8ahvuzeg/AIR+FORCE+1+FLYKNIT+2.0.png',
  },
  {
    _id: '3',
    ProductID: 'P003',
    Name: 'Nike Free Metcon 6',
    Description: 'Iconic skate shoes with timeless style.',
    Price: 550000,
    Discount_Price: 60000,
    StockQuantity: 10,
    Brand: 'Vans',
    Category: 'Casual',
    img_url: 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/556d3884-4081-4c5a-88aa-f3711c80742c/NIKE+FREE+METCON+6.png',
  },
  {
    _id: '4',
    ProductID: 'P004',
    Name: 'Nike Air Max SC',
    Description: 'Iconic skate shoes with timeless style.',
    Price: 50000,
    Discount_Price: 40000,
    StockQuantity: 12,
    Brand: 'Vans',
    Category: 'Casual',
    img_url: 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/8bf8448b-1595-4ad8-b872-3aaa5cc489f0/NIKE+AIR+MAX+SC.png',
  },
]

// Home page slider images from home.blade.php (one of the original three no longer exists, so it is left out).
export const slides = [
  'https://s3.amazonaws.com/yomzansi.com/wp-content/uploads/2023/10/23130251/asap-rocky-formula-1-puma-.jpg',
  'https://about.puma.com/sites/default/files/styles/dd_hero_tablet/public/media/news/images/m07-22.jpg?itok=Rjl74xLI',
]
