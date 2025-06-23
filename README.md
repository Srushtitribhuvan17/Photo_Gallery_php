# Photo_Gallery_php

# Photo Gallery Website

## Project Overview

This is a simple Photo Gallery Website that allows users to register, log in, and manage their photo uploads. Users can upload photos with descriptions, view images uploaded by all users, and edit or delete their own photos. The dashboard displays photos as cards with details such as the uploader's name and description. It also provides options to generate CSV and PDF reports of the images, and a logout feature.

---

## Features

- **User Registration**: Users can create an account with secure password hashing.
- **User Login**: Authentication with session management.
- **Dashboard**:
  - View all uploaded images from all users.
  - Display image details: photo, description, uploader's username.
  - Edit and delete photos only by their owners.
- **Photo Upload**: Users can upload new photos with a description.
- **Generate Reports**:
  - Generate CSV file listing all photos and their details.
  - Generate PDF file with the same photo data.
- **Logout**: Securely log out the user.
- **Session-based Authorization**: Users can only edit or delete their own images.

---

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, Bootstrap (for styling)
- **Session Management**: PHP sessions
- **Password Security**: Passwords hashed using PHP's `password_hash()` function
- **Report Generation**: CSV and PDF generation via PHP libraries (e.g., TCPDF for PDF)

---

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone <your-repo-url>
   cd <your-project-directory>
   ```

````


2. **Setup Database**
   - Create a MySQL database (e.g., `photo_gallery`).
   - Import the following SQL schema:

     ```sql
     CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );

     CREATE TABLE photos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       image_path VARCHAR(255) NOT NULL,
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
     );
     ```

3. **Configure Database Connection**
   - Open the `db.php` file.
   - Update the database host, name, username, and password according to your MySQL setup.

4. **Start the Server**
   - Use a local server environment like XAMPP, WAMP, or LAMP.
   - Place the project folder inside the `htdocs` directory (XAMPP).
   - Start Apache and MySQL.
   - Open your browser and navigate to:
     ```
     http://localhost/Photo_Gallery_php/
     ```

---

## Usage

1. **Register**
   - Visit the registration page to create an account.
   - The password will be securely hashed before storage.

2. **Login**
   - Enter your credentials on the login page.
   - Upon success, you will be redirected to the dashboard.

3. **Dashboard**
   - View all uploaded images from all users.
   - Edit and delete buttons appear only on your own uploaded images.
   - Use the **Upload** button to add new photos.
   - Use **Generate CSV** or **Generate PDF** buttons to export image data.
   - Click **Logout** to securely end your session.

---

---

## Security Considerations

- Passwords are hashed using `password_hash()` and verified using `password_verify()`.
- Users must be authenticated to access the dashboard and perform any actions.
- Session ID is used to restrict access and editing rights.
- Uploaded files are checked for valid file types (like JPG, PNG) and file size limits.

---

## Future Enhancements

- Add pagination or infinite scroll for better UX.
- Add profile management for users.
- AJAX-based photo uploads and edits.
- Preview feature before uploading photos.
- Implement CSRF protection in all forms.

---


*Thank you for using the Photo Gallery Website! Feel free to contribute or suggest improvements.*


````
