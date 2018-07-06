# laravel-mi-push基于laravel5.5的小米推送

# 安装方法
### 1、安装
    composer require qq175023117/laravel-mi-push    
    composer install
    
    或
    
    composer.json 中添加 "qq175023117/laravel-mi-push": "^1.1"  
    composer update 

 如果无法安装 请执行一下 composer update nothing 然后 composer update
 
 
###  2、配置app.php

    在config/app.php 'providers' 中添加 \Qian\MiPush\MiPushServiceProvider::class,
   
   
###  3、执行命令
    php artisan config:cache 清空配置缓存 
    php artisan vendor:publish 

###  5、配置文件
    config/mipush.php

# 实例

### 安卓初始化以及基本配置

    $secret = config('mipush.android.app_secret');
    $package = config('mipush.android.bundle_id');
    Constants::setSecret($secret);//AppSecret
    Constants::setPackage($package);//包名
    
    $message = new Builder();
    $message->title($title);  // 通知栏的title
    $message->description($description); // 通知栏的descption
    $message->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
    $message->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
    $message->extra(Builder::notifyEffect, 1); // 此处设置预定义点击行为，1为打开app
    $message->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
    $message->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
    $message->build();
        
##### 安卓topic发送

    先插入安卓初始化以及基本配置
            
    $sender = new Sender();
  
    $res = $sender->broadcast($message, $topic)->getRaw();
    return $res;

##### 安卓根据alias推送
    
     先插入安卓初始化以及基本配置
    
    $sender = new Sender();
    $res = $sender->sendToAlias($message, $alias)->getRaw();
    return $res;
    
### 苹果初始化以及基本配置

    $secret = config('mipush.ios.app_secret');
    $package = config('mipush.ios.bundle_id');
    Constants::setSecret($secret);//AppSecret
    Constants::setPackage($package);//包名
    
     // Constants::useSandbox(); //此代码为测试环境添加
     
     $message = new IOSBuilder();
     $message->title($title);
     $message->body($Description);
     $message->soundUrl('default');
     $message->badge('-1');
     $message->extra('payload', $Payload);
     $message->build();
     
##### 苹果全局发送
     
     先插入苹果初始化以及基本配置
     $sender = new Sender();

     $res = $sender->broadcastAll($message)->getRaw();
     return $res;


##### 苹果根据alias推送
        
     先插入苹果初始化以及基本配置
     
    $sender = new Sender();
    $res = $sender->sendToAlias($message,$alias)->getRaw();
    return $res;

#### 暂时四个方法可以满足基本需求，如有需要，欢迎大家提交问题