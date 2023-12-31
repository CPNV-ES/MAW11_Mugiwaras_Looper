<br />
<div align="center">

  <h1 align="center">MAW11 MUGIWARAS Looper</h1>

  <p align="center">
    An awesome copy of looper !
    <br />
    <br />
    <a href="https://github.com/CPNV-ES/MAW11_Mugiwaras_Framework/issues/new?assignees=&labels=bug&projects=&template=bug_report.md&title=%5BBUG%5D">Report Bug</a>
    ·
    <a href="https://github.com/CPNV-ES/MAW11_Mugiwaras_Framework/issues/new?assignees=&labels=enhancement&projects=&template=feature_request.md&title=">Request Feature</a>
  </p>
</div>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
  </ol>
</details>

# About The Project

This is a copy of looper useing the framework that we are developing beside. It is a project for the Web Applications Development course at the CPNV. The goal of this project is to copy http://exercice-looper.mycpnv.ch/ by using a framwork that we are currently developing.

# Getting Started

## Prerequisites

* PHP 8.2.9 (TS)
* xdebug 3.2.2
* composer 2.6.2
* MySQL 8.0.31

### How to install the requirements

#### PHP

> Use your favourite package manager to install PHP 8.2.9 (TS). Or follow this [link](https://www.php.net/manual/install.php) that redirects to the official PHP download page.

> You have to uncomment "extension=pdo_mysql" in your php init file

#### xdebug

> Follow this [link](https://xdebug.org/docs/install) that redirects to the official xdebug install documentation.

#### composer

> Follow this [link](https://getcomposer.org/download/) that redirects to the official composer download page.

#### MySQL

> Follow this [link](https://dev.mysql.com/downloads/installer/) that redirects to the official MySQL download page.

### Installation

1. Clone the repository.
```shell
git clone https://github.com/CPNV-ES/MAW11_Mugiwaras_Looper.git
```

2. Install the dependencies with composer

```shell
composer install
```
3. Create the looper database in your mySQL server by importing the db_looper.sql creation file.

4. Copy the .env.example or set the required environment variables.

5. You are all set! You can now start working on the project.

### Start the project

```
php -S localhost:8080 -t .\public\
```