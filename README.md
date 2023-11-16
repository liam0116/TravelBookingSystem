# 專案筆記

## 參考文件
從 Git 複製後如何設定 Laravel 項目:
```
https://mohasin-dev.medium.com/how-to-setup-laravel-project-after-cloning-from-git-2b8486bee257
```
RESTful Web API 设计:
```
切記 RESTful API 設計路由記得使用資料本原來思考設計, 因爲我們通常以功能性去思考，路由上設計可能會以功能上設計
比如 /top-Bnbs 或者 /getBnbsTop
https://learn.microsoft.com/zh-cn/azure/architecture/best-practices/api-design
```
## 取得專案過後需要運行的指令

### 第1步 git clone 專案過後:
```
composer install
```
### 第2步 env 設定:
```
1. 安裝 Composer 後，在專案根資料夾中建立 .env 文件，並將 .env.example 文件中的所有內容複製到 .env 檔案中。然後在終端機中執行(切記: 記得 cd 至專案底下)

3. php artisan key:generator 或 php artisan key:gen 指令。
它會在 .env 檔案中為您產生 APP_KEY。

4. 并且設定資料庫:
DB_DATABASE=(本地資料庫名稱)
DB_USERNAME=(xxx)
DB_PASSWORD=(xxx)
```
### 第3步 運行遷移，生成設定好的資料表:
```
php artisan migrate
```
### 第4步 單元測試(學習中):
```
php artisan test
```
### 第5步 資料表沒數據執行，資料庫填充器生成模擬數據 (Seeder 學習中):
```
php artisan db:seed --class=BnbsSeeder
```
### 第6步 在終端機中執行，專案
```
php artisan serve 或
php artisan ser 或
php artisanserve — port=8080
```
---

## 創建文件指令

### 1. 資料表遷移(migrations) 表格順序第一個優先因爲有關聯表
創建資料表遷移 (migrations)。
#### Bnbs 表：
```
php artisan make:migration create_bnbs_table
```
#### rooms 表：
```
php artisan make:migration create_rooms_table
```
#### orders 表：
```
php artisan make:migration create_orders_table
```

### 2. 創建模型(Models)
#### Bnbs Models：
```
php artisan make:model Bnbs
```
#### Rooms Models：
```
php artisan make:model Rooms
```
#### Order Models：
```
php artisan make:model Orders
```

### 3. 創建Models對應的工廠
#### Bnbs 工廠：
```
php artisan make:factory BnbsFactory --model=Bnbs
```
#### Rooms 工廠：
```
php artisan make:factory RoomsFactory --model=Rooms
```
#### Order 工廠：
```
php artisan make:factory OrdersFactory --model=Orders
```

### 4. 創建測試類別
#### Order 測試：
```
php artisan make:test OrderTest
```

### 5. 資料填充器創建文件指令 (Seeder):
#### 創建資料填充：
```
php artisan make:seeder BnbsSeeder
```