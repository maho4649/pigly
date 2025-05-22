## Dockerビルド
1. git clone git@github.com:maho4649/pigly.git
2. cd pigly
3. docker-compose up -d --build


## Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp .env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed


## 使用技術
PHP 8.1 
Laravel Framework 8.83.29  
mysql  Ver 9.2.0 for macos15.2 on arm64 (Homebrew)  
  
URL  
開発環境:http://localhost/  
phpMyAdmin:http://localhost:8080  


トップページ(管理画面)  
/weight_logs  
体重登録  
/weight_logs/create  
体重検索  
/weight_logs/search  
体重詳細  
/weight_logs/{:weightLogId}  
体重更新  
/weight_logs/{:weightLogId}/update  
体重削除  
/weight_logs/{:weightLogId}/delete  
目標設定  
/wight_logs/goal_setting  
会員登録  
/register/step1  
初期目標体重登録  
/register/step2  
ログイン  
/login  
ログアウト  
/logout  


┌────────────┐
│   users    │
├────────────┤
│ id         │ PK
│ name       │
│ email      │
│ password   │
│ created_at │
│ updated_at │
└────────────┘
      │
      │ 1
      │
      ▼
┌────────────────┐
│  weight_logs    │
├────────────────┤
│ id             │ PK
│ user_id        │ FK → users.id
│ date           │
│ weight         │
│ calories       │
│ exercise_time  │
│ exercise_content │
│ created_at     │
│ updated_at     │
└────────────────┘│
      │ 2
      │
      ▼
┌──────────────┐
│   goals      │
├──────────────┤
│ id           │ PK
│ user_id      │ FK → users.id
│ target_weight│    │
│ created_at   │
│ updated_at   │
└──────────────┘
