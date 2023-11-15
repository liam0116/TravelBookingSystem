# 安裝過後需要運行指令
### 第1步 env 設定:
```
DB_DATABASE=(本地資料庫名稱)
DB_USERNAME=(xxx)
DB_PASSWORD=(xxx)
```
### 第2步 運行遷移，生成設定好的資料表:
```
php artisan migrate
```
### 第3步 單元測試(學習中):
```
php artisan test
```
### 第4步 資料表沒數據執行，資料庫填充器生成模擬數據 (Seeder 學習中):
```
php artisan db:seed --class=BnbsSeeder
```

---

# 創建文件指令
## 1. 資料表遷移(migrations) 表格順序第一個優先因爲有關聯表
創建資料表遷移 (migrations)。
### Bnbs 表：
```
php artisan make:migration create_bnbs_table
```
### rooms 表：
```
php artisan make:migration create_rooms_table
```
### orders 表：
```
php artisan make:migration create_orders_table
```

## 2. 創建模型(Models)
### Bnbs Models：
```
php artisan make:model Bnbs
```
### Rooms Models：
```
php artisan make:model Rooms
```
### Order Models：
```
php artisan make:model Orders
```

## 3. 創建Models對應的工廠
### Bnbs 工廠：
```
php artisan make:factory BnbsFactory --model=Bnbs
```
### Rooms 工廠：
```
php artisan make:factory RoomsFactory --model=Rooms
```
### Order 工廠：
```
php artisan make:factory OrdersFactory --model=Orders
```

# 4. 創建測試類別
### Order 測試：
```
php artisan make:test OrderTest
```

# 資料庫填充器創建文件指令 (Seeder):
```
php artisan make:seeder BnbsSeeder
```