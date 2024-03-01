# Laravel Eloquent Order Manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rajurayhan/laravel-eloquent-order-manager.svg?style=flat-square)](https://packagist.org/packages/rajurayhan/laravel-eloquent-order-manager)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rajurayhan/laravel-eloquent-order-manager/run-tests?label=tests)](https://github.com/rajurayhan/laravel-eloquent-order-manager/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/rajurayhan/laravel-eloquent-order-manager.svg?style=flat-square)](https://packagist.org/packages/rajurayhan/laravel-eloquent-order-manager)

A Laravel package for effortlessly managing the order of Eloquent models. Simplify sorting, reordering, and maintaining the order of items in your application with ease.

## Installation

You can install the package via composer:

```bash
composer require rajurayhan/laravel-eloquent-order-manager


## Usage 
  
    use Raju\EloquentOrder\EloquentOrderManagerService;

    $orderManager = new EloquentOrderManagerService(YourModel::class);
    $newItem = ["name" => "New Item", "order" => 4];
    $newItem = ["id" => 5, "name" => "New Item", "order" => 4]; // If Updating existing entry.
    $orderManager->addOrUpdateItem($newItem);
 
## Find Me
	Email: devraju.bd@gmail.com 