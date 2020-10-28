# Muhammed Mızrak - Resize Image and upload Base64 of the image into the S3 bucket

! In this project I am using Image Intervention Package and AWS S3 bucket

## Getting Started
> git clone https://github.com/mhmmdmzrk/resize-image.git 

## Installations

> composer install

> php -r "file_exists('.env') || copy('.env.example', '.env');"

> php artisan key:generate

*In .env put your database configurations

> php artisan migrate

*Run the following command to able to use AWS S3 bucket

> composer require league/flysystem-aws-s3-v3

*In .env file put your AWS credentials. ( you can visit this link to setup your AWS S3 -> https://medium.com/@sehmbimanvir/laravel-upload-files-to-amazon-s3-a17d013f53ce )

![alt text](https://miro.medium.com/max/696/1*-gLMFOEq8WK1Ov2hT2804w.jpeg)

*Finally run the following command and enjoy it :D

> php artisan serve
