# migrations
#Tìm hiểu PHINX
#I.	PHINX
-	Tạo ra các phiên bản  database dựa trên những thay đổi  thuộc tính, table, dữ liệu trong database..( quá trình phát triển database)
#II.	Migration
Một migration mặc định có 3  hàm số: change,up,down
-	Change: là hàm số mặc định khi chạy file. Hỗ trợ Đối với những thao tác như: Create Table , RenameTable ,AddColumn, RenameColum, AddIndex, AddForeignKey sẽ tạo ra tương đương với function up và function down
-	Function Up(): Là hàm  chạy những  câu lệnh SQL cho phiên bản
-	Function DOWN(): LÀ hàm chạy những câu lệnh gỡ bỏ những thay đổi của Function up() để Phiên bản trở về phiên bản trước.

**	Chú ý
      1.Trong quá trình làm việc với bảng chỉ nên create hoặc update. Không nên save.
      2.Change chỉ nên sử dụng những thao tác được hỗ trợ => để có thể chạy rollback hay update 1 cách hiệu quả.
      3. Bất kể những  thao tác nào được viết để update trong function up thì đều phải  có thao tác khôi phục phiên bản cũ  trong function down và  phải viết theo qua trình ngược lại   cái gì chạy trước thì  thao tác sau.
      4.Khi tạo  file Migration nên chú ý khóa ngoại  những table nào  tham chiếu  sẽ tạo sau những table được tham chiếu	
      III.	Seeding	
-	Tạo ra cơ sở dữ liệu mẫu.   (test database)
-	 khi gọi seeding sẽ chạy hàm run();
VI.	Commant 
-	https://phinx.readthedocs.org/en/latest/commands.html
-	Vào thư mục project  chứa file phinx.yml 
Sử dụng composer :
-	Thao tác  với Migration
•	 php vendor/robmorgan/phinx/bin/phinx create NameMigration  => tạo ra file migration với định dạng YYYYMMDDHHMMSS_name_migration
•	php vendor/robmorgan/phinx/bin/phinx create NameMigration  --template “<file>”   =>Ghi đè lên file
•	php vendor/robmorgan/phinx/bin/phinx create NameMigration  --class “<class>”   Sử dụng mẫu
không thể sử dụng template và class cùng 1 lệnh
•	php vendor/robmorgan/phinx/bin/phinx migrate     => chạy tất cả phiên bản của database theo thứ tự thời gian
•	php vendor/robmorgan/phinx/bin/phinx migrate –t  YYYYMMDDHHMMSS      chạy 1 file migration  thời gian cụ thể
•	php vendor/robmorgan/phinx/bin/phinx rollback   => Trở về phiên bản trước
•	php vendor/robmorgan/phinx/bin/phinx status => kiểm tra phiên bản
.....
V.	Cấu hình database 
* cấu hình file phinx.yml để  cài đặt database…

paths:
    migrations: %%PHINX_CONFIG_DIR%%/app/migrations
	# Cấu hình vị trí lưu file migrations
environments:
    default_migration_table: phinxlog
    default_database: production
       # Database default	
# Thông số database
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
        name: testing_db
        user: root
        pass: ''
        port: 3306
        charset: utf8
