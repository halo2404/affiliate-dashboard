Affiliate-Dashboard
===================

[![Latest Stable Version](https://poser.pugx.org/klein0r/affiliate.dashboard/v/stable)](https://packagist.org/packages/klein0r/affiliate.dashboard) [![Total Downloads](https://poser.pugx.org/klein0r/affiliate.dashboard/downloads)](https://packagist.org/packages/klein0r/affiliate.dashboard) [![Latest Unstable Version](https://poser.pugx.org/klein0r/affiliate.dashboard/v/unstable)](https://packagist.org/packages/klein0r/affiliate.dashboard) [![License](https://poser.pugx.org/klein0r/affiliate.dashboard/license)](https://packagist.org/packages/klein0r/affiliate.dashboard) [![Code Climate](https://codeclimate.com/github/klein0r/affiliate-dashboard/badges/gpa.svg)](https://codeclimate.com/github/klein0r/affiliate-dashboard)

- Upload Amazon Partnetnet XML files
- Get information about sales, revenue and performing categories

## Installation

Get composer

```
curl -sS https://getcomposer.org/installer | php
```

Install the current version

```
php composer.phar install
```

Copy app/config/parameters.yml.dist to app/config/parameters.yml and fill required fields (like database connection)

Create the database schema

```
php bin/console doctrine:schema:create
```

Upload report.xml files from Amazon Partnernet

Start adding users and blogposts by using the ui and assign blogposts to tags and users

## Technologies

- Symfony 3 (MIT license)
- Bootstrap 3 (MIT license)
- Highcharts (Non-commercial - Creative Commons Attribution-NonCommercial 3.0 License)

## License

The MIT License (MIT)
Copyright (c) 2016 Matthias Kleine

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.