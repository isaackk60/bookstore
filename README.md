<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
  <img src="https://png.pngtree.com/template/20191125/ourmid/pngtree-book-store-logo-template-sale-learning-logo-designs-vector-image_335046.jpg" width="200" alt="Book store Logo">
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Welcome to the Bookstore Laravel Project!
This web application is made using Laravel framework and runs as an online bookstore. Our platform facilitates the browsing and purchase of books, however, support for transactions is currently lacking as a virtual account system has not been implemented. But the amount of the simulated checkout will be displayed in the database. Below is a detailed description of the entire project:

+ **Author:** 
    **Jianfeng Han (SD2A)** and **Kim Fui Leung (SD2A)**<br>

+ **Student Number:** 
    **D00251825** (Jianfeng Han) and **D00234545** (Kim Fui Leung)<br>

## Table Of Contents
1. [Web Description](#web-page-description-and-function-introduction)
2. [Technologies / Programming Languages Used](#technologies--programming-languages-used)
3. [Installation](#installation)
4. [Requirements](#Requirements)
5. [Configure Laravel Environment](#create-and-configure-laravel-environment)
6. [Screenshots](#ScreenShots)

2. [Technologies / Programming Languages Used](#technologies--programming-languages-used)
3. [Features](#Features)
4. [Screenshots](#Screenshots)
5. [Installation](#installation)
    - [Before Starting](#before-starting)
6. [Authors](#Authors)
7. [Contact](#Contact)
8. [Contributing](#Contributing)
9. [License](#License)

## Web page description and function introduction
 + **Book Browse, Search, and Sort:** Users can effortlessly browse, search, and sort books using a variety of criteria, including price and publication date, ensuring they find the books they need quickly and easily.
 + **User Authentication:** The system supports differentiated access levels, with distinct functionalities for guests, registered users, and administrators, enhancing security and user experience.
 + **User Detail:** Administrators have the ability to view detailed purchase records and user information, enabling effective management and oversight of platform activity.
 + **Shopping Cart:** To ensure fair distribution and manage inventory effectively, the system limits purchases to a maximum of 10 copies of each book per transaction.
 + **Payment Functionality:** While the checkout process includes a simulation that displays the total price, actual payment processing is not implemented,but the total price is displayed in the database, allowing for demonstration purposes without real transactions.

## Technologies / Programming Languages Used
•	Laravel 8 <br>
•	JavaScript<br>
•	Tailwind CSS <br>
•	MySQL<br>
•	PHP<br>

## Installation

To run the **Book Store Laravel** project on your local machine, follow these steps:

## Requirements
+	PHP 7.3 or higher <br>
+	Node 12.13.0 or higher <br>
+	Xampp/MySql<br>
+   Vs Code (code editor)<br>

## Create and Configure Laravel Environment

Follow these steps to set up your development environment on your local machine:

1. **Clone the repository and install dependencies**
    ```bash
    git clone git@github.com:codewithdary/laravel-8-complete-blog.git
    cd laravel-8-complete-blog
    cp .env.example .env
    composer install
    php artisan key:generate
    php artisan cache:clear && php artisan config:clear
    php artisan serve
    ```

2. **Install Laravel**
    - Open your terminal and install the Laravel framework first:
    ```bash
    composer create-project laravel/laravel my-project
    cd my-project
    ```

3. **Install Tailwind CSS**
    - Add Tailwind CSS to your project:
    ```bash
    npm install -D tailwindcss postcss autoprefixer
    npx tailwindcss init -p
    ```

4. **Configure your template paths**
    - Update your `tailwind.config.js` file to include the paths to all of your template files:
    ```javascript
    /** @type {import('tailwindcss').Config} */
    export default {
      content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
      theme: {
        extend: {},
      },
      plugins: [],
    }
    ```

5. **Add Tailwind Directives to Your CSS**
    - Insert the following Tailwind directives at the top of your CSS file:
    ```css
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    ```

6. **Start Your Build Process**
    - Run the following command to process your CSS with Tailwind:
    ```bash
    npm run dev
    ```

7. **Starter kit for Laravel LOGIN AND REGISTER**
    This Starter Kit is referenced from [Laravel starter kits website](https://laravel.com/docs/11.x/starter-kits).
    This video is tell you how to download and install this Starter kits [This YouTube video](https://www.youtube.com/watch?v=f1hCx-NXbek).

## ScreenShots


## Contact


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

