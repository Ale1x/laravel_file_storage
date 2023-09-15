# Laravel File Storage with GitHub Integration

## About

This application allows you to upload your school notes directly to a GitHub repository. Once authenticated with your GitHub account, you can configure your profile and upload files that will be automatically pushed to the specified repository.

## Features

- Login via GitHub
- Profile configuration with:
  - GitHub Token
  - Committer Name
  - Repository Name
  - Commit Message
- File upload following a specific naming convention (ACADEMIC_YEAR_COURSE_NAME_CHAPTER_DOCUMENT_NAME), for automatic push to your configured GitHub repository.

## Getting Started

1. Clone the repository:

    ```bash
    git clone https://github.com/Ale1x/laravel_file_storage.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel_file_storage
    ```

3. Install npm dependencies:

    ```bash
    npm i
    ```

4. Copy the example `.env` file:

    ```bash
    cp .env.example .env
    ```

5. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

## Configuration

You'll need to add some environment variables to your `.env` file:

\`
GITHUB_CLIENT_ID=your_client_id_here
GITHUB_CLIENT_SECRET=your_client_secret_here
GITHUB_REDIRECT_URI=your_redirect_uri_here
\`

### Generating OAuth Credentials

To generate the necessary OAuth credentials (Client ID & Client Secret), head to [GitHub Developer Settings](https://github.com/settings/developers).

### Setting the Callback URL

Set the Callback URL to `yourAppBaseUrl/auth/callback` in your GitHub Developer settings.

### ToDo

Here are some of the future enhancements that are planned:

- Support all file extensions: Currently, the application may have limitations on the types of files that can be uploaded. The goal is to extend this to support all file types.
- Support document versioning: Introduce version control for the documents being uploaded, allowing users to maintain multiple versions of the same file.
- Add tests with Pest: Implement unit and feature tests using Pest to ensure the application's reliability and stability.
- Automatically get GitHub token: Automate the process of obtaining a GitHub token to simplify the user experience.

Other improvements might include:

- User-friendly error messages and debugging options
- A dashboard to visualize upload statistics and repository status
- A search function to quickly find files in your repository
- Social sharing options for easily sharing your notes with classmates or colleagues
- Security enhancements like two-factor authentication
