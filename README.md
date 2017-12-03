# TMStock

**TMStock** is a **stock-keeping application** for organisations with **multiple warehouses/outlets/stores**. It keeps track of inventory in multiple warehouses belonging to a single organization, and manages sales by creating orders and invoices.

## **Features**

#### 1\) Warehouses/Godowns/Venues

* Create and manage multiple warehouses within the same organisation
* View stock-in-hand for a warehouse at any point
* Assign managers to each warehouse
* Venues can be places where stock is temporarily kept. For e.g., wedding halls, catering supplies, etc. 

#### 2\) Purchases

* Diligently create/view purchases from suppliers for each warehouse
* Split products in a purchase between different warehouses with separate quantities. For e.g., out of 40 quantities of product1 puchased, 30 can go to godown1 and rest 10 can go to godown2
* Assign a manager handling the purchase

#### 3\) Suppliers

* Add/view suppliers and historical purchases made from them, and edit those purchases at any instant
* Suppliers could be manufacturers, stock distributors, etc. 

#### 4\) Orders/Invoices

* Keep a record of orders received from customers
* Choose to fulfill orders from either one warehouse or multiple warehouses at a time
* Option to fulfill product quantities at different prices for each order
* Create and print invoices slips to be handed over to the customers

#### 5\) Customers

* Add/edit customers with their contact details
* These can be other warehouses, organizations or own stores/outlets
* Check historical orders supplied to a customer at any point of time

#### 6\) Items/Stocks

* Add item details in self-made categories and upload pictures, which can be used to verify items when selling them
* Check all the items present in a warehouse, and search flawlessly for items throughout the stock in multiple warehouses
* Start with doing a stock count, and update items with stock-in-hand. Inventory levels then can add/subtract by sales/purchase entries respectively

#### 7\) Rentals

* Manage rentals for goods being given at rent, or being taken for at rent
* Mange the periods for which a product is being given for rent. Stock reports then tell when is a particular item gonna be available in the warehouse next. 
* Items can be tracked for rentals for different business purposes, like catering, or event managements.

#### 8\) Business options

* Choose from multiple business options. For example, an organization may be involved in a separate catering business and an events management business. They could manage both of them separately within the same TMStock umbrella

#### 9\) User Management

* Users can be divided into admins and employees. Admins can create more employees and generate login credentials for them

#### 10\) App ease-of-access

* It's a web application, hence can run on any device out there with a browser
* The responsive bootstrap design makes it easy to work on phones, tablets and iPads
* Improved keyboard based interaction in the form of shortcut keys. So for a computer savvy guy with lots of data to fill in every day, everything could be done with just the keyboard without touching the trackpad/mouse for even a second.

## Demo

A demo of the app has been put here: [http://tmstock-staging.herokuapp.com](http://tmstock-staging.herokuapp.com) 

The demo is actually the staging environment, auto-deployed with the `develop` branch. The application is set up in heroku for free, and JawsDB as a database provider.

Use the following credentials for logging in and checking out all its cool features:

**Username**: `admin`

**Password**: `admin`  


## Scope of Improvement

This project was taken up by me for a client who had these exact requirements. This was long back when I was graduating, and had little to no knowledge of developing a production-ready application. So it has a lot of scope for improving, and could benefit lots of people.

#### 1\) Technical Improvements

* Minification of JS, CSS files
* Getting rid of the starter template files
* Use of a proper MVC framework \(Right now, it's just Core PHP, written along with HTML content in the same files\)
* Maintain proper directory structure
* Database scripts for gearing up applications for new users from scratch
* Use of composer for dependencies \(Back then I had no clue what this meant\)
* Multi-tenant support \(this may be debatable, a decision can be taken once more than 1 client starts using this. Right now it's just 1\)
* Improving database queries
* User management with proper role resolvers
* Logging \(nothing has been done in this area\)
* User experience has been setup closely for keyboard interaction. This conflicts with mouse based interaction a lot

#### 2\) Features Improvements

* Separation of features for different levels of users
* A settings page that could fix a set of rules for different organizations
* Look through the code to find a set of shortcut key combin[http://localhost/tmstock/index.php](http://localhost/tmstock/index.php)ations I had generated back then, and show them in the UI for ease of user-access. I forgot what they are, but are easy to find once I have the time.



## Collaborators/Developers/Resellers

* Collaborators are welcome to suggest both technical and features improvement, or even report bugs
* Developers can fork this repo, make improvements/add new features of their own, and generate a pull request.
* The project is pretty much open-source, so their is no reselling involved. Any organization with an in-house developer could start using it with minimal support. Just mention a thank you to `kamalkhatwani69@gmail.com`, and I'd be glad to help you out with anything required

## Set up project for development

* Download XAMPP server from this page, choosing your OS \(I initially used Windows in college times, now OS X\)
  * [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
* Choose Apache, PHP and MySQL while installation.
* Clone the repository to `XAMPP/htdocs/tmstock`. Alternatively, clone it in a directory of choice, and create a symbolic link to `XAMPP/htdocs/tmstock`
  * `git clone git@github.com:kamal0808/tmstock.git`
* Download phpMyAdmin for a UI based interaction with database
  * [https://www.phpmyadmin.net/downloads/](https://www.phpmyadmin.net/downloads/)
* Import the sql file through phpMyAdmin/command line from `tmstock-empty-db.sql` in `origin/develop`
  * https://github.com/kamal0808/tmstock/blob/develop/tmstock-empty-db.sql
* Once you're done with the setup, you can find the app running in [http://localhost/tmstock/index.php](http://localhost/tmstock/index.php)



