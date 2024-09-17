<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Wiliahn',
                'email' => 'ngocjapan.1945@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => null,
                'level' => 2,
                'description' => null,

                'company_name'=> 'Lego',
                'country'=> 'Việt Nam',
                'street_address'=> '307, Thành phố Hải Dương',
                'postcode_zip'=> '10000',
                'town_city'=> 'Hải Dương',
                'phone'=> '0768357168',
            ],
        ]);

        DB::table('users')->insert([
           
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => null,
                'level' => 0,
                'description' => null,
            ],
            [
                'id' => 3,
                'name' => 'Shane Lynch',
                'email' => 'ShaneLynch@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatar-0.png',
                'level' => 1,
                'description' => 'Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud amodo'
            ],
            [
                'id' => 4,
                'name' => 'Brandon Kelley',
                'email' => 'BrandonKelley@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatar-1.png',
                'level' => 1,
                'description' => null,
            ],
            [
                'id' => 5,
                'name' => 'Roy Banks',
                'email' => 'RoyBanks@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatar-2.png',
                'level' => 1,
                'description' => null,
            ],
        ]);

        DB::table('blogs')->insert([
            [
                'user_id' => 3,
                'title' => 'Xu hướng đua xe F1 McLaren 2023',
                'subtitle' => 'Khám phá mối liên hệ giữa sự hạnh phúc và tính cách.',
                'image' => 'blog-1.jpg',
                'category' => 'Sản phẩm mới',
                'content' => 'Xe đua Formula 1 McLaren 2023 đánh dấu sự tiến bộ vượt bậc trong công nghệ đua xe. Với thiết kế mới lạ và hiệu suất cao, chiếc xe này hứa hẹn sẽ mang lại trải nghiệm đua tốc độ tuyệt vời cho các tay lái chuyên nghiệp.'
            ],
            [
                'user_id' => 3,
                'title' => 'Dungeons & Dragons: Red Dragon\'s Tale',
                'subtitle' => 'Khám phá hành trình của một con rồng đỏ huyền thoại trong thế giới của Dungeon & Dragons.',
                'image' => 'blog-2.jpg',
                'category' => 'Trò chơi nhập vai',
                'content' => 'Dungeons & Dragons: Red Dragon\'s Tale là một trò chơi nhập vai thú vị với câu chuyện về một con rồng đỏ huyền thoại. Người chơi sẽ được đưa vào thế giới phong phú của Dungeon & Dragons, nơi họ sẽ trải qua những cuộc phiêu lưu kỳ thú và chiến đấu với quái vật để bảo vệ đất nước.'
            ],
            [
                'user_id' => 3,
                'title' => 'Snow White and the Seven Dwarfs\' Cottage',
                'subtitle' => 'Khám phá ngôi nhà của Bạch Tuyết và bảy chú lùn trong câu chuyện cổ tích nổi tiếng.',
                'image' => 'blog-3.jpg',
                'category' => 'Đồ chơi và Trò chơi',
                'content' => 'Snow White and the Seven Dwarfs\' Cottage là một sản phẩm đồ chơi được lấy cảm hứng từ câu chuyện cổ tích kinh điển "Bạch Tuyết và bảy chú lùn". Ngôi nhà này được thiết kế chân thực với những chi tiết tinh xảo, cho phép trẻ em khám phá và tái hiện lại các cảnh trong câu chuyện.'
            ],
            [
                'user_id' => 3,
                'title' => 'Wolf Mask Shadow Dojo',
                'subtitle' => 'Khám phá thế giới độc đáo của các chiến binh đeo mặt nạ sói.',
                'image' => 'blog-4.jpg',
                'category' => 'Trang phục và Phụ kiện',
                'content' => 'Wolf Mask Shadow Dojo là một sản phẩm phụ kiện thú vị dành cho các tín đồ của các trận đấu đối kháng và võ thuật. Với thiết kế mặt nạ sói độc đáo, sản phẩm này giúp người sử dụng thể hiện cá tính và phong cách riêng trong các hoạt động về võ thuật.'
            ],
            [
                'user_id' => 3,
                'title' => 'Mars Crew Exploration Rover',
                'subtitle' => 'Khám phá hành trình của nhóm thám hiểm đến sao Hỏa với chiếc Rover tiên tiến nhất.',
                'image' => 'blog-5.jpg',
                'category' => 'Khoa học và Công nghệ',
                'content' => 'Mars Crew Exploration Rover là một sản phẩm công nghệ tiên tiến, được phát triển để hỗ trợ nhóm thám hiểm trong việc khám phá sao Hỏa. Chiếc Rover này được trang bị đầy đủ các cảm biến và thiết bị khoa học, giúp thu thập dữ liệu và hình ảnh từ bề mặt sao Hỏa để nghiên cứu và khám phá các điều bí ẩn về hành tinh đỏ.'
            ],
            [
                'user_id' => 3,
                'title' => 'Darth Maul\'s Sith Infiltrator',
                'subtitle' => 'Khám phá chiếc Sith Infiltrator của Darth Maul - một trong những chiếc tàu vũ trụ độc đáo trong vũ trụ Star Wars.',
                'image' => 'blog-6.jpg',
                'category' => 'Đồ chơi và Trò chơi',
                'content' => 'Darth Maul\'s Sith Infiltrator là một trong những chiếc tàu vũ trụ nổi tiếng trong thế giới của Star Wars. Với thiết kế độc đáo và đầy ma mị, chiếc tàu này đã trở thành biểu tượng của Darth Maul - một trong những nhân vật Sith đáng sợ nhất trong loạt phim. Sản phẩm này không chỉ là một đồ chơi mà còn là một bộ sưu tập tuyệt vời cho các fan của Star Wars.'
            ],
        ]);
        
        DB::table('brands')->insert([
            [
                'name' => 'Calvin Klein',
            ],
            [
                'name' => 'Diesel',
            ],
            [
                'name' => 'Polo',
            ],
            [
                'name' => 'Tommy Hilfiger',
            ],
        ]);

        DB::table('product_categories')->insert([
            [
                'name' => 'Ninjago',
            ],
            [
                'name' => 'Cars',
            ],
            [
                'name' => 'Superhero',
            ],
        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'Long Đài Hòa Bình',
                'description' => 'Long Đài Hòa Bình là một di tích cổ xưa và huyền bí mang trong mình sức mạnh lớn lao. Truyền thuyết kể rằng nó được xây dựng bởi các con rồng để bảo vệ kho báu của chúng. Nay, những nhà thám hiểm tìm đến nó để tìm kiếm vinh quang và tài lộc.',
                'content' => 'Khám phá những bí ẩn của Long Đài Hòa Bình và khám phá những bí mật ẩn giấu bên trong. Nhưng hãy cẩn thận, vì những thế lực tăm tối có thể ẩn chứa trong những hành lang cổ xưa của nó.',
                'price' => 119,
                'qty' => 20,
                'discount' => null,
                'weight' => null,
                'sku' => '00012',
                'featured' => true,
                'tag' => 'Lego'
            ],
            [
                'id' => 2,
                'brand_id' => 2,
                'product_category_id' => 2,
                'name' => 'Lamborghini Huracán Tecnica Orange',
                'description' => 'Lamborghini Huracán Tecnica Orange là biểu tượng của sức mạnh và tốc độ. Với màu sắc cam nổi bật, chiếc xe này không chỉ thu hút mọi ánh nhìn mà còn mang lại trải nghiệm lái xe đầy phấn khích.',
                'content' => 'Với động cơ mạnh mẽ và công nghệ tiên tiến, Lamborghini Huracán Tecnica Orange sẽ đưa bạn đến những cung đường huyền thoại với tốc độ và đẳng cấp.',
                'price' => 399,
                'qty' => 10,
                'discount' => null,
                'weight' => null,
                'sku' => '00013',
                'featured' => true,
                'tag' => 'Lego'
            ],
            [
                'id' => 3,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'NINJAGO City Markets',
                'description' => 'NINJAGO City Markets là một bộ sản phẩm Lego mang đến cho bạn một phần của thành phố Ninjago đầy màu sắc và sôi động. Với những gian hàng đa dạng và đầy sáng tạo, bạn sẽ được trải nghiệm cuộc sống hàng ngày tại thị trấn Ninjago.',
                'content' => 'Bộ sản phẩm này bao gồm nhiều chi tiết độc đáo và các nhân vật quen thuộc từ series Ninjago. Bạn có thể sắp xếp lại các gian hàng và tạo ra những kịch bản phim hoặc phiêu lưu độc đáo với những nhà chiến binh Ninja.',
                'price' => 369.99,
                'qty' => 15,
                'discount' => null,
                'weight' => null,
                'sku' => '00014',
                'featured' => true,
                'tag' => 'Lego'
            ],
            [
                'id' => 4,
                'brand_id' => 3,
                'product_category_id' => 3,
                'name' => 'Batman: The Animated Series Gotham City',
                'description' => 'Batman: The Animated Series Gotham City là một bộ sản phẩm đặc biệt dành cho các fan của Batman. Bạn sẽ được đưa vào thế giới huyền bí và nguy hiểm của thành phố Gotham, nơi mà Batman chiến đấu để bảo vệ công lý và chống lại tội phạm.',
                'content' => 'Bộ sản phẩm này bao gồm nhiều phụ kiện và các tòa nhà biểu tượng của Gotham City, như Nhà Bảo tàng Gotham hay Nhà Tù Arkham. Bạn có thể tái hiện lại các cảnh quay hấp dẫn từ series hoạt hình Batman: The Animated Series hoặc tự tạo ra những cuộc phiêu lưu mới.',
                'price' => 299.99,
                'qty' => 8,
                'discount' => null,
                'weight' => null,
                'sku' => '00015',
                'featured' => true,
                'tag' => 'Batman'
            ],
            [
                'id' => 5,
                'brand_id' => 3,
                'product_category_id' => 3,
                'name' => 'LEGO Titanic',
                'description' => 'LEGO Titanic là một bộ sản phẩm độc đáo mang đến cho bạn cơ hội tái hiện lại chiếc tàu huyền thoại Titanic bằng các khối LEGO. Với hàng trăm, thậm chí hàng nghìn mảnh ghép, bạn có thể xây dựng một phiên bản nhỏ của tàu Titanic với đầy đủ chi tiết và sắc sảo.',
                'content' => 'Bộ sản phẩm LEGO Titanic bao gồm một hướng dẫn chi tiết để bạn có thể bắt đầu xây dựng. Từ phần thân đến các tầng lớp của tàu, mỗi phần đều được thiết kế để tái hiện lại sự hoành tráng của Titanic. Bạn cũng có thể tùy chỉnh và thêm các chi tiết theo ý muốn của mình.',
                'price' => 199.99,
                'qty' => 10,
                'discount' => null,
                'weight' => null,
                'sku' => '00016',
                'featured' => true,
                'tag' => 'LEGO'
            ],
            [
                'id' => 6,
                'brand_id' => 2,
                'product_category_id' => 2,
                'name' => 'Porsche 911 RSR',
                'description' => 'Porsche 911 RSR là một bộ xây dựng LEGO mang đến cho bạn cơ hội tái hiện một trong những siêu xe đua huyền thoại của Porsche. Với thiết kế chính xác và chi tiết, bạn sẽ được trải nghiệm cảm giác thú vị khi xây dựng và trưng bày chiếc Porsche 911 RSR này.',
                'content' => 'Bộ xây dựng bao gồm một hướng dẫn chi tiết và hàng trăm mảnh ghép LEGO chất lượng cao. Bạn sẽ có cơ hội khám phá và tìm hiểu về cách hoạt động của siêu xe này trong quá trình xây dựng. Sau khi hoàn thành, bạn có thể trưng bày chiếc Porsche 911 RSR với tự hào.',
                'price' => 149.99,
                'qty' => 12,
                'discount' => null,
                'weight' => null,
                'sku' => '00017',
                'featured' => true,
                'tag' => 'LEGO'
            ],
            [
                'id' => 7,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'Temple of the Dragon Energy Cores',
                'description' => 'Temple of the Dragon Energy Cores là một bộ xây dựng Lego Ninjago đầy kích thích và hấp dẫn. Trong cuộc phiêu lưu này, nhóm Ninja phải tìm kiếm và bảo vệ những hạt nhân năng lượng của Rồng để ngăn chặn thế lực tà ác.',
                'content' => 'Bộ xây dựng này bao gồm một đền thờ rộng lớn và chi tiết, nơi mà những hạt nhân năng lượng quý giá được giữ an toàn. Bạn cũng sẽ được trang bị các phụ kiện và nhân vật Lego Ninjago để tham gia vào cuộc hành trình đầy nguy hiểm này.',
                'price' => 79.99,
                'qty' => 15,
                'discount' => null,
                'weight' => null,
                'sku' => '00018',
                'featured' => true,
                'tag' => 'LEGO'
            ],
            [
                'id' => 8,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => "Destiny's Bounty",
                'description' => "Destiny's Bounty là một trong những phương tiện vận chuyển quan trọng của nhóm Ninja trong Lego Ninjago. Đây là một chiếc tàu thuyền lớn với nhiều tính năng đặc biệt, giúp Ninja du hành và chiến đấu trên biển.",
                'content' => "Bộ xây dựng này cung cấp một phiên bản miniaturized của Destiny's Bounty với đầy đủ chi tiết. Bạn sẽ được tham gia vào cuộc phiêu lưu trên biển với các nhân vật chính của Ninjago, như Kai, Jay, Cole và Zane.",
                'price' => 129.99,
                'qty' => 10,
                'discount' => null,
                'weight' => null,
                'sku' => '00019',
                'featured' => true,
                'tag' => 'LEGO'
            ],
            [
                'id' => 9,
                'brand_id' => 2,
                'product_category_id' => 2,
                'name' => 'Mercedes-AMG F1 W14 E Performance',
                'description' => 'Mercedes-AMG F1 W14 E Performance là một bộ xây dựng Lego mang đến cho bạn cơ hội tái hiện lại một trong những chiếc xe đua Formula 1 huyền thoại của đội Mercedes-AMG Petronas Formula One Team. Với thiết kế chính xác và chi tiết, bạn sẽ có trải nghiệm tuyệt vời khi xây dựng và trưng bày chiếc xe đua này.',
                'content' => 'Bộ xây dựng bao gồm một hướng dẫn chi tiết và hàng trăm mảnh ghép Lego chất lượng cao. Bạn sẽ được khám phá và tìm hiểu về cấu trúc và thiết kế của chiếc xe đua Formula 1 Mercedes-AMG W14 E Performance trong quá trình xây dựng. Khi hoàn thành, bạn có thể trưng bày chiếc Mercedes-AMG F1 W14 E Performance với tự hào.',
                'price' => 179.99,
                'qty' => 8,
                'discount' => null,
                'weight' => null,
                'sku' => '00020',
                'featured' => true,
                'tag' => 'Lego Speed Champions'
            ],
        ]);

        DB::table('product_images')->insert([
            [
                'product_id' => 1,
                'path' => 'product-1.jpg',
            ],
            [
                'product_id' => 1,
                'path' => 'product-1-1.jpg',
            ],
            [
                'product_id' => 1,
                'path' => 'product-1-2.jpg',
            ],
            [
                'product_id' => 2,
                'path' => 'product-2.jpg',
            ],
            [
                'product_id' => 2,
                'path' => 'product-2-1.jpg',
            ],
            [
                'product_id' => 2,
                'path' => 'product-2-2.jpg',
            ],
            [
                'product_id' => 3,
                'path' => 'product-3.jpg',
            ],
            [
                'product_id' => 3,
                'path' => 'product-3-1.jpg',
            ],
            [
                'product_id' => 3,
                'path' => 'product-3-2.jpg',
            ],
            [
                'product_id' => 4,
                'path' => 'product-4.jpg',
            ],
            [
                'product_id' => 4,
                'path' => 'product-4-1.jpg',
            ],
            [
                'product_id' => 4,
                'path' => 'product-4-2.jpg',
            ],
            [
                'product_id' => 5,
                'path' => 'product-5.jpg',
            ],
            [
                'product_id' => 5,
                'path' => 'product-5-1.jpg',
            ],
            [
                'product_id' => 5,
                'path' => 'product-5-2.jpg',
            ],
            [
                'product_id' => 6,
                'path' => 'product-6.jpg',
            ],
            [
                'product_id' => 6,
                'path' => 'product-6-1.jpg',
            ],
            [
                'product_id' => 6,
                'path' => 'product-6-2.jpg',
            ],
            [
                'product_id' => 7,
                'path' => 'product-7.jpg',
            ],
            [
                'product_id' => 7,
                'path' => 'product-7-1.jpg',
            ],
            [
                'product_id' => 7,
                'path' => 'product-7-2.jpg',
            ],
            [
                'product_id' => 8,
                'path' => 'product-8.jpg',
            ],
            [
                'product_id' => 8,
                'path' => 'product-8-1.jpg',
            ],
            [
                'product_id' => 8,
                'path' => 'product-8-2.jpg',
            ],
            [
                'product_id' => 9,
                'path' => 'product-9.jpg',
            ],
            [
                'product_id' => 9,
                'path' => 'product-9-1.jpg',
            ],
            [
                'product_id' => 9,
                'path' => 'product-9-2.jpg',
            ],
         
        ]);

        DB::table('product_details')->insert([
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'S',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'M',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'L',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'XS',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'yellow',
                'size' => 'S',
                'qty' => 0,
            ],
            [
                'product_id' => 1,
                'color' => 'violet',
                'size' => 'S',
                'qty' => 0,
            ],
        ]);

        DB::table('product_comments')->insert([
            [
                'product_id' => 1,
                'user_id' => 4,
                'email' => 'BrandonKelley@gmail.com',
                'name' => 'Brandon Kelley',
                'messages' => 'Nice !',
                'rating' => 4,
            ],
            [
                'product_id' => 1,
                'user_id' => 5,
                'email' => 'RoyBanks@gmail.com',
                'name' => 'Roy Banks',
                'messages' => 'Nice !',
                'rating' => 4,
            ],
        ]);
    }
}

