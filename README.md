# Gallery of Spatial Photos

This project is a **gallery of spatial photos** built using PHP with an object-oriented MVC methodology. The backend is powered by MongoDB, and the application leverages libraries for advanced photo processing.

---

## Features

### 1. File Upload
- **Supported Formats**: PNG, JPG
- **Size Limit**: Maximum file size is 1 MB.
- **Validation**:
  - File format and size checks with error messages for invalid inputs.
- **Storage**:
  - Uploaded images are stored in the `images` subdirectory under the application's `DocumentRoot` directory (ensure proper permissions for this directory).

### 2. Image Processing
- **Watermarking**:
  - A text watermark is applied to the original image. The watermark content is specified via a form field.
- **Thumbnail Generation**:
  - A 200x125-pixel thumbnail is created for each uploaded image.
- **PHP GD Library**:
  - All image processing uses the PHP GD library.

### 3. Photo Gallery
- Displays a paginated gallery of thumbnails.
- Clicking on a thumbnail shows the corresponding watermarked image in full size.
- Implements PHP directives (`include`, `include_once`, `require`, `require_once`) for modularity.

---

## Advanced Features

### **Database Usage**
- **Metadata Storage**:
  - Each uploaded photo is associated with a title and author. These details are stored in the MongoDB database.
- **Gallery Display**:
  - Titles and authors are displayed alongside photo thumbnails.

### **User Management**
- **Registration**:
  - Users can register with a form containing:
    - Email address, login, password, and password confirmation.
  - Passwords are securely hashed before storage in MongoDB.
- **Login**:
  - Users log in using their credentials.
  - Login status is managed via sessions.
- **Logout**:
  - Logged-in users can log out via an option in the UI.

### **Session Mechanism**
- Users can:
  - Select photos in the gallery using checkboxes.
  - Save selected photos in their session for future visits.
  - View and manage saved photos on a dedicated subpage, with options to remove photos from the saved set.

---

## User Differentiation
- **Private Photos**:
  - Logged-in users can choose to make photos "public" or "private".
  - Private photos:
    - Only visible to the user who uploaded them.
  - Public photos:
    - Visible to all users.
- **Automatic Author Attribution**

  - The "author" field is pre-filled with the logged-in user's login.

---

## AJAX Photo Search
- Implements an interactive search engine using AJAX.
- **Features**:
  - A text field allows users to search for photos by title.

  - As the user types, AJAX requests retrieve matching thumbnails asynchronously.
  - Matching results are dynamically displayed without reloading the page.
 
Some images:
![wai1](https://github.com/user-attachments/assets/cc4c2f24-4ef3-4293-b0a3-69d2f1baa73d)
:![wai6](https://github.com/user-attachments/assets/95f27df6-d5c2-48a7-9f9b-83e87bd6d8b8)
![wai5](https://github.com/user-attachments/assets/ba3c94d9-8dee-4090-ad5a-60a68273d815)
![wai4](https://github.com/user-attachments/assets/a2d7ca08-3a00-4a6b-9e4a-96217252e1e6)
![wai3](https://github.com/user-attachments/assets/88bd7091-3a92-4ca8-98ed-ae1ba540fe55)
![wai2](https://github.com/user-attachments/assets/47cdd2b9-2cde-4db5-8e7c-4ab947717162)

