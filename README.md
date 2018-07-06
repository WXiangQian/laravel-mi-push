# laravel-mi-push基于laravel5.5的小米推送

# 安装方法
### 1、在项目目录下 
    composer require qq175023117/laravel-mi-push    
    composer install
    
    或
    
    composer.json 中添加 "qq175023117/laravel-mi-push": "^1.1"  
    composer update 

 如果无法安装 请执行一下 composer update nothing 然后 composer update
 
 
###  2、在config/app.php
   'providers' 中添加 \Qian\MiPush\MiPushServiceProvider::class,
   
   
###  3、执行 php artisan config:cache 清空配置缓存 
执行 php artisan vendor:publish

###  4、配置 config/mipush.php


## 使用方法

##### 安卓向所有设备发送
MiPush::sendAll($title,$description,$payload);

##### 苹果向所有设备发送
MiPush::iosSendAll($title,$description,$payload);

##### 安卓根据alias推送
MiPush::sendToAlias($title,$description,$payload,$alias);

##### 苹果根据alias推送
MiPush::iosSendToAlias($title,$description,$payload,$alias);

#### 暂时四个方法可以满足基本需求，如有需要，欢迎大家提交问题