# SpeakEase

**SpeakEase** is a language-learning platform designed and developed by **Tushti Savarn**, **Shruti Kumari **, and **Nihira Sinha ** as part of the 5th-semester **Multimedia & Web Designing project** at Banasthali Vidyapith (BCA 2022-25, Batch B).  
Our mission is to make learning new languages engaging, accessible, and user-friendly for enthusiasts around the world.

---

## 🌟 Features
- **User Registration and Login System**: Secure user authentication using PHP and MySQL.
- **6 Languages to Learn**:
  - **Asia**: Hindi, Japanese, Korean
  - **Europe**: German, French
  - **America**: English
- **Interactive Language Pages**: Each language has its dedicated page with resources and exercises.
- **Responsive Design**: Optimized for both desktop and mobile devices.

---

## 🛠️ Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Version Control**: Git

## ⚙️ Setup and Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/SpeakEase.git
   cd SpeakEase
   ```

2. **Set Up the Database**:
   - Import the `speakEase.sql` file in your MySQL database.
   - Configure the database connection in `includes/db_config.php`:
     ```php
     <?php
     $host = "localhost";
     $username = "root";
     $password = "";
     $dbname = "speakease";

     $conn = new mysqli($host, $username, $password, $dbname);

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

3. **Run the Application**:
   - Place the project folder in your local server directory (e.g., XAMPP `htdocs`).
   - Open `http://localhost/SpeakEase/` in your browser.

---

## 🎓 About the Team
We are students of **Banasthali Vidyapith (BCA 2022-25 Batch B)**, driven by a passion for creating innovative web solutions.  
- **Tushti Savarn**: 
- **Shruti Kumari**:
- **Nihira Sinha**:

---

## 💡 Vision
To empower language enthusiasts by providing a seamless platform that simplifies the process of learning new languages.

---

## 📬 Contact
- **Tushti Savarn**: [LinkedIn](https://linkedin.com/in/tushti-savarn)
- **Nihira Sinha**: [LinkedIn](https://www.linkedin.com/in/nihira-sinha-263311288/)
- **Shruti Kumari**: [LinkedIn](https://www.linkedin.com/in/shruti-kumari-622133319/)

---

**Speak new languages with ease. Start learning today!**
