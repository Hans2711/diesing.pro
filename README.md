# diesing.pro

This repository contains the source code for [diesing.pro](https://www.diesing.pro/).

## Website

Visit: <https://www.diesing.pro/>

The site is available in English and German. It provides both public pages and a private account area for registered users. The displayed language is automatically selected based on the visitor's region when possible.

## Features

* **Home page** – overview with links to the main sections
* **Contact** – simple form to send messages
* **CV** – static resume overview with contact information
* **Real-Time Share** – beam text and files to other devices directly via WebRTC
* **Random Teams** – tool to create fair random teams
* **Account area** – contains private tools:
  * Notes
  * Redirects
* **Legal pages** – Imprint and Data Protection information

All content is located within the `resources` folder, and the routing logic can be found under `routes/`.

## Queue Workers

Background jobs rely on Laravel's queue system. For faster processing, configure a Redis queue connection and run multiple workers:

```bash
php artisan queue:work --queue=default --tries=3
```

Using several workers allows asynchronous fetching of URLs to complete more quickly.

