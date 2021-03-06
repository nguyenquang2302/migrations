#I.PHINX
Tạo ra các phiên bản  database dựa trên những thay đổi  thuộc tính, table, dữ liệu trong database..( quá trình phát triển database)
#II.MIGRATION
 Một migration  có 3  hàm số: change,up,down
 
 1.Change: là hàm số mặc định khi chạy file. Hỗ trợ Đối với những thao tác như: Create Table , RenameTable ,AddColumn, RenameColum, AddIndex, AddForeignKey sẽ tạo ra tương đương với function up và function down
 
 2.Function Up(): Là hàm  chạy những  câu lệnh SQL cho phiên bản
 
 3.Function DOWN(): LÀ hàm chạy những câu lệnh gỡ bỏ những thay đổi của Function up() để Phiên bản trở về phiên bản trước.
 
 4.Chú ý:
 -  Trong quá trình làm việc với table trong change chỉ nên create hoặc update. Không nên save.
 -  Change chỉ nên sử dụng những thao tác được hỗ trợ => để có thể chạy rollback hay update 1 cách hiệu quả
 -  Bất kể những  thao tác nào được viết để update trong function up thì đều phải  có thao tác khôi phục phiên bản cũ  trong function down và  phải viết theo qua trình ngược lại   cái gì chạy trước thì  thao tác sau.
 -  Khi tạo  file Migration nên chú ý khóa ngoại  những table nào  tham chiếu  sẽ tạo sau những table được tham chiếu
 
#III.SEEDING
1.	Tạo ra cơ sở dữ liệu mẫu.   (test database)

2. khi gọi seeding sẽ chạy hàm run();

#IV.COMMANDS
1. https://phinx.readthedocs.org/en/latest/commands.html

2.	Vào thư mục project  chứa file phinx.yml

3.  Sử dụng composer : Thao tác  với Migration

-	 ```php vendor/robmorgan/phinx/bin/phinx create NameMigration ``` => tạo ra file migration với định dạng YYYYMMDDHHMMSS_name_migration

-	```	php vendor/robmorgan/phinx/bin/phinx create NameMigration  --template “<file>” ```  =>Ghi đè lên file

-	```php vendor/robmorgan/phinx/bin/phinx create NameMigration  --class “<class>” ```  Sử dụng mẫu
không thể sử dụng template và class cùng 1 lệnh

- ```php vendor/robmorgan/phinx/bin/phinx migrate ```    => chạy tất cả phiên bản của database theo thứ tự thời gian

-	```	php vendor/robmorgan/phinx/bin/phinx migrate –t  YYYYMMDDHHMMSS     ``` chạy 1 file migration  thời gian cụ thể

-	```	php vendor/robmorgan/phinx/bin/phinx rollback ```  => Trở về phiên bản trước

-	```	php vendor/robmorgan/phinx/bin/phinx status ``` => kiểm tra phiên bản
4.  Sử dụng với Seeder
-	```php vendor/robmorgan/phinx/bin/phinx seed:create UserSeeder ``` => tạo ra 1 seeder
-	```php vendor/robmorgan/phinx/bin/phinx seed:run ``` => chạy all seeder
-	```php vendor/robmorgan/phinx/bin/phinx seed:run -s UserSeeder ``` => chạy 1 seeder

#V.CẤU HÌNH
* cấu hình file phinx.yml để  cài đặt database…

paths:
    migrations: %%PHINX_CONFIG_DIR%%/app/migrations
    seeds: %%PHINX_CONFIG_DIR%%/app/seeds
    
	# Cấu hình vị trí lưu file migrations và seeds
	
environments:

    default_migration_table: phinxlog
    
    default_database: production
    
       # Database default	
       
### Thông số database
    production:
        adapter: mysql
        host: localhost
        name: production_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    development:
        adapter: mysql
        host: localhost
        name: development_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    testing:
        adapter: mysql
        host: localhost

# VI.KIỂU DỮ LIỆU CHO COLUMN

https://phinx.readthedocs.org/en/latest/migrations.html#valid-column-types

###1.Số kiểu dữ liệu quan trọng 

```
biginteger
binary
boolean
date
datetime
decimal
float
integer
string
text
time
timestamp
uuid

```

###2.Đối với mỗi kiểu dữ liệu cho column ta cũng có thể chỉnh sửa option cho nó bằng các option sau:

####a.Đa số các colum đề hỗ trợ
	
```
		limit	: giới hạn tối đa chiều dài
		length	: alias for limit
		default	: mặc định giá trị 
		null	: cho phép null các giá trị ( không được đặt với khóa chính)
		after	: nằm sau vị trí ..
		comment	 : add comment cho column
```
####b.Đối với số thập phân

```
		precision : 	kết hợp với scale  để tăng tỉ lệ chính xác
		scale	  :	kết hợp với precision  để tăng tỉ lệ chính xác
```

####c.Đối với các cột mặc định chỉ cho phép những giá trị kiểu enum
	
```
		values:
```
####d.Đối với số nguyên

```
		identity  : áp dụng  tự động tăng ( thường danh cho id - khóa chính)
		signed : Chỉnh trường hợp số  không dấu
```
####e.Đối với số nguyên

```
		signed : Chỉnh trường hợp số  không dấu

```
####f.khóa ngoại
	
```
		update   : chỉnh sửa thay đổi khi khóa ngoại thay đổi
		delete	  : khóa ngoại xóa-> xóa theo
```
#VII. THỰC HÀNH VỚI MIGRATION
##1.Demo Tạo bảng với 1 số loại dữ liệu và khóa ngoại
```
public function change()
    {
        //create permissions
        $table = $this->table('permissions', [
            'id' => 'id',
            'primary_key' => 'id'
        ]);
        //add column permissions
        $table->addColumn('name', 'string', ['limit' => 45])
            ->addColumn('role', 'text')
            ->create();

        //create admins
        $table = $this->table('admins', [
            'id' => 'id',
            'primary_key' => 'id'
        ]);
        $table->addColumn('username', 'string', ['limit' => 45])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('fname', 'string', ['limit' => 45])
            ->addColumn('lname', 'string', ['limit' => 45])
            ->addColumn('id_permission', 'integer')
            ->addColumn('money', 'integer')
            ->addColumn('phone', 'string', ['limit' => 15])
            ->addColumn('images', 'string', ['limit' => 300])
            ->addColumn('last_login_date', 'timestamp')
            ->addColumn('last_login_ip', 'string', ['limit' => 45])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->addForeignKey('id_permission', 'permissions', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
     }
	
```
##2.Demo Tạo bảng với khóa ngoại không phải id , không tự tăng và có 2 khóa ngoại

```

public function change()
    {
        $table = $this->table('post_tag', [
            'id' => false,
            'primary_key' => ['id_post','id_tag']
        ]);
        $table->addColumn('id_post', 'integer')
            ->addColumn('id_tag', 'integer')
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
    
```
##3.Demo Sử dụng function up và down  ( trường hợp  không thể dùng  change)

``` 
public function up()
 
    {
        // execute()
        $count = $this->execute('update products   set money = money +100'); // returns the number of affected rows
    }
    
```
```
public function down()
    {
    	 $count = $this->execute('update products   set money = money -100'); // returns the number of affected rows
    }
```

#VII. THỰC HÀNH VỚI SEEDER

#1. Demo

chạy composer require faker  column

```

 require fzaninotto/faker
 
```

Tạo 100 user mẫu với seeder sử dụng faker để tạo dữ liệu ảo 

```
<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */

    public function run()
    {
      $faker = Faker\Factory::create();
      $data = [];
      for ($i = 0; $i < 100; $i++) {
          $data[] = [
              'username'      => $faker->userName,
              'password'      => sha1($faker->password),
              'email'         => $faker->email,
              'created_at'       => date('Y-m-d H:i:s'),
          ];
      }

      $this->insert('members', $data);
    }
}

```

