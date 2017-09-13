# Composer 新手入門教學

## 安裝 Composer

* 官網安裝指南：
    - Linux / Unix / OSX <https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx>
    - Windows: <https://getcomposer.org/doc/00-intro.md#installation-windows>
* 手動安裝下載位置：<https://getcomposer.org/download/>
* From 官網，使用 PHP 執行環境安裝 (一行一個指令)
    ```bash
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    ```
* 或直接下載 `.phar` 打包檔，<https://getcomposer.org/composer.phar>
* 執行 `php composer.phar`，出現以下資訊表示裝好了：

```
       ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 1.5.1 2017-08-09 16:07:22

Usage:
  command [options] [arguments]

Options:
  -h, --help                     Display this help message
  -q, --quiet                    Do not output any message
  -V, --version                  Display this application version
      --ansi                     Force ANSI output
      --no-ansi                  Disable ANSI output
  -n, --no-interaction           Do not ask any interactive question
      --profile                  Display timing and memory usage information
      --no-plugins               Whether to disable plugins.
  -d, --working-dir=WORKING-DIR  If specified, use the given directory as working directory.
  -v|vv|vvv, --verbose           Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

  # 後略...
```

* 看到一般 github 上寫例如： `$ composer require mike182uk/cart`
就是要執行 `$ php composer.phar require mike182uk/cart`
再例如要你執行： `$ composer install`
就是要執行 `$ php composer.phar install`

* 但一般來說，都會把 `composer.phar` 改名為 `composer` 變成一個可執行檔，
複製到系統 path 中可以讀得到的路徑上，
以 Mac 為例： `cp comopser.phar /usr/local/bin/composer`
這樣以後就只要執行 `composer` 不用再打一長串了。

* Windows 的話應該會製成 `composer.bat` 檔，複製到系統 path 中可以讀得到的路徑上，內容會類似是 `php.exe composer.phar %1 %2 %3 %4 %5` 之類的。可參考我搜尋到的一個 gist：<https://gist.github.com/JCook21/1752267> (沒試用過，有誰試過能用麻煩跟我說一聲，感謝！)

* 附註：以前使用 curl 的安裝的方式在 mac 環境仍然能用，
我想應該是因為在 windows 上沒有 curl 這個工具，所以官網才改的。
下這行指令，效果也一樣會下載 `composer.phar` 檔： `curl -sS https://getcomposer.org/installer | php`


<br>
<br>
<br>

## Composer Require 安裝/引用 package(套件)

### 引用購物車 package，執行：`$ composer require mike182uk/cart`

* <http://packagist.org> 可搜尋有哪些套件，是 `composer require {name}` 時會搜的資料庫
* <https://packagist.org/packages/mike182uk/cart>
* <https://github.com/mike182uk/cart>
* `composer.json` 裡的 name 就是 require 套件時要用的 {name}
* 相關源碼會下載到 vendor 資料夾

### 怎麼使用下載的套件？

* 在 php 中加入：
    ```php
    <?php
    require __DIR__ . '/vendor/autoload.php

    // ...
    ```
* 看套件的 readme.md 看怎麼用，如果沒有，就只好自己看原始碼了。

### 使用套件的 Live Demo

* 建立 Cart instance
* 加入 CartItem
* 計算 Totol amount

### Composer Require 做了什麼？
    - 會下載 `mike182uk/cart` 到 `vendor` 資料夾
    - 如果當時沒有 `composer.lock`，執行完會建立 `composer.lock`。

<br>
<br>
<br>

## Composer Install 安裝 package(套件)

### `composer.json` 設定檔，用來「限制」更新/安裝套件的版本

* `composer.json` 是 Composer 重要設定檔，最重要的功能就是用來「限制」更新套件的版本。功能類似 `package.json`, `bower.json`。
* 執行 `$ composer install` 時，如果找不到 `composer.lock` 檔，則依 `compsoer.json` 檔內容安裝套件。
* 其他還有很多功能，這邊先不混淆大家，怎麼「限制」版本到後面 composer update 再聊。

### `composer.lock` 用來「鎖定」安裝的套件和套件版本

* 用來「鎖定」安裝的套件及版本，在執行 `$ composer update` 或 `$ composer require` 時會改變其內容。 是 `$ composer install` 優先讀取的設定檔。
* 執行 `$ composer install` 「不會」改變 `composer.lock` 檔的內容。


### 1. 要用 `composer install` 安裝套件，需要先有 `composer.json` 或 `composer.lock`

以空專案為例，先自己新增一個 `composer.json` 檔，或是從同事的 repo 得來等等，例如：
```json
{
    "require": {
        "mike182uk/cart": "^3.0"
    }
}
```

### 2. 執行 `$ composer install`
    - 讀取 json 設定檔，會下載 `mike182uk/cart` 套件到 `vendor/` 資料夾
    - 在這 json 檔的例子裡，效果跟 `$ composer require mike182uk/cart` 結果一樣
    - 根據 `require` / `require-dev` 的設定限制安裝套件的版本
    - 版本限制一般是用 git repo 的 tag
    - 如果不想裝 `requrie-dev` 中的東西，可以改用 `$ composer install --no-dev`
    - 如果當時沒有 `composer.lock`，執行完會建立 `composer.lock`。

* 來看個比較複雜的例子，拿這次用的 `mike182uk/cart` 套件裡的 `composer.json` 為例：

```json
{
  "name": "mike182uk/cart",
  "description" : "A flexible and modern shopping cart package",
  "type": "library",
  "license": "MIT",
  "authors": [
    {
      "name": "Michael David Barrett",
      "email": "mike182uk@gmail.com"
    }
  ],
  "require" : {
    "php": ">=5.6.0"
  },
  "require-dev": {
    "phpunit/phpunit": "~5.0",
    "mockery/mockery": "~0.0",
    "friendsofphp/php-cs-fixer": "~2.0"
  },
  "autoload": {
    "psr-4": {
      "Cart\\": "src"
    }
  },
  "scripts": {
    "test": "phpunit --verbose --colors=always",
    "test-with-coverage": "phpunit --verbose --colors=always --coverage-clover coverage.clover",
    "lint": "php-cs-fixer fix --dry-run --verbose --ansi",
    "fix": "php-cs-fixer fix --ansi"
  }
}
```

## Composer Install 的重要觀念：

* 執行 `$ composer install` 會讀 `composer.lock` 檔，依 lock 檔內容安裝套件「指定的版本」。這時候完全不會管你 `composer.json` 寫什麼，就算有 json 檔中有加入新的套件，也不會被裝進來。

* 如果沒有 lock 檔，則直接讀 `composer.json`，依 json 檔設定的套件版本限制安裝套件。

* 沒有 `composer.json` 的話無法執行 `$ composer install`，就算有 `composer.lock` 也不行。 (tested at composer v1.5.1 on 2017-09-11)

<br>
<br>
<br>

## 用 Composer Update 安裝/更新 package(套件)

* 以安裝 PHPUnit 5.5 為例，`$ composer require --dev phpunit/phpunit "5.5.*"`
* 裝完後，想看該套件的 Home `$ composer home phpunit/phpunit`
* 或是看 github `$ composer browse phpunit/phpunit`
* 移除套件 `$ composer remove phpunit/phpunit`

### 1. 要用 `composer update` 更新套件，需要先注意 `composer.json` 裡的版本限制

我們剛剛故意安裝 phpunit `5.5.*` 的版本。現在要來更新到 `~5.0`。所以把 `composer.json` 改成這樣：

```json
{
    "require": {
        "mike182uk/cart": "^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "~5.0"
    }
}

```

* 關於版本的限制官網說明： <https://getcomposer.org/doc/articles/versions.md>
* 測試你的版本設定： <https://semver.mwl.be/>

#### 版本限制重點整理版：

|  常見限制條件  |        版本範圍(tag)/分支名稱(branch)        |
|----------------|----------------------------------------------|
| 3.*            | >= 3.0.0, < 4.0                              |
| 3.1.*          | >= 3.1.0, < 3.2                              |
| ~3.1           | >= 3.1.0, < 4.0 (最常見)                     |
| ~3.1.0         | >= 3.1.0, < 3.2 (注意)                       |
| ^3.1.0         | >= 3.1.0, < 4.0 (注意)                       |
| ^3.1           | >= 3.1.0, < 4.0 (注意)                       |
| dev-master     | master branch (需搭配 minimum-stability)     |
| dev-develop    | develop branch (需搭配 minimum-stability)    |
| dev-my-feature | my-feature branch (需搭配 minimum-stability) |
| 1.0 - 2.0      | >= 1.0.0, < 2.1                              |
| 1.0.0 - 2.1.0  | >= 1.1.0, <= 2.1.0                           |

> ref: https://blog.madewithlove.be/post/tilde-and-caret-constraints/


### 2. 執行 `composer update` 會做什麼？
```json
{
    "require": {
        "mike182uk/cart": "^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "~5.0"
    }
}
```

    - 讀取 `composer.json` 檔中的版本限制設定
    - 下載套件到 `vendor` 資料夾，並更新 `composer.lock` 檔中鎖定的套件版本
    - 以上面這個例子，會更新 phpunit 到 `< 6.0` 的最新版，目前就是 5.7.21
    - 無法復原，除非把套件砍掉重裝


### 3. 來車拼 `$ composer install` vs `$ composer update`

|                  |               Composer install               | Composer update |
|------------------|----------------------------------------------|-----------------|
| composer.json 檔 | 有 lock 檔先讀 lock 檔，<br>沒有才讀 json 檔 | 主要讀 json 檔  |
| composer.lock 檔 | 不會更新，若沒有的話會建一個                 | 會被更新        |

> 註：若套件沒有新版本當然 `composer update` 就不會更新 lock 檔

## 用 Composer 幫你 autoload 各 class 檔

* 這邊看影片跟著操作一次學比較快： <https://www.youtube.com/watch?v=qxaL_bjGKEw> (從 55:00 左右開始)

### 好處與重點：

* 只要 require 一個 autoload.php 檔，不用再一個個類別檔案 require
* 有 files, classmap, psr-4/0 等可以選擇
* 只有 functions 的 php 檔，必須要用 files 的方式放進 composer.json






