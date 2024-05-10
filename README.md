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
1. [Technologies / Programming Languages Used](#technologies--programming-languages-used)
2. [Requirements](#Requirements)
3. [Web Description And Features](#web-page-description-and-function-introduction)
4. [Screenshots](#ScreenShots)
5. [Installation](#installation)
	- [Before Starting](#before-starting)
6. [Contact](#Contact)
7. [Reference](#Reference)
8. [Contributing](#Contributing)
9. [About Laravel](#about-laravel)
10. [License](#License)



## Technologies / Programming Languages Used
+	Laravel 8 <br>
+	JavaScript<br>
+	Tailwind CSS <br>
+	MySQL<br>
+	PHP<br>

## Requirements
+	PHP 8.3 or higher <br>
+	Node 20.0.0 or higher <br>
+	Xampp/MySql<br>
+ Vs Code (code editor)<br>

## Web page description and function introduction
 + **Home page:** The homepage features dynamic scrolling subtitles and engaging text content designed to provide visitors with a quick overview of the services offered by the platform.<br>
 + **Book Browse, Search, and Sort:** The website offers an intuitive browsing experience where users can easily search for books and sort them using price and publication date. It is also possible to use search functions including (search for book title, price, type, etc.) This function ensures that users can find exactly the book they are looking for quickly and efficiently.<br>
 + **Comments and ratings functionality：** The system supports a strong comment and rating system. Users and administrators can comment on books and rate them on a scale of 1 to 5 stars. In addition, the system aggregates these ratings to arrive at a final average score for each book, helping other users make informed decisions based on varying user feedback.<br>
 + **User Authentication:** The system provides access levels to enhance security and user experience:
    - Visitors can browse books but need to register to purchase.
    - Registered users can purchase books, view purchase history, and participate in rating and reviewing books.
    - Administrators can access advanced features including book management, ratings and reviews, set book quantities, view detailed user information and purchase history, and delete user reviews and registered users.<br>
 + **User Detail:** Administrators have the ability to view detailed purchase records and user information, enabling effective management and oversight of platform activity.<br>
 + **Shopping Cart:** The system imposes a purchase limit of 10 copies per book per user per transaction. Users also have the option to purchase multiple different books during a single checkout process.<br>
 + **Payment Functionality:** While the checkout process includes a simulation that displays the total price, actual payment processing is not implemented,but the total price is displayed in the database, allowing for demonstration purposes without real transactions.



## ScreenShots



## Installation

To run the **Book Store Laravel** project on your local machine, follow these steps:

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
    + This Starter Kit is referenced from [Laravel starter kits website](https://laravel.com/docs/11.x/starter-kits).
    + This video is tell you how to download and install this Starter kits [This YouTube video](https://www.youtube.com/watch?v=f1hCx-NXbek).



## Before Starting
Create a database <br>
```
mysql
create database laravelbookstore;
exit;
```

Setup your database credentials in the .env file <br>
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelbookstore
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}
```

Migrate the tables
```
php artisan migrate
```



## Contact
For support, collaboration, or further inquiries, here are the ways you can reach out to us or For any questions, suggestions, or conspiracy theories you'd like to share, feel free to reach out to us to at:
+ Email (jf08942378268@gmail.com) / (D00251825@studnet.dkit.ie) Name: Jianfeng Han
+ Email (kimfuileung@gmail.com) / (D00234545@student.dkit.ie) Name: Kim Fui Leung


## Reference
+ We use this video to download and install this Starter kits [This YouTube video](https://www.youtube.com/watch?v=f1hCx-NXbek).
+ We use this video to design the reviews rating star css [This YouTube video](https://youtu.be/lW8-w66v9CQ?si=HZWD5t_TrYWVhVQx).



## Contributing
Do not hesitate to contribute to the project by adapting or adding features ! Bug reports or pull requests are welcome.


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


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

