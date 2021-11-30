<div id="top"></div>
<br />

### Built With
Laravel YAY

## Requirements
PHP version <b>^8.0</b>

<!-- GETTING STARTED -->
## Installation

Pull this repo please :)

Install dependencies:
```sh
composer install
   ```
Cache config
```sh
php artisan conf:cache
   ```
## Getting started

Run command -> (this is just a sample, you should use real path)
```sh
php artisan find:best /home/projects/app/file.csv
   ```
```sh
Select column to filter by:
[0] race
[1] year
[2] country
```
 For example, type 1 + Enter to select race

 In following question type value you want to use in order to filter columns:
```sh
Please enter column value:
```

For example, use 2007 to check only results within 2007.