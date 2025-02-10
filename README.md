# Candidate Testing Application

This is a Laravel-based candidate testing application built as a skill assessment assignment for RoyalApps. The application integrates with the Candidate Testing API to authenticate users and manage authors and books. It also includes an extra bonus feature—a custom Artisan command to add a new author via the CLI.

## Features

### 1. Authentication (Login)
- **Login Page:**  
  Users can log in using their email and password. Upon successful authentication via the Candidate Testing API, an access token is stored in the session.  
  *Includes both HTML5 and JavaScript-based form validation.*

### 2. Dashboard
- **User Profile & Logout:**  
  After logging in, the dashboard displays the logged-in user's first and last name along with a logout link.
- **Authors Table:**  
  Displays a list of authors fetched from the API in a table format. Each author has a "View" button to access detailed information.
- **Add New Book Link:**  
  Provides a link to a form for creating a new book.

### 3. Authors Management
- **Author Detail Page:**  
  Shows detailed information about a single author, including their biography and a list of books.
- **Conditional Delete Author:**  
  If an author has no associated books, a "Delete Author" button is displayed. Otherwise, the deletion option is not shown.

### 4. Books Management
- **Delete Book:**  
  On the author detail page, each book has a "Delete Book" button to allow individual deletion.
- **Create New Book:**  
  A dedicated form lets users create a new book. The form includes:
  - An Authors dropdown (populated via the API)
  - Fields for title, release date, description, ISBN, format, and number of pages  
  *Basic form validation is implemented on this page.*

### 5. Extra Bonus Feature
- **Artisan Command to Add a New Author:**  
  A custom Artisan command (`php artisan author:add`) is available to add a new author via the CLI. The command prompts for the necessary details and sends a POST request to the API.

## Getting Started

### Prerequisites
- **PHP:** Version 7.4 or higher (PHP 8.0+ recommended)
- **Composer**
- **Git**

### Installation Steps

1. **Clone the Repository:**
    ```bash
    git clone https://github.com/yourusername/yourrepository.git
    cd yourrepository
    ```

2. **Install Dependencies:**
    ```bash
    composer install
    ```

3. **Create the Environment File:**
    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5. **Configure API Credentials (if required):**
    - Open the `.env` file and add your API token (if needed):
      ```dotenv
      API_TOKEN=your_candidate_testing_api_token
      ```

6. **Run the Application:**
    ```bash
    php artisan serve
    ```
    - The application will be accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Running the Extra Artisan Command

To add a new author using the CLI, run:
```bash
php artisan author:add
