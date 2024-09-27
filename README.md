# PageRank Application

## Overview

This Laravel-based application fetches the PageRank of a list of domains from an external API (OpenPageRank) and displays the results in a Vue.js-powered web interface. The data is paginated, and users can search for specific domains.

## Features
- Fetches domain PageRank data using the OpenPageRank API.
- Saves or updates the PageRank for each domain in the database.
- Displays a paginated list of 100 domains per page.
- Includes a search feature to filter domains by name.
- Automatically fetches and updates PageRank data daily via a scheduled Laravel job.

## Installation

### Prerequisites
- **PHP 8.0+**
- **Composer**
- **Node.js with npm**
- **MySQL or another supported database**
- **OpenPageRank API Key** (`ws48csg0cow0w4kg0gck4oc8wo80kcg8w0g4s08k`)

### Step-by-Step Guide

1. **Clone the Repository:**
   ```bash
   git clone git@github.com:Ryttis/pagerank.git
   cd PageRankApp
2. **Install PHP dependencies: Use Composer to install the necessary Laravel dependencies:**
   ```bash
   composer install
3. **Install JavaScript dependencies: Use npm to install Vue.js and other frontend dependencies:**
   ```bash
   npm install
4. **Set up the environment: Copy the example environment file and configure it to match your setup:**
   ```bash
   cp .env.example .env
5. **Update the .env file with your database credentials, API keys, and other environment-specific settings.**
6. **Generate an application key: Generate the application key for Laravel:**
   ```` bash
   php artisan key:generate
7. **Run database migrations: Migrate the database schema to create necessary tables:**
   ````bash
   php artisan migrate
8. **Compile frontend assets: Compile and bundle the frontend (Vue.js) assets using Vite:**
   ````bash
   npm run dev
9. **Run the application: Start the Laravel development server:**
   ````bash
   php artisan serve
10. **Run background job manually (Optional for testing purposes): If you want to manually fetch the PageRank data from the OpenPageRank API:**
   ````bash
   php artisan fetch:page-rank     .
   ````
# Done Tasks

### Fetching and Storing PageRank Data:
- The application makes a daily API call to the OpenPageRank API and retrieves the PageRank of each domain from the provided JSON file.
- A Laravel job (`FetchPageRankJob`) was created to handle the API call and store the PageRank data in the database. It either saves new data or updates existing records.

### Vue.js Web Interface:
- The web page is built using Vue.js, displaying a paginated list of 100 domains per page.
- A search input is available to filter the list of domains by their names.

### Pagination and Search:
- The domains are displayed in a table with pagination, and a search box allows users to quickly find a specific domain.
- Both functionalities are handled in the Vue component `DomainList.vue`.

# Explanation of Key Components

### Laravel Job (`FetchPageRankJob`):
This is the core feature that fetches the PageRank data daily from the API and updates the database. It utilizes Laravel's job dispatching and queue systems.

### Vue.js Frontend:
The list of domains is managed and rendered by the `DomainList.vue` component, which interacts with the API to fetch and display paginated domain data. Tailwind CSS is used for styling the component.

### Tailwind CSS:
We use Tailwind CSS for styling the Vue component, providing a responsive and modern UI. The classes like `text-center`, `px-4`, `py-2`, etc., help align the content effectively.

### Daily Job Scheduling:
The Laravel Scheduler is used to ensure that the `FetchPageRankJob` runs daily. This is done in the `routes/console.php` file.

# Running Tests

**To run the automated tests, including those for fetching domain data and checking pagination:**
````bash
    php artisan test
````
**The test cases are located in the tests/Feature directory, including:**

- **PageRankControllerTest: Tests for the /api/domains endpoint to ensure the correct domain data is returned with pagination.**
- **FetchPageRankJobTest is a test case designed to verify the functionality of the FetchPageRankJob class in Laravel,**
**which is responsible for fetching and storing the PageRank data from the OpenPageRank API. This job typically runs on a schedule,**
**but for testing purposes, you can simulate its execution and confirm that it behaves as expected.**

