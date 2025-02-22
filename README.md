# Subscription Challenge

## Introduction

This project is a coding challenge, written in Laravel and using MySQL and Redis.

It is a simple subscription platform in which users can subscribe to a website - there can be multiple websites in the system. Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it.

## How to run?

This project uses Laravel Sail to ease development.

Make sure you have Docker installed and running, and run this command:

`./vendor/bin/sail up`

After that, run this command periodically to send posts to subscribers:
`./vendor/bin/sail artisan app:process-subscription-notifications`

This background worker must be running to send the actual emails:
`./vendor/bin/sail artisan queue:work`

## How to test?

There is a Postman collection file, located in this address:

`./docs/postman.json`

You can also use Bruno and open the collection located at this address:

`./docs/bruno`
