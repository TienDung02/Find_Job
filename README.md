

<p align="center">
    <span style="font-size: 24px;">Job search website</span>
    <br />
    <a href="https://github.com/TienDung02/Find_Job"><strong>Explore »</strong></a>
    <br />
</p>

    
    
    
</div>
  <!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#objectives">Project Objectives</a></li>
    <li><a href="#features">Features</a></li>
    <li><a href="#advancedfeatures">Advanced Features</a></li>
    <li><a href="#model">Entity-Relationship Diagram</a></li>
    <li><a href="#technology">Technologies Used</a></li>
    <li><a href="#setup">Laravel Project Setup Guide</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>
  
  
  <!-- ABOUT THE PROJECT -->
# <h2 id="objectives">Objectives of the Project</h2>
This is my personal project in the process of exploring and studying the Laravel framework, focusing on creating a system to assist with job searching.

The software aims to achieve the following objectives:
- Help users find suitable jobs quickly and conveniently.
- Provide convenience for both candidates and employers, allowing them to easily manage and update information.
- Ensure a simple and user-friendly interface.

# <h2 id="features">Summary of Features</h2>
- Candidates:<br/>
  + Login
  + Edit personal information
  + Change password
  + Apply for jobs
  + View job postings
  + View job details
  + View company information
  + Rate companies
  + Build and manage job seeker profiles
  + Bookmark jobs
- Employers:<br/>
  + Login
  + Manage company information
  + Post job vacancies
  + Manage jobs
  + Manage applications
  + Bookmark resumes
- Admin:<br/>
  + Manage comments (upon receiving reports)
  + Activate or deactivate job postings
  + Activate or deactivate company
  + Activate or deactivate candidates
  + Put the job in the spotlight
  + CURD Blog


# <h2 id="advancedfeatures">Advanced Features
- Meilisearch
- Messaging
- Commenting
- Send mail
- Pagination
- Filter and sorting options
- Load more

# <h2 id="technology">Technologies
<h4>Backend:
 <a href="https://laravel.com/docs/8.x/">Laravel 8</a>
<h4>Frontend:
 <a href="https://getbootstrap.com/">Bootstrap 5</a>
, <a href="">HTML</a>
, <a href="">CSS</a>
, <a href="">Jquery</a>
<h4>Database: 
 <a href="">MySQL</a>
  
# <h2 id="model">Entity-Relationship Diagram
![sơ đồ 2](https://github.com/TienDung02/Find_Job/blob/main/Worksout-ERD.png)


# <h2 id="setup">Laravel Project Setup Guide

Welcome to Worksout Laravel project! Below is a step-by-step guide to help you set up and run the project easily.

<h3>Prerequisites</h3> 

Before you begin, ensure you have the following software installed:

- **PHP** (compatible versions 7.3, 7.4, 8.0, 8.1)
- **Composer** (package manager for PHP)
- **MySQL** or **MariaDB** (or any database you have configured)
- **Node.js** và **npm** (if the project uses frontend)
- **Meilisearch** (if you are using Meilisearch for search functionality)

Step 1:  Clone the Project

Clone the project from GitHub to your local machine:
```bash
git clone https://github.com/TienDung02/Find_Job
```

Step 2: Install Dependencies

Navigate to the project directory and run the following command to install all necessary libraries and dependencies:
```bash
cd Find_Job
composer install
```
Step 3: Create Configuration File

Create a .env file from the sample .env.example file using the following command:
```bash
cp .env.example .env
```
If you are using Windows, use the following command:
```bash
copy .env.example .env
```
Step 4: Generate Application Key

Generate a unique application key for the project using the command:
```bash
php artisan key:generate
```
Step 5: Set Up the Database

Before running the following commands, make sure you have configured the database connection information in the .env file.

Then, run the following commands to wipe existing data (if any), perform migrations, and seed sample data:
```bash
php artisan db:wipe
php artisan migrate
php artisan db:seed
```
Step 6: Run Meilisearch

If your project uses Meilisearch, run the following command in the terminal to start Meilisearch:
```bash
meilisearch
```
Step 7: Import Data into Scout

Finally, run the following commands to import data into Scout:
```bash
php artisan scout:import "App\Models\Job"
php artisan scout:import "App\Models\CandidateResume"
```


# <h2 id="contact">Contact
Project Link: https://github.com/TienDung02/Find_Job </br>
Email: [nongtiendung2309@gmail.com]
