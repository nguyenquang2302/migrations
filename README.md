### Tìm hiểu PHINX
### I.	PHINX
-	Tạo ra các phiên bản  database dựa trên những thay đổi  thuộc tính, table, dữ liệu trong database..( quá trình phát triển database)
### II.	Migration
Một migration mặc định có 3  hàm số: change,up,down
-	Change: là hàm số mặc định khi chạy file. Hỗ trợ Đối với những thao tác như: Create Table , RenameTable ,AddColumn, RenameColum, AddIndex, AddForeignKey sẽ tạo ra tương đương với function up và function down
-	Function Up(): Là hàm  chạy những  câu lệnh SQL cho phiên bản
-	Function DOWN(): LÀ hàm chạy những câu lệnh gỡ bỏ những thay đổi của Function up() để Phiên bản trở về phiên bản trước.

**	Chú ý
      - Trong quá trình làm việc với bảng chỉ nên create hoặc update. Không nên save.
      
      -	Change chỉ nên sử dụng những thao tác được hỗ trợ => để có thể chạy rollback hay update 1 cách hiệu quả.
      
      -	Bất kể những  thao tác nào được viết để update trong function up thì đều phải  có thao tác khôi phục phiên bản cũ  trong function down và  phải viết theo qua trình ngược lại   cái gì chạy trước thì  thao tác sau.
      
      -  Khi tạo  file Migration nên chú ý khóa ngoại  những table nào  tham chiếu  sẽ tạo sau những table được tham chiếu
      
